<x-layout>
    <x-slot:title>
        Posts
    </x-slot>

    <ul>
        @if ($published)
            @foreach ($published as $post)
                <li>
                    <h2>
                        {{ $post->title }}
                    </h2>
                    <p>
                        {{ $post->content }}
                    </p>
                </li>
            @endforeach
        @else
            <p>
                No Post published yet
            </p>
        @endif

    </ul>
</x-layout>
