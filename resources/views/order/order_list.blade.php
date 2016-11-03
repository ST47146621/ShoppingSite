@extends('public_layout')

@section('title')
訂單查詢
@endsection

@section('tool')
<link rel=stylesheet type="text/css" href="Tools/bootstrap/css/order_list.css">

@endsection


<!--彈跳視窗-->
<!-- Modal -->
@section('content')

<!-- <div class="container content"> -->
  <ol class="breadcrumb" >
          <li><a href="product_index">首頁</a></li>
          <li><a href="member_center">會員中心</a></li>
          <li class="active">訂單查詢</li>
      </ol>   
      <!---->

      @if(empty($check))
      <div class="white_bg" style="border-radius:1em;padding:2em">
      
      <span class="heading" >訂單查詢 </span>
      
      
      <div class="row myProduct" style="height:220px;border-radius:1em;background-color:#eceade;padding:2em">       
        <p style="font-size:30px;;text-align:center;line-height:164px;">您目前沒有任何訂單</p>       
      </div>
      </div>  
      @else
      <div class="white_bg">
      <div  class=" content_header col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span class="heading" >訂單查詢 </span>
        <span class="order_state">處理狀況　
          <select  name="YourLocation">
            <option value="Taipei">全部</option>
            <option value="Taoyuan">未到貨</option>
          </select>
          </span>       
      </div>
      
      <!---->
        <?php $count=0; 
        ?>
        
        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="panel-group" id="accordion">
          @foreach($datas as $data)
            <?php 
              $subtotal = 0;
              $shipment = 20;
              $PAmount = 10;
            ?>
             <div class="panel panel">
              <div class="panel-heading" data-toggle="collapse" href="#{{ $data->bid }}" style="cursor:pointer">
                <h4 class="panel-title">
                <p>訂單編號
                    <a>
                   <span>{{ $data->bid }}</span> 
                    </a>
                    <span>訂單日期：{{str_replace(".000","",$data->order_time)}}</span>
                    <span class="hidden-lg hidden-md hidden-sm"><br/></span>
                    <span>處理狀況：處理狀況</span> 
                 <a href="#"><button class="btn btn-default pull-right">未付款</button></a>
                   </p>
                </h4>
              </div><!--panel heading-->
              <div id="{{ $data->bid }}" class="panel-collapse collapse ">
                            <div class="panel-body">
                            <div class="row">
                              <div class="col-sm-3"><label>付款方式：貨到付款</label></div>
                              <div class="col-sm-3"><label>聯絡電話：{{ $data->mobphone }}</label></div>
                              <div class="col-sm-6"><label>收貨地址：{{ $data->shipaddr }}</label></div>
                            </div>
                             <table class="table table-striped">
                                  <thead>
                                    <tr>
                                    <th class="col-sm-3">產品編號</th>
                                    <th class="col-sm-4">產品名稱</th>
                                    <th>數量</th>
                                    <th>價錢</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                      @for($i=0;$i<$response[$count]['count'];$i++)
                                      <tr>
                                        <td>{{$response[$count][$i]['mdesc']}}</td>
                                        <td>{{$response[$count][$i]['quit']}}</td>
                                        <td>${{str_replace(".00","",$response[$count][$i]['price'])}}</td>
                                      </tr>
                                      <?php $subtotal += $response[$count][$i]['price']?>
                                      @endfor
                                    
                                    </tbody>
                                    <tfoot>                                   
                                      <td>運費： {{$shipment}}元 + 小計： {{$subtotal}}元</td>
                                      <td>總計： {{$shipment+$subtotal}}元</td>
                                      <td>使用積分金額： {{$PAmount}}元</td>
                                      <td>總共： {{$shipment+$subtotal-$PAmount}}元</td>
                                    </tfoot>
                              </table>
                      </div><!--.panel-body-->
            </div><!--.panel-collapse-->
            </div><!--panel-default-->
            <?php $count+=1; ?>
            @endforeach
         </div><!--panel group-->
      </div><!--row-->
    
    <!--頁碼-->

    <?php $total=$datas->total(); ?>

    @if(  $total  >5 )
      {!! $datas->render() !!} 
    @else
      <ul class="pagination">
        <li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
      </ul>
    @endif   
    <!--
    <nav>
      <ul class="pagination">
        <li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
      </ul>
    </nav>
    -->
    </div><!--white_bg-->
    @endif
<!-- </div> -->



@endsection

@include('shopcart')