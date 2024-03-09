@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <h3 class="title-5 m-b-35 text-primary">Roles</h3>
                </div>
                <div class="table-data__tool-right">
                    <div class="d-flex justify-content-end">
                        <div class="header-button mx-1">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="content m-0 p-0">
                                        <a class="js-acc-btn text-white btn btn-primary" href="#">Actions</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown bg-light-secondary">
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('roles.new') }}">New Role</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('roles.export') }}">Export Roles</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-button mx-1">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="content m-0 p-0">
                                        <a class="js-acc-btn text-white btn btn-secondary" href="#">Filter</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown bg-light-secondary">
                                        <div class="account-dropdown__body">
                                            <div class="container">
                                                <form action="{{ route('roles') }}" method="GET"
                                                    enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Name..." value="{{request()->query('name')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="text" name="description" class="form-control"
                                                            placeholder="Description..."
                                                            value="{{request()->query('description')}}">
                                                    </div>

                                                    <div class="actions d-flex justify-content-around">
                                                        <a href="{{ route('roles') }}"
                                                            class="btn btn-secondary">Reset</a>
                                                        <button type="submit" class="btn btn-primary">Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2" id="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Metrics</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                        <tr class="tr-shadow">
                            <td>{{ucwords($role->name)}}</td>
                            <td>
                                <span class="block-email">{{$role->description}}</span>
                            </td>
                            <td>
                                @foreach ($role->metrics as $metric)
                                {{ $metric->name }} <br>
                                @endforeach
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a class="item bg-warning" href="{{ route('roles.edit', $role->id) }}"
                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit text-dark"></i>
                                    </a>
                                    <form method="GET" action="{{ route('roles.destroy', $role->id) }}">
                                        @csrf
                                        <button class="item bg-danger show_confirm" type="submit" data-toggle="tooltip"
                                            data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete text-dark"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No Roles Found ...</td>
                        </tr>
                        @endforelse
                        <tr>
                            <td colspan="4">{{$roles->appends(['name' => request()->query('name'), 'description' =>
                                request()->query('description')])->links()}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection