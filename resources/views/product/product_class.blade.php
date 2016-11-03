@extends('public_layout')

@section('tool')
<link rel=stylesheet type="text/css" href="Tools/bootstrap/css/product_class.css">
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
        var product_unit = 1;
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
            console.log('error:',data.status);
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

  <ol class="breadcrumb">
    <li><a href="product_index">首頁</a></li>
    <li class="active">{{$class}}</li>
  </ol><!--breadcrumb-->

  <h2>商品類別:{{$class}}</h2>            
  <!--產品圖片們-->
  <div class="P_boxs">
   @foreach($data as $data)
   <div class="product_box">
    <div>
      <a href="product_info?id={{urlencode($data->bid)}}"><div class="product_pic"><img src="NoImage140.png" alt=""></div></a>
      <div class="P_infor_min">
        <div>{{str_limit(($data -> mdesc),10)}}</div>

        <div>單價：
        
        @if($data->loutprice == ".00")
           {{str_replace(".00","0",$data->loutprice)}}
        
        @else
        {{str_replace(".00","",$data->loutprice)}}
        
        @endif
        
        </div>                 
      </div>
      <div class="PutshoppingCart">
        <button class="PutshoppingCart_btn" id="put" name="Submit" value="{{ $data->bid }}" type="Submit">
          <i class="fa fa-shopping-cart"></i>放入購物車
        </button>
        <!--
        <button style="visibility: hidden;" id="btnModal1" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" >放入購物車車
        </button>
        <button style="visibility: hidden;" id="btnModal2" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2" data-backdrop="static" data-keyboard="false">不能放入購物車車 因為已經有了 不能太貪心
        </button>
        -->
      </div>
    </div>
  </div><!--end product_box-->  
  @endforeach    
</div><!--end P_boxs-->

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


@endsection
@include('shopcart')