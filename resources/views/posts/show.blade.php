@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 offset-2 bg-white">
                <div class="row align-items-center">
                    <div class="col-4 text-center">
                        <img class="w-75 rounded-circle" src="storage/images/{{$post->image}}"/>
                        <div class="w-100 text-muted h5 pt-3">
                            {{$post->user->name}}
                        </div>
                    </div>
                    <div class="col-8 h2">
                        {{$post->title}}
                    </div>
                </div>
                <div class="row px-5 py-5">
                    <p class="h5">{{ $post->content }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
