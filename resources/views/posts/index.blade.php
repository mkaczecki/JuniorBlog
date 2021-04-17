@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @forelse($posts as $post)
            <div class="col-12 border-bottom border-muted pb-4 pt-3">
                <div class="row align-items-center">
                    <div class="h2 text-left w-100 pt-3">
                        <strong>{{$post->title}}</strong>
                    </div>
                    <div class="text-muted text-left w-100 h5 pt-0 pb-3">
                        {{$post->user->name}}
                    </div>
                </div>
                <div class="row">
                    <p class="text-muted h6 py-2">
                        {{$updated[$post->id]}}
                    </p>
                    <p class="h5 text-justify">
                        @if($post->image != null)
                        <img class="img-thumbnail float-left mr-3 mb-1"
                             src="/storage/images/{{ $post->image }}"
                             style="max-width: 200px; max-height: 200px;"/>
                        @endif
                        @if( strlen($post->content) > 500 )
                        {{ substr($post->content,0, 500)}}
                            ...&ensp;<a href="/posts/{{ $post->id }}">Read More</a>
                        @else
                            {{ $post->content }}
                        @endif

                    </p>
                </div>
            </div>
            @empty
                No posts in database!
            @endforelse
            <div class="row pt-4 pb-5">
                {{ $posts->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
@endsection
