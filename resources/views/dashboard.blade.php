<!doctype html>
<html lang="en">
    @extends('layouts.menu')

<head>
    <!-- Required meta tags -->
    
    <title>Dashboard</title>
</head>

<body>
    
</body>
<style>

</style>
@section('sectionName')
Dashboard
@stop
@section('content')
<div class="container">

    <div class="d-flex flex-column justify-content-center align-items-center text-center position-relative aos-init aos-animate" data-aos="zoom-out"> 
        <img src="{{ asset('img/tennis-tournament.svg') }}" class="img-fluid animated w-25 p-3">
        <h2>Welcome to <span>Test</span></h2><p>Simulate tennis tournament.</p>
        <p><strong>Select from the Tournament menu to get started!!</strong></p>
</div>
</div>
</form>
<br>

<div class="tbl-result"></div>

@stop

</div>

</html>
