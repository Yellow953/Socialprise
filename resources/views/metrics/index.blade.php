@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <h3 class="title-5 m-b-35 text-primary">Metrics</h3>
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
                                                <a href="{{ route('metrics.new') }}">New Metric</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('metrics.export') }}">Export Metrics</a>
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
                                                <form action="{{ route('metrics') }}" method="GET"
                                                    enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Name..." value="{{request()->query('name')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Code</label>
                                                        <input type="text" name="code" class="form-control"
                                                            placeholder="Code..." value="{{request()->query('code')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="text" name="description" class="form-control"
                                                            placeholder="Description..."
                                                            value="{{request()->query('description')}}">
                                                    </div>

                                                    <div class="actions d-flex justify-content-around">
                                                        <a href="{{ route('metrics') }}"
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
                            <th>Code</th>
                            <th>Platform</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($metrics as $metric)
                        <tr class="tr-shadow">
                            <td>{{ucwords($metric->name)}}</td>
                            <td>
                                <span class="block-email">{{$metric->code}}</span>
                            </td>
                            <td>
                                <span class="block-email">{{$metric->platform}}</span>
                            </td>
                            <td>
                                <span class="block-email">{{$metric->description}}</span>
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a class="item bg-warning" href="{{ route('metrics.edit', $metric->id) }}"
                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit text-dark"></i>
                                    </a>
                                    <form method="GET" action="{{ route('metrics.destroy', $metric->id) }}">
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
                            <td colspan="5" class="text-center">No Metrics Found ...</td>
                        </tr>
                        @endforelse
                        <tr>
                            <td colspan="5">{{$metrics->appends(['name' => request()->query('name'), 'code' =>
                                request()->query('code')])->links()}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection