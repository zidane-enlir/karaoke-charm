@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/track-show-style.css') }}">
@endsection

@section('content')
  <div class="container">
    <div class="row">
    
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">登録曲リスト</div>
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
            <div class="list-group">
                <a href="#" class="list-group-item active">
                  <!-- track->title -->
                  {{ $track->title }}
                </a>
            </div>
          </div>
          <div class="list-group">
            @foreach ($playlists as $playlist)
              <a href="#" class="list-group-item">
                {{ $playlist->name }} 
              </a>
              <form action="{{ route('tracks.add', [
                                'playlist_id' => $playlist->id,
                                'track_id'    => $track->id
                                ]) }}" 
                    method="POST" class="button-form">
                @csrf

                <input type="submit" value="追加" class="button">
              </form>
            @endforeach
          </div>
          <div class="list-group">
              <a href="#" id="delete" class="list-group-item active">
                <!-- track->title -->
                削除
              </a>
              <form id="delete-track" action="{{ route('tracks.destroy', ['track' => $track->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
          </div>
        </nav>
      </div>

      <div class="column col-md-8">
      </div>

    </div>
  </div>
@endsection

@section('scripts')
  <script>
    document.getElementById('delete').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('delete-track').submit();
    });
  </script>
@endsection('scripts')