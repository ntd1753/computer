<?php

namespace App\Http\Requests\PC;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddPcRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',  // Assuming the slug is unique in the posts table
            'cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'discount_type' =>  ['nullable', Rule::in(array_keys(Product::$listDiscount))],
            'discount_value' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Assuming the category_id references the 'categories' table
            'brand_id' => 'nullable|exists:brands,id', // Assuming the brand_id references the 'brands' table
            'description' => 'nullable|string',
            'content' => 'required|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'product_type' => 'nullable|string',  // Based on the fillDataPreBuiltPCDetail method
            'screen_size' => 'nullable|numeric|min:1|max:100',
            'cpu' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'ram_memory' => 'required|string',
            'battery_life' => 'nullable|numeric|min:1|max:100',
            'vga' => 'required|string|max:255',
            'mainboard' => 'nullable|string|max:255',
            'power_supply' => 'nullable|string|max:255',
            'cpu_fan' => 'nullable|string|max:255',
            'hdd_size' => 'nullable|string|min:1',
            'ssd_size' => 'nullable|string|min:1',
            'dataSheet' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'required', // Assuming the images are uploaded and need to be validated
            'quantity' => 'required|integer|min:1',
        ];
    }
}
