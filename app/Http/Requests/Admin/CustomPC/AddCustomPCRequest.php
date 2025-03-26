<?php

namespace App\Http\Requests\Admin\CustomPC;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddCustomPCRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'discount_type'=> 'nullable|in:1,99',
            'discount_value' => 'nullable|numeric|min:0',
            'category_id' => 'required|not_in:Chọn Danh Mục',
            'images' => 'required|array|min:1',
            'CPU_id' => 'required',
            'RAM_id' => 'required',
            'VGA_id' => 'nullable',
            'SSD_id' => 'nullable|required_without:HDD_id',
            'HDD_id' => 'required|required_without:SSD_id',
            'PSU_id' => 'required',
            'case_id' => 'required',
            'fan_id' => 'nullable',
            'CPU_Fan_id' => 'nullable|required_without:AIOFan_id',
            'AIOFan_id' => 'nullable|required_without:CPU_Fan_id',

        ];
        return $rules;
    }
    /**
     * Customize error messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'category_id.not_in' => 'Vui lòng chọn một danh mục hợp lệ.',
            'brand_id.not_in' => 'Vui lòng chọn một nhãn hàng hợp lệ.',
            'cost.numeric' => 'Chi phí phải là một số.',
            'price.numeric' => 'Giá phải là một số.',
            'discount_value.numeric' => 'Giá trị giảm giá phải là một số.',
            'images.required' => 'Hình ảnh sản phẩm là bắt buộc.',
            'images.array' => 'Hình ảnh sản phẩm phải là một mảng.',
            'images.min' => 'Hình ảnh sản phẩm phải chứa ít nhất một phần tử.',
            'CPU_id.required' => 'CPU là bắt buộc.',
            'RAM_id.required' => 'RAM là bắt buộc.',
            'SSD_id.required_without' => 'SSD hoặc HDD là bắt buộc.',
            'HDD_id.required' => 'SSD hoặc HDD là bắt buộc.',
            'PSU_id.required' => 'Nguồn là bắt buộc.',
            'case_id.required' => 'Case là bắt buộc.',
            'CPU_Fan_id.required_without' => 'CPU Fan hoặc AIO Fan là bắt buộc.',
            'AIOFan_id.required_without' => 'CPU Fan hoặc AIO Fan là bắt buộc.',
            'fan_id.required' => 'Fan là bắt buộc.',

        ];
    }
}
