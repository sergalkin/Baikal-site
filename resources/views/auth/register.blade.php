@extends('layouts.app')

@section('content')
    <main class="register-bg">
        <registration-component csrf="{{csrf_token()}}"></registration-component>
    </main>
@endsection
