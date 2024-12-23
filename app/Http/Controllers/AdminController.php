<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        if(Auth::check()){
            $user = Auth::user();

            $posts = Post::with(['listImages','location'])
                ->where('approved', 1)
                ->orderBy('created_at','desc')
                ->get();

            $comments = Comment::where('approved', 1)->get();

            if($user->role_id ===2){
                return view('admin-home',['user'=>$user], compact('posts','comments'));
            }else{
                return redirect()->route('login')->withErrors(['msg'=>'Unauthorized']);
            }
        }

        return redirect()->route('login');
    }

    public function showUserManagementPage()
    {
            $user = Auth::user();
            $users = User::with(['posts', 'comments'])->get();
            return view('user-management',compact('users','user'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $user->posts()->delete();
        $user->comments()->delete();

        $user->delete();
        return redirect()->route('user.management');
    }

    public function showPostManagementPage()
    {
        $posts = Post::all();
        return view('post-management', compact('posts'));
    }

    public function showCommentManagementPage()
    {
        $comments = Comment::all();
        return view('comment-management',compact('comments'));
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('comment.management');
    }

    public function showProfileAdmin()
    {
        $user = Auth::user();
        return view('admin-profile',['user'=>$user]);
    }

    public function updateProfileAdmin(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
        ]);


        $user->update([
            'full_name'=> $request->input('full_name'),
            'phone'=> $request->input('phone'),
        ]);

        return redirect()->route('admin.profile')->with('success', 'Cập nhật thông tin thành công.');
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('post.management');
    }

}
