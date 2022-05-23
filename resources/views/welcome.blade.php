@extends('layouts.admin')

@section('pageTitle', 'Home page')

@section('pageContent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center"><a href="{{ route('login')}}">Effettua il Login</a></h1>
        </div>
    </div>
</div>
@endsection
