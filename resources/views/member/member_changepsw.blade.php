@extends('public_layout')

@section('tool')
<link rel=stylesheet type="text/css" href="Tools/bootstrap/css/member_changepsw.css">
@endsection

@section('title')
修改密碼
@endsection

@section('content')

  <ol class="breadcrumb">
    <li><a href="product_index">首頁</a></li>
    <li><a href="member_center">會員中心</a></li>
    <li class="active">修改密碼</li>
  </ol><!--breadcrumb-->
  <form method="post" action="{{ url('member_changepsw') }}">
  {!! csrf_field() !!}
  <input type="text" style="display:none" name="email" value="{{ $data['email'] }}">
    <div class="col-lg-12 col-xs-12">
      <div class="key">密碼</div>
      <div class="key-column col-lg-3 col-xs-3"><p class="transform" >舊密碼</p></div>
      <div class="key1 col-lg-9 col-xs-9">
        <div class="input-group" style="width:100%;margin-left:10px">
          <input type="password" class="input-group form-control" id="oldpsw" name="oldpsw" style="height:30px;width:40%">
          @if ($errors->has('password'))
          <span class="help-block" style="margin-top:7px;">
            <strong style="margin-left:20px">{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="key-column col-lg-3 col-xs-3""><p class="transform">新密碼</div>
      <div class="key1 col-lg-9 col-xs-9">
        <div class="input-group" style="width:100%;margin-left:10px">
          <input type="password" class="input-group form-control" id="newpsw" name="newpsw" style="height:30px;width:40%">
          @if ($errors->has('new_password'))
          <span class="help-block" style="margin-top:7px;">
            <strong style="margin-left:20px">{{ $errors->first('new_password') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="key-column col-lg-3 col-xs-3""><p class="transform">請再輸入新密碼</div>
      <div class="key1 col-lg-9 col-xs-9">
        <div class="input-group" style="width:100%;margin-left:10px">
          <input type="password" class="input-group form-control" id="checkpsw" name="checkpsw" style="height:30px;width:40%">
          @if ($errors->has('new_password_confirmation'))
          <span class="help-block" style="margin-top:7px;">
            <strong style="margin-left:20px;">{{ $errors->first('new_password_confirmation') }}</strong>
          </span>
          @endif
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary pull-right sure_btn">確認修改</button>
  </form><!--key-->

  @endsection