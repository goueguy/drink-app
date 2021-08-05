@extends('layouts.template')
@section('title','Utilisateurs')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><span class="float-right"><a href="{{route('admin.roles')}}">Liste</a></span></h6>
        </div>
        <form action="{{route('admin.roles.update',['id'=>$role->id])}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" name="name" value="{{$role->name}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{$role->description}}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="permissions" class="form-control-label">Permissions</label>
                            @foreach ($permissions as $permission)
                                <div class="form-group form-check">
                                    <input type="checkbox" name="permissions[]" id="{{$permission->id}}" value="{{$permission->id}}" @if($role->permissions->pluck('id')->contains($permission->id)) checked @endif>
                                    <label for="{{$permission->id}}" class="form-check-label">{{$permission->name}}</label>
                                </div>
                            @endforeach

                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
