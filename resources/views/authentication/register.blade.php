@extends('layout.auth')

@section('content')
<!-- <h1 class="auth-title">Sign Up</h1> -->
@if(Session::has('response'))
    {!!Session::get('response')['message']!!}
@endif

<form class="splash-container" action="{{route('register.store')}}" method="post">
@csrf
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1">Registrations Form</h3>
                <p>Please enter your user information.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input name="FullName" value="{{old('FullName')}}" class="form-control form-control-lg" type="text" name="nick" required="" placeholder="Full Name" autocomplete="off">
                    @if($errors->has('FullName'))
                        <small class="d-block text-danger">
                            {{$errors->first('FullName')}}
                        </small>
                    @endif
                </div>
                <div class="form-group position-relative has-icon-left mb-3">
                    <input name="PhoneNumber" value="{{old('PhoneNumber')}}" type="text" class="form-control form-control-xl" placeholder="Phone Number">
                    <div class="form-control-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    @if($errors->has('PhoneNumber'))
                        <small class="d-block text-danger">
                            {{$errors->first('PhoneNumber')}}
                        </small>
                    @endif
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="EmailAddress" value="{{old('EmailAddress')}}" type="email" required="" placeholder="E-mail" autocomplete="off">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                       </div>
                    @if($errors->has('EmailAddress'))
                        <small class="d-block text-danger">
                            {{$errors->first('EmailAddress')}}
                        </small>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-xl form-control form-control-lg" placeholder="Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @if($errors->has('password'))
                        <small class="d-block text-danger">
                            {{$errors->first('password')}}
                        </small>
                    @endif
                </div>
                <div class="form-group position-relative has-icon-left mb-3">
                    <input type="password" name="password_confirmation" class="form-control form-control-xl" placeholder="Confirm Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @if($errors->has('password_confirmation'))
                        <small class="d-block text-danger">
                            {{$errors->first('password_confirmation')}}
                        </small>
                    @endif
                </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Sign Up</button>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit">Register My Account</button>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p>Already member? <a href="#" class="text-secondary">Login Here.</a></p>
            </div>
        </div>
    </form>
<div class="text-center mt-3 text-lg fs-4">
    <p class='text-gray-600'>Already have an account? <a href="{{route('login')}}" class="font-bold">Log
            in</a>.</p>
</div>

@endsection