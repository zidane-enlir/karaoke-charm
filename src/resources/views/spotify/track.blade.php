@extends('layouts.app')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/spotify-style.css') }}">
@endsection
  
@section('content')
  <div class="container">
    <div class="row">
      <h1>Spotify search Artist's Track</h1>      
      
      @if (isset($singles) && is_array($singles))
      <table>
      <tbody>
          <tr>
            <td style="font-weight: bold;">シングル名</td>
            <td style="font-weight: bold;">選択ボタン</td>
            <td style="font-weight: bold;">写真</td>
          </tr>
        @foreach ($singles['items'] as $single)
          <tr>
            

            <td>{{ $single['name'] }}</td>
            @foreach ($single['artists'] as $artist_name)            
            <td>
              <!-- <a href="#" id="artist-name" class="my-navbar-item">選択</a> -->
              <form id="artist-name-form" action="{{ route('tracks.store')}}" method="POST">
                @csrf
                <input type="hidden" name="title" value="{{ $single['name'] }}">
                <input type="hidden" name="artist" value="{{ $artist_name['name'] }}">
                <input type="submit" value="追加">
              </form>
            </td>
            @endforeach
            @if (isset($single['images'][2]))
            <td>
              <a href="{{ route('spotifies.getCDSleeves', 
                        ['imageurl' => 
                          preg_replace("!https://i.scdn.co/image/!", "", $single['images'][2]['url']) ]) }}">
                <img src="{{ $single['images'][2]['url'] }}">
              </a>
            </td>
            <!-- デバッグのために１列追加 -->
            <!-- <td>
            single['images'][2]['url']
            </td> -->
            @else
            <td>
              No Image
            </td>
            @endif 
          </tr>
        @endforeach
        </tbody>
      </table>
      @else
        <p>検索結果がありません。</p>
      @endif
        
      
    </div>
  </div>
@endsection

@section('scripts')
@endsection('scripts')