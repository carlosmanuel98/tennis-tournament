<!doctype html>
<html lang="en">

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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- Jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    
</body>


<div class="container players-input">
    <h1 class="pt-3">Setttings players</h1>
    <form action="{{ route('savePlayer')  }}" method="post" accept-charset="UTF-8">
        {{csrf_field()}}
        {{-- {{ $data['gender'] }} --}}
        {{-- {{ $data['tournamentName'] }} --}}
        <input class="form-control" type="text" value="{{ $data['tournamentName'] }}" name="inputTournamentName" hidden>
        <input class="form-control" type="text" value="{{ $data['gender'] }}" name="inputGenderTournament" hidden>
        @for ($i = 0; $i < $data['pow_number']; $i++)
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputName-{{ $i }}">First Name:</label>
                    <input type="text" class="form-control" name="request[{{ $i }}][inputName]" id="inputName-{{ $i }}" placeholder="First Name" required>
                </div>                
                <div class="form-group col-md-2">
                    <label for="inputLastName-{{ $i }}">Last Name:</label>
                    <input type="text" class="form-control" name="request[{{ $i }}][inputLastName]" id="inputLastName-{{ $i }}" placeholder="Last Name" required>
                </div>          
                <div class="form-group col-md-2" title="minimum value 0. maximum value 100">
                    <label for="inputAbility-{{ $i }}">Ability</label>
                    <input type="number" min="0" max="100" name="request[{{ $i }}][inputAbility]" class="form-control"
                        id="inputAbility-{{ $i }}" placeholder="0 - 100" required>
                        <p class="text-muted">Player skill</p>
                </div>      
                @foreach ($data['cat_skills'] as $key => $skills)
                    <div class="form-group col-md-3" title="minimum value 0. maximum value 100">
                        <label for="inputSkill-{{ $i }}">{{ $skills->description }}</label>
                        <input type="number" min="0" max="100" name="request[{{ $i }}][{{ $skills->tag_name }}]" class="form-control"
                            id="inputSkill-{{ $i }}" placeholder="0 - 100" required>
                            <p class="text-muted">Player skill</p>
                    </div>
                @endforeach              
            </div>
        @endfor
        <button type="submit" class="btn btn-primary">Simulate matches</button>
    </form>
</div>

</html>
