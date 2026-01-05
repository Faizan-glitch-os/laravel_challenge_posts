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

        return redirect('/', 302);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
            return redirect('/')->with('message', 'Succesfully deleted');
        }

        return back()->with('message', 'No Post found to delete');
    }
}
