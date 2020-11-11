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
            あなたのプロフィール
          </div>
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
            <div class="text-center">
                <form action="{{ route('users.profiles.update', [
                                    'user' => Auth::user()->id,
                                    'profile' => Auth::user()->id,
                                  ]) }}" method="POST">
                  @csrf
                  @method('PUT')
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
                                <td><input name="name" type="text" value="{{ $authUser->name }}"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><a href="#" class="btn btn-primary">Email再設定リンク</a></td>
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
                <input type="submit" value="この内容で変更する">
                </form>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@endsection('scripts')
