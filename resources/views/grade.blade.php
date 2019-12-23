<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
      table.table-bordered{
        border:1px solid blue;
       
      }
    table.table-bordered > thead > tr > th{
        border:1px solid blue;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid blue;
        text-align:center;
    }
    table.table-bordered > tbody > tr > th{
        border:1px solid blue;
        color:rgb(255,179,191);
    }
    .d-lex{
      background-color:blue;
    }
    </style>
  </head>
  <body>
  <!-- <div class="d-flex justify-content-center bg-primary text-white""><p>fss</p></div> -->
  <div class="alert alert-primary" style="margin-left:30px; margin-right:30px; text-align: center;  border-radius: 25px; " role="alert">
       Điểm HK 1, NH 2019-2020
  </div>
  <div style="margin:1px" >
    <table class="table table-bordered  table-sm">
        <thead style="color:rgb(255,179,191);  text-align: center">
            <tr>
            <th scope="col" style="text-align: left">MAMH</th>
            <th scope="col">TC</th>
            <th scope="col">QT</th>
            <th scope="col">TH</th>
            <th scope="col">GK</th>
            <th scope="col">CK</th>
            <th scope="col">TB</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
            <tr >
                <th scope="row" >{{$grade->MAMH}}</th>
                <td>{{$grade->TCLT + $grade->TCTH}}</td>
                <td>{{$grade->QT}}</td>
                <td>{{$grade->TH}}</td>
                <td>{{$grade->GK}}</td>
                <td>{{$grade->CK}}</td>
                <td>{{$grade->TB}}</td>
            </tr>
            @endforeach
            
           
        </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>