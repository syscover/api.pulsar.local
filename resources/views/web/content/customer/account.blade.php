@extends('web.layouts.default')

@section('title', 'My Account')

@section('head')
@endsection

@section('content')
    <h1 class="my-20">My Account</h1>

    @if(session('successMessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span>&times;</span>
            </button>
            {!! session('successMessage')['message'] !!}
        </div>
    @endif

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="false">Address</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active p-20" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form action="{{ route('web.update_customer') }}" method="post">
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
                    <label for="name">{{ trans_choice('core::common.name', 1) }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="surname">{{ trans_choice('core::common.surname', 1) }}</label>
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
                <div class="form-group">
                    <label for="name">País</label>
                    <select class="form-control" name="country_id" required>
                        <option value="">Select a country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" @if($country->id == $customer->country_id) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">{{ trans_choice('core::common.zip', 1) }}</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="{{ $customer->zip }}" placeholder="CP" required>
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

        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
            2
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            3
        </div>
    </div>




@endsection