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
                <form action="{{ route('delete.post', $post->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button>Delete</button>
                </form>

                <form action="{{ route('edit.post', $post->id) }}" method="get">
                    @csrf
                    <button>Edit</button>
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
                    <form action="{{ route('delete.post', $post->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button>Delete</button>
                    </form>

                <form action="{{ route('edit.post', $post->id) }}" method="get">
                    @csrf
                    <button>Edit</button>
                </form>
                </li>
            @endforeach
        </ul>
    @endif

</x-layout>
