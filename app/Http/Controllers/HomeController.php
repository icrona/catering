<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\History;
use Illuminate\Http\Request;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $histories = History::orderBy('id','desc')->where('user_id',Auth::user()->id)->paginate(10);
        return view('home')->withHistories($histories);
    }


    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $num=DB::table('histories')->where('user_id',$id)->count();
        if($user->quota!=$request->quota || $num==0){
            $user->quota=$request->quota;
            $user->save();

            $history=new History;
            $history->user_id=Auth::user()->id;
            $history->quota=$user->quota;
            $history->save();
        }
        
        return redirect('home');
    }

}
