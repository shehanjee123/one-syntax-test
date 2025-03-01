@extends('frontend.inc.app')
@section('title', env('APP_NAME').' | Home')

@section('css')

@endsection

@section('content')
    <h2>{{ $post_title }}</h2>
    <p>{{ $post_description }}</p>
@endsection


@section('js')

@endsection