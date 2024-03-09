@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{ route('users') }}" class="mb-3">
        <h3>
            < Back</h3>
    </a>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Update User</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class=" form-control-label">Name *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name" placeholder="Text" class="form-control"
                                value="{{$user->name}}" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email" class=" form-control-label">Email *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="email" id="email" name="email" placeholder="Enter Email" required
                                value="{{$user->email}}" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="offset-9 col-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <strong>Update User</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('users.change_password', $user->id) }}" method="post"
                    enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="new_password" class=" form-control-label">New Password *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" id="new_password" name="new_password" placeholder="New Password"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="confirm_password" class=" form-control-label">Password Confirmation *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" id="confirm_password" name="confirm_password"
                                placeholder="Confirm Password" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="offset-9 col-3">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection