@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/metrics" class="mb-3">
        <h3>
            < Back</h3>
    </a>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Update Metric</strong>
            </div>
            <div class="card-body card-block">
                <form action="/metrics/{{$metric->id}}/update" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class=" form-control-label">Name *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name" placeholder="Text" class="form-control"
                                value="{{$metric->name}}" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="code" class=" form-control-label">Code *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="code" name="code" placeholder="Code ..." required
                                value="{{$metric->code}}" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="description" class=" form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="description" name="description" placeholder="Description ..."
                                value="{{$metric->description}}" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="offset-9 col-3">
                            <button type="submit" class="btn btn-primary">Update Metric</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection