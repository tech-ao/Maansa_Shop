<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    private static function mirrorToPublic($path, $name)
    {
        try {
            $src = storage_path('app/public/' . $path . '/' . $name);
            $pubDir = public_path('storage/' . $path);
            if (!file_exists($pubDir)) {
                @mkdir($pubDir, 0775, true);
            }
            if (file_exists($src)) {
                @copy($src, $pubDir . '/' . $name);
            }
        } catch (\Throwable $e) {}
    }

    public static function handleUploadedImage($file, $path, $delete = null)
    {
        if ($file) {

            if ($delete) {
                Storage::delete($path . '/' . $delete);
                @unlink(public_path('storage/' . $path . '/' . $delete));
            }

            $name = Str::random(4) . $file->getClientOriginalName();
            Storage::putFileAs($path, $file, $name);
            self::mirrorToPublic($path, $name);

            return $name;
        }
    }


    public static function uploadSummernoteImage($file, $path)
    {

        if (!file_exists($path)) {
            @mkdir($path, 0777, true);
        }

        if ($file) {

            $name = 'OM_' . time() .  Str::random(8) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs($path, $file, $name);
            self::mirrorToPublic($path, $name);

            return $name;
        }
    }



    public static function ItemhandleUploadedImage($file, $path, $delete = null)
    {
        if ($file) {

            if ($delete) {
                Storage::delete($path . '/' . $delete);
                @unlink(public_path('storage/' . $path . '/' . $delete));
            }

            $photoName = 'OM_' . time() .  Str::random(8) . '.' . $file->getClientOriginalExtension();
            $thumbnailName = 'OM_' . time() .  Str::random(8) . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs($path, $file, $photoName);
            self::mirrorToPublic($path, $photoName);

            $image = \Image::make($file)->resize(230, 230);
            $thumbnailPath = $path . '/' . $thumbnailName;
            Storage::put($thumbnailPath, (string) $image->encode());
            self::mirrorToPublic($path, $thumbnailName);

            return [$photoName, $thumbnailName];
        }
    }

    public static function handleUpdatedUploadedImage($file, $path, $data, $delete_path, $field)
    {

        $name = 'OM_' . time() .  Str::random(8) . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs($path, $file, $name);
        self::mirrorToPublic($path, $name);

        if ($data[$field] != null) {
            Storage::delete($delete_path . '/' . $data[$field]);
            @unlink(public_path('storage/' . $delete_path . '/' . $data[$field]));
        }

        return $name;
    }


    public static function ItemhandleUpdatedUploadedImage($file, $path, $data, $delete_path, $field)
    {

        $photoName = 'OM_' . time() .  Str::random(8) . '.' . $file->getClientOriginalExtension();
        $thumbnailName = 'OM_' . time() . Str::random(8) . '.' . $file->getClientOriginalExtension();

        $image = \Image::make($file)->resize(230, 230);
        $thumbnailPath = $path . '/' . $thumbnailName;
        Storage::put($thumbnailPath, (string) $image->encode());
        self::mirrorToPublic($path, $thumbnailName);

        $photoPath = $path . '/' . $photoName;
        Storage::putFileAs($path, $file, $photoName);
        self::mirrorToPublic($path, $photoName);

        if (!empty($data['thumbnail'])) {
            Storage::delete($delete_path . '/' . $data['thumbnail']);
            @unlink(public_path('storage/' . $delete_path . '/' . $data['thumbnail']));
        }

        if (!empty($data[$field])) {
            Storage::delete($delete_path . '/' . $data[$field]);
            @unlink(public_path('storage/' . $delete_path . '/' . $data[$field]));
        }

        return [$photoName, $thumbnailName];
    }


    public static function handleDeletedImage($data, $field, $delete_path)
    {
        if (!empty($data[$field])) {
            Storage::delete($delete_path . '/' . $data[$field]);
            @unlink(public_path('storage/' . $delete_path . '/' . $data[$field]));
        }
    }
}
