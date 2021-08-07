@extends('layouts.template')
@section('title','Commandes de Boissons')
@section('module-name','Commandes de Boissons')
@section('content')
<!-- DataTales Example -->
<div class="container-fluid">
    @include('layouts.includes._errors_message')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste <span class="float-right"><a href="{{route('admin.commandes.create')}}">Ajouter</a></span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ref. Commande</th>
                            <th>Nom du Client</th>
                            <th>Téléphone</th>
                            <th>Boissons Commandées</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commandes as $key=> $commande)
                            <tr>
                                <td>{{$commande->numero_commande}}</td>
                                <td>{{$commande->customer_name}}</td>
                                <td>{{$commande->telephone}}</td>
                                <td>
                                    <ul>
                                        @foreach ($commande->drinks as $item)
                                            <li>{{$item->pivot->quantite}} {{$item->name}} </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{$commande->total}}</td>
                                <td>{{$commande->status}}</td>
                                <td>
                                    @if($commande->status==="validée")
                                        <a href="{{route('admin.commandes.change-status',['id'=>$commande->id])}}"><i class="fa fa-lock"></i></a>
                                    @endif
                                    <a href="{{route('admin.commandes.show',['id'=>$commande->id])}}"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('admin.commandes.delete',['id'=>$commande->id])}}" onclick="return confirm('êtes vous sûre');"><i class="fa fa-trash"></i></a>
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
