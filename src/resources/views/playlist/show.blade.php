@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">プレイリスト</div>
          <div class="panel-body">
            <a href="{{ route('playlists.index') }}" class="btn btn-default btn-block">
            プレイリスト一覧に戻る
            </a>
          </div>
          <div class="list-group">
              <a href="#" class="list-group-item active">
                <!-- track->title -->
                {{ $playlist->name }}
              </a>
          </div>
        </nav>
        <div>
          <a href="{{ route('playlists.edit', [ 'playlist' => $playlist->id ] ) }}">
            編集
          </a>
        </div>
        <div>
          <form action="{{ route('playlists.destroy', [ 'playlist' => $playlist->id ] ) }}" method="POST">
            @csrf
            @method('delete')
            <input type="submit" value="削除"/>
          </form>
        </div>
      </div>
      <div class="column col-md-8">

        <!-- ここに曲が表示される -->
        <div class="panel panel-default">
          <div class="panel-heading">リスト内の曲</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="{{ route('tracks.index') }}" class="btn btn-default btn-block">
                リストに曲を追加する
              </a>
            </div>
          </div>
          @if (isset($tracks) || count($tracks) !== 0)
          <table class="table">
            <thead>
            <tr>
              <th>曲名</th>
              <th>Artist</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              @foreach($tracks as $track)
                <tr>
                  <td>{{ $track->title }}</td>
                  <td>{{ $track->artist }}</td>
                  <td><a href="{{ route('tracks.edit', [
                                  'track' => $track->id,
                                ])}}">編集</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <p style="
            padding: 1rem 1rem;
            text-align: center;">まだ、このプレイリストに分類された曲はありません。</p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection('content')

@section('scripts')
@endsection('scripts')