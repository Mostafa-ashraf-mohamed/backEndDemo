@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('done'))
    <div class="alert alert-info">
        <h5>{{ Sessoin::get('done') }}</h5>
    </div>
@endif
<div class="container col-7">
    <div class="card">
        <div class="card-body">
            <form action="{{ Route('file.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="titleLab">Title</label>
                    <input type="text" name="title"  class="form-control" id="titleLab">
                </div>
                <div class="form-group">
                    <label for="desLab">description</label>
                    <textarea col=30 rows=10 name="des" class="form-control" id="desLab"></textarea>
                </div>
                <div class="form-group">
                    <label for="fileLab">File</label>
                    <input type="file" name="fileInput" id="fileLab">
                </div>
                <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-primary btn-block">Send</button>
            </form>
        </div>
    </div>
</div>

@endsection
