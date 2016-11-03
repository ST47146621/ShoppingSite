

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script type="text/javascript">
   $.ajaxSetup({
        headers: { 
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')          } 
      });

  $(document).ready(function(){ 

    $.ajax({
            type:"post",         
            url:"get_quick_view",
            success:function(data){
              console.log(data.data.length);
              console.log(data.data[0].mid)
              
              var i;
              var detail="";
              var title="";
              for(i=0;i<data.data.length;i++)
              {
                 detail=detail+'<tr><td><a href="product_info?id='+encodeURIComponent(data.data[i].mid)+'">'+(data.data[i].mdesc.substr(0,8))+".."+'</a></td><td>'+data.data[i].qty+'</td><td>'+'規格'+'</td><td>'+data.data[i].price+'</td></tr>'        
              }      
              title='<tr><th class="SP_lists-name">商品名稱</th><th class="SP_lists-am">數量</th><th class="SP_lists-size">規格</th><th class="SP_lists-money">金額</th></tr>';           
              document.getElementById("SP_lists").innerHTML =title+detail;
              document.getElementById("num").innerHTML =data.data.length;
              document.getElementById("SP_list").innerHTML ='查看詳情';
              
            },
            error:function(){
              console.log('error');

            }
          });
  });

</script>

<div class="shopping_float" style="z-index:1">
  <div class="shopping_Box">

   <!-- 右下 購物車小框顯示 -->
    <div class="SP_lists_height">
    <table id=SP_lists>  
    </table>
    </div>
    @if(Auth::user())
    <div class="cart-detail"><a href="order_shoppingcart"><div class="SP_list check_Detail" id="SP_list"></div></a></div>
    @else
    <script type="text/javascript">
    $(document).ready(function(){
      $(".shopping_Icon").click(function(){      
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
      });
    });
    </script>
    <div id="dialog3" style="display:none" title="會員通知">
    <p>請先登入再查看購物車<br></p>
    </div>
    @endif
  </div>

  <!-- 右下 購物車圓形圖示 -->
    <div class="shopping_Icon">
        <div class="goTop">
          <i class="fa fa-shopping-cart fa-2x transform"></i>      
        </div>
      <div id="num" class="goTop_num"><p>      </p></div>
    </div><!-- end 右下 購物車圓形圖示 -->
</div>
