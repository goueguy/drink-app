@extends('layouts.template')
@section('title','Boissons')
@section('module-name','Boissons')
@section('content')
<div class="container-fluid">
    @include('layouts.includes._errors_message')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste <span class="float-right"><a href="{{route('admin.drinks.create')}}">Ajouter</a></span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Catégorie</th>
                            <th>Fournisseur</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drinks as $key=> $boisson)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$boisson->name}}</td>
                                <td>{{$boisson->description}}</td>
                                <td>{{$boisson->quantite}}</td>
                                <td>{{$boisson->prix_unitaire}}</td>
                                <td>{{$boisson->categorie_drink_id}}</td>
                                <td>{{$boisson->fournisseur_id}}</td>
                                <td><img src="{{asset('uploads/boissons/'.$boisson->image)}}" alt="{{$boisson->name}}" class="h-25"></td>
                                <td>
                                    <a href="{{route('admin.drinks.edit',['id'=>$boisson->id])}}"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('admin.drinks.delete',['id'=>$boisson->id])}}" onclick="return confirm('êtes vous sûre');"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
