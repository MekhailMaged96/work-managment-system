<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Invitation;
use Auth;
use Hash;
class PagesController extends Controller
{
    public function index() {
        


        if(auth()->user()->is_admin==1)
        {

          
            $tasks =Task::where('admin_id',auth()->user()->id)
            ->orderBy('created_at','DESC')->paginate(4);
            $admins=[];

            $invitations =Invitation::where('admin_id',auth()->user()->id)->where('accepted',0)->get();
            $coworkers= Invitation::where('admin_id',auth()->user()->id)->where('accepted',1)->get();
       
        }
        else {
            $invitations=[];
            $tasks = Task::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->paginate(4);
            $admins = User::where('is_admin',1)->get();
            $coworkers =[];
        }
        return view('index')->with('tasks',$tasks)->with('admins',$admins)->with('invitations',$invitations)->with('coworkers',$coworkers);
    }
    public function addadmin() {

        return view('auth.addadmin');
    }

    public function add_admin(Request $request) {
        $this->validate($request,array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ));
        if(auth()->user()->super==1)
        {
        $user = new User;
        $user->name= $request->name;
        $user->password= Hash::make($request->password);
        $user->email = $request->email;
        $user->is_admin=true;

        $user->save();


        session()->flash('success','admin created successfully');
        return redirect('/home');
        }
    
    }
}
