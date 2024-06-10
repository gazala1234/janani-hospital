@extends('navbar')

@section('maincontent')
@include('boot')

<form>

    <div class="container">
        <label for="academic_year">Academic Year</label>
        <input type="text" class="form-control" id="academic_year" name="academic_year">
    </div>

</form>


@endsection