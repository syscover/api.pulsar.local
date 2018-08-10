@extends('web.layouts.default')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">

            <div class="col-6 mt-100">
                <form method="post" action="{{ route('web.post_login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="user" class="form-control" id="email" aria-describedby="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <a href="{{ nt_route('web.reset_password-' . user_lang()) }}">¿Olvidó su contraseña?</a>
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
                    <a href="{{ route('web.get_sing_in-' . user_lang()) }}" class="btn btn-outline-primary">Sing In</a>
                </form>
            </div>

        </div>
    </div>
@endsection