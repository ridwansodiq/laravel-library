<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBook extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'isbn'=> 'required|unique:book_list,isbn',
            'title' => 'required|unique:book_list,title|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
            'book_cover' => 'required|image|mimes:jpeg,gif,png,jpg,PNG,JPG,JPEG|max:500',
            'book_category' => 'required|exists:categories,_id',
            'published_year' => 'required|integer',
            'publisher' => 'required|max:255',
        ];
    }

    public function response(array $errors)
    {
        return response()->json(['error' => $errors]); 
    }
}