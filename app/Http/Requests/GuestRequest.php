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
            'guest_event_name.required' => 'ご芳名を入力してください',
        ];
    }
}
