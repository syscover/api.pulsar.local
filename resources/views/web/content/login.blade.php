@extends('web.layouts.default')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-center d-flex align-items-center">

            <div class="card margin-top-100">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body padding-30">
                    <form method="post" action="{{ route('postLogin') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-check">
                            <a href="{{ nt_route('getPasswordReset-' . user_lang()) }}">Olvidó su contraseña</a>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('getSingIn-' . user_lang()) }}" class="btn btn-outline-primary">Sing In</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection