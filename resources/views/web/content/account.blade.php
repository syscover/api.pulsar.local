@extends('web.layouts.default')

@section('title', 'My Account')

@section('head')
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">

            <h1 class="margin-vertical-10">My Account</h1>

            @if(session('successMessage'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span>&times;</span>
                    </button>
                    {!! session('successMessage')['message'] !!}
                </div>
            @endif

            <form action="{{ route('updateCustomer-' . user_lang()) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="active" value="1"> <!-- set customer created like active -->
                <input type="hidden" name="id" value="{{ $customer->id }}">

                <div class="form-group">
                    <label for="name">Group</label>
                    <select class="form-control" name="group_id" required>
                        <option value="">Select a customer group</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" @if($group->id == $customer->group_id) selected @endif>{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">{{ trans_choice('common.name', 1) }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="surname">{{ trans_choice('common.surname', 1) }}</label>
                    <input type="text" class="form-control" id="surname" name="surname" value="{{ $customer->surname }}" placeholder="Surname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="repassword">Repeat Password</label>
                    <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Password">
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
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@stop