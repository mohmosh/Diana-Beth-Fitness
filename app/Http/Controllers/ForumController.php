<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // Display all categories
    public function index()
    {
        $categories = Category::all();
        return view('forum.index', compact('categories'));
    }

    // Display threads in a category
    public function showCategory(Category $category)
    {
        $threads = $category->threads()->with('user')->get();
        return view('forum.category', compact('category', 'threads'));
    }

    // Display posts in a thread
    public function showThread(Thread $thread)
    {
        $posts = $thread->posts()->with('user')->get();
        return view('forum.thread', compact('thread', 'posts'));
    }

    // Store a new post in a thread
    public function storePost(Request $request, Thread $thread)
    {
        $request->validate(['content' => 'required']);
        $thread->posts()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        return back()->with('success', 'Post added!');
    }
}

