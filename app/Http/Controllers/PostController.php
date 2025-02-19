<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $post->load('comments.user');
        return view('posts.show', compact('post'));
    }

    public function like($id)
    {
        $post = Post::findOrFail($id);
        
        $user = auth()->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            // Unlike the post
            $post->likes()->where('user_id', $user->id)->delete();
        } else {
            // Like the post
            $post->likes()->create(['user_id' => $user->id]);
        }

        return response()->json(['likes' => $post->likes()->count()]);
    }

    public function comment(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return response()->json([
            'user' => $comment->user->name,
            'content' => $comment->content
        ]);
    }
}
