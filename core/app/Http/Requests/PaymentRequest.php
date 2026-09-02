<?php

namespace App\Http\Requests;

use App\Helpers\PriceHelper;
use App\Models\ShippingService;
use App\Models\State;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (PriceHelper::CheckDigital() && !$this->shipping_id) {
            $cart_total = 0;
            if (Session::has('cart')) {
                foreach (Session::get('cart') as $key => $item) {
                    $cart_total += ($item['main_price'] + $item['attribute_price']) * $item['qty'];
                }
            }
            $free_shipping = ShippingService::whereStatus(1)->whereIsCondition(1)->first();
            if ($free_shipping && $cart_total >= $free_shipping->minimum_price) {
                $shipping_id = $free_shipping->id;
            } else {
                $paid = ShippingService::whereStatus(1)->where('id', '!=', 1)->first();
                $shipping_id = $paid ? $paid->id : ($free_shipping ? $free_shipping->id : 1);
            }
            if ($shipping_id) {
                $this->merge(['shipping_id' => $shipping_id]);
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        if(PriceHelper::CheckDigital() == false){
            return [];
        }
        $state = State::whereStatus(1)->count() != 0  ? 'required' : '';
        
        $shipping = ShippingService::whereStatus(1)->count() == 0 || PriceHelper::CheckDigital() == true? 'required' : '';

        if($this->single_page_checkout == 1){
            return [
                'state_id' => $state,
                "shipping_id" => $shipping,
                'bill_first_name' => 'required|max:100',
                'bill_last_name' => 'required|max:100',
                'bill_email' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
                ],
                'bill_phone' => [
                    'required',
                    'regex:/^[0-9]{10,15}$/'
                ],
                'bill_address' => 'required|max:255',
                'bill_city' => 'required|max:100',
                'bill_zip' => [
                    'required',
                    'regex:/^[0-9]{5,10}$/'
                ],
            ];
        }else{
            return [
                'state_id' => $state,
                "shipping_id" => $shipping,
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'state_id.required'   => __('Please select your shipping state.'),
            'shipping_id.required'   => __('Please select your shipping method.'),
            'bill_email.regex' => __('Please enter a valid e-mail address (e.g. name@example.com).'),
            'bill_phone.regex' => __('Please enter a valid mobile number (10 to 15 digits, numbers only).'),
            'bill_zip.regex' => __('Please enter a valid postal / zip code (numbers only).'),
        ];
    }

}
