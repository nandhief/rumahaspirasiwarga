<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->action == 'datatable') {
            $posts = Post::query();

            return \DataTables::of($posts)->toJson();
        }

        return view('posts.index');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);
        $post = Post::create(array_merge($request->all(), [
            'slug' => \Str::slug($request->name),
        ]));

        return ['message' => 'Berhasil disimpan'];
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);
        $post->update($request->all());

        return ['message' => 'Berhasil diupdate'];
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return ['message' => 'Berhasil dihapus'];
    }
}
