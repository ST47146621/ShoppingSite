@extends('public_layout')

@section('title')
交易完成
@endsection

@section('tool')
<link rel=stylesheet type="text/css" href="Tools/bootstrap/css/compelete.css">
@endsection



@section('content')
    <div class="block transform">
      <li class="block2">確認資料</li>
      <p class="arrow">
        <i class="material-icons">keyboard_arrow_right</i>
      </p>
      <li class="block1">完成交易</li>
    </div>
    <!--進度流程-->
          
    <div class="text-control">
      <p>親愛的<span class="text-color">{{ $data[0]['username'] }}</span>您好，<br>
        感謝您的訂購，您的訂購編號為：<span class="text-color">{{ $data[0]['order_id'] }}</span>
        </p>
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
                    <td class="form3 col-lg-3 col-xs-3">運費</td>
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
      <div class="notice-title">注意事項</div>
        <div class="notice">
          <p>＊ 謝謝您的惠顧，我們將在24小時內計一份完整的訂購需求至顧客信箱供您留存。<br>
              &nbsp;&nbsp;&nbsp;&nbsp;果您有任何疑問，請來函至QQ或微信或致電931-777-262........，客服專員將為您服務。<br>
              ＊ 您也可以至訂單查詢，查看您的訂單處理狀況。<br>
              ＊ 您所訂購的商品到貨後，會立即送至指定地點或門市，取貨日期將會透過email通知您。
              </p>
        </div>
        <!--注意事項-->

        <div class="buttom-control">
        <form method="get" action="product_index">
          <button type="submit" class="btn btn-primary pull-right" >返回首頁</button>
        </form> 
        </div><!--buttom-->
@endsection