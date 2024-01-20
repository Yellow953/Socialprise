@extends('layouts.app')

@section('content')

<div class="container">
    <a href="/businesses" class="mb-3">
        <h3>
            < Back</h3>
    </a>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Update Business</strong>
            </div>
            <div class="card-body card-block">
                <form action="/businesses/{{$business->id}}/update" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class=" form-control-label">Name *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name" placeholder="Text" class="form-control"
                                value="{{$business->name}}" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="page_id" class=" form-control-label">Page ID *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="page_id" name="page_id" placeholder="Page ID ..." required
                                value="{{$business->page_id}}" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="access_token" class=" form-control-label">Access Token</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="access_token" name="access_token" placeholder="Access Token ..."
                                class="form-control" value="{{ $business->access_token }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="offset-9 col-3">
                            <button type="submit" class="btn btn-primary">Update Business</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection