<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'guest') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'names' => 'required_without_all:guest_name, company_name',
            // 'guest_event_name' => 'required|max:255',
        ];
    }
    
    /**
     * メッセージのカスタマイズ
     * 
     * 
     */
    public function messages()
    {
        return [
            'names.required_without_all' => 'ご芳名または会社名を入力してください',
        ];
    }
}
