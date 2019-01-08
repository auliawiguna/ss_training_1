<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Link;
use App\Models\LinkStat;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard/index');
    }

    public function view($id='')
    {
        $data = LinkStat::where('link_id',$id)
        ->with('links')
        ->get();
        return view('backend/view',compact('data'));
    }    

    public function page($page = '')
    {
        $data['data'] = '';
        switch ($page) {
            case 'history':
                $data['data'] = Link::where('user_id',\Session::get('id'))->get();
                break;            
            default:
                # code...
                break;
        }
        return view('backend/'.$page, $data);
    }

    public function goTo($url='', Request $request)
    {
        $data = Link::where('code',$url)
        //check if URL time valid
        ->where('created','<=',Carbon::now())
        ->where('expired','>=',Carbon::now())
        ->first();
        if ($data) {
            LinkStat::create([
                'link_id' => $data->id,
                'ip' => $request->ip(),
                'browser' => $_SERVER['HTTP_USER_AGENT'],
            ]);
            return redirect($data->link);
        }
    }
    
    public function dataTable()
    {
        $data = Link::where('user_id',\Session::get('id'))->get();

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
                '<a href="'.url('i/'.$d->code).'" target="_blank">'.$d->code.'</a>',
                $d->link,
                $d->created->format('d M Y H:i:s'),
                $d->expired,
                '<a href="" id="view" data-id="'.$d->id.'">View</a>',
            ];
        }
        $json['data'] = $arr;
        return response()->json($json);
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
            'created' => Carbon::now(),
            'expired' => $now->addHours(24),
            'deleted' => '0' 
        ];
        $save= Link::create($arr);
        if ($save) {
            return 'Link : '.url('i/'.$rand);
        } else {
            return 'Failed Generate Url';
        }
    }    
}
