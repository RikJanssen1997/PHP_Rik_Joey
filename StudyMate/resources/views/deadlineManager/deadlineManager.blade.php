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
            @foreach($deadlines as $deadline)
            <tr>
                <th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="{{$deadline->id}}">
                        <label class="custom-control-label" for="{{$deadline->id}}"></label>
                    </div>
                </th>
                <th>{{$deadline->lesson->module->name}}</th>
                <td>{{date('d-m-Y', strtotime($deadline->deadline_date))}}</td>
                <td>{{$deadline->lesson->module->test->testType->name}}</td>
                <td>{{$deadline->lesson->teacher->name}}</td>
                <td>{{$deadline->tag->name}}</td>
            </tr>
            @endforeach
            

        </tbody>

    </table>
    <div class="card">
                <div class="card-header">Lesson</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Module</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Create Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->lessons as $lesson)
                        
                            <tr>
                                <th scope="row"></th>
                                <td>{{$lesson->module()->first()->name}}</td>
                                <td>{{$lesson->teacher()->first()->name ?? 'none'}}</td>
                                <td><a href="{{ route('deadlineManager.deadlinemanager.create', $lesson->id)}}"><button type="button" class="btn btn-primary float-left">Create Deadline</button></a>
                                </td>
                            </tr>
                         
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
</div>

@endsection