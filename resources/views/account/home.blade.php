@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="my-4">Account Info {{$user->email}}</h1>
        </div>
    </div>
</div>
@endsection
