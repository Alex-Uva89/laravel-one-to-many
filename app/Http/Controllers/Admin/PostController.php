<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

class PostController extends Controller
{

    private function getValidators($model) {
        return [
            // 'user_id'   => 'required|exists:App\User,id',
            'title'     => 'required|max:100',
            'slug'      => [
                'required',
                Rule::unique('posts')->ignore($model),
                'max:100'
            ],
            'category_id' => 'required|exists:App\Category,id',
            'content'   => 'required'
        ];
    }

    public function index(Request $request)
    {

        $posts = Post::where('id', '>', 0);

        if ($request->searchTitle) {
            $posts = $posts->where('title', 'like', "%$request->searchTitle%");
        }

        if($request->category) {
            $posts = $posts->where('category_id', $request->category);
        }

        if($request->author) {
            $posts = $posts->where('user_id', $request->author);
        }

        $posts = $posts->paginate(20);

        $categories = Category::all();
        $users = User::all();


        return view('admin.posts.index', [
            'posts'      => $posts,
            'categories' => $categories,
            'users'      => $users
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',  compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate($this->getValidators(null));

        $formData = $request->all() + [
            'user_id' => Auth::user()->id
        ];
        $post = Post::create($formData);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        if (Auth::user()->id !== $post->user_id) abort(403);
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));

        $post->update($request->all());

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
