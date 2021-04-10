@extends('admin.layouts.app')

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Write Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Write Post</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Titles</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    @if (session('message'))
                        <div class="alert alert-danger">{{ session('message') }}</div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @include('errors.errors')
                    
                    <!-- form start -->
                    <form role="form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">Post Title</Title></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                    <p id="p_title"></p>
                                </div>
                                <div class="form-group">
                                    <label for="sub_title">Post Sub-Title</Title></label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Sub_title">
                                    <p id="s_title"></p>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Post Slug</Title></label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                                    <p id="p_slug"></p>
                                </div>
                                <div class="form-group">
                                    <label for="author_name">Author</Title></label>
                                    <select name="author_name" id="author_name" class="form-control">
                                        <option value="Select">Select</option>
                                        @foreach ($author_list as $author)
                                            <option value="{{ $author -> name }}">{{ $author -> name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="author"></p>
                                </div>
        
                                <div class="container">
                                    <label for="image">Image Upload</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="image" name="image[]" multiple>
                                        </div>
                                    </div> 
                                    <input type="text" id="img_titles">
                                    <div id="image-to-upload"></div>        
                                </div>
                            </div>

                            <br><div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Write Post body Here</h3>
                                    <!-- tools box -->
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                        title="Collapse"> <i class="fas fa-minus"></i></button>
                                    </div>
                                        <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pad">
                                    <div class="mb-3">
                                        <textarea class="textarea" placeholder="Write body..." name="body" id="p_body"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        <p id="body"></p>
                                    </div>

                                </div>
                            </div>
                                        
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status">
                                <label class="form-check-label" for="status">Publish</label>
                            </div>
                                
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="admin_post">Submit</button>
                                <a class="btn btn-warning" href="{{ route('post.index') }}">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>
        $('#image').on('change', function(e){
            var files = e.target.files;

            $.each(files, function(i, file){

                var reader = new FileReader();
                reader.readAsDataURL(file);

                reader.onload = function(e){
                    var template = '<form>'+
                        '<br><img src="'+e.target.result+'" style="width:50px">&nbsp;&nbsp;'+
                        '<lavel>&nbsp;&nbsp;Image Title : </label>'+
                        '<input type="text" id="img_title" placeholder="Title of Image">&nbsp;&nbsp;'+
                        '<a class="btn btn-danger" href="#">Remove</a>'+        
                    '</form>';
                    
                    $('#image-to-upload').append(template);
                };

            });
            
        });

        $('#img_title').on('change', function(){
            alert("Hitesh");
            // var img_titles = $('#img_title').val();
            // $('#img_titles').append(img_titles);
        });

    </script>
@endsection