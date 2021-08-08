@extends('layouts.template')
@section('title','Information du Profile')
@section('module-name','nformation du Profile')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Information du Profile</h6>
        </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" name="name" value="{{$user->name}}" readonly>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="Prénoms" name="lastname" value="{{$user->lastname}}" readonly>
                            @error('lastname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Adresse Email" name="email" value="{{$user->email}}" readonly>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('role') is-invalid @enderror" placeholder="Rôle" name="password" value="{{$user->role->name}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
    </div>
</div>

@endsection
