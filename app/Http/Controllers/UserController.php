<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

            if($user->role_id ===1){
                return view('user-home',['user'=>$user],compact('posts','comments'));
            }else{
                return redirect()->route('login')->withErrors(['msg'=>'Unauthorized access']);
            }
        }

        return redirect()->route('login');
    }

    public function showIntroduce()
    {
        $user = Auth::user();
        return view('introduce',compact('user'));
    }

    public function showContact()
    {
        $user = Auth::user();
        return view('contact',compact('user'));
    }

    public function showHome()
    {
        $posts = Post::with(['listImages', 'location'])
            ->where('approved', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        $comments = Comment::where('approved',1);
        return view('home',compact('posts','comments'));
    }


    public function showProfilePage()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        $comments = Comment::where('user_id', $user->id)->get();
        return view('profile', compact('user', 'posts', 'comments'));
    }

    public function updateProfile(Request $request)
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

        return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin thành công.');
    }

}
