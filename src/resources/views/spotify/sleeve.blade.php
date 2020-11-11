@extends('layouts.app')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/spotify-style.css') }}">
  <style>
    .image-bn {
      display: block;
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <h1>Spotify search Artist's Track Sleeve</h1>

      <div>
            <p>
                <a id="store" class="image-btn" href="#">
                    <img src="{{ $url }}">
                </a>
                <form id="store-form" action="{{ route('spotifies.storeCDSleeves') }}" method="POST" style="display: none;">
                    @csrf
                    <input name="imageurl" type="text" value="{{ $url }}"/>
                </form>
            </p>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('store').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('store-form').submit();
        });
    </script>
@endsection('scripts')