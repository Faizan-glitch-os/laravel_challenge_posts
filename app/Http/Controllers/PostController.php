<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $published = Post::where('is_published', '=', true)->get();
        $unPublished = Post::where('is_published', '=', false)->get();


        return view('posts', [
            'published' => $published,
            'unPublished' => $unPublished
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('create_post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'publish' => 'nullable'
        ]);
        $isPublished = $request->has('publish');


        Post::create([
            'title' => $incomingData['title'],
            'content' => $incomingData['content'],
            'is_published' => $isPublished ? true : false,
            'published_at' => $isPublished ? now() : null
        ]);

        return to_route('home')->with('message', 'Post Created Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'required|string']);
        $id = $validator->safe()->only('id');

        $post = Post::where('id', '=', $id)->first();

        if ($post) {
            return view('edit_post', ['post' => $post, 'id' => $id['id']]);
        }

        return back()->with('message', 'No such post found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incomingData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'publish' => 'nullable'
        ]);
        $isPublished = $request->has('publish');

        $validator = Validator::make(['id' => $id], ['id' => 'required|string']);
        $id = $validator->safe()->only('id');

        $post = Post::find($id['id']);
        if ($post) {
            $post->title = $incomingData['title'];
            $post->content = $incomingData['content'];
            $post->is_published = $isPublished ? true : false;

            $post->save();

            return to_route('home')->with('message', 'Succesfully edited');
        }

        return back()->with('message', 'No such post found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'required|string']);
        $id = $validator->safe()->only('id');
        $post = Post::destroy($id);

        if ($post) {
            return to_route('home')->with('message', 'Succesfully deleted');
        }

        return back()->with('message', 'No Post found to delete');
    }
}
