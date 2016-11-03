<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use ChromePhp;
use DB;
use Hash;
use Mail;
use View;


class MemberController extends Controller
{
    //登入 註冊view
    public function member()
    {   
        if(Auth::check()==false){
    	    return view('member.member');
        }else{
            return view('member.member_center');
        }
    }

    //會員中心
    public function member_center()
    {
        ChromePhp::log('user:',Auth::user());
    	return view('member.member_center');
    }

    //會員登入
    public function member_login(Request $request)
    {
        $input=Input::all();
        $validator=$this->validator_login($request->all());
        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
        }else
        {
            $attempt=Auth::attempt([
                'email'=>$input['email'],
                'password'=>$input['password']
                ]);
            if($attempt)
            {
                return Redirect::intended('member_center');
            }else
            {
                return Redirect::to('member')
                ->withErrors(['fail'=>'帳號或密碼錯誤!']);
            }
        }
    }

    //登入資料驗證
    public function validator_login(array $data)
    {
        $messages=[
        'valid_captcha'=>'驗證碼打錯了!請在試一次',
        'required'=>'請輸入驗證碼'
        ];

        return Validator::make($data,[
            'CaptchaCode'=>'required|valid_captcha'
            ],$messages);
    }

    //會員登出
    public function member_logout()
    {
        Auth::logout();
        return Redirect::to('member');
    }

    //會員註冊
    public function member_registered(Request $request)
    {
        $data=Input::all();
        $validator=$this->validator_registered($request->all());
        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
        }else
        {
            //判斷資料是否重複
            $db = DB::select("SELECT email from aSD_DM_CUSTINFO0 where email='".$data['username']."'");
            if(empty($db))
            {   
                //新增進資料庫
                $insert=DB::table('aSD_DM_CUSTINFO0')->insert([
                    'email'=>$data['username'],
                    'password'=>bcrypt($data['password']),
                    'custname'=>$data['custname'],
                    'mobphone'=>$data['mobphone'],
                    'compaddr'=>$data['compaddr'],
                    'bid'=>$data['username']
                    ]);
                //判斷新增成功進行登入
                if($insert)
                {
                    $attempt=Auth::attempt([
                        'email'=>$data['username'],
                        'password'=>$data['password']
                        ]);
                    //登入成功跳轉頁面
                    if($attempt)
                    {
                        return Redirect::intended('member_center');
                    }else
                    {
                        return Redirect::to('member')
                        ->withErrors(['fail'=>'登入發生錯誤!']);
                    }
                }else
                {
                    return Redirect::to('member')
                    ->withErrors(['fail'=>'帳號註冊發生錯誤!']);
                } 
            }else
            {
                return Redirect::to('member')
                ->withErrors(['email'=>'帳號重複!']);
            }


        }
    }

    //註冊資料驗證
    public function validator_registered(array $data)
    {
        $messages=[
        'required'=>'※必填',
        'accepted'=>'未同意服務條款',
        'email'=>'請輸入有效的電子郵件地址',
        'min'=>'至少由六個字元組成',
        'same'=>'密碼與確認密碼不相同',
        'numeric'=>'請輸入有效的手機號碼'
        ];
        return validator::make(
            ['email' => $data['username'],
             'password' => $data['password'],
             'password_confirmation' => $data['cpassword'],
             'custname' => $data['custname'],
             'mobphone' => $data['mobphone'],
             'optradio' => $data['optradio'],
             'compaddr' => $data['compaddr']
            ],
            ['email' => 'required|email',
             'password' => 'required|alpha_num|min:6',
             'password_confirmation' => 'required|alpha_num|min:6|same:password',
             'custname' => 'required',
             'mobphone' => 'required|numeric',
             'optradio' => 'accepted',
             'compaddr' => 'required'
            ],$messages
            );
    }

    //忘記密碼view
    public function member_forget_emailcheck_view()
    {
        return view('member.member_forget');
    }

    //忘記密碼
    public function member_forget_emailcheck(Request $request)
    {
        $email = $request->yourEmail;
        $baemail = base64_encode($email);
        $string = 'http://127.0.0.1:8001/glmp/public/forget_changepsw?'.$baemail;
        $pswdt = Carbon::now()->timezone('Asia/Taipei');
        $pswdt->addMinutes(15);
        $db = DB::select("SELECT email from aSD_DM_CUSTINFO0 where email='".$email."'");
        $data = array(
            'password' => $string       
            );
        
        if($db[0]->email==""){
            $response = array(
                'status' => 'success',
                'msg' => 'Setting created successfully',
                );
            return \Response::json($response);

        }else{
            DB::table('aSD_DM_CUSTINFO0')
            ->where('email',$email) 
            ->update(['psw_dateline' => $pswdt,
              'psw_count' => 0
              ]);
            Mail::send('forget_email', ['key' => $data], function ($message) use($email){

                $message->from('boss01132295@gmail.com', '海量數位工程股份有限公司');

                $message->to($email)->subject('會員申請重設密碼回信通知');
            });
            $response = array(
                'status' => 'success',
                'msg' => 'Setting created successfully',
                );
            return \Response::json($response);
        }
    }

    // 忘記密碼修改密碼view
    public function member_forget_changepsw_view(){
        $email = $_SERVER["QUERY_STRING"];
        $reemail = base64_decode(str_replace(" ","+",$email));
        return \View::make('member.member_forget_changepsw')->with('reemail',$reemail);
    }

    // 忘記密碼修改密碼
    public function member_forget_changepsw(Request $request){
        $data = Input::all();
        $validator = $this->validator_forget_changepsw($request->all());
        if ($validator->fails()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
        }else{
            $update = DB::table('aSD_DM_CUSTINFO0')
            ->where('email',$data['email'])
            ->update(['password' => bcrypt($data['newPassword'])]);
            if($update)
            {
                $attempt=Auth::attempt([
                    'email'=>$data['email'],
                    'password'=>$data['newPassword']
                    ]);
                    //登入成功跳轉頁面
                if($attempt)
                {
                    return Redirect::intended('member_center');
                }else
                {
                    return Redirect::to('member')
                    ->withErrors(['fail'=>'登入發生錯誤!']);
                }
            }else
            {
                return Redirect::to('member')
                ->withErrors(['fail'=>'變更密碼發生錯誤!']);
            } 
        }
    }

    // 忘記密碼修改密碼驗證
    public function validator_forget_changepsw(array $data)
    {
        $messages=[
        'required'=>'※必填',
        'alpha_num'=>'密碼含非法字元',
        'min'=>'至少由六個字元組成',
        'same'=>'密碼與確認密碼不相同'
        ];
        return validator::make(
            ['newPassword' => $data['newPassword'],
            'againPassword' => $data['againPassword']
            ],
            ['newPassword' => 'required|alpha_num|min:6',
            'againPassword' => 'required|alpha_num|min:6|same:newPassword'
            ],$messages);
    }

    //修改會員資料view
    public function member_change_view()
    {
        $user = Auth::user();
        $data = DB::select("SELECT email,custname,mobphone,compaddr FROM aSD_DM_CUSTINFO0 WHERE email = '".$user['email']."'");
        return \View::make('member.member_change')->with('data',$data);
    }

    //修改會員資料
    public function member_change(){
        $data = Input::all();
        DB::table('aSD_DM_CUSTINFO0')
        ->where('email',$data['email'])
        ->update(['custname' => $data['custname'],
            'mobphone' => $data['mobphone'],
            'compaddr' => $data['compaddr']
            ]);
        return \View::make('member.member_center');
    }

    // 修改密碼view
    public function member_changepsw_view(){
        $user = Auth::user();
        return \View::make('member.member_changepsw')->with('data',$user);
    }

    // 修改密碼
    public function member_changepsw(Request $request){
        $data = Input::all();
        $validator = $this->validator_psw($request->all());

        if(Hash::check($data['oldpsw'],Auth::user()->password)){
            if ($validator->fails())
            {
              return redirect()
              ->back()
              ->withInput()
              ->withErrors($validator->errors());
            }else{
              DB::table('aSD_DM_CUSTINFO0')
              ->where('email',$data['email'])
              ->update(['password' => bcrypt($data['newpsw'])]);
              return view('member.member_center');
            }
        }else{
            return Redirect::to('member_changepsw')
            ->withErrors(['password'=>'密碼輸入錯誤']);
        }
    }

    // 修改密碼驗證
    public function validator_psw(array $data)
    {
        // custom error message for valid_captcha validation rule
      $messages = [
      'required' => '必填',
      'min' => '密碼長度需大於6',
      'same' => '密碼不相同',
      'alpha_num' =>'密碼含非法字元'
      ];


      return Validator::make(

        ['new_password' => $data['newpsw'],
        'new_password_confirmation' => $data['checkpsw']
        ],
        ['new_password' => 'required|alpha_num|min:6',
        'new_password_confirmation' => 'required|alpha_num|min:6|same:new_password'
        ],$messages);
    }
}
