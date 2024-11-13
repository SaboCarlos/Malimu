@extends('layouts.admin')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Listagem De Usuarios <a href="{{route('admin.user.create')}}" class="float-end btn btn-outline-primary btn-sm">Criar</a></h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tipo de Conta</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                   
                                    <td>{{$user->email}}</td>
                                    <td class="
                                        @if ($user->role == 'admin')
                                            text-danger
                                        @else
                                            text-warning
                                        @endif
                                    ">
                                        {{ $user->role }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-sm-square btn-outline-primary"><i class="fa fa-pen"></i></a>
                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-sm-square btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este imigrante?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>
            

    </div>
</div>

@endsection