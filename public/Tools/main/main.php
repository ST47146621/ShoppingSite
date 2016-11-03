<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>廠商名稱 測試面板</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
  
  <!--bootstrap樣式-->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    
  <script src="js/bootstrap.min.js"></script>
  <script src="js/product_indexjs"></script>
  <!--icon樣式-->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--主文件-->
  <script src="js/main.js"></script>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  




</head>
<body>
  <div class="wrap">
    <div class="row index-header">
      <div class="container">
        <div class="logo1 col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <img src="image/logo1.png" alt="company logo" class="logoimang">
        </div>
        <div class="more_and_search">
          <ul class="nav nav-pills  pull-right">
            <li id="moreNav" role="presentation"><a onclick="show_ANav()"><i class="fa fa-bars"></i></a></li>
          </ul>
          <!--搜尋引擎-->
          <form id = TopSearch class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>                
          </form><!--end 搜尋引擎-->
        </div>

        <div class="index-header-nav  col-lg-9 col-md-9 col-sm-9 col-xs-12">
          <ul id="ANav" class="nav nav-pills  pull-right">                      
            <li role="presentation"><a href="#">認識我們</a></li>
            
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" >產品類別<span class="caret"></span></a>

              <ul class="dropdown-menu" role="menu">
                
                <li role="presentation" class="dropdown-submenu">
                  <a class="dropdown-toggle" data-toggle="dropdown" >1大類別</a>
                  <ul class="dropdown-menu sc" role="menu">
                    <li><a href="#">小項目</a></li>

                  </ul>                      
                </li>                      
                
                <li role="presentation" class="dropdown-submenu">
                  <a class="dropdown-toggle" data-toggle="dropdown" >2大類別</a>
                  <ul class="dropdown-menu sc" role="menu">
                    <li><a href="#">小項目</a></li>
                    <li><a href="#">小項目</a></li>                          

                  </ul>                      
                </li>

                <li id="D" role="presentation" class="dropdown-submenu">
                  <a class="dropdown-toggle" data-toggle="dropdown" >3大類別</a>
                  <ul class="dropdown-menu sc" role="menu" >
                    <li><a href="#">小項目</a></li>
                    <li><a href="#">小項目</a></li>
                    <li><a href="#">小項目</a></li>
                  </ul>                      
                </li>               

              </ul>              
            </li>            
            <li role="presentation"><a href="../shopingCar/shopingCar.php">我的購物車</a></li>            
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="../memberCenter/memberCenter.php">
                會員中心
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="../member_center/member_center.php">會員中心</a></li>
                <li><a href="../getOrder/getOrder.php">訂單查詢</a></li>
                <li><a href="#">登出</a></li>
              </ul>
            </li>

            

          </ul>
          
        </div><!--index-header-nav-->
      </div><!--container-->
    </div><!--index-header-->

    <div class="container content">

    </div>
  </div><!--endwrap-->

  <div class="row footer">
   <div class="address transform">
    <p>電話:931-777-262　傳真:931-777-263　地址:深圳南山大新村口下街7深圳0755 86179001<br>
      建議使用Google Chrome或是Mozilla Firefox 4+或是Microsoft IE 11.0以上版本瀏覽器為佳</p>
    </div>
    <!-- end .footer -->
  </div>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~右下 浮動 購物車~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="shopping_float "> 
  

  <div class="shopping_Box"><!-- 右下 購物車小框顯示 -->

  <div class="SP_lists_height">
	<table id="SP_lists">
		<tr>
			<th class="SP_lists-name">商品名稱</th>
			<th class="SP_lists-am">數量</th>
			<th class="SP_lists-size">規格</th>
			<th class="SP_lists-money">金額</th>			
		</tr>

		<tr >
			<td><a  href="#">商品名稱商品名稱商品名稱</a></td>
			<td>數量</td>
			<td>規格</td>
			<td>0,000</td>
		</tr>
		
		<tr >
			<td><a  href="#">商品名稱商品名稱商品名稱</a></td>
			<td>00</td>
			<td>規格</td>
			<td>0,000</td>
		</tr>

		<tr >
			<td><a  href="#">商品名稱商品名稱商品名稱</a></td>
			<td>00</td>
			<td>規格</td>
			<td>0,000</td>
		</tr>

    <tr >
      <td><a  href="#">商品名稱商品名稱商品名稱</a></td>
      <td>00</td>
      <td>規格</td>
      <td>0,000</td>
    </tr>
  </table>
   </div>

    <a href="../shopingCar/shopingCar.php"><div class="SP_list check_Detail">查看詳情</div></a>

  </div><!--end 右下 購物車小框顯示 -->

  
  <div class="shopping_Icon"><!-- 右下 購物車圓形圖示 -->
<!--     <a href="../shopingCar/shopingCar.php"> -->
      <div class="goTop">
        <i class="fa fa-shopping-cart fa-2x transform"></i>      
      </div>
    </a>
    <div class="goTop_num"><p>   2   </p></div>
  </div><!-- end 右下 購物車圓形圖示 -->

</div>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~end 右下 浮動 購物車~~~~~~~~~~~~~~~~~~~~~~~~ -->



  <!-- 右側NAV(手機板) -->
  <nav id="sideNav"></nav>

</body>
</html>