<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;
use App\Models;
use ChromePhp;

class ProductController extends Controller
{
    //測試連接DB
    public function linkDB(){
    	return collect(DB::select("SELECT city_id from city"));
    }

    //產品首頁
    public function product_index(){
    	return view('product.product_index');
    }
    

    //產品資訊
    public function product_info()
    {
    	$id = Input::get('id');
        $code = urldecode($id);

        $data= DB::table('aPI_PI_PRODUCT0')
                 ->where('bid', $code)->first();
        $class = DB::table('aPI_BI_PARTTYPE0')
        ->where('bid',$data->parttype)->first();
        
        
      return view('product.product_info')->with('data' , $data)->with('check',$id)->with('class',$class);
    }

    //搜尋
    public function search_act()
    {
    	 $data = Input::get('search');
         $datas= DB::table('aPI_PI_PRODUCT0')
             ->where('mdesc','like', '%'.$data.'%')->get();
            
             return \View::make('product.product_search')->with('data', $datas)->with('search', $data); 
    }

    //header類別
    public function  product_showclass_ajax(){
        $datas = DB::table('aPI_PI_PRODUCT0')
            ->leftJoin('aPI_BI_PARTTYPE0','parttype','=','aPI_BI_PARTTYPE0.bid')
            ->orderby('aPI_BI_PARTTYPE0.bid','desc')
            ->get(); 
        $response = array(
        'status' => 'success',
        'msg' => 'Setting created successfully',
        'data'=>$datas
        );
        return \Response::json($response);
    }

    
    //類別連結
    public function product_class(){
        $class = Input::get('class');
        $id = Input::get('id');
       
        $datas= DB::table('aPI_PI_PRODUCT0')
            ->where('parttype','=',$id)->get();
        return view('product.product_class')->with('data', $datas)->with('class', $class);
    }
    
    //header搜尋列表
     public function  product_searchui_ajax(){
        $datas = DB::table('aPI_PI_PRODUCT0')
            ->get(); 
        $response = array(
        'status' => 'success',
        'msg' => 'Setting created successfully',
        'data'=>$datas
        );
        return \Response::json($response);
    }

    //首頁下方類別
    public function index_class(){
        $datas = DB::select("SELECT aPI_PI_PRODUCT0.bid as pid, mdesc, parttype, aPI_BI_PARTTYPE0.bid, typename from aPI_PI_PRODUCT0 left join aPI_BI_PARTTYPE0
        on parttype = aPI_BI_PARTTYPE0.bid order by aPI_BI_PARTTYPE0.bid desc"); 
        $response = array(
        'status' => 'success',
        'msg' => 'Setting created successfully',
        'data'=>$datas
        );
        return \Response::json($response);
    }

    /*public function index_class(){
        
        $id=array();
        $name=array();
        $head=array();
        $class= DB::table('class_head')->get();

        foreach ($class as $class) {
            array_push($head, $class->ch_name);
            $data = DB::table('class_body')
                  ->leftJoin('class_head','id_head','=','class_head.ch_id')
                  ->leftJoin('product','product.prodtype','=','cb_id')
                  ->where('ch_id','=',$class->ch_id)
                  ->orderby('lasteditdt')
                  ->get();
            array_push($id, $data[0]->bid);
            array_push($name, $data[0]->mdesc);
            array_push($id, $data[1]->bid);
            array_push($name, $data[1]->mdesc);
            array_push($id, $data[2]->bid);
            array_push($name, $data[2]->mdesc);
            array_push($id, $data[3]->bid);
            array_push($name, $data[3]->mdesc);
            array_push($id, $data[4]->bid);
            array_push($name, $data[4]->mdesc);
        }
        $response = array(
            'head' => $head,
            'id' => $id,
            'name' => $name
        );
        return \Response::json($response);
    }*/



}
