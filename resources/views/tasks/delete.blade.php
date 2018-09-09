@extends('layouts.main')

@section('content')
<form  action="{{route('tasks.destroy',$task->id)}}" method="post">
    @csrf
    <h2> Are You sure to delete  {{$task->content}}  </h2>
    <button class="btn btn-danger">Delete </button>

    {{Form::hidden('_method','delete')}}

</form>


@endsection