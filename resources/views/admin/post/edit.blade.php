@extends('admin.layouts.app')

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Post</li>
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

                    @include('errors.errors')
                    
                    <!-- form start -->
                    <form role="form" action="{{ route('post.update', $post -> id) }}" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                      
                        <div class="card-body">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="title">Post Title</Title></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $post -> title }}" id="title">
                                    <p id="p_title"></p>
                                </div>
                                <div class="form-group">
                                    <label for="sub_title">Post Sub-Title</Title></label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Sub_title" value="{{ $post -> sub_title }}" id="sub_title">
                                    <p id="s_title"></p>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Post Slug</Title></label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $post -> slug }}" id="slug">
                                    <p id="p_slug"></p>
                                </div>
                
                            </div>

                            <div class="card card-outline card-info">
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
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $post -> body }}</textarea>
                                        <p id="body"></p>
                                    </div>

                                </div>
                            </div>
                                        
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" @if ($post -> status == 1) checked @endif>
                                <label class="form-check-label" for="status" name="status">Publish</label>
                            </div>
                                
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="post_update">Update</button>
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

@endsection