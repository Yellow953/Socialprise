@extends('layouts.app')

@section('content')

<div class="loader" id="loader"></div>

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Analytics Tool</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('tool.result') }}" method="post" enctype="multipart/form-data"
                    class="form-horizontal" id="form">
                    @csrf
                    <div class="form-group">
                        <label for="page_id" class=" form-control-label">Facebook Page ID *</label>
                        <select id="page_id" name="page_id" class="form-control" required>
                            <option value="">Facebook Page ID</option>
                            @foreach ($businesses as $business)
                            <option value="{{$business->page_id}}" {{ old('page_id')==$business->page_id ? 'selected' :
                                ''}}>{{$business->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="metrics" class=" form-control-label">Metrics *</label>
                        <div class="row mx-3">
                            @foreach ($metrics as $metric)
                            <div class="form-check col-4">
                                <input type="checkbox" class="form-check-input" id="{{ $metric->code }}"
                                    name="metrics[]" value="{{ $metric->code }}">
                                <label class="form-check-label" for="{{ $metric->code }}">{{ $metric->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="offset-9 col-3">
                            <button type="submit" class="btn btn-primary w-100" onclick="showLoader()">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showLoader() {
        document.getElementById('loader').classList.add('active');
    }
</script>

@endsection