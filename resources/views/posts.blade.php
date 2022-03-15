<x-layout>
    @foreach($posts as $post)
        <article>
            <h1>
                <a href="/posts/{{ $post->slug }}">
                    {{-- PHP syntax <?= $post->title; ?> --}}

                    {!! $post->title !!}
                </a>
            </h1>

            <p>
                By <a href="/authors/{{ $post->author->username }}">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug}}">{{ $post->category->name }}</a>
            </p>

            <p>
                <a href="/categories/{{ $post->category->slug}}">{{ $post->category->name }}</a>
            </p>

            <div>
                {{ $post->excerpt }}
            </div>
        </article>
    @endforeach
</x-layout>
