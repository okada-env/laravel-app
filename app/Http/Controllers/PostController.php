<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request)
    {
        $company_id = $request->company_id;
        return view('post.create', compact('company_id'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'company_id' => 'required|exists:companies,id' ← 削除
        ]);
    
        $post = new Post();
        $post->title = $request->title;
        $post->user_id = auth()->user()->id;
        $post->company_id = $request->company_id ?? null;
        $post->contact_person = '';
        $post->save();
    
        return back()->with('message', '投稿を作成しました');
    }

    public function index()
    {
        $posts = Post::all();
        $user = auth()->user();
        return view('post.index', ['posts' => $posts]);
    }
    
    public function show(Post $post, Request $request)
    {
        $person_keyword = $request->input('person_keyword');
        $peopleQuery = $post->people();

        if (!empty($person_keyword)) {
            $peopleQuery->where('contact_person', 'LIKE', "%{$person_keyword}%");
        }

        $people = $peopleQuery->get();

        return view('post.show', compact('post', 'people'));
    }
    
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }
    
    public function update(Request $request, Post $post)
    {  
        $inputs = $request->validate([
            'title' => 'required|max:255',
            // 'body' => 'required|max:255',
            // 'contact_person' => 'required|max:255',
            'image' => 'image|max:1024'
        ]);

        $post->title = $inputs['title'];
        // $post->body = $inputs['body'];
        // $post->contact_person = $inputs['contact_person'];
                
        $post->save();

        return back()->with('message', '投稿を更新しました');
    }
    
    public function destroy(Post $post)
    {        
        $post->delete();
        return redirect()->route('home')->with('message', '投稿を削除しました');
    }


}
