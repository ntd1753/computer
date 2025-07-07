<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        // Lấy tất cả bộ lọc từ cơ sở dữ liệu
        $filters = Filter::all();

        return view('content.filter.index', compact('filters'));
    }

    // Hiển thị form chỉnh sửa bộ lọc
    public function edit($id)
    {
        // Lấy bộ lọc theo ID
        $filter = Filter::findOrFail($id);

        return view('content.filter.edit', compact('filter'));
    }

    // Xử lý cập nhật bộ lọc
    public function update(Request $request, $id)
    {


        // Lấy bộ lọc theo ID
        $filter = Filter::findOrFail($id);
        // Cập nhật giá trị mới cho bộ lọc
        $filter->value = json_encode($request->values); // Chuyển mảng giá trị thành JSON
        $filter->save();

        // Quay lại trang trước với thông báo thành công
        return redirect()->route('filters.edit', $id)->with('success', 'Bộ lọc đã được cập nhật!');
    }
}
