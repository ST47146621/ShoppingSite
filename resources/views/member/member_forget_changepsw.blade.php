@extends('public_layout')

@section('title')
修改密碼
@endsection

@section('tool')
<link rel="stylesheet" type="text/css" href="Tools/bootstrap/css/keychange.css">
@endsection
@section('content')

<ol class="breadcrumb">
  <li><a href="product_index">首頁</a></li>
  <li><a href="member_center">會員中心</a></li>
  <li class="active">修改密碼</li>
</ol><!--breadcrumb-->
<form method="post" action="{{ url('forget_changepsw') }}">
  {!! csrf_field() !!}

  <input type="text" style="display:none" id="email" name="email" value="{{$reemail}}">
  <div class="col-lg-12 col-xs-12">
    <div class="key">密碼</div>
    <div class="key-column col-lg-3 col-xs-3""><p class="transform">新密碼</div>
    <div class="key1 col-lg-9 col-xs-9">
      <div class="col-lg-8 col-xs-8">
        <input type="text" class="input-group form-control" id="newPassword" name="newPassword">
      </div>
      @if ($errors->has('newPassword'))
      <span class="help-block" style="margin-top:11px;">
        <strong>{{ $errors->first('newPassword') }}</strong>
      </span>
      @endif
    </div>
    <div class="key-column col-lg-3 col-xs-3""><p class="transform">請再輸入新密碼</div>
    <div class="key1 col-lg-9 col-xs-9">
      <div class="col-lg-8 col-xs-8">
        <input type="text" class="input-group form-control" id="againPassword" name="againPassword">
      </div>
      @if ($errors->has('againPassword'))
      <span class="help-block" style="margin-top:11px;"">
        <strong>{{ $errors->first('againPassword') }}</strong>
      </span>
      @endif
    </div>
  </div>
  <button type="Submit" class="btn btn-primary pull-right sure_btn">確認修改</button>
</form><!--key-->
@endsection