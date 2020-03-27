<link href="{{ asset('css/DeadlineManager.css') }}" rel="stylesheet">
@extends('layouts.app')

@section('content')
<div class="deadlineTableDiv">
    <H2 id="pageHeader">Deadline Manager</H2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Afgerond</th>
                <th scope="col">Module</th>
                <th scope="col">Tijdstip</th>
                <th scope="col">Categorie</th>
                <th scope="col">Docent</th>
                <th scope="col">Tag</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="Python">
                        <label class="custom-control-label" for="Python"></label>
                    </div>
                </th>
                <th>PYTHON</th>
                <td>25-05-2020 08:00</td>
                <td>Assesment</td>
                <td>Reinout Versteeg</td>
                <td>Leuk</td>
            </tr>
            <tr>
                <th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="PHP">
                        <label class="custom-control-label" for="PHP"></label>
                    </div>
                </th>
                <th>WEBSPHP</th>
                <td>12-03-2020 13:00</td>
                <td>Assesment</td>
                <td>Rik Meijer</td>
                <td>Niet leuk</td>
            </tr>
            <tr>
                <th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="JS">
                        <label class="custom-control-label" for="JS"></label>
                    </div>
                </th>
                <th>WEBSJS</th>
                <td>12-05-2020 13:00</td>
                <td>Assesment</td>
                <td>Stijn Smulders</td>
                <td>Leuk</td>
            </tr>

        </tbody>
    </table>
</div>

@endsection