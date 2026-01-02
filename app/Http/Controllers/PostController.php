<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function Symfony\Component\Clock\now;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $published = Post::where('is_published', '=', true)->get();

        return view('posts', ['published' => $published]);
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

        return redirect('/published_posts', 302);
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
        //
    }
}
