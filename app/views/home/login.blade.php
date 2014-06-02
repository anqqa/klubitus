@extends('layouts.aside')

@section('content')
	@include('home._login', [ 'form' => $form ])
@stop
