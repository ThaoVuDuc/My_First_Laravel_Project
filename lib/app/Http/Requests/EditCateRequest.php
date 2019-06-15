<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCateRequest extends FormRequest
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
            //
            'name'=>'unique:categories,cate_name,'.$this->segment(4).',cate_id'
            //4 tham số là : tên bảng, cột cần xét trùng, giá trị điều kiện, cột điều kiện
            //segment là lấy giá trị trên url ở vị trí thứ 4 sau /
        ];
    }
    public function messages(){
        return [
            'name.unique'=>'tên danh mục đã tồn tại'
        ];
    }
}
