@extends('user/app')

    @section('bg-img', asset('user/img/post-bg.jpg'))
    @section('heading', 'POST VIEW')
    @section('sub-heading', "Let's Learn together and Grow together")

    @section('main-content')
         <!-- Post Content -->
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        
                        <h2 class="section-heading">{{ $posts['title'] }}</h2>

                        <p>{{ $posts['sub_title'] }}</p>

                        <blockquote class="blockquote">{{ $posts['slug'] }}</blockquote>

                        <p>{{ $posts['body'] }}</p>
                        <a href="#">
                            <img class="img-fluid" src="{{ asset('img/'.$posts['image']) }}" alt="Image Source isn't found.">
                        </a>            

                    </div>
                </div><br>
                <form action="{{ route('user_comment', $posts['id']) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h6 class="card-title">Write Comments</h6>
                        </div>
                        <!-- /.card-header -->
                        @include('errors.errors')

                        <div class="card-body pad text-right">
                            <div class="mb-3">
                                <textarea class="textarea" placeholder="Your comments is Valuable for us" id="comment" name="comment" 
                                style="width: 100%; height: 50px; font-size: 14px; line-height: 8px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                <p id="post_comment"></p>
                            </div>
                        
                                <button type="submit" class="btn btn-primary" id="">Comment</button>
                            
                        </div>
                    </div>
                </form><br>
                @foreach ($comments as $comment)
                    <p>{{ $comment -> user_name }}<br>
                        {{ $comment -> comments }}</p>
                @endforeach
                {{-- {{ $comments -> links() }} --}}
                
            </div>
        </article>

        <hr>
    @endsection