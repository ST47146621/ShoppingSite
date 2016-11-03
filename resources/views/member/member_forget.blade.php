@extends('public_layout')

@section('tool')
<link rel="stylesheet" type="text/css" href="Tools/bootstrap/css/forgetKey.css">
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
        } 
      });

    $(window).load(function(){
      $('.btn.danger').button('toggle').addClass('fat')
    });

    //彈跳視窗
    function to_member(){
      document.location.href="member";
      //document.getElementById("myModal").style.visibility = 'hidden'; 
      //document.getElementById("myModal2").style.visibility = 'hidden';
      
    };
    function to_forget(){
      document.location.href="forget_emailcheck";
      //document.getElementById("myModal").style.visibility = 'hidden'; 
      //document.getElementById("myModal2").style.visibility = 'hidden';
      
    };
    //auto.submit();
    $(document).ready(function(){
      
        $('#send').click(function(){
          $(".wrap").show().css({"opacity": "0.5"});
          $("#loading").show();

          //$('#btnModal3').click();
          //document.getElementById("myModal3").style.visibility = 'visible';

          var email = $('#yourEmail').val();
          var dataString = "yourEmail="+email;
          $.ajax({
            type:"post",         
            url:"forget_emailcheck",
            data:dataString,
            success:function(data){
              console.log('in');
              $("#loading").hide();
              $(".wrap").show().css({"opacity": "1"});
              //關掉Loading
              //document.getElementById("myModal3").style.visibility = 'hidden';
              //顯示寄信成功
              //document.getElementById("myModal").style.visibility = 'visible';
              $('#btnModal1').click();
              
              //document.getElementById("myModal3").style.visibility = 'hidden';
            },
            error:function(){
              console.log('error');
              $("#loading").hide();
              $(".wrap").show().css({"opacity": "1"});
              $('#btnModal2').click();
            }
          });
        });
      });
</script> 
  @endsection

@section('title')
忘記密碼
@endsection

  @section('content')
  <div id="loading" style="text-align : center;z-index:9999;position: absolute; top: 40%;left: 50%;display:none;opacity:1">
      <div id="LoadingImage" >
          <img src="Tools/bootstrap/img/ajax-loader-b.gif" />
      </div>
      <p><br><strong>寄信中，請稍後。</strong></p>
  </div>
  <ol class="breadcrumb">
    <li><a href="product_index">首頁</a></li>
    <li><a href="member_center">會員中心</a></li>
    <li class="active">忘記密碼</li>
  </ol><!--breadcrumb-->
    <div class="col-lg-12 col-xs-12">
      <div class="email">密碼</div>
      <div class="email-column col-lg-3 col-xs-3"><p class="transform">email</p></div>
      <div class="email1 col-lg-9 col-xs-9">
        <div class=" col-lg-8 col-xs-8">
          <input type="text" class="input-group form-control" id="yourEmail" name="yourEmail">
          
        </div>
        <!--<span class="wrong col-lg-4 col-xs-4">輸入錯誤</span>-->
      </div>
    </div>
    <button  id="send" type="button" class="btn btn-primary btn-lg">確認送出

    <!-- Button trigger modal -->
    
   
  <button style="visibility: hidden;" id="btnModal1" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">確認送出
  </button>
  <button style="visibility: hidden;" id="btnModal2" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2" data-backdrop="static" data-keyboard="false">錯誤
  </button>
  <button style="visibility: hidden;" id="btnModal3" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal3" data-backdrop="static" data-keyboard="false">Loading
  </button>
  <!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">會員中心 忘記密碼</h4>
        </div>
        <div class="modal-body">
          <p>已經寄到email，請立刻至email的連結更改密碼。<br>
            如有任何問題請來電由客服人員幫您處理。
          </p>
        </div>
        <div class="modal-footer">
          <a class="btn btn-default" role="button" onclick="to_member()">Close</a>
        </div>
      </div>
    </div>
  </div>
  <!--Modal2 -->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">會員中心 忘記密碼</h4>
        </div>
        <div class="modal-body">
          <p>查無此信箱帳號或輸入錯誤！請重新輸入。<br>
            如有任何問題請來電由客服人員幫您處理。
          </p>
        </div>
        <div class="modal-footer">
          <a class="btn btn-default" role="button" onclick="to_forget()">Close</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Loading -->
  <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">   
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">會員中心 忘記密碼</h4>
        </div>   
        <div class="modal-body" style="text-align : center;">
          <div id="LoadingImage" >
            <img src="Tools/bootstrap/img/ajax-loader-b.gif" />
          </div>
          <p><br><strong>寄信中，請稍後。</strong></p>
        </div>
      </div>
    </div>
  </div>

  <!--end 中間內容container content"-->
  @endsection


