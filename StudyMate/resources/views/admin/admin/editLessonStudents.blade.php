@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Module</div>

                <div class="card-body">
                    <form action="{{ route('admin.lesson.update', $lesson) }}" method="POST">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group row">
                            <label for="users" class="col-md-2 col-form-label text-md-right">Users</label>
                            <div class="col-md-6">
                                @foreach($users as $user)
                                <div class="form-check">
                                    <input type="checkbox" name="users[]" value="{{ $user->id }}" @if($lesson->users->pluck('id')->contains($user->id)) checked @endif>
                                    <label>{{ $user->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection