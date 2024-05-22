<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new Post;
    }

    public function addPost(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        if ($validation->fails()) return back()->withInput()->with(['status' => 'warning', 'message' => implode('<br>', $validation->errors()->all())]);

        $this->post->create([
            'title' => trim($request->title),
            'body' => trim($request->body),
            'user_id' => auth()->user()->id,
            'stars' => 0
        ]);

        return back()->with('success', 'Successfully added.');
    }

    public function editPost(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'id' => 'required'
        ]);

        if ($validation->fails()) return back()->withInput()->with('warning', implode('<br>', $validation->errors()->all()));

        $post = $this->post->find($request->id);

        if (!$post) return back()->withInput()->with('warning', "Post not exist.");

        $this->authorize('update', $post);

        $post->update([
            'title' => trim($request->title),
            'body' => trim($request->body)
        ]);

        return back()->with('success', 'Successfully updated.');
    }

    public function deletePost($postId)
    {
        $post = $this->post->find($postId);

        if (!$post) {
            return response(['status' => 'warning', 'message' => 'Post does not exist.'], 404);
        }

        // Ensure the user is authorized to delete the post
        $this->authorize('delete', $post);

        $post->delete();

        return response(['status' => 'success', 'message' => 'Post successfully deleted.']);
    }

    public function starPost($postId)
    {
        $post = $this->post->find($postId);

        if (!$post) return response(['status' => 'warning', 'message' => 'Post not exist.']);

        $post->update([
            'stars' => $post->stars += 1
        ]);

        return response([]);
    }
}
