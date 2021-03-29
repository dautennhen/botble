<?php

namespace Theme\Missuniversity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThisinhRequest extends FormRequest
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

    public function rules()
    {
        return [
            'mssv' => 'required',
            'id_truong' => 'required',
            'id_nam_hoc' => 'required',
            'ho' => 'required',
            'ten' => 'required',
            'sdt' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'chieu_cao' => 'required',
            'so_do_ba_vong' => 'required',
            'khoa_nganh' => 'required',
            'sdt_nguoi_than' => 'required|numeric|digits:10',
            'dia_chi' => 'required',
            'can_nang' => 'required',
            'ngay_sinh' => 'required'
        ];
    }
    
    protected function prepareForValidation()
    {
        $ngay_sinh = $this->year.'-'.$this->month.'-'.$this->date;
        if(empty($this->year) || empty($this->month) || empty($this->date))
            $ngay_sinh = '';
        $this->merge(['ngay_sinh'=> $ngay_sinh ]);
    }

    public function messages()
    {
        return [];
    }
    
    public function attributes()
    {
        return [
            'mssv' => 'mã số sinh viên',
            'id_truong' => 'tên trường',
            'id_nam_hoc' => 'năm học',
            'ho' => 'họ',
            'ten' => 'tên',
            'sdt' => 'số điện thoại',
            'email' => 'email',
            'chieu_cao' => 'chiều cao',
            'can_nang' => 'cân nặng',
            'so_do_ba_vong' => 'số đo ba vòng',
            'khoa_nganh' => 'khoa ngành',
            'sdt_nguoi_than' => 'số điện thoại người thân',
            'dia_chi' => 'địa chỉ',
            'ngay_sinh' => 'ngày sinh',
        ];
    }
}
