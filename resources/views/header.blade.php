  <!--類別列表-->
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <link rel="stylesheet" href="Tools/jquery/jquery-ui.css" />
  <script type="text/javascript">
    $.ajaxSetup({
        headers: { 
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
        } 
      });
    $(document).ready(function(){      
          $.ajax({
            type:"post",         
            url:"header_ajax",
            success:function(data){
             //href="product_class?class='+data.data[i].parttype+'&id='+data.data[i].bid+'"name="class" value=""
              var now_head=data.data[0].typename;
              var i=0;
              var x="";
              console.log(now_head+"!!!");
              x+='<li><a href="product_class?class='+data.data[i].typename+'&id='+data.data[i].bid+'"name="class" value="">'+ data.data[0].typename +'</a></li>';
              for(i=0 ; i<data.data.length ; i++)
              {
                if(now_head != data.data[i].typename){
                  if(data.data[i].typename == null){
                    x+='<li><a href="product_class?class=其他&id="name="class" value="">其他</a></li>';
                  }
                  else{
                    console.log(data.data[i].typename);
                    x+='<li><a href="product_class?class='+data.data[i].typename+'&id='+data.data[i].bid+'"name="class" value="">'+ data.data[i].typename +'</a></li>';
                  }
                  now_head=data.data[i].typename;
                }
              }       
              document.getElementById("product").innerHTML =x;
            },
            error:function(){
              console.log('error');
            }
          });
          //搜尋列表
         
           var availableTags =[];
           
            $.ajax({
            type:"post",         
            url:"search_ajax",
            success:function(data){
            for(j=0;j<data.data.length;j++)
              {
                  availableTags[j] = 
                  {
             value:data.data[j].bid,
             label:data.data[j].mdesc
          
                   };
                    
            }
              
             $( "#tags" ).autocomplete({
             source: availableTags,
            focus: function(event,ui) {
            $( "#tags" ).val(ui.item.label);
             return false;
            },
           select: function(event,ui) { 
           
           location.assign('product_info?id=' + encodeURIComponent(ui.item.value));
            return false;
          }
    });
            },
            error:function(){
              console.log('error');
            }
          });



      });
  </script>
  


  <!--其他內容-->
  <div class="row index-header">
      <div class="container">
        <div class="logo1 col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <a href="product_index"><img src="Tools/bootstrap/img/logo1.png" alt="company logo" class="logoimang"></a>
        </div>

        <div class="more_and_search">
          <ul class="nav nav-pills  pull-right">
            <li id="moreNav" role="presentation"><a onclick="show_ANav()"><i class="fa fa-bars"></i></a></li>
          </ul>
          <!--搜尋引擎-->
          <form action="product_search" method="post" id = TopSearch class="navbar-form navbar-left" role="search" >
            {!! csrf_field() !!}
            <div class="form-group">
            
              <input type="text" class="form-control" placeholder="Search" name = "search" id="tags">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>                
          </form><!--end 搜尋引擎-->
        </div>

        <div class="index-header-nav  col-lg-9 col-md-9 col-sm-9 col-xs-12">
          <ul id="ANav" class="nav nav-pills  pull-right">                      
            <li role="presentation"><a href="about_us">認識我們</a></li>
            
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" >產品類別<span class="caret"></span></a>
              <ul id="product" class="dropdown-menu" role="menu">      
              </ul>
            </li>      

            <li role="presentation"><a href="order_shoppingcart">我的購物車</a></li>            
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="../memberCenter/memberCenter.php">
                會員中心
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
              @if(Auth::check())
                <li><a href="member_center">{{ Auth::user()->custname}}</a></li>
                @else
                <li><a href="member_center">會員中心</a></li>
                @endif
                <li><a href="order_list">訂單查詢</a></li>
                  @if(Auth::check())
            <li><a href="logout" >登出</a><li>           
              @else
              <li><a href="member">登入</a></li>
              @endif
              </ul>
            </li>

            

          </ul>
          
        </div><!--index-header-nav-->
      </div><!--container-->
    </div><!--index-header-->