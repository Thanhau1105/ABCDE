<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để bình luận.');
        }

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:255',
            'postId' => 'required|exists:posts,id',
        ]);


        $comment = Comment::create([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            'post_id' => $request->input('postId'),
            'user_id' => Auth::id(),
            'approved' => false,
        ]);


        return redirect()->route('post.detail', ['id' => $comment->post_id])
            ->with('success', 'Bình luận của bạn đã được gửi. Chờ duyệt.');
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('user.profile')->with('success', 'Bài đăng đã được xóa thành công.');
    }

}
