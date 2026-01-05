<x-layout>
    <x-slot:title>
        Posts
    </x-slot>

    @if ($published->isEmpty() && $unPublished->isEmpty())
        <p>No Posts to see here</p>
    @endif

    @if (!$published->isEmpty())
    <h1>Published Posts</h1>
    <ul>
        @foreach ($published as $post)
            <li>
                <h2>
                    {{ $post->title }}
                </h2>
                <p>
                    {{ $post->content }}
                </p>
                <form action="/delete_post/{{ $post->id }}" method="POST">
                    @method('delete')
                    @csrf
                    <button>Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
    @endif

    @if (!$unPublished->isEmpty())
        <h1>Unpublished Posts</h1>
        <ul>
            @foreach ($unPublished as $post)
                <li>
                    <h2>
                    {{ $post->title }}
                    </h2>
                    <p>
                    {{ $post->content }}
                    </p>
                    <form action="/delete_post/{{ $post->id }}" method="POST">
                    @method('delete')
                    @csrf
                    <button>Delete</button>
                </form>
                </li>
            @endforeach
        </ul>
    @endif

</x-layout>
