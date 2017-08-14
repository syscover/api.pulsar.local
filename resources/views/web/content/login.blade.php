@extends('web.layouts.default')

@section('title', 'Login')

@section('head')
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3">

            <h1 class="margin-vertical-10">Login</h1>

            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-block">
                    <form method="post" action="{{ route('loginCustomer') }}">

                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input name="user" type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
                            </div>
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
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-3">
                                <button class="btn btn-primary pointer">Login</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ route('getSingIn-' . user_lang()) }}" class="btn btn-outline-primary">Sing In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop