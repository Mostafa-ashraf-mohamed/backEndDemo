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
<div class="container">
        <div class="w-100">
            <div class="row justify-content-center">
                <div class="card-header col-3">
                    <b>Title</b><br>{{ $file->title }}
                </div>
                <div class="card-header col-6">
                    <b>description</b><br>{{ $file->des }}
                </div>
                <div class="card-header col-3">
                    <b>file extension</b><br>{{ $file->fileExt }}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ Route('publicFile.shareTo') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="emailLab">Email</label>
                        <input type="email" name="email"  class="form-control" id="emailLab">
                    </div>
                    <input type="hidden" name="fileid" value="{{ $file->id }}">
                    <button type="submit" class="btn btn-primary btn-block">add</button>
                </form>
                @if ($file->shareStatus == "unshare")
                <form action="{{ Route('publicFile.shareToAll',$file->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="mt-1 btn btn-primary float-right">share to all users</button>
                </form>
                @else
                <form action="{{ Route('publicFile.makePrivate',$file->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="mt-1 btn btn-primary float-right">make it private</button>
                </form>
                @endif
            </div>
        </div>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">email shared with</th>
                <th> Action </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($ShareTo as $index )
                     <tr>
                         <th>{{$index->email}}</th>
                         <th>
                            <a href="{{ Route('publicFile.sheredelete',$index->id) }}" class="btn btn-danger">Delete</a>
                        </th>
                     </tr>
                @endforeach
            </tbody>
          </table>
</div>
@endsection
