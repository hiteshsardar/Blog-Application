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

                        <p>{{ $posts['body'] }} 
                            &nbsp;&nbsp;<a name="like" id="like" onclick="Post_like()" style="cursor: pointer">
                                <i class="fa fa-thumbs-o-up"></i>
                                <label id="post_like">{{ $posts['like'] }}</label>
                            </a>&nbsp;&nbsp;&nbsp;&nbsp; 
                            <a name="dislike" id="dislike" onclick="Post_Dislike()" style="cursor: pointer">
                                <i class="fa fa-thumbs-o-down" style="color:red" ></i>
                                <label id="post_dislike">{{ $posts['dislike'] }}</label>
                            </a>
                        </p>
                        
                            @foreach ($post_image as $post_img)
                                <a href="#">
                                    <img class="img-fluid" src="{{ asset('img/'.$post_img['image']) }}" 
                                    alt="Image Source isn't found."><br>
                                </a> 
                                <label style="font-size: 15px">Img : {{ $loop->iteration }}</label><br><br>
                            @endforeach
                                   

                    </div>
                </div><br>
                <form action="{{ route('user_comment', $posts['post_id']) }}" method="POST">
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
                        {{ $comment -> comments }}

                        &nbsp;&nbsp;<a name="like" id="like" onclick="comment_like()" style="cursor: pointer">
                            <i class="fa fa-thumbs-o-up"></i>
                            <label id="comment_like">{{ $comment -> like }}</label>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp; 
                        <a name="dislike" id="dislike" onclick="comment_Dislike()" style="cursor: pointer">
                            <i class="fa fa-thumbs-o-down" style="color:red" ></i>
                            <label id="comment_dislike">{{ $comment -> dislike }}</label>
                        </a>

                    </p>
                @endforeach
                {{-- {{ $comments -> links() }} --}}
                
            </div>
        </article>

        <hr>
        <script>
            function Post_like(){
              
                var _token = $('input[name = _token]').val();
        
                $.ajax({
                  url:'{{ route("post_Like", $posts["post_id"]) }}',
                  type:'post',
                  data:{_token: _token},
                  datatype:"JSON",
        
                  success : function(data){
                    $("#post_like").text(data.like);
                  }
                });
            
            }

            function Post_Dislike(){
              
              var _token = $('input[name = _token]').val();
      
              $.ajax({
                url:'{{ route("post_Dislike", $posts["post_id"]) }}',
                type:'post',
                data:{_token: _token},
                datatype:"JSON",
      
                success : function(data){
                  $("#post_dislike").text(data.like);
                }
              });
          
            }

            function comment_like(){
              
              var _token = $('input[name = _token]').val();
      
              $.ajax({
                url:'{{ route("comment_Like", $posts["post_id"]) }}',
                type:'post',
                data:{_token: _token},
                datatype:"JSON",
      
                success : function(data){
                  $("#comment_like").text(data.like);
                }
              });
          
          }

          function comment_Dislike(){
            
            var _token = $('input[name = _token]').val();
    
            $.ajax({
              url:'{{ route("comment_Dislike", $posts["post_id"]) }}',
              type:'post',
              data:{_token: _token},
              datatype:"JSON",
    
              success : function(data){
                $("#comment_dislike").text(data.like);
              }
            });
        
          }
      
        </script>
    @endsection
    