<?php

namespace App\Http\Requests;

use App\Models\Accessory;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class AddAccessoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'discount_value' => 'nullable|numeric|min:0',
            'category_id' => 'required|not_in:Chọn Danh Mục',
            'brand_id' => 'required|not_in:Chọn Nhãn Hàng',
        ];

        $productType = $this->input('product_type'); // Xác định loại sản phẩm
        switch ($productType) {
            case Accessory::TYPE_MAINBOARD:
                $rules = array_merge($rules, [
                    'socket' => 'required|string|max:255',
                    'chipset' => 'required|string|max:255',
                    'ram_slot' => 'required|string|max:255',
                    'size' => 'required|string|max:255',
                ]);
                break;

            case Accessory::TYPE_CPU:
                $rules = array_merge($rules, [
                    'core_type' => 'required|string|max:255',
                    'core_series' => 'required|string|max:255',
                    'socket' => 'required|string|max:255',
                ]);
                break;

            case Accessory::TYPE_VGA:
                $rules = array_merge($rules, [
                    'vga_series' => 'required|string|max:255',
                    'memory_type' => 'required|string|max:255',
                    'memory_size' => 'required|string|max:255',
                    'inteface' => 'required|string',
                    'export_port' => 'nullable|string',
                ]);
                break;

            case Accessory::TYPE_PSU:
                $rules = array_merge($rules, [
                    'power_output' => 'required|string|max:255',
                    'power_standard' => 'required|string|max:255',
                    'connector_type' => 'required|string|max:255',
                ]);
                break;

            case Accessory::TYPE_RAM:
                $rules = array_merge($rules, [
                    'ram_type' => 'required|string|max:255',
                    'memory_type' => 'required|string|max:255',
                    'memory_size' => 'required|string|max:255',
                    'bus' => 'required|string|max:255',
                ]);
                break;

            case Accessory::TYPE_CASE:
                $rules = array_merge($rules, [
                    'case_type' => 'required|string|max:255',
                    'material' => 'required|string|max:255',
                    'mainboard_size' => 'required|string|max:255',
                    'color' => 'nullable|string|max:255',
                ]);
                break;

            case Accessory::TYPE_STORAGE:
                $rules = array_merge($rules, [
                    'storage_type' => 'required|in:SSD,HDD',
                    'size' => 'required|string|max:255',
                    'SSD_type' => 'required|string|max:255',
                    'HDD_SPEED' => 'required|string|max:255',
                    'HDD_CACHE' => 'required|string|max:255',
                ]);
                break;

            case Accessory::TYPE_FAN:
                $rules = array_merge($rules, [
                    'type' => 'required|in:AirFan,AIOFan,CaseFan',
                    'CPU_socket' => 'required|string|max:255',
                    'height' => 'required|string|max:255',
                    'fan_size' => 'required|string|max:255',
                    'led_type' => 'required|string|max:255',
                ]);
                break;

            default:
                throw new \Exception('Loại sản phẩm không hợp lệ.');
        }

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

            // MainBoard
            'socket.required' => 'Trường socket là bắt buộc.',
            'chipset.required' => 'Trường chipset là bắt buộc.',
            'ram_slot.required' => 'Trường ram slot là bắt buộc.',
            'size.required' => 'Trường size là bắt buộc.',

            // CPU
            'core_type.required' => 'Trường core type là bắt buộc.',
            'core_series.required' => 'Trường core series là bắt buộc.',

            // VGA
            'vga_series.required' => 'Trường vga series là bắt buộc.',
            'memory_type.required' => 'Trường memory type là bắt buộc.',
            'memory_size.required' => 'Trường memory size là bắt buộc.',
            'inteface.required' => 'Trường inteface là bắt buộc.',

            // PSU
            'power_output.required' => 'Trường công suất là bắt buộc.',
            'power_standard.required' => 'Trường chuẩn nguồn là bắt buộc.',
            'connector_type.required' => 'Trường kiểu dây kết nối là bắt buộc.',

            // RAM
            'ram_type.required' => 'Trường ram_type là bắt buộc.',
            'bus.required' => 'Trường bus là bắt buộc.',

            // CASE
            'case_type.required' => 'Trường case_type là bắt buộc.',
            'material.required' => 'Trường material là bắt buộc.',
            'mainboard_size.required' => 'Trường mainboad_size là bắt buộc.',

            // Storage
            'storage_type.required' => 'Trường storage_type là bắt buộc.',
            'storage_type.in' => 'storage_type phải là SSD hoặc HDD.',

            // Fan
            'type.required' => 'Trường type là bắt buộc.',
            'type.in' => 'Type phải là AirFan, AIOFan hoặc CaseFan.',
            'fan_size.required' => 'Trường fan size là bắt buộc.',
            'led_type.required' => 'Trường led type là bắt buộc.',
            'height.required' => 'Trường height là bắt buộc.',

        ];
    }
}
