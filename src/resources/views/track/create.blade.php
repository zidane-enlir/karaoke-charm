@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col col-md-offset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">曲を追加する</div>
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
              <form action="{{ route('tracks.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="name">曲名</label>
                  <input type="text" class="form-control" name="title" id="title" 
                          value="{{ old('artist') }}"/>
                </div>
                <div class="form-group">
                  <label for="name">アーティスト名</label>
                  <input type="text" class="form-control" name="artist" id="artist" 
                          value="{{ old('artist') }}"/>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">追加</button>
                </div>
              </form>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </main>
@endsection('content')


@section('scripts')
@endsection('scripts')