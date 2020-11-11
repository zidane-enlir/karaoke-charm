@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
  <div class="container">
    <div class="row">
    
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">登録曲リスト</div>
          <div class="panel-body">
            <a href="{{ route('tracks.create') }}" class="btn btn-default btn-block">
              曲を追加する
            </a>
          </div>
          <div class="list-group">
            @foreach ($tracks as $track)
              <a href="{{ route('tracks.show', ['track' => $track->id ]) }}" class="list-group-item">
                {{ $track->title }} 
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