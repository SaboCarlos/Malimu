@extends('layouts.util')
@section('title', ('Mundaça De Password'))
@section('content')
<section class="section" id="about">
    <div class="container">
 
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                @if (session('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{session('message')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <h4 class="mb-4">
                    Mundaça De Password
                    <a href="{{route('perfil')}}" class="btn btn-outline-danger btn-sm float-end"><i
                            class="fa fa-minus me-2"></i>Voltar
                    </a>
                </h4>
                <form action="{{ route('changePassword') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        
                        <input type="password" class="form-control" name="current_password" id="floatingInput"
                            placeholder="Antigo Password">
                        <label for="floatingInput">Antigo Password</label>
                       
                        @error('current_password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        
                        <input type="password" class="form-control" name="password" id="floatingPassword"
                            placeholder="Novo Password">
                        <label for="floatingPassword">Novo Password</label>
                        
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                       
                        <input type="password" class="form-control" name="password_confirmation" id="floatingPassword"
                            placeholder="Confirmar">
                        <label for="floatingPassword">Confirmar</label>
                       
                        @error('password_confirmation')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Atualizar Password</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection