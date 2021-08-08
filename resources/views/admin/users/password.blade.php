@extends('layouts.template')
@section('title','Mot de passe')
@section('module-name','Mot de passe')
@section('content')
<div class="container-fluid">
    @include('layouts.includes._errors_message')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mot de passe</h6>
        </div>
        <form action="{{route('admin.users.password.post')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password" class="form-control-label">Mot de passe</label>
                            <input type="password" id="password" name="password" placeholder="Mot de passe" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-control-label">Confirmer Mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer Mot de passe" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{old('password_confirmation')}}">
                            @error('password_confirmation')
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
