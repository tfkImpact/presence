<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Presence</title>
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <!-- bootsrap -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- data table---->
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"  rel="stylesheet">
    </head>
</head>
<body>
    <div class="space" style="height:1em;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="space" style="height:20em;"></div>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                     Dashbord
                    </a>
                        <a href="/employees" class="list-group-item list-group-item-action">Liste des employees</a>
                        <a href="/presence" class="list-group-item list-group-item-action">Inserer la presence</a>
                        @if(auth()->user()->can('Delete employee'))
                        <a href="/home" class="list-group-item list-group-item-action">Liste des utilisateur de l'app</a>
                            <a href="/role" class="list-group-item list-group-item-action">Role assignment</a>
                        @endif
                      
                  </div>
                  <hr>
                 
                <div class="d-flex" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }} ? {{ Auth::user()->name }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                <div class="card p-4 md-4" style="padding: 2em;">
                    <div class="col-md-4"> 
                     <h3 class="display-4">Gestion de la presence</h3>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ route('add_presence.store') }}" method="POST" id="employee_select">
                            @csrf
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
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Date:</label>
                                <input type="date" class="form-control" name="date" id="creation_date">
                                </div>          
                            <button type="submit" class="btn btn-info btn-block btn-sm">Ajouter</button>
                        </form>
                    </div>
                  </div>
                </div>
                <div class="row">
                 <div class="table_div" style="margin-top: .6em; padding: 3em;">
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
</body>
</html>