@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="row">
                {!!Form::model(Auth::user(),['route'=>['home.update',Auth::user()->id],'method'=>'PUT'])!!}
                    <div class="col-md-5">
                        <h1> {{Form::label('quota',Auth::user()->name."`s Quota : ")}}</h1>
                    </div>
                    <div class="col-md-3">
                        <h1> {{Form::text('quota',null,['class'=>'form-control input-lg'])}}</h1>
                    </div>                   
                    <div class="col-md-2">
                        {{Form::submit('Set Quota',['class' =>'btn btn-primary btn-block btn-lg','style'=>'margin-top:25px'])}}
                        {!!Form::close()!!}
                    </div>
                    <div class="col-md-2">
                        {!!Form::open(['route'=>'history.store','method'=>'POST'])!!}
                        {{Form::submit('Reduce Quota',['class' =>'btn btn-success btn-block btn-lg','style'=>'margin-top:25px'])}}
                        {!!Form::close()!!}
                    </div>

                </div>
                </div>

                <div  class="panel-body">
                    <h3>History</h3>{!!Form::open(['route'=>['history.destroy',Auth::user()->id],'method'=>'DELETE'])!!}
                        {{Form::submit('Clear All History',['class' =>'btn btn-danger btn-lg','style'=>'margin-top:25px'])}}
                        {!!Form::close()!!}
                    <br>
                    <div class="col-md-8">
                        <table class="table">
                            <thead>
                                <th>Date</th>
                                <th>Remaining Quota</th>
                                <th></th>
                            </thead>
                            <tbody>                               
                                @foreach($histories as $history)
                                    <tr>
                                        <td>{{date('l - F jS, Y H:i:s',strtotime($history->created_at))}}</td>
                                        <td>{{$history->quota}}</td>
                                        <td>
                                            {!!Form::open(['route'=>['history.delete',$history->id],'method'=>'DELETE','class'=>'delete_form'])!!}
                                            <button class="btn btn-danger delete-btn">Delete</button>
                                            {!!Form::close()!!} 
                                        </td>
                                    </tr>
                                @endforeach 

                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $histories->links(); !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('button.delete-btn').on('click', function(e){

            e.preventDefault();
            var self = $(this);
            swal({
                title             : "Are you sure?",
                text              : "You will not be able to recover this history!",
                type              : "warning",
                showCancelButton  : true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText : "Yes, delete it!",
                cancelButtonText  : "No, Cancel delete!",
                closeOnConfirm    : false,
                closeOnCancel     : false
            },
            function(isConfirm){
                if(isConfirm){
                    swal("Deleted!","your history has been deleted", "success");

                    setTimeout(function() {
                        self.parents(".delete_form").submit()
                    }, 2000); //2 second delay (2000 milliseconds = 2 seconds)
                }
                else{
                      swal("cancelled","Your history is safe", "error");
                }
            });
        });
    </script>                      

</div>
@endsection
