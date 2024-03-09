@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{ route('roles') }}" class="mb-3">
        <h3>
            < Back</h3>
    </a>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit Role</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class=" form-control-label">Name *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name" placeholder="Name ..." class="form-control"
                                value="{{$role->name}}" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="description" class=" form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="description" name="description" placeholder="Description ..."
                                value="{{$role->description}}" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="metrics" class="form-control-label">Metrics *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="metrics[]" id="metrics" class="form-select form-control" multiple required>
                                @foreach ($metrics as $metric)
                                <option value="{{ $metric->id }}" {{ in_array($metric->id,
                                    $role->metrics->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ ucwords($metric->name) }}
                                </option>
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