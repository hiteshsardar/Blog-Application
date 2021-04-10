<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Admin </b>Register</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      @if (session('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>
      @endif
      @include('errors.errors')

      <form action="{{ route('admin.admin_register') }}" method="POST">

        {{ csrf_field() }}

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="name" id="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <p id="e_name"></p>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <p id="e_email"></p>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <p id="e_pass"></p>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="cpassword" id="cpass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <p id="e_cpass"></p>
        
        <div class="card-body">
          <div class="form-group">
            <div class="col-md-8" style="padding:75px border-right:1px solid #ddd">
              <p><label for="image">Select Image</label></p>
              <input type="file" name="upload_image" id="upload_image" accept="image/*"/><br>
            </div>

            <input type="text" value="" style="display: none" name="admin_img" id="admin_img">
            <br><div id="uploaded_image" align="center">
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="admin_register">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="/admin_login" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<div id="uploadImageModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h4 class="modal-title">Upload & Crop Image</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8 text-center">
            <div id="image_demo" style="width:350px; margin-top:30px"></div>
          </div>
          <div class="col-md-4" style="padding-top: 30px;">
            <br>
            <br>
            <br>
            <button class="btn btn-success crop_image">Crop & Upload</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div> 
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" />

</body>

<script>
  $(document).ready(function(){

    $image_crop = $('#image_demo').croppie({
      enableExif:true,

      viewport: {
        width:200,
        height:200,
        type:'square'
      },

      boundary: {
        width:300,
        height:300
      }
    });

    $('#upload_image').on('change', function(){
      var reader = new FileReader();

      reader.onload = function(event){
        $image_crop.croppie('bind', {
          url: event.target.result,
        }).then(function(){
          console.log("Jquery Bind Complete");
        });
      }

      reader.readAsDataURL(this.files[0]);
      $('#uploadImageModal').modal('show');
    });

    $('.crop_image').click(function(event){
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response){
        var _token = $('input[name = _token]').val();

        $.ajax({
          url:'{{ route("image_crop.upload") }}',
          type:'post',
          data:{"image" : response, _token: _token},
          datatype:"JSON",

          success : function(data){

            $('#uploadImageModal').modal('hide');
            var crop_image = '<img src=" admin_img/'+ data.path +'"/>';
            $("#admin_img").val(data.path);
            $('#uploaded_image').html(crop_image);
          }
        });
      })
    });
  });
</script>
<script src="{{ asset('js/validation.js') }}"></script>
</html>
