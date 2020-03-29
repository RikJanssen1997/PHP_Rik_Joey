@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Module</div>

                <div class="card-body">
                    <form action="{{ route('admin.grades.update', $lesson) }}" method="POST">
                        @csrf
                        {{method_field('PUT')}}
                        <label> EC</label>
                        @foreach($lesson->users as $user)

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{$user->name}}</label>

                            <label for="ec" class="col-md-2 col-form-label text-md-right">EC</label>
                            <div class="col-md-6">
                                <input type="number" class="@error('ec') is-invalid @enderror" id="ec" name="ec[]" min="0" max="{{$lesson->module->ec}}" required="true" @foreach($lesson->users as $followedLesson) @if($followedLesson->pivot->user_id == $user->id) value= "{{$followedLesson->pivot->ec }}">@endif @endforeach
                                @error('ec')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                        <label>Grade</label>
                        @foreach($lesson->users as $user)

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{$user->name}}</label>

                            <label for="grade" class="col-md-2 col-form-label text-md-right">grade</label>
                            <div class="col-md-6">
                                <input type="number" class="@error('grade') is-invalid @enderror" id="grade" name="grade[]" min="0" max="10" required="true" @foreach($lesson->users as $followedLesson) @if($followedLesson->pivot->user_id == $user->id) value= "{{$followedLesson->pivot->grade }}">@endif @endforeach
                                @error('grade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection