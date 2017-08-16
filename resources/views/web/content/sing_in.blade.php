@extends('web.layouts.default')

@section('title', 'Sing In')

@section('head')
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">

            <h1 class="margin-vertical-10">Sing In</h1>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('postSingIn-' . user_lang()) }}" method="post">

                {{ csrf_field() }}
                <input type="hidden" name="active" value="1"> <!-- set customer created like active -->

                <div class="form-group">
                    <label for="name">Name</label>
                    <select class="form-control" name="group_id" required>
                        <option value="">Select a customer group</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="re_password">Repeat Password</label>
                    <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary">Sing In</button>
            </form>
        </div>
    </div>
@endsection