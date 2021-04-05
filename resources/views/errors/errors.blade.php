@if (count($errors) > 0)
    @foreach ($errors -> all() as $error)
        <div class="alert-danger">{{ $error }}</div><br>
    @endforeach                        
@endif