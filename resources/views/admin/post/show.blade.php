@extends('admin.layouts.app')

@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Posts Page</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active">Posts Page</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Posts</h3>&nbsp;&nbsp;
                <a class="col-lg-offset-5 btn btn-success" href="{{ route('post.create') }}">Add New Post</a>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <h3 class="card-title">&nbsp;Post DataTable</h3>
                        </div>
                        <form action="/search" method="GET">
                            <div class="input-group">
                                <input type="search" name="search" id="search" class="form-control" placeholder="Search by title">
                                <span class="input-group-prepend">
                                    <button class="btn btn-primary" id="search_btn">Search</button>
                                </span>
                                
                                <div class="dropdown">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="dropbtn" disabled> Sorting </button>
                                    <div class="dropdown-content">
                                        <a href="{{ route('assending_order') }}">Assendig</a>
                                        <a href="{{ route('descending_order') }}">Descending</a>
                                    </div>
                                </div>
                               
                            </div>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        <table id="post_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Slug</th>
                                    <th>Author_name</th>
                                    <th>Post_status</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $loop -> index + 1 }}</td>
                                        <td>{{ $post -> title }}</td>
                                        <td>{{ $post -> sub_title }}</td>
                                        <td>{{ $post -> slug }}</td>
                                        <td>{{ $post -> author_name }}</td>
                                        <td>{{ $post -> status }}</td>
                                        <td>{{ $post -> created_at }}</td>
                                        <td><a href="{{ route('post.edit', $post -> id) }}">Edit</span></a></td>
                                        <td><form id="delete-form-{{ $post -> id }}" method="POST" 
                                            action="{{ route('post.destroy', $post -> id) }}" style="display: none">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            </form>
                                            <a href="" onclick="
                                            if(confirm('Are you Sure, to Delete this Data?')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $post -> id }}').submit();
                                            } else {
                                                event.preventDefault();
                                            }">Delete</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card-body -->
                {{ $posts -> links() }}
            </div>

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
