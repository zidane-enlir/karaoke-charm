@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">
            まずはプレイリストを作成しましょう
          </div>
          <div class="panel-body">
            <div class="text-center">
              <a href="{{ route('playlists.create') }}" class="btn btn-primary">
              プレイリスト作成ページへ
              </a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@endsection('scripts')
