<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use ChromePhp;
use DB;
use Mail;

class OrderController extends Controller
{
    // 訂單查詢
    public function order_list(){
        $user = Auth::user()->bid;   
        $data_order_id = DB::table('aSD_OD_CUSTORDER0')->where('customer',$user)->where('hremark',1)->orderBy('bid','desc')->paginate(5);
        $data_check = DB::table('aSD_OD_CUSTORDER0')->where('customer',$user)->where('hremark',1)->get();
        if(empty($data_check)){
            $data_order_id = "";
            $response = "";
        }else{
            for($i = 0; $i < count($data_order_id); $i++){
                $data1 = DB::select("SELECT * FROM aSD_OD_CUSTORDER1 WHERE bid = '". $data_order_id[0]->bid ."'");  
                for($j = 0; $j < count($data1); $j++)
                {        
                    $response[$i][$j]=array('mdesc'=>str_limit($data1[$j]->mdesc,30),'price'=>$data1[$j]->price,'quit'=>$data1[$j]->qty,'order_id'=>$data_order_id[$i]->bid,'address'=>$data_order_id[$i]->shipaddr,'phone'=>$data_order_id[$i]->mobphone);
                }
                $response[$i] += array('count' => count($response[$i]));
                
            }
        }
        ChromePhp::log($data_order_id);
        return view('order.order_list') -> with('datas',$data_order_id) -> with('response',$response)->with('check',$data_check);
    }

    // 訂單細節
    public function order_detail(){
        return view('order.order_detail');
    }

    // 加入購物車
    public function order_putshoppingcart(Request $request){
        $data_product_id = $request->product_id;
        $data_product_quit = $request->P_amount;
        $user = Auth::user();
        $shoppingcart_db = DB::select("SELECT * FROM aSD_OD_CUSTORDER0 WHERE customer='". $user['bid'] ."' and hremark=0"); //查詢是否有購物車
        $data_product = DB::select("SELECT mdesc,unit,loutprice FROM aPI_PI_PRODUCT0 WHERE bid ='". $data_product_id ."'");
        if(empty($shoppingcart_db)){ //確認有無購物車
            $now = Carbon::now()->timezone('Asia/Taipei')->toDateString();
            $today_array = explode("-",$now);
            $today = $today_array[0] . $today_array[1] . $today_array[2];   
            $order_id_top = DB::select("SELECT top 1 bid FROM aSD_OD_CUSTORDER0 WHERE bid like 'A".$today."%' order by bid desc");
            ChromePhp::log($order_id_top);
            if(empty($order_id_top)){
                $order_id = 'A'.$today.'001';
            }else{
                $order_split = explode("A",$order_id_top[0]->bid);
                $order_id = 'A'.($order_split[1]+1);
            }
            $response = array(
                'status' => 0,
                'msg' => 'success',
                );
            DB::table('aSD_OD_CUSTORDER0')->insert([
                'billstate' => 255,
                'customer' => $user['bid'],
                'bid' => $order_id,
                'hremark' => 0
                ]);
            DB::table('aSD_OD_CUSTORDER1')->insert([
                'bid' => $order_id,
                'mid' => $data_product_id,
                'qty' => $data_product_quit,
                'unit' => $data_product[0]->unit,
                'mdesc' => $data_product[0]->mdesc,
                'price' => $data_product[0]->loutprice
                ]);
            return \Response::json($response);
        }else{
            $repeat = 0;
            $shoppingcart_bid = DB::select("SELECT bid FROM aSD_OD_CUSTORDER0 WHERE customer='". $user['bid'] ."' and hremark=0");
            $data_product_bid = DB::select("SELECT mid FROM aSD_OD_CUSTORDER1 WHERE bid='" . $shoppingcart_bid[0]->bid . "'");
            for($i = 0; $i < count($data_product_bid); $i++)
            if(preg_match("/".$data_product_id."/i", $data_product_bid[$i]->mid)){ // 確認商品是否已存在購物車
                $response = array(
                    'status' => 1,
                    'msg' => 'fail',
                    );
                $repeat = 1;
                return \Response::json($response);   
            }
            if($repeat == 0){
                $response = array(
                    'status' => 0,
                    'msg' => 'success',
                    );
                ChromePhp::log('yes');
                DB::table('aSD_OD_CUSTORDER1')->insert([
                    'bid' => $shoppingcart_bid[0]->bid,
                    'mid' => $data_product_id,
                    'qty' => $data_product_quit,
                    'unit' => $data_product[0]->unit,
                    'mdesc' => $data_product[0]->mdesc,
                    'price' => $data_product[0]->loutprice
                    ]);
                return \Response::json($response);
            }
        }
    }

    // 購物車
    public function order_shoppingcart(){
        $user = Auth::user()->bid;
        $data0 = DB::select("SELECT * FROM aSD_OD_CUSTORDER0 WHERE customer='".$user."' and hremark=0");
        if(empty($data0)){
            $response = "";
        }else{
            $data1 = DB::select("SELECT * FROM aSD_OD_CUSTORDER1 WHERE bid = '". $data0[0]->bid ."'"); 
            if($data1[0] == "" || $data1 == null){ 
                $response = "";
            }else{
                for($i = 0; $i < count($data1); $i++)
                {          
                    $response[$i]=array('mdesc'=>$data1[$i]->mdesc,'price'=>$data1[$i]->price,'quit'=>$data1[$i]->qty,'bid'=>$data1[$i]->mid,'unit'=>$data1[$i]->unit);
                }
            }
        }    
        return \View::make('order.order_shoppingcart') -> with('data',$response);
    }

    // 刪除購物車商品
    public function order_delete(Request $request){
        $pid = $request->pid;
        $user = Auth::user()->bid;
        $data0 = DB::select("SELECT * FROM aSD_OD_CUSTORDER0 WHERE customer='".$user."' and hremark=0");
        DB::table('aSD_OD_CUSTORDER1')->where('bid','=',$data0[0]->bid)->where('mid','=',$pid)->delete();
    }
    //購物車小圖示
    public function get_quick_view(){

        $user = Auth::user()->bid;
        $data0 = DB::select("SELECT * FROM aSD_OD_CUSTORDER0 WHERE customer='".$user."' and hremark=0");
        $data1 = DB::select("SELECT * FROM aSD_OD_CUSTORDER1 WHERE bid = '". $data0[0]->bid ."'");
        $response = array(
            'status' => 'success',
            'msg'   => 'search created successfully',
            'data'=>$data1
            );
        return \Response::json($response);
    }
    // 填寫訂貨資料
    public function order_write(){
        $user = Auth::user()->bid;
        $data0 = DB::select("SELECT * FROM aSD_OD_CUSTORDER0 WHERE customer='".$user."' and hremark=0");
        $data1 = DB::select("SELECT * FROM aSD_OD_CUSTORDER1 WHERE bid = '". $data0[0]->bid ."'");
        for($i = 0; $i < count($data1); $i++)
        {            
            $response[$i]=array('mdesc'=>$data1[0]->mdesc,'price'=>$data1[0]->price,'quit'=>$data1[0]->qty,'bid'=>$data1[0]->mid);

        }
        return view('order.pay.order_write') -> with('data',$response);
    }
    
    // 確認交易
    public function order_confirm(Request $request){
        $validator=$this->validator_order($request->all());
        if($validator->fails()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
        }else{
            $user = Auth::user()->bid;
            $now = Carbon::now()->timezone('Asia/Taipei');
            DB::update("UPDATE aSD_OD_CUSTORDER0 SET dname = ?,mobphone = ?,email = ?,shipaddr = ?,note1 = ?,order_time = ? WHERE customer = ? and hremark = ?", [$request->recipient,$request->phone,$request->email,$request->address,$request->remark,$now,$user,0]); // 更新收件人資料

            $data0 = DB::select("SELECT * FROM aSD_OD_CUSTORDER0 WHERE customer='".$user."' and hremark=0");
            $data1 = DB::select("SELECT * FROM aSD_OD_CUSTORDER1 WHERE bid = '". $data0[0]->bid ."'");
            for($i = 0; $i < count($data1); $i++){          
                $response[$i]=array('mdesc'=>$data1[$i]->mdesc,'price'=>$data1[$i]->price,'quit'=>$data1[$i]->qty,'bid'=>$data1[$i]->mid,'order_id'=>$data1[$i]->bid,'order_time'=>$data0[0]->order_time,'dname'=>$data0[0]->dname,'phone'=>$data0[0]->mobphone,'email'=>$data0[0]->email,'address'=>$data0[0]->shipaddr,'remark'=>$data0[0]->note1);
            }
            return view('order.pay.order_confirm') -> with('data',$response);
        }
        
    }

    // 完成交易
    public function order_complete(){
        $user = Auth::user()->bid;
        $data0 = DB::select("SELECT * FROM aSD_OD_CUSTORDER0 WHERE customer='".$user."' and hremark=0");    
        if(empty($data0)){
            return view('product.product_index');
        }else{
            $total = Input::get('total');
            $user = Auth::user()->bid;
            $username = Auth::user()->dname;
            DB::update("UPDATE aSD_OD_CUSTORDER0 SET total_price = ?,hremark = ? WHERE bid = ? and hremark = ?", [$total,1,$data0[0]->bid,0]); // 更新訂單
            $data1 = DB::select("SELECT * FROM aSD_OD_CUSTORDER1 WHERE bid = '". $data0[0]->bid ."'"); 
            for($i = 0; $i < count($data1); $i++)
            {          
                $response[$i]=array('mdesc'=>$data1[$i]->mdesc,'price'=>$data1[$i]->price,'quit'=>$data1[$i]->qty,'order_id'=>$data0[0]->bid,'order_time'=>$data0[0]->order_time,'dname'=>$data0[0]->dname,'phone'=>$data0[0]->mobphone,'email'=>$data0[0]->email,'address'=>$data0[0]->shipaddr,'remark'=>$data0[0]->note1,'username'=>$username);
            }
            $email = $data0[0]->email;
            
            Mail::send('order.order_shopping_emailcheck', ['data' => $response], function ($message)use($email){
                $message->from('boss01132295@gmail.com', '海量數位工程股份有限公司');

                $message->to($email)->subject('訂單完成通知');
            });
            return view('order.pay.order_complete') -> with('data',$response);
        }
    }

    // 自動載入使用者資訊
    public function order_userinfo(){
        $user = Auth::user()->bid;
        $data = DB::select("SELECT custname,email,mobphone,compaddr FROM aSD_DM_CUSTINFO0 WHERE bid ='".$user."'");
        $response = array(
            'name' => $data[0]->custname,
            'email' => $data[0]->email,
            'phone' => $data[0]->mobphone,
            'compaddr' => $data[0]->compaddr,
            );
        return \Response::json($response);
    }
    //訂單資料驗證
    public function validator_order(array $data)
    {
        $messages=[
        'required'=>'※必填',
        'email'=>'請輸入有效的電子郵件地址',
        'numeric'=>'請輸入有效的手機號碼'
        ];
        return validator::make(
            ['email' => $data['email'],
             'recipient' => $data['recipient'],
             'phone' => $data['phone'],
             'address' => $data['address'],
            ],
            ['email' => 'required|email',
             'recipient' => 'required',
             'phone' => 'required|numeric',
             'address' => 'required',
            ],$messages
            );
    }

    // 變更購買數量
    public function order_unit_change(Request $request){
        ChromePhp::log($request->unit);
        $user = Auth::user()->bid;
        $data0 = DB::select("SELECT * FROM aSD_OD_CUSTORDER0 WHERE customer='".$user."' and hremark=0");
        DB::update("UPDATE aSD_OD_CUSTORDER1 SET qty = ? WHERE bid = ? and mid = ?", [$request->unit,$data0[0]->bid,$request->pid]);
    }
}
