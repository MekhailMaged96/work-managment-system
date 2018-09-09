<div class="worker-cont">
    <div class="row">
        <div class="col-md-10">
            <table class="table margin-top" >
                <thead>
                    <tr>   
                        <th scope="col">Task</th>
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
                        <td>
                            <a href="{{route('tasks.edit',$task->id)}}"><i class="fa fa-pencil" style="font-size:36px;"></i></a>
                        </td>
                        <td>
                            <a href="{{route('tasks.show',$task->id)}}"><i class="fa fa-trash-o" style="font-size:36px; color:#F00;"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>    
            </table>
                {{ $tasks->links() }}
        </div>     
    </div>
    <div class="row">
        <div class="col-md-7">
            <form action="{{route('tasks.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="name" class="form-control"  name="content" placeholder="New Task">
                    <button class="btn btn-success margin-top">Add New Task </button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{route('sendinvitation')}}" method="post">
                @csrf
                <div class="form-group">
                    <select class="form-control" name="admin">
                    @foreach($admins as $admin)
                        <option value="{{$admin->id}}" >{{$admin->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success margin-top">Send Invitation </button>
                </div>
            </form>
        </div>
    </div>
</div>