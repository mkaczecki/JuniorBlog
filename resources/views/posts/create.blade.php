@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <div class="row justify-content-center">
        <h3 class="col-11 text-center text-muted pb-4"><strong>Publish New Post</strong></h3>
        <div class="col-11 col-md-7">
            <form method="POST" action="/posts" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input name="title" placeholder="Post Title" class="form-control" id="title" type="text"
                           value="{{ old('title') }}" class="@error('title') is-invalid @enderror" required>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                <textarea name="content" placeholder="Write here something amazing..."
                          class="form-control" id="content"
                          class="@error('content') is-invalid @enderror"
                          rows="20" style="resize: none;" required>{{ old('content') }}
                </textarea>
                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input name="image" class="form-control-file" id="image"
                           type="file" class="@error('image') is-invalid @enderror">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary col-12 col-md-3 py-2 mt-3">Publish</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
