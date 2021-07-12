<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function model()
    {
        return new Post();
    }

    public function home()
    {
        return view('posts', [
            'posts' => Post::latest()
                ->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString(),
            'categories' => Category::all(),
            'currentCategory' => Category::firstWhere('slug', request('category'))

        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }

    public function index()
    {
        $data = Post::with(['category', 'author'])->get();
        return view('post.index', ['data' => $data]);
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('post.create', ['categories' => $categories, 'users' => $users]);
    }

    public function store(PostRequest $request)
    {
        $validate = $request->validated();
        if ($validate) {
            $this->model()->create($validate);
            return redirect()->route('post.index');
        } else {
            return new Error();
        }
    }

    public function getUpdateById($id)
    {
        $categories = Category::all();
        $users = User::all();
        $data = Post::with(['category', 'author'])->find($id);
        return view('post.update', ['data' => $data, 'categories' => $categories, 'users' => $users]);
    }

    public function update(PostRequest $request)
    {
        $data = Post::findOrFail($request->input('post_id'));
        if ($request->validated($data)) {
            $data->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'excerpt' => $request->excerpt,
                'body' => $request->body,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
            ]);
            return redirect()->route('post.index');
        } else {
            return new \http\Exception\InvalidArgumentException('Has not validate');
        }
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('post.index');
    }



}
