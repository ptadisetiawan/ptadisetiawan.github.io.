@extends('layouts.customauth.index')

@section('title')
Login
@endsection

@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">Login</div>
    <div class="card-body">
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>
        
                <div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Password</label>
        
                <div>
                    <input id="password" type="password" class="form-control" name="password" required>
        
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        
            <div class="form-group">
                <div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
            </div>
        
            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary float-right">
                        Login
                    </button>
        
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </div>
            <div class="form-group">
                <div>Create new User 
                    <a class="btn btn-link" href="{{ route('register') }}">
                        << Register >>
                    </a>
                </div>
            </div>
      </form>
    </div>
  </div>
  @endsection
