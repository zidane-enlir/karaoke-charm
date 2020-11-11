@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
  <div class="container">
    @if (session('message'))
      <div class="alert alert-success">
        <p>{{ session('message') }}</p>
      </div>
    @endif
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">プレイリスト</div>
          <div class="panel-body">
            <a href="{{ route('playlists.create') }}" class="btn btn-default btn-block">
              プレイリストを新規作成する
            </a>
          </div>
          <div class="list-group">
            @foreach ($playlists as $playlist)
              <a href="{{ route('playlists.show', ['playlist' => $playlist] ) }}" class="list-group-item">
                {{ $playlist->name }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>

      <div class="column col-md-8">
      </div>

    </div>
  </div>
@endsection('content')

@section('scripts')
@endsection('scripts')