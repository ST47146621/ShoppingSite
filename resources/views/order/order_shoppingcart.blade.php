@extends('public_layout')

@section('title')
購物車
@endsection

@section('tool')
<link rel=stylesheet type="text/css" href="Tools/bootstrap/css/shop_cart.css">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
  .no-close .ui-dialog-titlebar-close {
  display: none;
}
</style>
<script type="text/javascript">
  $.ajaxSetup({
    headers: { 
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
    } 
  });
    //auto.submit();
    $(document).ready(function(){

      $("#userinfo").click(function(){
        var x = document.getElementById("userinfo").checked;
        if (x == true) {
          $.ajax({
            type:"post",         
            url:"order_userinfo",
            success:function(data){
              console.log('in');
              document.forms['myform'].elements['recipient'].value = data.name;
              document.forms['myform'].elements['phone'].value = data.phone;
              document.forms['myform'].elements['email'].value = data.email;
              document.forms['myform'].elements['address'].value = data.compaddr;
            },
            error:function(data){
              console.log(data);
            }
          });
          
        }else{
          document.forms['myform'].elements['recipient'].value = '';
          document.forms['myform'].elements['phone'].value = '';
          document.forms['myform'].elements['email'].value = '';
          document.forms['myform'].elements['address'].value = '';
        }
      });
      $('button').click(function(){
        var pid = this.value;
        var dataString = "pid="+pid;
        $( "#dialog" ).dialog({
          dialogClass: "no-close",
          modal:true,
          buttons: [
          {
            id:"btnDel",
            text: "確定",
            click: function(){
              $.ajax({
                type:"post",         
                url:"order_delete",
                data:dataString,
                success:function(data){
                  console.log('in');
                  location.reload();
                },
                error:function(data){
                  console.log(data);
                }
              });
            }
          },
          {
            id:"btnCancel",
            text:"取消",
            click:function(){
              $( "#dialog" ).dialog( "close" );
            }
          }
          ]
        });
      });
    });
  </script> 
  @endsection

  @section('content')
  <ol class="breadcrumb">
    <li><a href="product_index">首頁</a></li>
    <li class="active">我的購物車</li>
  </ol><!--end breadcrumb-->

  <div id="dialog" style="display:none" title="刪除通知">
    <p>確定要刪除這筆商品嗎？</p>
  </div>
  <!--購買商品-->
  <form class="white-bg form-horizontal" action="order_confirm" method="post" name="myform" >
    {!! csrf_field() !!}
    <div class="white-bg-header">
      <i class="fa fa-shopping-cart fa-2x"> </i> 我的購物車
    </div>
    <?php $total=0; ?>

    @if($data == "")
    <div class="row myProduct" style="height:220px">       
      <p style="font-size:30px;;text-align:center;line-height:164px;">您的購物車目前沒有商品</p>       
    </div>
    @else
    @foreach($data as $data)
    <div class="row myProduct">
      <div class="product_box col-md-6 col-sm-6 col-xs-12"><a href="#" ><img src="#" class="product_pic" alt=""></a></div>
      <div class="P_information col-md-6 col-sm-6 col-xs-12">
        <ul>
          <li class="name" > 商品名稱：{{ $data['mdesc'] }}</li>
          <input id="name" value="{{ $data['bid'] }}" style="display:none">
          <li id="price">  單價：@if($data['price'] == ".00")
           {{str_replace(".00","0",$data['price'])}}

           @else
           {{str_replace(".00","",$data['price'])}}

           @endif

         </li>
         <li>  數量：
          <select name="product_unit" id="product_unit" onchange="change_unit(this)" >
            @for($i = 1;$i<=(int)($data['unit']);$i++)
            @if($i == $data['quit'])
            <option value="{{$i}}" selected="selected">{{ $i }}</option>
            @else
            <option value="{{$i}}" >{{ $i }}</option>
            @endif
            @endfor
          </select>
          <script type="text/javascript">
            function change_unit(sel){
              var el = sel.parentNode.parentNode;
              //單價
              var price = $(el).find("#price").text().split("：");
              //小計
              var subtotal = ($(el).find("#su").text()).split("：");
              //總計
              var total = $('#total').text().split("$");
              //小計變化量
              var subtotal_change = (parseInt(price[1])*sel.value - parseInt(subtotal[1]));
                   
              $(el).find("#su").text('小計：'+parseInt(price[1])*sel.value);
              $('#total').text('總計：$'+(parseInt(total[1])+subtotal_change));
              
              var pid = $(el).find("#name").val();
              var unit = sel.value;
              var dataString = "pid="+pid+"&unit="+unit;

              $.ajax({
                type:"post",         
                url:"order_unit_change",
                data:dataString,
                success:function(data){
                  console.log('in');
                },
                error:function(data){
                  console.log(data);
                }
              });
            }
          </script>
              </li>
              <li>  尺寸：</li>
              <li>  顏色：</li>
              <?php 
              $price = $data['price'] * $data['quit'];
              $total += $price;
              $shipment = 0;
              ?>
              <li class="sub" id="su">  小計：{{ $price }}</li>        
            </ul>
          </div>

          <button id="order_delete" class="DeleteShoppingCart" name="order_delete" value="{{ $data['bid'] }}" type="button"><i class="fa fa-trash"></i></button>
        </div>

        @endforeach

        <!--end of 購買商品-->

        <div class=GoToPay>
          <div class="delivery row">
            <ul>
              <li id="fee">運費：<span></span>
                <select id="send_fee" onchange="add_fee()">
                  <option value="0">請選擇交貨方式</option>
                  <option value="120">貨運 / 宅配 (運費：120元) </option>
                  <option value="60">全家取貨付款 (運費：60元) </option>
                  <option value="30">7-11取貨付款 (運費：30元) </option>
                </select>
                <script type="text/javascript">
                  function add_fee(){
                    var x = document.getElementById("send_fee").value;
                    var t = {{$total}};
                    var t = t + parseInt(x);
                    document.getElementById("total").innerHTML = '總計：$'+t;
                  }
                </script>
              </li>
              <li id="total" class="sub">總計：${{$total}}</li>       
            </ul>
          </div>

          <div class="payment row" style="padding-left: 14px;">
            <div class="pay-heading ">付款方式</div>
            <div class="form2">           
              <input type="radio" name="pay" value="market" checked> 商店取貨付款<br>
              <input type="radio" name="pay" value="creditcard"> 信用卡線上刷卡<br>
              <input type="radio" name="pay" value="ATM"> ATM轉帳<br>
              <input type="radio" name="pay" value="cash"> 貨到付款
            </div>
          </div>
          <div class="recipient-info row" style="padding-left: 14px;">
            <div class="form1 pay-heading" >收件人資料<input type="checkbox" id="userinfo" style="margin-left:20px">同帳號資訊</div>
            <div class="receiver col-lg-12 col-md-12 col-sm-12 col-xs-12">
             @if ($errors->has('recipient'))
             <div class="form-group">
              <label class="control-label col-sm-2" for="#recipient">收件人:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="recipient" name="recipient" style="border-color:red">
              </div>
              <span class="help-block col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-right:0px;">
                <strong>{{ $errors->first('recipient') }}</strong>
              </span>
            </div>
            @else
            <div class="form-group">
              <label class="control-label col-sm-2" for="#recipient">收件人:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="recipient" name="recipient">
              </div>
            </div>
            @endif
            @if ($errors->has('phone'))
            <div class="form-group">
              <label class="control-label col-sm-2" for="#phone">連絡電話:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="phone" name="phone" style="border-color:red">
              </div>
              <span class="help-block col-lg-3 col-md-3 col-sm-3 col-xs-12 "  style="padding-right:0px;">
               <strong>{{ $errors->first('phone') }}</strong>
             </span>
           </div>
           @else
           <div class="form-group">
            <label class="control-label col-sm-2" for="#phone">連絡電話:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="phone" name="phone">
            </div>
          </div>
          @endif
          @if ($errors->has('email'))
          <div class="form-group">
            <label class="control-label col-sm-2" for="#email">email：</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="email" name="email" style="border-color:red">
            </div>
            <span class="help-block col-lg-3 col-md-3 col-sm-3 col-xs-12 "  style="padding-right:0px;">
             <strong>{{ $errors->first('email') }}</strong>
           </span>
         </div>
         @else
         <div class="form-group">
          <label class="control-label col-sm-2" for="#email">email：</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" id="email" name="email">
          </div>
        </div>
        @endif
        @if ($errors->has('address'))
        <div class="form-group">
          <label class="control-label col-sm-2" for="#address">地址：</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" id="address" name="address" style="border-color:red">
          </div>
          <span class="help-block col-lg-3 col-md-3 col-sm-3 col-xs-12 "  style="padding-right:0px;">
           <strong>{{ $errors->first('address') }}</strong>
         </span>
       </div>
       @else
       <div class="form-group">
        <label class="control-label col-sm-2" for="#address">地址：</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="address" name="address">
        </div>
      </div>
      @endif
      <div class="form-group">
        <label class="control-label col-sm-2" for="#remark">備註：</label>
        <div class="formdata1 col-sm-7" >
          <textarea  class="form-control " id="remark" name="remark"></textarea>
        </div>
      </div>

    </div>
  </div> 
</div>
<div class="text-right">
  <input class="GoToPay_btn row"  name="GoToPay_btn" value="前往結帳" type="submit">
</div>
@endif
</form>
@endsection
