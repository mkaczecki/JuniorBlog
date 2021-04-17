@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 bg-white">
                <div class="row align-items-center">
                    <div class="h1 text-center w-100 pt-3">
                        <strong>{{$post->title}}</strong>
                    </div>
                    <div class="text-muted text-center w-100 h5 pt-0 pb-4">
                        {{$post->user->name}}
                    </div>
                </div>
                <div class="row">
                    <p class="text-muted h6 py-2">
                        {{$updated }}
                    </p>
                    <p class="h5 text-justify">
                        @if($post->image != null)
                        <img class="img-thumbnail float-left mr-3 mb-1"
                             src="/storage/images/{{ $post->image }}"
                             style="max-width: 300px; max-height: 300px;"/>
                        @endif
                        {{ $post->content }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
