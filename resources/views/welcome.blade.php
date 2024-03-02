@extends('layouts.app')
@section('title')
    Toghether
@endsection

@section('content')
    @if ($posts->count() > 0)
        <x-post-list :posts="$posts" />
    @endif

    @if (count($posts_all) > 0)
        <x-post-list :posts="$posts_all" maybe='1' />
    @endif
@endsection
