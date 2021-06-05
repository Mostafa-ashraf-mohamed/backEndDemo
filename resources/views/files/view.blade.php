@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    <b>Title</b><br>{{ $data->title }}<br>
                    <b>description</b><br>{{ $data->des }}<br>
                </div>
                <div class="card-header">
                    @if ($data->userid == Auth::user()->id)
                    <a href="{{ Route('file.edit', $data->id) }}" class="btn btn-secondary mx-3">Edit</a>
                    <a href="{{ Route('file.download',$data->id) }}" class="btn btn-success mx-3">Download</a>
                    <a href="{{ Route('file.delete',$data->id) }}" class="btn btn-danger mx-3">Delete</a>
                    <a href="{{ Route('publicFile.share',$data->id) }}" class="btn btn-primary mx-3">share file</a>
                    @else
                    <a href="{{ Route('file.download',$data->id) }}" class="btn btn-success mx-3">Download</a>
                    @endif
                </div>
                <div class="card-body">
                    @if($data->fileExt=="mp4")
                      <video class="w-100" controls>
                        <source src="{{ asset('uploded/'.$data->file) }}" type="video/mp4">
                        Your browser does not support HTML video.
                      </video>
                      @elseif ($data->fileExt == "jpg" || $data->fileExt == "png" ||$data->fileExt == "jpeg")
                      <img src="{{ asset('uploded/'.$data->file) }}" class="w-100" alt="{{$data->file}}">
                      @elseif ($data->fileExt == "pdf")
                      <iframe src="{{ asset('uploded/'.$data->file) }}" height="1000" class="w-100"></iframe>
                      @else
                      <img src="{{ asset('img/file_ico.png') }}" class="w-100" alt="{{$data->file}}">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
