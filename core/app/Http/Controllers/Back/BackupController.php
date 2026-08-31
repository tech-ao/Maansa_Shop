<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;
use Zip;

class BackupController extends Controller
{
     /**
     * Constructor Method.
     *
     * Setting Authentication
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
    }

    
    public function systemBackup()
    {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $timestamp = date('Y-m-d_H-i-s');
        $zip_file = 'system-backup-' . $timestamp . '.zip';

        // Store temporarily in storage/app/backups
        $backupDir = storage_path('app' . DIRECTORY_SEPARATOR . 'backups');
        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0777, true);
        }
        $zipPath = $backupDir . DIRECTORY_SEPARATOR . $zip_file;

        $dir = public_path();
        $rootPath = realpath($dir);

        if (!$rootPath || !is_dir($rootPath)) {
            return back()->with('error', __('Target directory for backup was not found.'));
        }

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($rootPath, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                $pathName = $file->getPathname();
                $filePath = $file->getRealPath();

                // Exclude junctions/symlinks, directories, and invalid paths
                if (!$filePath || is_dir($pathName) || is_dir($filePath) || is_link($pathName)) {
                    continue;
                }

                // Exclude backup output file, temporary dir, and unreadable files
                if ($filePath === $zipPath || strpos($filePath, $backupDir) === 0 || !is_file($filePath) || !is_readable($filePath)) {
                    continue;
                }

                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
            $zip->close();

            if (file_exists($zipPath) && filesize($zipPath) > 0) {
                return response()->download($zipPath, $zip_file, [
                    'Content-Type' => 'application/zip',
                ])->deleteFileAfterSend(true);
            }
        }

        return back()->with('error', __('System backup could not be completed.'));
    }

    public function databaseBackup()
    {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $dbName = config('database.connections.mysql.database') ?: env('DB_DATABASE');

        $tables = DB::select('SHOW TABLES');
        $tableNames = [];
        foreach ($tables as $table) {
            $tableArr = (array)$table;
            $tableNames[] = reset($tableArr);
        }

        $connect = DB::connection()->getPdo();

        $output = "-- --------------------------------------------------------\n";
        $output .= "-- Database Backup for: " . $dbName . "\n";
        $output .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
        $output .= "-- --------------------------------------------------------\n\n";
        $output .= "SET FOREIGN_KEY_CHECKS=0;\nSET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n\n";

        foreach ($tableNames as $table) {
            $statement = $connect->prepare("SHOW CREATE TABLE `" . $table . "`");
            $statement->execute();
            $show_table_result = $statement->fetch(\PDO::FETCH_ASSOC);

            if ($show_table_result && isset($show_table_result['Create Table'])) {
                $output .= "\n-- --------------------------------------------------------\n";
                $output .= "-- Table structure for table `" . $table . "`\n";
                $output .= "-- --------------------------------------------------------\n\n";
                $output .= "DROP TABLE IF EXISTS `" . $table . "`;\n";
                $output .= $show_table_result["Create Table"] . ";\n\n";
            }

            $select_query = "SELECT * FROM `" . $table . "`";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            if ($total_row > 0) {
                $output .= "-- Dumping data for table `" . $table . "`\n";
                while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                    $columns = array_keys($row);
                    $escaped_cols = array_map(function($c) { return '`' . str_replace('`', '``', $c) . '`'; }, $columns);
                    $escaped_vals = array_map(function($v) use ($connect) {
                        if ($v === null) {
                            return 'NULL';
                        }
                        return $connect->quote($v);
                    }, array_values($row));

                    $output .= "INSERT INTO `" . $table . "` (" . implode(", ", $escaped_cols) . ") VALUES (" . implode(", ", $escaped_vals) . ");\n";
                }
                $output .= "\n";
            }
        }

        $output .= "SET FOREIGN_KEY_CHECKS=1;\n";

        $file_name = 'database_backup_on_' . date('Y-m-d_H-i-s') . '.sql';
        $backupDir = storage_path('app' . DIRECTORY_SEPARATOR . 'backups');
        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0777, true);
        }
        $filePath = $backupDir . DIRECTORY_SEPARATOR . $file_name;
        file_put_contents($filePath, $output);

        return response()->download($filePath, $file_name, [
            'Content-Type' => 'application/sql',
        ])->deleteFileAfterSend(true);
    }
}
