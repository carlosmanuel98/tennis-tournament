<!doctype html>
<html lang="en">
<style>
    .match_time {
  background: #595eeccf;
  border-radius: 0 0 20px 20px;
}
.team_view {
  background: #4444441a;
  padding: 70px;
  border-radius: 30px 30px 0 0;
}
.upper{
text-transform:uppercase;
}
.score-upp{
font-size:22px;
}
.display-back{
    display: none;
}
</style>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- datatable --}}
    <link src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link src="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link src="https://cdn.datatables.net/fixedheader/3.3.1/css/fixedHeader.bootstrap5.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    

    <title>Tournament</title>
</head>

<body style="background-color: #94bfd34f;">
    <script type="text/javascript" src="{{ asset('js/tournament.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    {{-- datatable --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

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


<div class="container pt-4">
    <h1 class="text-center">{{ $data['msg_stage'] }}</h1>
    <div class="team_view d-flex flex-wrap justify-content-center">
        <div class="team_one d-flex  flex-wrap justify-content-center">
          <h6 class="m-auto">Player name: <span class="upper">{{ $data['name_player_one'] }}</span></h6>          
        </div>
        <div class="m-auto">
            <strong><span class="score-upp">{{ $data['score_one'] }}</span></strong>
            <strong>-</strong>
            <strong><span class="score-upp">{{ $data['score_two'] }}</span></strong></div>
        <div class="team_one d-flex flex-wrap justify-content-center">          
          <h6 class="m-auto">Player name: <span class="upper">{{ $data['name_player_two'] }}</span></h6>
        </div>
      </div>
      <div class="match_time d-flex flex-wrap text-center justify-content-center ">
        <h6><i class="fa-solid fa-calendar-days"></i> {{ $data['msg_stage'] }}&nbsp;</h6>
        <h6><i class="fa-solid fa-location-dot"></i> The Winner is: <strong><span class="upper">{{ $data['winner_score'] }}</span></strong> </h6>
      </div>
      <br/>
</div>

<a class="display-back" href="{{ URL::previous() }}">
    <div class="container">
        <button class="btn btn-primary col-12" type="button">Generate new Tournament.</button>
    </div>
</a>
</html>
