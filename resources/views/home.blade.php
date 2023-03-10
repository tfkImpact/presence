{{-- @extends('layouts.app')
@section('content') --}}
@extends('layouts.mainLayout')
@section('content')
<div class="space" style="height:3em;"></div>
    <div class="container-fluid">
        <div class="row">
           
            <div class="col-md-12">
                    <br>
                <h4>Liste des utilisateurs </h4> <br><br>
                  <table  class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nom et Prenom</td>
                            <td>email</td>
                            <td>Cree le </td>
                            <td>Roles</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @foreach($user->getRoleNames() as $role)
                                    <div style="padding: 0.2em;border:0.1px solid gray;background-color: rgba(127, 204, 209, 0.589);margin-bottom: .2em;border-radius: .3em; width: 100px;text-align: center;">
                                        <p>{{$role}}</p>
                                    </div>
                                @endforeach
                                </td>
                                <td>
                                    <div style="display: flex; justify-content: space-evenly;">
                                    <div class="role">
                                        <a href="" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal2" data-id="{{ $user->id }}" >Assign roles</a>
                                    </div>
                                    <div class="revoke_role">
                                        <a href="" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal3" data-id-to-revoke="{{ $user->id }}" >Revoke roles</a>
                                    </div>
                                        @if(auth()->user()->can('Delete employee'))
                                        <div class="delete">
                                            <form action="{{ route('user.destroy', $user->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input class="btn btn-danger btn-sm" type="submit" value="Delete"/>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>  
    <!------------------------modal to assign role------------------------>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Assigning role to User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @foreach($roles as $role)
                <div style="padding: 0.3em;background-color: rgba(248, 132, 112, 0.849);margin-bottom: .2em;border-radius: .3em; width: auto">
                    <h5><span class="badge badge-danger">{{$role->id}}</span>&nbsp;&nbsp;&nbsp; {{$role->name}}&nbsp;&nbsp;&nbsp;<input type="checkbox" name="role" id="check_{{$role->id}}" value="{{$role->id}}"></h5>
                </div>
                @endforeach
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" id="toUser" data-link="{{ route('rolesToUser.assignRoles')}}" >Ajouter</button>
                </div>
            </div>
          </div>
        </div>
    </div>
    <!------------------------modal to revoke role------------------------>
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Revoking role from user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @foreach($roles as $role)
                <div style="padding: 0.3em;background-color: rgba(248, 132, 112, 0.849);margin-bottom: .2em;border-radius: .3em; width: auto">
                    <h5><span class="badge badge-danger">{{$role->id}}</span>&nbsp;&nbsp;&nbsp; {{$role->name}}&nbsp;&nbsp;&nbsp;<input type="checkbox" name="role" id="check_{{$role->id}}" value="{{$role->id}}"></h5>
                </div>
                @endforeach
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" id="fromUser" data-link="{{ route('revokeRoleFromUser.revokeRole')}}" >Ajouter</button>
                </div>
            </div>
          </div>
        </div>
    </div>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
var roles = [];
var id=0;
var id2=0;
$('#exampleModal2').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      id = button.data('id')
    });
$('#exampleModal3').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      id2 = button.data('id-to-revoke')
    });
    $('#toUser').click(function(){

            $.each($("input[name='role']:checked"), function(){
                roles.push($(this).val());
            });
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var url =$(this).attr("data-link");
            $.ajax({
            type: "POST",
            url: url, 
            dataType: 'JSON',
            data: { _token: CSRF_TOKEN,
                    roles: roles,
                    user_id:id
                },
            success:function(data){
                $('#exampleModal2').modal('hide');
                window.location.reload();
            },error:function(){ 
                alert("error!!!!");
            }
            });
            roles = [];
            id=0;
    });
    $('#fromUser').click(function(){

        $.each($("input[name='role']:checked"), function(){
            roles.push($(this).val());
        });
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url =$(this).attr("data-link");
        $.ajax({
        type: "POST",
        url: url, 
        dataType: 'JSON',
        data: { _token: CSRF_TOKEN,
                roles: roles,
                user_id:id2
            },
        success:function(data){
            $('#exampleModal3').modal('hide');
            window.location.reload();
        },error:function(){ 
            alert("error!!!!");
        }
        });
        roles = [];
        id2=0;
        });

});
</script>
@endsection


