<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layouts.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        @section('main-content')
            @show

        @include('admin.layouts.footer')
    </div>
    
</body>
<script src="{{ asset('js/validation.js') }}"></script>
</html>