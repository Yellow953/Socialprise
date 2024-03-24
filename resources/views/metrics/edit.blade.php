@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('metrics') }}" class="mb-3">
        <h3>
            < Back</h3>
    </a>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit Metric</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('metrics.update', $metric->id) }}" method="post" enctype="multipart/form-data"
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
                        <div class="col col-md-3">
                            <label for="platform" class="form-control-label">Platform *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select id="platform" name="platform" class="form-control" required>
                                @foreach (Helper::get_platforms() as $platform)
                                <option value="{{ $platform }}" {{ $metric->platform==$platform ? 'selected' : '' }}>{{
                                    ucwords($platform) }}</option>
                                @endforeach
                            </select>
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
    </div>
</div>
@endsection