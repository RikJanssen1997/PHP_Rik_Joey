@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teachers</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Modules</th>
                                <th scope="col">Coördinator</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                            <tr>
                                <th scope="row">{{$teacher->id}}</th>
                                <td>{{$teacher->name}}</td>
                                <td>{{implode(', ', $teacher->teaching()->get()->pluck('name')->toArray() )}}</td>
                                <td>{{implode(', ', $teacher->teaching()->wherePivot('coordinator', '=', '1')->get()->pluck('name')->toArray() )}}</td>
                                <td><a href="{{ route('admin.teacher.edit', $teacher->id)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                    <form action="{{ route('admin.teacher.destroy', $teacher)}}" method="POST" class="float-left">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-secondary">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="{{ route('admin.teacher.create')}}"><button type="button" class="btn btn-primary float-left">Create new</button></a>

                </div>
            </div>
            <div class="card">
                <div class="card-header">Modules</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules as $module)
                            <tr>
                                <th scope="row">{{$module->id}}</th>
                                <td>{{$module->name}}</td>
                                <td><a href="{{ route('admin.module.edit', $module->id)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                    <form action="{{ route('admin.module.destroy', $module)}}" method="POST" class="float-left">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-secondary">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="{{ route('admin.module.create')}}"><button type="button" class="btn btn-primary float-left">Create new</button></a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Lesson</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Module</th>
                                <th scope="col">Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lessons as $lesson)
                            <tr>
                                <th scope="row"></th>
                                <td>{{$lesson->module()->first()->name}}</td>
                                <td>{{$lesson->teacher()->first()->name ?? 'none'}}</td>
                                <td><a href="{{ route('admin.lesson.edit', $lesson->id)}}"><button type="button" class="btn btn-primary float-left">Edit Students</button></a>
                                <a href="{{ route('admin.grades.edit', $lesson->id)}}"><button type="button" class="btn btn-primary float-left">Edit Grades</button></a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection