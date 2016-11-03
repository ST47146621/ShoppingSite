@extends('public_layout')

@section('title')
確認交易
@endsection

@section('tool')
<link rel=stylesheet type="text/css" href="Tools/bootstrap/css/data_confirm.css">
<script type="text/javascript">
    $(document).ready(function(){
        var order_date = $('#order_time').text().split(".");
        $('#order_time').text(order_date[0]);''
    });
</script>
@endsection

@section('content')
<div class="block transform">
    <li class="block1">確認資料</li>
    <p class="arrow">
      <i class="material-icons">keyboard_arrow_right</i>
  </p>
  <li class="block2">完成交易</li>
</div>
<div class="title-comtrol">訂單明細確認</div>
<table class="col-lg-12 col-xs-12 col-lg-12 col-xs-12">
    <thead>
        <tr>
            <th class="form1 col-lg-6 col-xs-6">商品名稱</th>
            <th class="form1 col-lg-3 col-xs-3">數量</th>
            <th class="form1 col-lg-3 col-xs-3">金額</th>
        </tr>
    </thead>
    <tbody>
        <?php $total=0; $shipment=10; $subtotal=0;?>
        @foreach($data as $data)
        <?php 
        $price = $data['price'] * $data['quit'];
        $subtotal += $price;
        ?>
        <tr class="underline">
            <td class="form2 col-lg-6 col-xs-6">{{ $data['mdesc'] }}</td>
            <td class="form3 col-lg-3 col-xs-3">{{ $data['quit'] }}</td>
            <td class="form2 col-lg-3 col-xs-3">{{ $price }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="underline">
            <td class="form2 col-lg-6 col-xs-6"></td>
            <td class="form3 col-lg-3 col-xs-3">小計</td>
            <td class="form2 col-lg-3 col-xs-3">{{ $subtotal }}</td>
        </tr>
        <tr class="underline">
            <td class="form2 col-lg-6 col-xs-6"></td>
            <td class="form3 col-lg-3 col-xs-3">運送方式：貨運 / 宅配</td>
            <td class="form2 col-lg-3 col-xs-3">{{ $shipment }}</td>
        </tr>
        <?php $total = $subtotal + $shipment ?>
        <tr class="underline">
            <td class="form2 col-lg-6 col-xs-6"></td>
            <td class="form3 col-lg-3 col-xs-3">總金額</td>
            <td class="form2 total col-lg-3 col-xs-3">{{ $total }}</td>
        </tr>
    </tfoot>

</table>

<!--訂單明細確認-->
<div class="title-comtrol">訂單確認</div>
<div class="form4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="col-lg-3 col-md-3 col-sm-12 col-xs-12">付款方式：</p>
    <p class="col-lg-9 col-md-9 col-sm-12 col-xs-12">腦劉邦你付</p>
</div>
<div class="form4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="col-lg-3 col-md-3 col-sm-12 col-xs-12">訂購日期：</p>
    <p id="order_time" class="col-lg-9 col-md-9 col-sm-12 col-xs-12">{{ $data['order_time'] }}</p>
</div>
<div class="form5 col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="col-lg-3 col-md-3 col-sm-12 col-xs-12">收件人：</p>
    <p class="col-lg-9 col-md-9 col-sm-12 col-xs-12">{{ $data['dname'] }}</p>
</div>
<div class="form4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="col-lg-3 col-md-3 col-sm-12 col-xs-12">電話：</p>
    <p class="col-lg-9 col-md-9 col-sm-12 col-xs-12">{{ $data['phone'] }}</p>
</div>
<div class="form4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="col-lg-3 col-md-3 col-sm-12 col-xs-12">E-mail：</p>
    <p class="col-lg-9 col-md-9 col-sm-12 col-xs-12">{{ $data['email'] }}</p>
</div>
<div class="form4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="col-lg-3 col-md-3 col-sm-12 col-xs-12">地址：</p>
    <p class="col-lg-9 col-md-9 col-sm-12 col-xs-12">{{ $data['address'] }}</p>
</div>
<div class="form4-1 col-lg-12 col-md-12  col-sm-12 col-xs-12">
    <p class="col-lg-3 col-md-3 col-sm-12 col-xs-12">備註：</p>
    <p class="col-lg-9 col-md-9 col-sm-12 col-xs-12">{{ $data['remark'] }}</p>
</div>

<!--訂單確認-->
<div class="buttom-control">
    <form method="post" action="order_complete">
        {!! csrf_field() !!}
        <input type="text" name="total" style="display:none" value="{{ $total }}">
        <button type="submit" class="btn btn-primary pull-right" >確認，下一步</button>
    </form>
    <form method="get" action="order_shoppingcart">
    <button type="submit" class="btn btn-default pull-right buttom-right" >上一步</button>
    </form>
</div><!--buttom-->
@endsection

