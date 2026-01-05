<x-layout>
    <x-slot:title>
        Eidt Post
    </x-slot:title>

    <form action="{{ route('edit.post', $id) }}" method="post">
        @csrf
        @method('put')

        <div>
            <label for="title">
            Title
        </label>
        <input type="text" name="title" id="title" value="{{ $post->title }}">
        </div>
        @error('title')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="content">
            Content
        </label>
        <input type="text" name="content" id="content" value="{{ old('content', $post->content )}}">
        </div>
        @error('content')
            <p>{{ $message }}</p>
        @enderror

        <input type="checkbox" name="publish" id="publish" value="yes" {{ $post->is_published ? 'checked' : '' }}>
        <label for="publish">Publish Now</label>

        <button type="submit">Submit</button>
    </form>
</x-layout>
