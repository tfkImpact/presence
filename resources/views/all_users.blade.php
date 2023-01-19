<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>All users</title>
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
<body>
    <div class="space" style="height:3em;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="space" style="height:20em;"></div>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                     Dashbord
                    </a>
                        <a href="/employees" class="list-group-item list-group-item-action">List des employees</a>
                        <a href="/presence" class="list-group-item list-group-item-action">Inserer la presence</a>
                  </div>
            </div>
            <div class="col-md-5">
                <div class="jumbotron">
                    <h3 class="display-4">Liste des Employees</h3>
                    <p class="lead">Affichage de tous ls employees d'E-empact👍</p>
                    <hr class="my-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">AJOUTER employee</button>
                  </div>
                  <hr>
                  <table  class="table" id="myTable">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nom et Prenom</td>
                            <td>email</td>
                            <td>password</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->password }}</td>
                                <td>
                                    <div style="display: flex; justify-content: space-evenly;">
                                    <div class="edit">
                                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-id="{{ $user->id }}" data-name="{{$user->name}}" data-email="{{ $user->email }}" data-password="{{ $user->password }}">Edit</a>
                                    </div>
                                    <div class="delete">
                                        <form action="{{ route('employees.destroy', $user->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input class="btn btn-danger" type="submit" value="Delete" />
                                        </form>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="col-md-5">
                
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

<script>
$(document).ready( function () {
$('#myTable').DataTable();

} );
</script>
</body>
</html>


