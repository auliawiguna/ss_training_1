<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Links;
use App\Models\LinkStats;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard/index');
    }

    public function view($id='')
    {
        $data = LinkStats::where('link_id',$id)
        ->with('links')
        ->get();
        return view('backend/view',compact('data'));
    }    

    public function page($page = '')
    {
        $data['data'] = '';
        switch ($page) {
            case 'history':
                $data['data'] = Links::where('user_id',\Session::get('id'))->get();
                break;            
            default:
                # code...
                break;
        }
        return view('backend/'.$page, $data);
    }

    public function goTo($url='', Request $request)
    {
        $data = Links::where('code',$url)
        //check if URL time valid
        ->where('created','<=',Carbon::now())
        ->where('expired','>=',Carbon::now())
        ->first();
        if ($data) {
            LinkStats::create([
                'link_id' => $data->id,
                'ip' => $request->ip(),
                'browser' => $_SERVER['HTTP_USER_AGENT'],
            ]);
            return redirect($data->link);
        }
    }
    
    public function dataTable()
    {
        $data = Links::where('user_id',\Session::get('id'))->get();

        $json = [
            'draw' => 1,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => []
        ];
        $arr = [];
        foreach ($data as $no => $d) {
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

    public function createLink(\Request $request)
    {
        $data = $request::all();
        $rand = str_random(6);
        $now = Carbon::now();
        $arr = [
            'code' => $rand,
            'link' => $data['url'],
            'user_id' => \Session::get('id'),
            'expired' => $now->addHours(24),
            'deleted' => '0' 
        ];
        $save= Links::create($arr);
        if ($save) {
            echo 'Link : '.url('i/'.$rand);
        } else {
            echo 'Failed Generate Url';
        }
    }    

}
