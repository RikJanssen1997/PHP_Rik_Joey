@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Module</div>

                <div class="card-body">
                    <form action="{{ route('deadlineManager.deadlinemanager.store' , $lesson)}}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                        <div class="form-group row">
                            <label for="modules" class="col-md-2 col-form-label text-md-right">Deadline date</label>
                            <div class="col-md-6">
                                <input type="date" name="deadlineDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="test" class="col-md-2 col-form-label text-md-right">Tag</label>
                            <div class="col-md-6">
                                <select id="test" name="tag">
                                    @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">
                                        {{$tag->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection