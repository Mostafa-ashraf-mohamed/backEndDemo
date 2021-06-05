@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row text-center">
    @foreach ( $indexFiles as $data)
    <div class="col-12 col-md-4">
      <div class="card">
        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
          @if ($data->shareStatus == "share")
            <img src="{{  asset('img/share_ico.png') }}" class="iconUp">
          @endif

          <img
          @if ($data->fileExt == "pdf")
          src="{{  asset('img/pdf_ico.png') }}"
          @elseif ($data->fileExt == "docx")
          src="{{  asset('img/word_ico.png') }}"
          @elseif ($data->fileExt == "mp4")
          src="{{  asset('img/video_ico.jpg') }}"
          @elseif ($data->fileExt == "jpg" || $data->fileExt == "png" ||$data->fileExt == "jpeg")
          src="{{ asset('img/photo_ico.jpg') }}"
          @else
          src="{{ asset('img/file_ico.png') }}"
          @endif
            class="img-fluid"

          >
          <a href="#">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body bg-dark text-light">
          <h5 class="card-title">{{ $data->title }}</h5>
          <h6><b>{{ $data->fileExt }}</b></h6>
          <p class="card-text">
            {{ $data->des }}
          </p>
          <a href="{{ Route('file.show', $data->id) }}" class="btn btn-info mx-3">View</a>
          <a href="{{ Route('file.edit', $data->id) }}" class="btn btn-secondary mx-3">Edit</a>
          <a href="{{ Route('file.delete',$data->id) }}" class="btn btn-danger mx-3">Delete</a>
          <a href="{{ Route('publicFile.share',$data->id) }}" class="btn btn-primary mx-3 mt-3">share file</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
