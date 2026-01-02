<x-layout>
    <x-slot:title>
        Create Post
    </x-slot:title>

    <form action="/create_post" method="post">
        @csrf

        <div>
            <label for="title">
            Title
        </label>
        <input type="text" name="title" id="title">
        </div>
        @error('title')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="content">
            Content
        </label>
        <input type="text" name="content" id="content">
        </div>
        @error('content')
            <p>{{ $message }}</p>
        @enderror

        <input type="checkbox" name="publish" id="publish" value="yes">
        <label for="publish">Publish Now</label>

        <button type="submit">Submit</button>
    </form>
</x-layout>
