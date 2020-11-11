@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
  <main>
    <div class="container">
      <div class="row">
        <div class="col col-md-offset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">曲情報を編集する</div>
            <div class="panel-body">
              @if($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $message)
                      <li>{{ $message }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form action="{{ route('tracks.update', ['track' => $track ]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="name">曲名</label>
                  <input type="text" class="form-control" name="title" id="name" 
                          value="{{ $track->title }}"/>
                </div>
                <div class="form-group">
                  <label for="name">アーティスト名</label>
                  <input type="text" class="form-control" name="artist" id="name" 
                          value="{{ $track->artist }}"/>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">送信</button>
                </div>
              </form>
            </div>
          </nav>
        </div>
      </div>
    </div>
@endsection('content')

@section('scripts')
@endsection('scripts')