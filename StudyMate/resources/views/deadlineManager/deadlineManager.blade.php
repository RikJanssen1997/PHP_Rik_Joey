<link href="{{ asset('css/DeadlineManager.css') }}" rel="stylesheet">
@extends('layouts.app')

@section('content')
<div class="deadlineTableDiv">
    <H2 id="pageHeader">Deadline Manager</H2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Afgerond</th>
                <th scope="col"><a class="noStyle" href = "{{ route('deadlineManager.deadlinemanager.sortModule')}}">Module</a></th>
                <th scope="col"><a class="noStyle" href = "{{ route('deadlineManager.deadlinemanager.sortDeadlineDate')}}">Tijdstip</a></th>
                <th scope="col"><a class="noStyle" href = "{{ route('deadlineManager.deadlinemanager.sortCategory')}}">Categorie</a></th>
                <th scope="col"><a class="noStyle" href = "{{ route('deadlineManager.deadlinemanager.sortTeacher')}}">Docent</a></th>
                <th scope="col">Tag</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deadlines as $deadline)
            <tr>
                <th>
                    <form action="{{ route('deadlineManager.deadlinemanager.updateFinished' , $deadline)}}" method="POST">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="{{$deadline->id}}" name="finished" onclick="this.form.submit();" @if($deadline->finished) checked @endif>
                            <label class="custom-control-label" for="{{$deadline->id}}"></label>
                        </div>
                    </form>
                </th>
                <th>{{$deadline->lesson->module->name}}</th>
                <td>{{date('d-m-Y', strtotime($deadline->deadline_date))}}</td>
                <td>{{$deadline->lesson->module->test->testType->name}}</td>
                <td>{{$deadline->lesson->teacher->name}}</td>
                <td>{{$deadline->tag->name}}</td>
                <td>
                    <form action="{{ route('deadlineManager.deadlinemanager.destroy' , $deadline)}}" method="POST" class="float-left">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
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