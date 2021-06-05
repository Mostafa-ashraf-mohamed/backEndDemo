@extends('layouts.app')

@section('content')

@foreach ( $indexFiles as $data )
<div class="w-100">
    <div class="row">
        <div class="card-header col-3">
            <b>Title</b><br>{{ $data->title }}
        </div>
        <div class="card-header col-3">
            <b>description</b><br>{{ $data->des }}
        </div>
        <div class="card-header col-3">
            <b>file extension</b><br>{{ $data->fileExt }}
        </div>
        <div class="card-header col-3">
            <a href="{{ Route('file.show', $data->id) }}" class="btn btn-info mx-3">View</a>
            <a href="{{ Route('file.download',$data->id) }}" class="btn btn-success mx-3">Download</a>
        </div>
    </div>
</div>
@endforeach

@endsection
