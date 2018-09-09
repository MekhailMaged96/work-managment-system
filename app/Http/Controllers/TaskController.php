<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Invitation;
use Illuminate\Support\Facades\Auth;
use Session;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,array(
            'content'=>'required | string',
            'assignto' =>'integer'
        ));

        $task = new Task;
        $task->content = $request->content;

        if(auth()->user()->is_admin)
        {
            if($request->input('assignto')!=null) {

                   $task->user_id = $request->input('assignto');
                   $task->admin_id = auth()->user()->id;
                   $task->save();
            }
      


        } else {

            $task->user_id = auth()->user()->id;
            $task->save();

        }
        session()->flash('success', 'The Task Successfully Created!');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $task = Task::find($id);

        if(auth()->user()->is_admin  ) {
            $invitations =Invitation::where('admin_id',auth()->user()->id)->where('accepted',0)->get();
            $coworkers= Invitation::where('admin_id',auth()->user()->id)->where('accepted',1)->get();

            return view('tasks.edit')->with('task',$task)->with('coworkers',$coworkers);
        }else {
            $invitations=[];
            $coworkers=[];

        }

        if($this->_authorize($task->user_id)==false) {
           
            return redirect('/home');
        } else {
            
        return view('tasks.edit')->with('task',$task)->with('coworkers',$coworkers);
        }
       
        //
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,array(
            'content'=>'required | string',
            'assignto'=>'integer|required',

        ));



        $task = Task::find($id);
        $task->content = $request->content;

        if(auth()->user()->is_admin)
        {
            if($request->input('assignto')!=null) {

                $task->user_id = $request->input('assignto');
                $task->admin_id = auth()->user()->id;
                $task->save();
            }


        }else {
            $task->save();

        }



        session()->flash('success', 'The Task Successfully Edited!');

        return redirect('/home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $task = Task::find($id);

        if($task->user_id == auth()->user()->id || auth()->user()->is_admin)
        {
            return view('tasks.delete')->with('task',$task);
            
        }


        return redirect()->back();

    }


    public function destroy($id)
    {
        //
        $task = Task::find($id);

        if($this->_authorize($task->user_id)==true ||auth()->user()->is_admin) {
            $task->delete();
            session()->flash('success', 'The Task Successfully Deleted!');
    
        } 

        

        
        return redirect('/home');
    }

    public function updatestatus($id) {

        $task = Task::find($id);
        $task->status = !$task->status;
        if($this->_authorize($task->user_id)== true) {
        $task->save();
        }
        return redirect('/home');

    }
    public function sendinvitation(Request $request) {
        $this->validate($request,array(
            'admin' =>'integer | required'


        ));
        
        if(!Invitation::where('user_id',auth()->user()->id)->where('admin_id',$request->admin)->exists())
        {
            $invitation = new Invitation;

            $invitation->user_id = auth()->user()->id;
            $invitation->admin_id = $request->admin;

            $invitation->save();

        }       
           
        session()->flash('success', 'The invitation Successfully sent to the admin!');
        return redirect()->back();
        
    }
    public function acceptinvitation($id) {
        $invitation = Invitation::find($id);
        $invitation->accepted= true;
        $invitation->save();

        return redirect()->back();
    }
    public function denyinvitation($id) {
        $invitation = Invitation::find($id);
        $invitation->delete();

        return redirect()->back();
        
    }
    public function deletworker($id) {
        $invitation = Invitation::find($id);
        $invitation->delete();
   
          
        session()->flash('success', 'The workers Successfully Deleted!');
        return redirect()->back();
        
    }
    public function _authorize($id) {

        if(auth()->user()->id == $id) {

            return true; 
        }
        else {

            return false; 
        }
    }
}
