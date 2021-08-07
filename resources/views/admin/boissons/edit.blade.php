@extends('layouts.template')
@section('title','Boissons')
@section('module-name','Boissons')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Modification<span class="float-right"><a href="{{route('admin.drinks')}}">Liste</a></span></h6>
        </div>
        <form action="{{route('admin.drinks.update',['id'=>$drink->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" name="name" value="{{$drink->name}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description" value="{{$drink->description}}">
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                            <option value="">---Choisir Une Catégorie---</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{($category->id===$drink->category_drink_id) ? 'selected':''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <select name="fournisseur" id="fournisseur" class="form-control @error('fournisseur') is-invalid @enderror">
                                <option value="">---Choisir Un Fournisseur---</option>
                                @foreach ($fournisseurs as $fournisseur)
                                    <option value="{{$fournisseur->id}}" {{($fournisseur->id===$drink->fournisseur_id) ? 'selected':''}}>{{$fournisseur->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('fournisseur')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="number" class="form-control @error('quantite') is-invalid @enderror" placeholder="Quantite" name="quantite" value="{{$drink->quantite}}">
                            @error('quantite')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="number" class="form-control @error('prix_unitaire') is-invalid @enderror" placeholder="Prix Unitaire" name="prix_unitaire" value="{{$drink->prix_unitaire}}">
                            @error('prix_unitaire')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{old('image')}}">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{asset('uploads/boissons/'.$drink->image)}}" class="w-100 h-100" alt="">
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
