@extends('layouts.template')
@section('title','Roles')
@section('module-name','Roles')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><span class="float-right"><a href="{{route('admin.roles')}}">Liste</a></span></h6>
        </div>
        <form action="{{route('admin.roles.store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" name="name" value="{{old('name')}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{old('description')}}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

@endsection
