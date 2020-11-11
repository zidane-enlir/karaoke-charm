@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
      .delete-btn {
        margin: 4rem 0 0 0;
      }
      .profile {
        /* width: 200px; */
        width: 14rem;
      }
    </style>
@endsection

@section('content')
  <div class="container">
    @if (session('message'))
      <div class="alert alert-success">
        <p>{{ session('message') }}</p>
      </div>
    @endif
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">
            あなたのプロフィール
          </div>
          <div class="panel-body">
            <div class="text-center">
                <div class="table-responsive">
                　　<table class="table table-condensed table-hover">
                    　　<!-- 基本記述と同じ -->
                        <tbody>
                            <tr>
                                <th>user_id</th>
                                <td>{{ $authUser->id }}</td>
                            </tr>
                            <tr>
                                <th>user_name</th>
                                <td>{{ $authUser->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $authUser->email }}</td>
                            </tr>
                            <tr>
                                <th>email_verified_at</th>
                                <td>{{ $authUser->email_verified_at }}</td>
                            </tr>
                            <tr>
                                <th>created_at</th>
                                <td>{{ $authUser->created_at }}</td>
                            </tr>
                            <tr>
                                <th>updated_at</th>
                                <td>{{ $authUser->updated_at }}</td>
                            </tr>
                        </tbody>
                　　</table>
                </div>

              <div>
                @if (isset(Auth::user()->userProfile))
                <img class="profile" src="/storage/profiles/{{ Auth::user()->userProfile->image_url }}"/>
                @endif
              </div>
              <a href="{{ route('users.profiles.edit', [
                              'user' => Auth::user()->id,
                              'profile' => Auth::user()->id
                            ]) }}" class="btn btn-primary">
              プロフィール情報編集
              </a>
              <a href="{{ route('users.profiles.photos.create', [
                              'user' => Auth::user()->id,
                              'profile' => Auth::user()->id
                            ]) }}" class="btn btn-primary">
              プロフィール画像変更
              </a>
              <div class="delete-btn">
              <form action="{{ route('users.destroy', [ 'user' => Auth::user()->id ]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="退会する">
              </form>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@endsection('scripts')