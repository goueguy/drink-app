@extends('layouts.template')
@section('title','Commandes de Boissons')
@section('module-name','Commandes de Boissons')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><span class="float-right"><a href="{{route('admin.commandes')}}">Liste</a></span></h6>
        </div>
        <form action="{{route('admin.commandes.store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nom du Client" name="name" value="{{old('name')}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror" placeholder="Téléphone du Client" name="telephone" value="{{old('telephone')}}">
                            @error('telephone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="boisson_table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Boissons</th>
                                        <th>Quantite</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="boisson0">
                                        <td>
                                            <select name="boissons[]" class="form-control">
                                                <option value="">Choisir Boisson</option>
                                                @foreach ($drinks as $drink)
                                                    <option value="{{$drink->id}}">{{$drink->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantites[]" class="form-control" value="1">
                                        </td>
                                    </tr>
                                    <tr id="boisson1"></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button id="add-row" type="button" class="btn btn-success">+ Ajouter une ligne</button>
                        <button id="delete-row" type="button" class="btn btn-danger">- Supprimer une ligne</button>
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

