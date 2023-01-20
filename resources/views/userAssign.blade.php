<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Employees</title>
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
<style>
    ul {
     list-style-image: url("{{ asset('assets/img/bullet.png') }}") ;
    }
    ul li{
        font-size: 20px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
</style>
<body>
<div class="space" style="height:3em;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="space" style="height:20em;"></div>
                <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">Dashbord</a>
                        <a href="/employees" class="list-group-item list-group-item-action">List des employees</a>
                        <a href="/presence" class="list-group-item list-group-item-action">Inserer la presence</a>
                        <a href="/home" class="list-group-item list-group-item-action">Liste des utilisateur de l'app</a>
                        <a href="/role" class="list-group-item list-group-item-action">Role assignment</a>
                       
                </div>
            </div>
            <div class="col-md-10">
                <div class="card p-4 shadow p-3 mb-5 bg-white rounded" style="width: 1000px">
                    <h4>Role liste:</h4>
                    <br> <br>
                    <table class="table table-dark" >
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Permission</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td >{{$role->name}}</td>
                                    <td>
                                        <ul>
                                            @foreach($role->getPermissionNames() as $permission)
                                             <li>{{$permission}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <div class="d-flex space-between">
                                            <a type="botton" name="role" class="btn btn-warning btn-sm" id="{{$role->id}}" data-id="{{$role->id}}" data-toggle="modal" data-target="#exampleModal">Edit</a> &nbsp;&nbsp;
                                            <a type="botton" name="role" class="btn btn-danger btn-sm" id="{{$role->id}}">Delete</a>
                                            <a type="botton" name="role" class="btn btn-info btn-sm" id="{{$role->id}}" data-idToShow="{{$role->id}}" data-toggle="modal" data-target="#permissionModal">Show permissions</a>
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
    <!-----------------------modal--------------------->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adding Permission to Role</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @foreach($permissions as $permission)
                <div style="padding: 0.5em;border:0.5px solid gray;background-color: rgba(127, 153, 209, 0.589);margin-bottom: .2em;border-radius: .3em; width: auto">
                    <h5><span class="badge badge-danger">{{$permission->id}}</span>&nbsp;&nbsp;&nbsp; {{$permission->name}}&nbsp;&nbsp;&nbsp;<input type="checkbox" name="permission" id="check_{{$permission->id}}" value="{{$permission->id}}"></h5>
                </div>
                @endforeach
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" id="toRole" data-link="{{ route('permissionsToRole.assignPermissions')}}" >Ajouter</button>
                </div>
            </div>
          </div>
        </div>
    </div>
     
    <!-----------------------modal of permisssion----------------->
     <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="permissionModalLabel">Role Permission</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @foreach($permissions->where('id',) as $permission)
                    <div style="padding: 0.5em;border:0.5px solid gray;background-color: rgba(127, 153, 209, 0.589);margin-bottom: .2em;border-radius: .3em; width: auto">
                        <h5><span class="badge badge-danger">{{$permission->id}}</span>&nbsp;&nbsp;&nbsp; {{$permission->name}}&nbsp;&nbsp;&nbsp;<input type="checkbox" name="permission" id="check_{{$permission->id}}" value="{{$permission->id}}"></h5>
                    </div>
                @endforeach
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" id="toRole" data-link="{{ route('permissionsToRole.assignPermissions')}}">Ajouter</button>
                </div>
            </div>
          </div>
        </div>
    </div>
<script>
$(document).ready( function () {
    var id=0;
    var permissions = [];
    $('#myTable').DataTable();
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      id = button.data('id')
    });
    $('#permissionModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
    });
    $('#toRole').click(function(){
        $.each($("input[name='permission']:checked"), function(){
            permissions.push($(this).val());
        });
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url =$(this).attr("data-link");
        $.ajax({
        type: "POST",
        url: url, 
        dataType: 'JSON',
        data: { _token: CSRF_TOKEN,
                permissions: permissions,
                role_id:id
            },
        success:function(data){
            alert(data.answer);
        },error:function(){ 
            alert("error!!!!");
        }
        });
        permissions = []
        id=0;
    });
});

</script>
</body>
</html>