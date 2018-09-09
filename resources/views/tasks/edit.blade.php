@extends('layouts.main')

@section('content')

<form action="{{route('tasks.update',$task->id)}}" method="post">
    @csrf
    <div class="form-group col-md-8">
    @isadmin
 
        <select class="form-control  margin-select-top" name="assignto">
            @foreach($coworkers as $coworker)
                <option value="{{$coworker->worker->id}}">{{$coworker->worker->name}}</option>
            @endforeach
        </select>
  


    @endisadmin
    
  
        <input type="name" class="form-control margin-top"  name="content" placeholder="{{$task->content}}">
        <button class="btn btn-success margin-top">Edit Task </button>
    </div>

    {{Form::hidden('_method','PUT')}}

</form>




@endsection