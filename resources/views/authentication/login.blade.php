@extends('layout.auth')

@section('content')
<!-- <h1 class="auth-title">Login</h1> -->
@if(Session::has('response'))
    {!!Session::get('response')['message']!!}
@endif
<div class="card ">
    <div class="card-header text-center">
        <a href="../index.html"><img class="logo-img" src="./public/assets/images/logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span>
    </div>
    <div class="card-body">
    <form action="{{route('login.check')}}" method="post">
    @csrf
            <div class="form-group">
                <input name="PhoneNumber" value="{{old('PhoneNumber')}}" class="form-control form-control-lg" id="username" type="text" placeholder="PhoneNumber" autocomplete="off">
                @if($errors->has('PhoneNumber'))
                    <small class="d-block text-danger">
                        {{$errors->first('PhoneNumber')}}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <input name="password" class="form-control form-control-lg" id="password" type="password" placeholder="Password">
                @if($errors->has('password'))
                    <small class="d-block text-danger">
                        {{$errors->first('password')}}
                    </small>
                @endif
            </div>
           
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </form>
    </div>
    <div class="card-footer bg-white p-0  ">
        <div class="card-footer-item card-footer-item-bordered">
            <a href="{{route('register')}}" class="footer-link btn btn-success btn-sm btn-block">Create An Account</a>
        </div>
    </div>
</div>

@endsection