@extends('layouts.subMainLayout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="d-flex justify-content-between" style="align-items:center">
                    <h3 class="display-4">Liste des Employees</h3>
                    @if(auth()->user()->can('Delete employee'))
                        <button type="button" class="btn btn-primary sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-plus-square"></i></button>
                    @endif
                  </div>
                  <br>
                  
                  <table  class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nom et Prenom</td>
                            <td>Phone</td>
                            <td>email</td>
                            <td>adress</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->first_name.' '. $employee->last_name }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->adress }}</td>
                                <td>
                                  @if(auth()->user()->can('Delete employee'))
                                    <div style="display: flex; justify-content: space-evenly;">
                                    <div class="edit">
                                          <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" data-id="{{ $employee->id }}" data-fname="{{$employee->first_name}}" data-lname="{{$employee->last_name}}" data-phone="{{$employee->phone}}" data-email="{{ $employee->email }}" data-adress="{{ $employee->adress }}">Edit</a>
                                    </div>
                                    <div class="delete">
                                        <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input class="btn btn-danger btn-sm" type="submit" value="Delete" />
                                        </form>
                                    </div>
                                    @endif
                                    <div class="stats">
                                      <a href="{{ route('stats.show', $employee->id)}}" class="btn btn-info btn-sm">Stats</a>
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
  <!-- BOOTSTRAP MODAL for adding -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajout d'un employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('add_employees.store') }}" method="POST">
            @csrf
        <div class="modal-body">
          <input type="text"  name="id" hidden id="hidden_id" value="">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Prenom:</label>
              <input type="text" class="form-control" name="first_name" id="first_name">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nom:</label>
              <input type="text" class="form-control" name="last_name"  id="last_name">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tel:</label>
              <input type="text" class="form-control" name="phone"  id="phone">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="text" class="form-control" name="email"  id="email">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Adress:</label>
              <input type="text" class="form-control" name="adress"  id="adress">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Date de naissance:</label>
              <input type="date" class="form-control" name="birth_date"  id="recipient-name">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
<script>
$(document).ready( function () {
  $('#myTable').DataTable();
  $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id')
    var fname = button.data('fname')
    var lname = button.data('lname')
    var phone = button.data('phone')
    var email = button.data('email')
    var adress = button.data('adress')
    var modal = $(this)
    modal.find('.modal-title').text('Modification des info de ' + fname)
    modal.find('.modal-body #hidden_id').val(id)
    modal.find('.modal-body #first_name').val(fname)
    modal.find('.modal-body #last_name').val(lname)
    modal.find('.modal-body #phone').val(phone)
    modal.find('.modal-body #email').val(email)
    modal.find('.modal-body #adress').val(adress)
  });
});
</script>
@stop

