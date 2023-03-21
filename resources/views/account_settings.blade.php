@extends('index')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form-horizontal" method="POST" action="{{ route('account_settings_update') }}">
        @csrf
        <div class="card-body">
            <h4 class="card-title">Account</h4>
            <div class="form-group row">
                <label for="username" class="col-sm-3 text-right control-label col-form-label">Username</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 text-right control-label col-form-label">New Password</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-3 text-right control-label col-form-label">Confirm New
                    Password</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
        </div>
        <div class="border-top">
            <div class="card-body">
                <button type="submit" class="btn btn-primary" id="update_user" name="update_user">Update</button>
            </div>
        </div>
    </form>
@endsection
