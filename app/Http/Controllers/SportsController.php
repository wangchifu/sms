<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SportAction;

class SportsController extends Controller
{
    public function index(){
        $data = [

        ];
        return view('sports.index',$data);
    }


    public function setup(){
        $users = User::where('disable',null)->get();
        $actions = SportAction::orderBy('id','DESC')
            ->get();
        
        $data = [
            'users'=>$users,
            'actions'=>$actions,
            
        ];
        return view('sports.setup',$data);
    }

    public function action_create(){
        $data = [

        ];
        return view('sports.action_create',$data);
    }

    public function action_store(Request $request)
    {
        $att = $request->all();        
        SportAction::create($att);
        return redirect()->route('sports.setup');
    }

    public function sign_up(){
        $data = [
            
        ];
        return view('sports.sign_up',$data);
    }

    public function list(){
        $data = [
            
        ];
        return view('sports.list',$data);
    }

    public function score(){
        $data = [
            
        ];
        return view('sports.score',$data);
    }

    public function demo(){
        $data = [
            
        ];
        return view('sports.demo',$data);
    }
}
