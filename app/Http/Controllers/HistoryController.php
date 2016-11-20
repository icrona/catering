<?php

namespace App\Http\Controllers;
use Auth;
use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $history=new History;
        $history->user_id=Auth::user()->id;
        $history->quota=Auth::user()->quota-1;
        Auth::user()->quota-=1;
        Auth::user()->save();
        $history->save();

        return redirect('home');
    }

    public function destroy($user_id)
    {
        DB::table('histories')->where('user_id','=',$user_id)->delete();
        return redirect('home');
    }

    public function delete($id)
    {
        DB::table('histories')->where('id','=',$id)->delete();
        return redirect('home');
    }

}
