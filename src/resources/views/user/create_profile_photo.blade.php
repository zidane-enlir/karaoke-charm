@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- <style>
      .delete-btn {
        margin: 4rem 0 0 0;
      }
    </style> -->
    <style>
    .base {
      /* background-color: red; */
      margin: 2rem;
      padding: 4rem;
    }
    .upload-field {
      /* background-color: #DDD; */
      margin: 1rem 0;
      padding: 2rem 0;
    }
    </style>
@endsection

@section('content')
<div class="base">
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $message)
          <li>{{ $message }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <h3>画像のアップロード</h3>

  <form method="post" action="{{ route('users.profiles.photos.store', [
                                'user' => Auth::user()->id,
                                'profile' => Auth::user()->id
                                ]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <fieldset>
      <div class="bg-light upload-field">
        <input id="file" type="file" name="profile_image" class="form-control">
        @if ($errors->has('image'))
            {{ $errors->first('image') }}
        @endif
      </div>
    </fieldset>

    <button type="submit" class="btn btn-info btn-block">アップロード</button>
  </form>
</div>
@endsection

@section('scripts')
@endsection('scripts')