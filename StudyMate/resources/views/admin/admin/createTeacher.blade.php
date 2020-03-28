@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Module</div>

                <div class="card-body">
                    <form action="{{ route('admin.teacher.store') }}" method="POST">
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
                            <label for="modules" class="col-md-2 col-form-label text-md-right">Modules</label>
                            <div class="col-md-6">
                                @foreach($modules as $module)
                                <div class="form-check">
                                    <input type="checkbox" name="modules[]" value="{{ $module->id }}">
                                    <label>{{ $module->name }}</label>
                                </div>
                                @endforeach
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