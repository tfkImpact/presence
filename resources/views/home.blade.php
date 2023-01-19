@extends('layouts.app')
@section('content')
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
                        <a href="/permission" class="list-group-item list-group-item-action">Permission assignment</a>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card p-4 shadow p-3 mb-5 bg-white rounded">
                    <br>
                <h4>Liste des utilisateurs</h4> <br><br>
                  <table  class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nom et Prenom</td>
                            <td>email</td>
                            <td>Cree le </td>
                            <td>Select</td>
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
                                <td><input type="checkbox" name="role" id="permission_{{$user->id}}" value="{{$user->id}}"></td>
                                <td>
                                    <div style="display: flex; justify-content: space-evenly;">
                                    <div class="edit">
                                        <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" data-id="{{ $user->id }}" data-name="{{$user->name}}" data-email="{{ $user->email }}" data-password="{{ $user->password }}">Edit</a>
                                    </div>
                                    <div class="delete">
                                        <form action="{{ route('user.destroy', $user->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input class="btn btn-danger btn-sm" type="submit" value="Delete"/>
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
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );


var permissions = [];
$('input[type="checkbox"]').change(function() {

    // alert($(this).parent().prev().text()+" "+$(this).val())
    
});

</script>
@endsection


