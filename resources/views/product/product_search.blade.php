@extends('public_layout')

@section('tool')
  <link rel=stylesheet type="text/css" href="Tools/bootstrap/css/product_search.css">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="product_index">首頁</a></li>
        <li class="active">商品搜尋</li>
    </ol><!--breadcrumb-->

    <h2>搜尋:{{$search}}</h2>    
    <h4>所搜尋到的商品：</h4>

    <!--產品圖片們-->
    <div class="P_boxs">
    @foreach($data as $data)
      <div class="product_box">
          <div>
              <form action="../shopingCar/shopingCar.php" method="get">
              {!! csrf_field()!!}
              
              <a href="product_info?id={{$a = urlencode($data->bid)}}"><div class="product_pic"><img src="NoImage140.png" alt=""></div></a>
              <div class="P_infor_min">            
                  <div>{{str_limit(($data -> mdesc),10)}}</div>
                  <div>NT：
                       @if($data->loutprice == ".00")
                   {{str_replace(".00","0",$data->loutprice)}}
        
                       @else
                   {{str_replace(".00","",$data->loutprice)}}
        
                       @endif

                  </div>                 
              </div>
              <div class="PutshoppingCart">
              <button class="PutshoppingCart_btn"  name="Submit" value="" type="Submit">
                <i class="fa fa-shopping-cart"></i>放入購物車
              </button>
                  
              </div>
              </form>
          </div>
      </div><!--end product_box-->
  
@endforeach
    
    </div><!--end P_boxs-->
@endsection


@include('shopcart')

