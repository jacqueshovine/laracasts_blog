@extends('layout')

@section('banner')
    <h1>My blog</h1>
@endsection

@section('content')
    @foreach($posts as $post)
        <article>
            <h1>
                <a href="/posts/{{ $post->slug }}">
                    {{-- PHP syntax <?= $post->title; ?> --}}

                    {{ $post->title }}
                </a>
            </h1>

            <div>
                {{ $post->excerpt }}
            </div>
        </article>
    @endforeach
@endsection

