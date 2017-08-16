@extends('web.layouts.default')

@section('title', 'Login')

@section('head')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 justify-content-center">

            <h1 class="margin-vertical-20">Login</h1>

            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
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
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Check me out
                            </label>
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