<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'book_img' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|max:50',
            'author' => 'required|max:50',
            'publication_date' => 'required|max:11',
            'price' => 'required|max:20',
            'score' => 'required|max:3',
            'caption' => 'required|max:1000',
            'body' => 'required|max:2000',
            'upfile' => 'nullable|max:102400',
            'upmovie-url' => 'nullable|url',
        ];
    }

    public function attributes()
    {
        return [
            'book_img' => '本の画像',
            'title' => 'タイトル',
            'author' => '著者',
            'publication_date' => '出版日',
            'price' => '価格',
            'score' => '評点',
            'caption' => '見出し',
            'body' => '本文',
            'upfile' => '添付ファイル',
            'upmovie-url' => '動画へのURL',
        ];
    }
}
