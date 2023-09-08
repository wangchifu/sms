<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SportAction;
use App\Models\SportItem;

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

    public function action_edit(SportAction $action)
    {
        
        $data = [
            'action'=>$action
        ];
        return view('sports.action_edit',$data);
    }
    
    public function action_update(Request $request,SportAction $action)
    {
        $att = $request->all();        
        $action->update($att);
        return redirect()->route('sports.setup');
    }

    public function action_disable(SportAction $action)
    {        
        $att['disable'] = ($action->disable)?null:1;
        $action->update($att);
        return redirect()->route('sports.setup');
    }

    public function action_destroy(SportAction $action)
    {        
        //SportItem::where('action_id',$action->id)->delete();
        //StudentSign::where('action_id',$action->id)->delete();
        $action->delete();
        return redirect()->route('sports.setup');
    }

    public function item_index(SportAction $select_action){
        $actions = SportAction::orderBy('id','DESC')->get();
        $action_array = [];
        foreach($actions as $action){
            $action_array[$action->id] = $action->name;
        }

        $items = SportItem::where('sport_action_id',$select_action)
                ->orderBy('disable')
                ->orderBy('order')->get();

        $data = [
            'actions'=>$actions,            
            'action_array'=>$action_array,            
            'select_action'=>$select_action,
            'items'=>$items,
        ];
        return view('sports.item_index',$data);
    }

    public function item_create(SportAction $action)
    {        
        $data = [
          'action'=>$action,
        ];

        return view('sports.item_create',$data);
    }

    public function item_store(Request $request)
    {
        $att = $request->all();
        $att['years'] = serialize($att['years']);        
        $att['limit'] = ($request->input('limit'))?1:null;
        if($att['game_type'] == "personal"){
            $att['official'] = null;
            $att['reserve'] = null;
        }
        if($att['game_type'] == "class"){
            $att['official'] = null;
            $att['reserve'] = null;
            $att['group'] = 4;
            $att['people'] = 1;
        }
        $item = SportItem::create($att);
        if($att['game_type'] == "class"){
            $years = unserialize($item->years);
            $student_classes = StudentClass::where('semester', $item->action->semester)                
                ->whereIn('student_year',$years)
                ->orderBy('student_year')
                ->orderBy('student_class')
                ->get();
            foreach($student_classes as $student_class){                
                $att['item_id'] = $item->id;
                $att['item_name'] = $item->name;
                $att['game_type'] = "class";
                $att['student_id'] = $student_class->id;
                $att['action_id'] = $item->action_id;
                $att['student_year'] = $student_class->student_year;
                $att['student_class'] = $student_class->student_class;
                $att['sex'] = 4;
                StudentSign::create($att);
            }
        }
        return redirect()->route('school_admins.item',$item->action_id);
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
