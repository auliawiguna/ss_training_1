<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index(){
        return view('dashboard/index');
    }    
    public function view($id=''){
        return view('backend/view',['id'=>$id]);
    }    
    public function goto($url=''){
        $data = \DB::table('links')->where('code',$url)
        //check if URL time valid
        ->where('created','<=',Carbon::now())
        ->where('expired','>=',Carbon::now())
        ->first();
        if($data){
            \DB::table('link_stats')->insert([
                'link_id' => $data->id,
                'ip' => \Request::ip(),
                'browser' => $_SERVER['HTTP_USER_AGENT'],
                'time' => Carbon::now(),
            ]);
            return \Redirect::to($data->link);
        }
    }    
    
    public function datatable(){
        $data = \DB::table('links')->where('user_id',\Session::get('id'))->get();

        $json = [
            'draw' => 1,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => []
        ];
        foreach($data as $no => $d){
            $arr[] = [
                $no + 1,
                $d->code,
                $d->link,
                $d->created,
                $d->expired,
                '<a href="" id="view" data-id="'.$d->id.'">View</a>',
            ];
        }
        $json['data'] = $arr;
        echo json_encode($json);
    }    

    public function createlink(){
        $data = \Request::all();
        $rand = str_random(6);
        $now = Carbon::now();
        $arr = [
            'code' => $rand,
            'link' => $data['url'],
            'user_id' => \Session::get('id'),
            'created' =>  $now,
            'expired' => $now->addHours(24),
            'deleted' => '0' 
        ];

        $save= \DB::table('links')->insert($arr);
        if($save){
            echo 'Link : '.url('i/'.$rand);
        }else{
            echo 'Failed Generate Url';
        }
    }    
    

}
