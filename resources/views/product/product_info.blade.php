@extends('public_layout')

@section('title')
product_info
@endsection
@section('tool')
<link href="Tools/bootstrap/css/product.css" rel="stylesheet" type="text/css">
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
      
      $('button').click(function(){
        var product_id = this.value;
        var product_unit = $("#product_unit").val();
        var dataString = "product_id="+product_id+"&P_amount="+product_unit;
        $.ajax({
          type:"post",         
          url:"order_putshoppingcart",
          data:dataString,
          success:function(data){
          //console.log('success:',data.status);
          if(data.status == 0){   
            //console.log('status:',data.status);
            $( "#dialog" ).dialog({
              modal:true,
              dialogClass: "no-close",
              buttons: [
              {
                text: "OK",
                click: function() {
                $( this ).dialog( "close" );
                location.reload();
                }
              }]
            });
          }
          else
          {
            //console.log('status:',data.status);
            $( "#dialog2" ).dialog({
              modal:true,
              dialogClass: "no-close",
              buttons: [
              {
                text: "OK",
                click: function() {
                $( this ).dialog( "close" );
                }
              }]
            });
          }
          },
          error:function(data){
          //console.log('error')
          if(data.status == 401)
          {
            //console.log('error:',data.status);
            $( "#dialog3" ).dialog({
              dialogClass: "no-close",
              modal:true,
              buttons: [
              {
                text: "OK",
                click: function() {
                $( this ).dialog( "close" );
                document.location.href="member";
                }
              }]
            });
          }            
          }
        });
      });
      
    });
  </script> 
@endsection
@section('content')

@if($data != null)
<ol class="breadcrumb">
    <li><a href="product_index">首頁</a></li>
    @if($class !=null)
    
    <li><a href="product_class?class={{$class->typename}}&id={{$data->parttype}}">{{$class->typename}}</a></li>
    @else
    <li><a href="product_class?class=其他&id={{$data->prodtype}}">其他</a></li>
    @endif
    <!--<li class="active">{{$data->bid}}-{{$data->mdesc}}</li>-->
    <li class="active">{{$data->mdesc}}</li>
</ol><!--breadcrumb-->

<!--商品-->
<form  name="PutshoppingCart" class="PutshoppingCart">
  {!! csrf_field() !!}
    <div class="product_box "><a href="#" ><img src="NoImage400.png" class="product_pic" alt=""></a></div>
    <div class="P_infor">
        <ul>
            <!--<li class="neme"> {{$data->bid}}-{{$data->mdesc}}</li>-->
            <li class="neme">{{$data->mdesc}}</li>
            <li>    單價 :@if($data->loutprice == ".00")
             {{str_replace(".00","0",$data->loutprice)}}

             @else
             {{str_replace(".00","",$data->loutprice)}}

             @endif</li>
             <li>    數量：

                <select name="product_unit" id="product_unit">
                    @for($i = 1;$i<=(int)($data->unit);$i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor

                </select>
            </li>
            <li>    <strong style="color:#F00">剩餘數量：{{ $data->unit }}</strong>
            </li>
        </ul>
        <button class="PutshoppingCart_btn"  name="Submit" value="{{ $data->bid }}" type="button"><i class="fa fa-shopping-cart"></i>放入購物車</button>
    </div>
    </form>
    <!--end商品-->
    <div id="dialog" style="display:none" title="已成功加入購物車">
    <p>您的商品已加入購物車</p>
    </div>

    <div id="dialog2" style="display:none" title="加入購物車失敗">
    <p>此商品已存在於購物車<br></p>
    <p>請在購物車裡面選擇數量</p>
    </div>

    <div id="dialog3" style="display:none" title="會員通知">
    <p>請先登入再加入購物車<br></p>
    </div>
    @endif
    <div class="detailed">
        <h3>詳細資料</h3>
        <hr>
        <p>尺寸</br>
            規格
        </p>
    </div>
    <!--end 產品-->



</div><!--endwrap-->

@endsection
@include('shopcart')