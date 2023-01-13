<!doctype html>
<html lang="en">
    @extends('layouts.menu')

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Tournament</title>
</head>

<body>
    <script type="text/javascript" src="{{ asset('js/tournament.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    {{-- Jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        var base_url = {!! json_encode(url('/')) !!}
        var IS = {
            base_url: "{{ URL('/') }}"
        }
    </script>
</body>
@section('sectionName')
Tournament setup
@stop
@section('content')
<div class="container">

    <div class="row">
        <div class="form-group col-md-4">
            <label for="inputTournamentName">Name of tournament</label>
            <input type="text" class="form-control" name="inputTournamentName" id="inputTournamentName" placeholder="Tournament name" required>
        </div>  
        <div class="form-group col-md-4">
            <label for="inputPlayers">Amount of player to play:</label>
            <select id="inputPlayers" class="form-control">
                <option value="">Choose...</option>
                {{-- <option value="1">2 Players</option> --}}
                <option value="2">4 Players</option>
                <option value="3">8 Players</option>
                <option value="4">16 Players</option>
                <option value="5">32 Players</option>
                <option value="6">64 Players</option>
                <option value="7">128 Players</option>
                {{-- <option value="1">2 &sup1; = 2</option>
                <option value="2">2 &sup2; = 4</option>
                <option value="3">2 &sup3; = 8</option>
                <option value="4">2 &#x2074; = 16</option>
                <option value="5">2 &#x2075; = 32</option>
                <option value="6">2 &#x2076; = 64</option>
                <option value="7">2 &#x2077; = 128</option> --}}
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="inputGender">Gender</label>
            <select id="inputGender" class="form-control">
                <option selected value="">Choose...</option>
                @foreach ($data['cat_gender'] as $gender)
                    <option value="{{ $gender->id_cat_gender }}">{{ $gender->description }}</option>
                @endforeach
            </select>
        </div>
         
    </div>
    <button class="btn btn-primary create-button" disabled>Create Players</button>
</div>
</form>


<div class="player-create"></div>
@stop

</div>

</html>
