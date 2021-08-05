@extends('layouts.template')
@section('title','Utilisateurs')
@section('module-name','Utilisateurs')
@section('content')
<!-- DataTales Example -->
<div class="container-fluid">
    @include('layouts.includes._errors_message')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste <span class="float-right"><a href="{{route('admin.users.create')}}">Ajouter</a></span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom & Prénoms</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key=> $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name.'  '.$user->lastname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role->name}}</td>
                                <td>
                                    <a href="{{route('admin.users.edit',['id'=>$user->id])}}"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('admin.users.delete',['id'=>$user->id])}}" onclick="return confirm('êtes vous sûre');"><i class="fa fa-trash"></i></a>
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
