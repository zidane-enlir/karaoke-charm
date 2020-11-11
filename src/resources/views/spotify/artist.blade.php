@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/spotify-style.css') }}">
@endsection
  
@section('content')
  <div class="container">
    <div class="row">
      <h1>Spotify search Artists</h1>
      <form action="{{ route('spotifies.allArtists') }}" action="GET">
        <input type="text" name="word" value="{{ $input_word }}">
        <input type="submit" value="検索">
      </form>
      
      
      @if (isset($artist_ids) && is_array($artist_ids))
      <table>
      <tbody>
          <tr>
            <td style="font-weight: bold;">アーティストID</td>
            <td style="font-weight: bold;">アーティスト名</td>
            <td style="font-weight: bold;">選択ボタン</td>
            <td style="font-weight: bold;">写真</td>
          </tr>
        @foreach ($artist_ids as $artist_id)
          <tr>
            <td>{{ $artist_id['id'] }}</td>
            <td>{{ $artist_id['name'] }}</td>
            <td><a href="{{ route('spotifies.allTracks', [
                                  'targeted_artist_id' => $artist_id['id']]) }}">選択</a></td>
            @if (isset($artist_id['images'][2]))
            <td>
              <img src="{{ $artist_id['images'][2]['url'] }}">
            </td>
            @else
            <td>
              No Image
            </td>
            @endif 
          </tr>
        @endforeach
        </tbody>
      </table>
      @elseif (isset($artist_ids))
        <p>検索ワードを入力してください。</p>
      @else
        <p>検索結果がありません。</p>
      @endif
        
      
    </div>
  </div>
@endsection

@section('scripts')
@endsection('scripts')