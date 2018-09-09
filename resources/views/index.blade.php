@extends('layouts.main')

@section('content')


    
    @isadmin
          @include('partials.admin')
    @endisadmin

    @isworker
        @include('partials.worker')
    @endisworker
@endsection