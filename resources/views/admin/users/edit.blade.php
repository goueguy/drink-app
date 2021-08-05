@extends('layouts.template')
@section('title','Utilisateurs')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><span class="float-right"><a href="{{route('admin.users')}}">Liste</a></span></h6>
        </div>
        <form action="{{route('admin.users.update',['id'=>$user->id])}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" name="name" value="{{$user->name}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="Prénoms" name="lastname" value="{{$user->lastname}}">
                            @error('lastname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Adresse Email" name="email" value="{{$user->email}}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="">---Choisir Un rôle---</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{($role->id===$user->role_id) ? 'selected':''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-danger">Modifier</button>
            </div>
        </form>
    </div>
</div>

@endsection
