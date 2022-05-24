<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use Psy\Util\Str;

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
            'content'     => 'required',
            'tags'        => 'array|exists:App\Tag,id',
        ];
    }

    public function index(Request $request)
    {

        $posts = Post::where('id', '>', 0);

        if ($request->searchTitle) {
            $posts->where(function($query) use ($request) {
                $query->where('title', 'like', "%$request->searchTitle%")
                    ->orWhere('description', 'like', "%$request->searchTitle%");
            });
            $posts->where('title', 'like', "%$request->searchTitle%");
        }

        if($request->category) {
            $posts->where('category_id', $request->category);
        }

        if($request->author) {
            $posts->where('user_id', $request->author);
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
        $tags = Tag::all();
        return view('admin.posts.create',  compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->getValidators(null));

        $formData = $request->all() + [
            'user_id' => Auth::user()->id
        ];

        // preg_match_all('/\#([a-zA-Z0-9]+)/', $formData['content'], $tags_from_content);

        // foreach ($tags_from_content[1] as $tag) {
        //     $newTags = Tag::create([
        //         'name' => $tag,
        //         // 'slug' => Str::slug($tag)
        //         'slug' => $tag
        //     ]);
        //     $tagIds[] = $newTags->id;
        // }

        // $formData['tags'] = $tagIds;

        // Tag::create(array_map(function($tag) {
        //     return ['name' => $tag];
        // }, $tags_from_content[1]));

        $post = Post::create($formData);
        $post->tags()->attach($formData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));

        $formData = $request->all();

        $post->update($formData);
        $post->tags()->sync($formData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
