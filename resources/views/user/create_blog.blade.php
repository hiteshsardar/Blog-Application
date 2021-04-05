<!DOCTYPE html>
<html lang="en">

<head>

  @include('user/layouts/head')

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#">Post Content</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ "Hi ".session('author_name') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="/user_logout">LogOut</a>
                  </li>
                </ul>
            </div>
        </div>
    </nav><br><br>

    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">    
                    <h1 id="head">Write Post</h1>
                    <style>
                        #head{
                            margin-left: 40%;
                        }
                    </style>
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

                    @include('errors.errors')
                    
                    <!-- form start -->
                    <form role="form" action="{{ route('blog_store', session('author_name')) }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}
                            
                        <div class="container card-body col-lg-6">
                            
                            @if (session('message'))
                                <div class="alert alert-danger">{{ session('message') }}</div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                                <div class="form-group">
                                    <label for="title">Post Title</Title></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" id="title">
                                    <p id="p_title"></p>
                                </div>
                                <div class="form-group">
                                    <label for="sub_title">Post Sub-Title</Title></label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Sub_title" id="sub_title">
                                    <p id="s_title"></p>
                                </div>
                            
                                <div class="form-group">
                                    <label for="slug">Post Slug</Title></label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" id="slug">
                                    <p id="p_slug"></p>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image Upload</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="image" name="image">
                                            {{-- <label class="custom-file-label" for="image">Choose file</label> --}}
                                        </div>
                                    </div>
                                </div>

                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Write Post body Here</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pad">
                                    <div class="mb-3">
                                        <textarea class="textarea" placeholder="Write body..." id="p_body" name="body" 
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        <p id="body"></p>
                                    </div>
                                    </div>
                            </div>
                                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" required>
                                <label class="form-check-label" for="status">Publish</label>
                            </div>
                                    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="user_post">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @include('user/layouts/footer')

</body>
<script src="{{ asset('js/validation.js') }}"></script>
</html>

