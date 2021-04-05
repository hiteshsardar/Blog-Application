@extends('admin.layouts.app')

@section('main-content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Text Editors</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Text Editors</li>
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
                            <h3 class="card-title">Tags</h3>
                        </div>
                        <!-- /.card-header -->

                        @include('errors.errors')

                        <!-- form start -->
                        <form role="form" action="{{ route('tag.update', $tag -> id) }}" method="POST">

                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="card-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Tag title</Title></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="tag title" value="{{ $tag -> name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Tag Slug</Title></label>
                                        <input type="text" class="form-control" id="slug" name="slug" placeholder="tag Slug" value="{{ $tag -> slug }}">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a class="btn btn-warning" href="{{ route('tag.index') }}">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
