@extends('user/app')

@section('bg-img', asset('user/img/home-bg.jpg'))
@section('heading', 'POST HEADING')
@section('sub-heading', "Let's Learn together and Grow together")

@section('main-content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            @foreach ($posts as $post)
                <div class="post-preview">
                <a href="{{ route('show', $post -> post_id) }}">
                    <h2 class="post-title">
                        {{ $post -> title }}
                    </h2>
                    <h3 class="post-subtitle">
                        {{ $post -> sub_title }}
                    </h3>
                </a>
                <p class="post-meta d-inline-block">Author : 
                    <a href="#">{{ $post -> author_name }}</a>
                    <p class="post-meta d-inline-block">
                        &nbsp; Last Updated at : {{ $post -> updated_at }}
                    </p>
                </p>
                </div>
                <hr>
            @endforeach
            {{ $posts -> links() }}
        </div>
        </div>
    </div>
    <hr>

@endsection