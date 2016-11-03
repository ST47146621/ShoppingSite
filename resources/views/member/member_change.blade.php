@extends('public_layout')

@section('tool')
<link rel="stylesheet" type="text/css" href="Tools/bootstrap/css/member_change.css">    
@endsection

@section('title')
修改會員資料
@endsection

@section('content')
<ol class="breadcrumb">
	<li><a href="product_index">首頁</a></li>
	<li><a href="member_center">會員中心</a></li>
	<li class="active">修改會員資料</li>
</ol><!--breadcrumb-->
<form method="post" action="{{ url('member_change') }}">
	{!! csrf_field() !!}
	<div class="col-lg-12 col-xs-12">
		<div class="memberdata">會員資料</div>
		@foreach($data as $data)
		<input type="text" class="form-control memberdata-control" style="display:none" value="{{ $data->email }}" name="email">
		<div class="memberdata-column col-lg-3 col-xs-3" ">姓名</div>
		<div class="memberdata1 col-lg-9 col-xs-9">
			<div class="col-lg-8 col-xs-8">
				<input type="text" class="form-control memberdata-control " id="custname" name="custname" value="{{ $data->custname }}">
			</div>
		</div>
		<div class="memberdata-column col-lg-3 col-xs-3">手機號碼</div>
		<div class="memberdata1 col-lg-9 col-xs-9">
			<div class="col-lg-8 col-xs-8">
				<input type="text" class="form-control memberdata-control" id="mobphone" name="mobphone" value="{{ $data->mobphone }}">
			</div>
		</div>
		<div class="memberdata-column col-lg-3 col-xs-3">地址</div>
		<div class="memberdata1 col-lg-9 col-xs-9">
			<div class="col-lg-8 col-xs-8">
				<input type="text" class="form-control memberdata-control " id="compaddr" name="compaddr"
				value="{{ $data->compaddr }}">
			</div>
		</div>
	</div>
	@endforeach
	<div class="buttonsize">
		<button type="submit" class="btn btn-primary pull-right " >確認修改</button>
	</div>
</form>
<!--mamberdata-->
@endsection

