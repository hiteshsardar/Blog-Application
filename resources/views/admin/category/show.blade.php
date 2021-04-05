@extends('admin.layouts.app')

@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Categories Page</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active">Categories Page</li>
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
            <h3 class="card-title">Categories</h3>&nbsp;&nbsp;
            <a class="col-lg-offset-5 btn btn-success" href="{{ route('category.create') }}">Add New</a>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category DataTable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="category_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Tag Name</th>
                                <th>Slug</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $category -> name }}</td>
                                    <td>{{ $category -> slug }}</td>
                                    <td><a href="{{ route('category.edit', $category -> id) }}">Edit</span></a></td>
                                        <td><form id="delete-form-{{ $category -> id }}" method="POST" 
                                            action="{{ route('category.destroy', $category -> id) }}" style="display: none">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            </form>
                                            <a href="" onclick="
                                            if(confirm('Are you Sure, to Delete this Data?')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $category -> id }}').submit();
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
            {{ $categories -> links() }}
        </div>
        <!-- /.card-body -->
        
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

