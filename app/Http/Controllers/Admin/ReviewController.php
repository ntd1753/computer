<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $review = Review::whereNull('parent_id')->status($request->get('status'))
            ->orderBy('created_at', 'desc')->paginate(10);

        // Trả về view với các review đã phân loại
        return view('content.review.index', [
            'reviews' => $review,
        ]);
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        // Trả về view chi tiết review
        return view('content.review.edit', [
            'review' => $review,
        ]);
    }
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->status = $request->post('status');

        if ($request->post('reply_content') !== null) {
            Review::create([
                'user_id' => null,
                'product_id' => $review->product_id,
                'rating' => null,
                'review_content' => $request->post('reply_content'),
                'image_url' => null,
                'parent_id' => $review->id, // Đặt parent_id để liên kết với review gốc
                'status' => Review::STATUS_APPROVED,
            ]);
        }
        $review->save();

        return response()->json(['success' => true, 'message' => __('update success'),
            'url' => route('review.index')]);
    }
}
