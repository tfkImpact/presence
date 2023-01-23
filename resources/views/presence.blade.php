@extends('layouts.subMainLayout')
@section('content')
                <div class="row">
                    <br>
                    <div class="col-md-3"> 
                        <h3 class="display-4">Gestion de la presence</h3>
                       
                    </div>
                    <div class="col-md-9">
                        <br> 
                        <div class="row">
                            
                            <form action="{{ route('add_presence.store') }}" method="POST" id="employee_select">
                                @csrf
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Employee:</label>
                                <select name="employee" aria-label="Default select example" >
                                    <option value="" selected> -Selectioner L'employee</option>
                                    @foreach($employee as $emp)
                                        <option value="{{$emp->id}}">{{ $emp->first_name. ' '. $emp->last_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Time:</label>
                                <input type="time" class="form-control" name="time"  id="time">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Date:</label>
                                <input type="date" class="form-control" name="date" id="creation_date">
                                </div>          
                            <button type="submit" class="btn btn-info btn-block btn-sm">Ajouter</button>
                        </div>
                        </form>  
                    </div>
                    </div>
                </div>
                <div class="row">
                 <div class="table_div" style="margin-top: .3em; padding: 3em;">
                  <table  class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Employee</td>
                            <td>Time</td>
                            <td>Date</td>
                            <td>action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($presence as $pres)
                            <tr>
                                <td>{{ $pres->id }}</td>
                                <td>{{ $pres->employee->first_name. ' '.$pres->employee->last_name}}</td>
                                <td>{{ $pres->arrival_hour }}</td>
                                <td>{{ $pres->created_at }}</td>
                                <td>
                                    <div style="display: flex; justify-content: space-evenly;">
                                    <div class="edit_btn">
                                        <input type="text" id="id_to_update" hidden value="{{ $pres->employee->id }}">
                                        <input type="text" id="arrival" hidden value="{{ $pres->arrival_hour }}">
                                        <input type="text" id="date" hidden value="{{ $pres->created_at }}">
                                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                                    </div>
                                    <div class="delete">
                                        <form action="{{ route('presence.destroy', $pres->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input class="btn btn-danger btn-sm" type="submit" value="Delete" />
                                        </form>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            </div>
        </div>
    </div>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
});

$(".edit_btn").click(function(){
    var id_to_update = $(this).find("#id_to_update").val();
    var arrival_hour = $(this).find("#arrival").val();
    var date = $(this).find("#date").val();
     $("#employee_select").find("option[value="+id_to_update+"]").attr('selected','selected').change()
     $("#employee_select").find("#time").val(arrival_hour)
     $("#employee_select").find("#creation_date").val(date)
});
</script>
@stop

