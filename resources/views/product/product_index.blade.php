@extends('public_layout')

@section('tool')
  <link rel=stylesheet type="text/css" href="Tools/bootstrap/css/product_index.css">
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
   $.ajaxSetup({
        headers: { 
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
        } 
      });

  $(document).ready(function(){ 
    $.ajax({
            type:"post",         
            url:"index_class",
            success:function(data){
              //var z=data.id.length;
              var now_head=data.data[0].typename;
              var i=0;
              var x="";
              console.log(data);
              x+='<div class="show_product_pic"><h3>'+now_head+'</h3><a href="product_info?id='+data.data[0].pid+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[0].mdesc + '</div></a><a href="product_info?id='+data.data[1].pid+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[1].mdesc + '</div></a><a href="product_info?id='+data.data[2].pid+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[2].mdesc + '</div></a><a href="product_info?id='+data.data[3].pid+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[3].mdesc + '</div></a><a href="product_info?id='+data.data[4].pid+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[4].mdesc + '</div></a>';
              for(i=0 ; i<data.data.length ; i++){
                if(now_head != data.data[i].typename){
                  if(data.data[i].typename == null){
                    now_head = "其他";
                    console.log("change");
                  }
                  x+='<div class="show_product_pic"><h3>'+now_head+'</h3><a href="product_info?id='+encodeURIComponent(data.data[i].pid)+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[i].mdesc +'</div></a><a href="product_info?id='+encodeURIComponent(data.data[++i].pid)+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[i].mdesc +'</div></a><a href="product_info?id='+encodeURIComponent(data.data[++i].pid)+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[i].mdesc +'</div></a><a href="product_info?id='+encodeURIComponent(data.data[++i].pid)+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[i].mdesc +'</div></a><a href="product_info?id='+encodeURIComponent(data.data[++i].pid)+'"><div class="product_pic"><img src="NoImage108.png">'+ data.data[i].mdesc +'</div></a>';now_head = data.data[i].typename;             
                }
              }
              

              
              /*x+='<div class="show_product_pic">';            
              for (i; i<z; i++) {
                if((i%5)==0){
                  x+='<h3>'+data.head[i/5]+'</h3>';
                }
                x+='<a href="product_info?id='+encodeURIComponent(data.id[i])+'"><div class="product_pic"><img src="NoImage108.png">'+data.id[i].substr(0,10)+'</div></a>';
              }
              x+='</div>' */
              
              document.getElementById("test").innerHTML =x;
              
            },
            error:function(){
              console.log('error');
            }
          });
  });

</script>

@section('content')
   <!--輪播圖片-->
    <div class="show_pic">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="NoImage1070.png" alt="...">
              <div class="carousel-caption">
                產品名稱
              </div>
            </div>
            <div class="item">
              <img src="NoImage10702.png" alt="...">
              <div class="carousel-caption">
                產品名稱
              </div>
            </div>
            <div class="item">
              <img src="NoImage1070.png" alt="...">
              <div class="carousel-caption">
                產品名稱
              </div>
            </div>
            <div class="item">
              <img src="NoImage10702.png" alt="...">
              <div class="carousel-caption">
                產品名稱
              </div>
            </div>

          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>   

    </div><!--end 輪播圖片-->

    <!--類別 產品圖片-->
    <div id = test>
        
    </div><!--end 類別 產品圖片-->
@endsection

@include('shopcart')