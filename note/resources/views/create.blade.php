@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">新規メモ作成</div>
        <div class="card-body">
            	
            {{--データベースにインサートする、データを送信するときはPOST、どこにデータを投げるかをACTIONで指定--}}
            <form method='POST' action="/store">
            	
                {{--ユーザー乗っ取りを防ぐ --}}   
            @csrf
                	
                {{--ログインしているユーザーのIDのみを表示する--}}
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                     <textarea name='content' class="form-control"rows="10"></textarea>
                </div>

                <button type='submit' class="btn btn-primary btn-lg">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection