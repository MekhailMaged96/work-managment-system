
@if(Session::has('success'))
<div class="alert alert-success margin-top" role="alert">
    <strong>Success: </strong>{{Session::get('success') }}
</div>
@endif

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <strong>Errors:</strong>
    @foreach($errors->all() as $error )
        <p> {{$error}} </p> 
    @endforeach 
</div>
@endif
