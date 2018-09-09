<div class="admin-cont">
    <h1> Admin Panel </h1>
    <div class="container">
        <div class="row">
            <div class="col-md-11">      
                <div class="dropdown">
                    <i class="fa fa-user-plus" style="font-size:24px; margin:20px 0; padding-right:15px;" aria-hidden="true"></i>   
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Invitations  <span class="badge badge-light">{{$invitations->count()}}</span> 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($invitations as $invitation)
                        <p  class="dropdown-item" style="padding:5px;">{{$invitation->worker->name}} <a href="{{route('acceptInv',$invitation->id)}}" class="badge badge-primary">Accept</a> | <a href="{{route('denyInv',$invitation->id)}}" class="badge badge-danger">Deny</a></p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h4><span class="badge badge-secondary">Tasks</span></h4>
        <div class="row">
            <div class="col-md-10">
                <table class="table margin-top" >
                    <thead>
                        <tr>  
                            <th scope="col">Task</th>
                            <th scope="col">Assign To</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <th scope="row">
                                <a href="{{route('updatestatus',$task->id)}}">
                                @if(!$task->status)
                                    {{$task->content}}
                                @else
                                <p><del>{{$task->content}}</del></p>
                                @endif
                            </a>
                            </th>
                            <td>{{ $task->user->name }}</td>
                            <td><a href="{{route('tasks.edit',$task->id)}}"><i class="fa fa-pencil" style="font-size:36px;"></i></a></td>
                            <td><a href="{{route('tasks.show',$task->id)}}"><i class="fa fa-trash-o" style="font-size:36px; color:#F00;"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tasks->links() }}
                    
                <p>{{auth()->user()->admin_id}} </p>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <form action="{{route('tasks.store')}}" method="POST" class="first-form">
                 @csrf
                    <div class="form-group">
                        <input type="name" class="form-control "  name="content" placeholder="New Task">
                        <select class="form-control margin-select-top" name="assignto">
                            @foreach($coworkers as $coworker)
                            <option value="{{$coworker->worker->id}}">{{$coworker->worker->name}} </option>

                            @endforeach
                        </select>
                        <button class="btn btn-success margin-top">Add New Task </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="delworker">
                    <h2> Workers </h2>
                    @foreach($coworkers as $coworker)
                    <div class="clearfix">
                        <hr> 
                        <p class="float-left">{{$coworker->worker->name}}</p>
                        <a  href="{{route('deleteworker',$coworker->id)}}" class="float-right btn btn-danger">Delete</a>  
                    </div>
                    @endforeach
                    <hr class="padding-bottom:2px;">
                </div>
            </div>
        </div>
    </div>
</div>