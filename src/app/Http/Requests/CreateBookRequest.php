<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 認証されているとみなす
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string,string>
     */
    public function rules()
    {
        return [
            'author_id' => 'required|numeric',
            'title'     => 'required|min:4|max:15',
        ];
    }
}