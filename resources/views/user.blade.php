@extends('layouts.app')

@section('content')
    <User name="{{Auth::user()->name}}"></User>
@endsection