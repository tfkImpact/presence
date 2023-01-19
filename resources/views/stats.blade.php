<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Statistics</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- bootsrap -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <!--  chart js---------->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        table{
            border: none;
            border-spacing: 5px;
            border-collapse: separate;
        }
        td{
            text-align: center;
            border: 0.3px solid gray;
            height: 80px;
            width: 120px;
            background-color: #82cdffc9;
            border-radius: .2em;
        }
        th{
            text-align: center;
            border: 0.3px solid gray;
            border-radius: .2em;
            height: 50px;
            width: 100px;
        }
        #weekend{
            background-color: rgba(243, 125, 184, 0.356);
        }
    </style>
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
                        <a href="/home" class="list-group-item list-group-item-action">Liste des utilisateur de l'app</a>
                        <a href="/role" class="list-group-item list-group-item-action">Role assignment</a>
                        <a href="/permission" class="list-group-item list-group-item-action">Permission assignment</a>
                  </div>
            </div>
            <div class="col-md-10">
                <div class="jumbotron">
                    <h3>Employee statistics</h3>
                    <p class="lead">statistics de <span class="badge badge-danger">{{$employee->first_name.' '. $employee->last_name}}</span></p>
                    <p><b>Phone: {{ $employee->phone }} </b> &nbsp;&nbsp; Email: {{ $employee->email }}  </p>
                  </div>
                  <hr>
                  <div class="card p-4" style="padding: 2em;">
                        <h3 class="ml-4">Employee: <span class="badge badge-success">{{$employee->first_name.' '. $employee->last_name}}</span></h3>
                    <br>
                        <br>
                        <!-------------------  chart ----------------->
                        <div class="data" style="display: flex; justify-content: space-evenly;">
                        <div style="height: 700px;width:800px">
                            <p><b>Minutes de retard par semaine</b></p> 
                            <canvas id="myChart"></canvas>
                        </div>
                        <div style="height: 500px;width:600px">
                            <p><b>Minutes de retard par mois</b></p> 
                           <table class="">
                                <thead>
                                    <tr>
                                        <th>Lundi</th>
                                        <th>Mardi</th>
                                        <th>Mercredi</th>
                                        <th>Jeudi</th>
                                        <th>Vendredi</th>
                                        <th>Samedi</th>
                                        <th>Dimanche</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if(  $data['Monday'] > 0)
                                                <span class="badge badge-danger">{{$data['Monday']}} Min</span>
                                            @else
                                                <span class="badge badge-danger"></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(  $data['Tuesday'] > 0)
                                            <span class="badge badge-danger">{{$data['Tuesday']}} Min</span>
                                            @else
                                                <span class="badge badge-danger"></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(  $data['Wednesday'] > 0)
                                            <span class="badge badge-danger">{{$data['Wednesday']}} Min</span>
                                            @else
                                                <span class="badge badge-danger"></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(  $data['Thursday'] > 0)
                                            <span class="badge badge-danger">{{$data['Thursday']}} Min</span>
                                            @else
                                                <span class="badge badge-danger"></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(  $data['Friday'] > 0)
                                            <span class="badge badge-danger">{{$data['Friday']}} Min</span>
                                            @else
                                                <span class="badge badge-danger"></span>
                                            @endif
                                        </td>
                                        <td id="weekend">
                                           ----
                                        </td>
                                        <td id="weekend">
                                           ----
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td id="weekend">
                                            ----
                                         </td>
                                         <td id="weekend">
                                            ----
                                         </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td id="weekend">
                                            ----
                                         </td>
                                         <td id="weekend">
                                            ----
                                         </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td id="weekend">
                                            ----
                                         </td>
                                         <td id="weekend">
                                            ----
                                         </td>
                                    </tr>
                                </tbody>
                           </table>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>  

    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'],
            datasets: [{
              label: 'delay',
              data: [{{$data['Monday']}}, {{$data['Tuesday']}}, {{$data['Wednesday']}}, {{$data['Thursday']}}, {{$data['Friday']}}],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
</body>
</html>


