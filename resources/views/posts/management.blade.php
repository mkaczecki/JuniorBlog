@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="row justify-content-center">
    <h3 class="col-11 text-center text-muted pb-4"><strong>Posts Management</strong></h3>
    <div class="col-11 col-md-7">
        <table class="table-borderless w-100">
            <thead>
            <tr class="h6 text-uppercase text-muted border-bottom border-muted">
                <th class="pb-4">
                    Title
                </th>
                <th class="pb-4">
                    Published
                </th>
                <th class="pb-4">
                    Edit
                </th>
                <th class="pb-4">
                    Delete
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($posts as $post)
            <tr class="h5 border-bottom border-muted align-items-center">
                <td class="py-3 px-2">
                    {{$post->title}}
                </td>
                <td class="px-2">
                    {{ $updated[$post->id] }}
                </td>
                <td class="px-2">
                    <a href="/posts/edit/{{ $post->id }}" class="rounded bg-gradient-primary py-1 px-4 text-white h6 text-uppercase">Edit</a>
                </td>
                <td class="px-2">
                    <form action="/posts/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded bg-gradient-danger py-1 px-3 text-white h6 text-uppercase my-3" style="border: none; outline: none;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <td class="py-3">
                    No posts.
                </td>
            @endforelse
            </tbody>
        </table>
        <div class="row pt-4 pb-5">
            {{ $posts->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
