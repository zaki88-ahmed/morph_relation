<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getPostRules($this->input('class'));
    }

    public function getPostRules($class){
        $rules = [];
        switch ($class){
            case "addPost":
                $rules = [
                    'content' => 'required',
                ];
                break;
            case "deletePost":
                $rules = [
                    'post_id' => 'required|exists:posts,id',
                ];
                break;
            case "updatePost":
                $rules = [
                    'content' => 'required',
//            '     status' => 'in:0,1',
                    'post_id' => 'required|exists:posts,id',
                ];
                break;
            case "specificPost":
                $rules = [
                    'post_id' => 'required|exists:posts,id',
                ];
                break;
        }
        return $rules;
    }
}
