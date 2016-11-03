@extends('public_layout')

@section('tool')
<link rel="stylesheet" type="text/css" href="Tools/bootstrap/css/member_center.css">    
@endsection

@section('title')
會員中心
@endsection

@section('content')

<ol class="breadcrumb">
          <li><a href="product_index">首頁</a></li>
          <li class="active">會員中心</li>
          <li> {{ Auth::user()->custname}}</li>
      </ol><!--breadcrumb-->

      <div class="col-lg-12 col-xs-12">
      <div class="transaction">交易紀錄</div>
      <div class="transaction1 col-lg-12 col-xs-12">
        <i class="fa fa-paste col-lg-1 col-xs-1"></i>
        <span><a class="transaction1-btn col-lg-2 col-xs-4" href="order_list">訂單查詢</a></span>
        <span class="transaction1-text col-lg-5 col-md-5 col-sm-5 col-xs-10 col-xs-offset-2">(未出貨：0 已到門市：0 已寄出：0)</span>
      </div>
    </div><!--交易紀錄-->

      <div class="col-lg-12 col-xs-12">
      <div class="transaction" style="">會員資料</div>
      <div class="transaction1 col-lg-12 col-xs-12">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <i class="material-icons" style="color:#3288c8;">person</i>
              <span><a class="transaction1-btn" href="member_change">修改會員資料</a></span>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 clear">
            <i class="material-icons" style="color:#f1c40f;">vpn_key</i>
              <span><a class="transaction1-btn" href="member_changepsw">修改密碼</a></span>
          </div>
      </div>
    </div><!--會員資料-->
@endsection