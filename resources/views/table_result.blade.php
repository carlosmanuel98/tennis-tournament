<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Table</title>
</head>

<body>
    <script type="text/javascript">
         $('#dataTable-report').DataTable( {
            fixedHeader: true
        });
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</body>

<h1 class="text-center">Report - Tournament</h1>


<div class="container">
    <table id="dataTable-report" class="table table-striped" style="width:100%">        
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Date</th>
                <th>Category</th>
                <th>Player winner</th>
                <th>Results</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $value->id_tournament }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->date }}</td>
                    <td>{{ $value->category }}</td>
                    <td>{{ $value->player_win }}</td>
                    <td>{{ $value->result }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>



</html>
