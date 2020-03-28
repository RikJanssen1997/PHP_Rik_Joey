@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Module</div>

                <div class="card-body">
                    <form action="{{ route('admin.module.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="test" class="col-md-2 col-form-label text-md-right">Test</label>
                            <div class="col-md-6">
                                <select id="test" name="testType">
                                    @foreach($testTypes as $testType)
                                    <option value="{{$testType->id}}">
                                        {{$testType->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="coordinator" class="col-md-2 col-form-label text-md-right">Coordinator</label>
                            <div class="col-md-6">
                                <select id="coordinator" name="coordinator">
                                    @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}">
                                        {{$teacher->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Block" class="col-md-2 col-form-label text-md-right">Block</label>
                            <div class="col-md-6">
                                <select id="block" name="block">
                                    @foreach($blocks as $block)
                                    <option value="{{$block->id}}">
                                        {{$block->number}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ec" class="col-md-2 col-form-label text-md-right">EC</label>
                            <div class="col-md-6">
                            <input type="number" id="ec" name="ec" min="1" max="5" required="true">
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