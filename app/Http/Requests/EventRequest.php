<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'events') {
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
            'new_event_name' => 'required|max:255',
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
            'new_event_name.required' => 'イベント名を入力してください',
        ];
    }
}
