@extends('layouts.admin')
@section('title','Lista de assistentes')
@section('content')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">

        @if (session('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>{{session('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h6 class="mb-4">Lista de assistentes
            <a href="{{url('admin/assistentes/criar')}}" class="btn btn-outline-primary btn-sm float-end"><i
                    class="fa fa-plus me-2"></i>Adicionar</a>
        </h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Província</th>
                        <th scope="col">Distrito</th>
                        <th scope="col">Contactos</th>
                        <th scope="col">Área de Experiência</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assistants as $item )
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <th>
                                <img src="{{ asset('storage/' . $item->profile) }}" style="width:50px;height:50px;" class="rounded" alt="{{ $item->full_name }}">
                            </th>
                            <td>{{$item->full_name}}</td>
                            <td>{{$item->province}}</td>
                            <td>{{$item->district}}</td>
                            <td>{{$item->contacts}}</td>
                            <td>{{$item->area_of_experience}}</td>
                            <td class="text-success">{{$item->status}}</td>
                            <td>
                                <a href="{{ url('admin/assistentes/'.$item->id.'/edit')}}"
                                    class="btn btn-outline-success btn-sm">Editar</a>
                                <a href="{{url('admin/assistentes/'.$item->id.'/delete')}}"  onclick="return confirm('Voçê tem a certeza que quer deletar esse assistente?')" class="btn btn-outline-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                   
                    @empty
                    <tr>
                        <td colspan="9" class="text-center"> Não à assistentes Disponiveis</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            
        </div>

    </div>
</div>  
@endsection