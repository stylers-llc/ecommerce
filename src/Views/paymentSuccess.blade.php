@extends('master')

@section('title', 'Success Payment')

@section('content')
    <div class="alert alert-success">
        <strong>{{ $success }}</strong>
    </div>
@endsection