@extends('public_layout')

@section('tool')
<link rel=stylesheet type="text/css" href="Tools/bootstrap/css/member.css">
@endsection

@section('title')
XX股份有限公司
@endsection

@section('content')
    <div class="panel panel1 col-lg-6 col-md-6 col-sm-6  col-xs-12">
      <div class="panel-heading">登入</div>
      <div class="panel-body">
        <div>
          <form action="{{ url('login') }}" method="post" name="Login_Form" class="">    
          {!! csrf_field() !!}      
              <div class="input-group">
                                <span class="input-group-addon">登入e-mail</span>
                                <input type="text" class="form-control" name="email" placeholder="E-mail" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">密碼</span>
                                 <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            
                            <div class="input-group">
                                <span class="input-group-addon">驗證碼</span>
                                
                                 <input style="width:50%" type="text" class="form-control" id="CaptchaCode" name="CaptchaCode">    

                            </div>
                            <div class="input-group">
                                {!! captcha_image_html('ContactCaptcha') !!}
                            </div>

                            @if ($errors->has('CaptchaCode'))
                            <span class="help-block">
                            <strong>{{ $errors->first('CaptchaCode') }}</strong>
                            </span>
                            @endif                
                            @if ($errors->has('fail'))
                            <span class="help-block">
                            <strong>{{ $errors->first('fail') }}</strong>
                            </span>
                            @endif

                <div style="position:absolute;bottom:0%;width:95%">
               <button class="btn btn-lg btn-block login-btn"  name="Submit" value="Login" type="Submit">登入</button> 
                </form>
               <form action="{{ url('/forget_emailcheck') }}" method="get" name="Foget_Form" class="">
               <button class="btn btn-lg btn-block login-btn"  name="Submit" value="Login" type="Submit">忘記密碼</button>  
              </div>      
            </form>     
        </div>
      </div>
    </div>
  <!-- panel-register-->
    <div  class="panel panel1  col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="panel-heading">註冊</div>
      <div class="panel-body">
        <div>
          <form action="{{ url('registered')}}" method="post" name="Login_Form" class="">
          {!! csrf_field() !!}
                            @if ($errors->has('email'))
                            <div class="input-group">
                                <span class="input-group-addon">登入e-mail</span>
                                <input type="text" class="form-control" name="username" placeholder="E-mail" style="border-color:red">
                            </div>                         
                            <span class="help-block" style="margin-top:-20px;margin-bottom:0px;">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @else
                            <div class="input-group">
                                <span class="input-group-addon">登入e-mail</span>
                                <input type="text" class="form-control" name="username" placeholder="E-mail" >
                            </div>
                            @endif                           
                            
                            @if ($errors->has('password'))
                            <div class="input-group">
                                <span class="input-group-addon">登入密碼</span>
                                 <input type="password" class="form-control" name="password"  placeholder="Password" style="border-color:red">
                            </div>
                            <span class="help-block" style="margin-top:-20px;margin-bottom:0px;">
                            <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @else
                            <div class="input-group">
                                <span class="input-group-addon">登入密碼</span>
                                 <input type="password" class="form-control" name="password"  placeholder="Password">
                            </div>
                            @endif 
                            
                            @if ($errors->has('password_confirmation'))
                            <div class="input-group">
                                <span class="input-group-addon">確認密碼</span>
                                 <input type="password" class="form-control" name="cpassword" placeholder="Confirm password" style="border-color:red">
                            </div>
                            <span class="help-block" style="margin-top:-20px;margin-bottom:0px;">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @else
                            <div class="input-group">
                                <span class="input-group-addon">確認密碼</span>
                                 <input type="password" class="form-control" name="cpassword" placeholder="Confirm password">
                            </div>
                            @endif 
                               
                            @if ($errors->has('mobphone'))
                            <div class="input-group">
                                <span class="input-group-addon">手機號碼</span>
                                 <input type="text" class="form-control" name="mobphone" placeholder="Cell phone" style="border-color:red">
                            </div> 
                            <span class="help-block" style="margin-top:-20px;margin-bottom:0px;">
                            <strong>{{ $errors->first('mobphone') }}</strong>
                            </span>
                            @else
                            <div class="input-group">
                                <span class="input-group-addon">手機號碼</span>
                                 <input type="text" class="form-control" name="mobphone" placeholder="Cell phone">
                            </div> 
                            @endif 
                               
                            @if ($errors->has('custname'))
                            <div class="input-group">
                                <span class="input-group-addon">用戶姓名</span>
                                 <input type="text" class="form-control" name="custname"  placeholder="Name" style="border-color:red">
                            </div> 
                            <span class="help-block" style="margin-top:-20px;margin-bottom:0px;">
                            <strong>{{ $errors->first('custname') }}</strong>
                            </span>
                            @else
                            <div class="input-group">
                                <span class="input-group-addon">用戶姓名</span>
                                 <input type="text" class="form-control" name="custname"  placeholder="Name">
                            </div> 
                            @endif   

                            @if ($errors->has('compaddr'))                     
                            <div class="input-group">
                                <span class="input-group-addon">地址</span>
                                 <input type="text" class="form-control" name="compaddr" placeholder="Address" style="border-color:red">
                            </div> 
                            <span class="help-block" style="margin-top:-20px;margin-bottom:0px;">
                            <strong>{{ $errors->first('compaddr') }}</strong>
                            </span>
                            @else
                            <div class="input-group">
                                <span class="input-group-addon">地址</span>
                                 <input type="text" class="form-control" name="compaddr" placeholder="Address">
                            </div>
                            @endif

                              <div class="input-group">
                                是否同意<a data-toggle="modal" data-target="#myModal" type="button" style="color:#FB6A90;font-weight:bold;" >服務條款</a>                              　                                   
                                    <label class="radio-inline">
                                    <input type="radio" name="optradio" value="true">同意
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="optradio" checked="" value="false">不同意
                                    </label>

                                    <label style="color:red;margin-left:20px">                                    
                                    @if ($errors->has('optradio'))                                  
                                        {{ $errors->first('optradio') }}
                                    @endif                                   
                                    </label>
                              </div>
                     <!-- Modal -->
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <h4 class="modal-title" style="font-weight:bold;" id="myModalLabel">服務條款</h4>
                            </div>
                            <div class="modal-body" >
                              一、認知與接受條款 iToEat 點餐時光（以下簡稱本站）係依據本服務條款提供美食點餐平台（連結）服務以及其他相關之服務（以下簡稱本服務）。當您在本站註冊成正式使用者，開始使用本服務時，即表示您已閱讀、瞭解並同意接受本約定書之所有內容。本站有權於任何時間修改或變更本約定書之內容，唯在修改或變更後，須立即公告於本站之系統消息頁面。您於任何修改或變更後繼續使用本服務，<strong style="color:#FB6A90">即視為您已閱讀、瞭解並同意接受該等修改或變更。</strong>如果<strong style="color:#4A73AB">您不同意本約定書的內容，您應該立即停止使用本站提供的任何服務。</strong>
                              </br>
                              </br>
                          二、您的註冊義務 為了能使用本服務，您同意以下事項： 為了確保雙方權益，請您依本服務註冊表之提示提供您本人正確、最新及完整的資料 維持並更新您個人資料，確保其為正確、最新及完整 若您提供任何錯誤或不實的資料，本公司有權暫停或終止您的帳號，並拒絕您使用本服務之全部或一部。
                          </br>
                          </br>
                          三、隱私權政策 本站依上述規定收集您的個人資料，不會對任何人出售或出借您的個人資料。除非是下列情況，本站不會向任何人公開您的資料： 基於法律相關規定 接受司法機關或是其他有權機關基於法定程序之要求 在緊急情況下為維護使用者或第三人之人身安全
                          </br>
                          </br>
                          四、會員帳號、密碼及安全 完成本服務的登記程序後，您將擁有一個專屬帳號及密碼。維持帳號及密碼的機密安全，是您的責任。利用該密碼及帳號所進行的一切行動，於法律上您將負相應的責任。您並同意以下事項： 您的帳號或密碼遭到盜用或有其他任何安全問題發生時，您將立即通知本站。 每次連線使用完畢，均進行登出以結束您的帳號使用。
                          </br>
                          </br>
                          五、使用者的守法義務及承諾 您承諾絕不為任何非法目的或以任何非法方式使用本服務，並承諾遵守中華民國相關法規及一切使用網際網路之國際慣例。（若您為中華民國以外之使用者，並同意遵守所屬國家或地域之法令）您同意並保證不得利用本服務從事侵害他人權益或違法之行為，包括但不限於： 妨害他人名譽或隱私權 張貼任何誹謗、侮辱、具威脅性、攻擊性、不雅、猥褻、不實、違反公共秩序、善良風俗或其他不法之文字。 違反依法律或契約所應負之保密義務 冒用他人名義使用本服務 從事不法交易行為 濫發廣告郵件及張貼廣告文張 其他本站有正當理由認為不適當之行為
                          </br>
                          </br>
                          六、系統中斷或故障、免責聲明 本站將盡最大努力維護本站的正常運作以及資料安全。本服務有可能出現中斷或故障等等的情況，或許會造成您使用上的不便，資料的喪失、錯誤、遭人篡改或其他損失情形。您於使用本服務時宜自行採取防護措施。本站對你因為使用（或無法使用）本服務而造成的損害，將不負任何賠償責任。
                          </br>
                          </br>
                          七、資料授權 對於會員所登錄或留存之個人資料，您同意iToEat點餐時光得於合理之範圍內蒐集、處理、保存、傳遞及使用該等資料，以提供使用者其他資訊或服務、或作成會員統計資料、或進行關於網路行為之調查或研究，或為任何之合法使用。
                          </br>
                          </br>
                          八、拒絕或終止您的使用 您同意iToEat點餐時光得基於維護交易安全之考量，因任何理由，包含但不限於久未使用，或違反本服務條款的明文規定及精神，終止您的密碼、帳號（或其任何部分）或本服務之使用，並將本服務內任何「會員內容」加以移除並刪除，亦得已通知之情形下，隨時終止本服務或任何部分。此外，您同意若本服務之使用被終止，進iToEat點餐時光對您或任何第三人均不承擔責任。
                          </br>
                          </br>
                          九、準據法與管轄法院 本約定書之解釋與適用，以及與本約定書有關的爭議，均應依照中華民國法律予以處理，並以台灣台中地方法院為第一審管轄法院。

                            </div>

                          </div>
                        </div>
                      </div>

                      
                      

                               
                            </div>  

               <button class="btn btn-lg btn-block login-btn"  name="Submit" value="Login" type="Submit">註冊</button>  
                    
            </form>     
        </div>
      </div>
    </div>

    </div><!-- end .all .container -->
 @endsection
 

