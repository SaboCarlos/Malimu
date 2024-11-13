@extends('layouts.util')
@section('title', ('Informações Pessoais'))
@section('content')
    <section class="section" id="about">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h4 class="mb-4 text-uppercase fw-bold">Informações Pessoais</h4>
            <a href="{{ route('change-password') }}" class="btn btn-success btn-sm"><i
                class="fa fa-plus me-2"></i>Mudar Password</a>
            <form action="{{ route('updateUserDetails') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 mb-3">
                            <div class="form-floating">
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control"
                                    id="floatingNome" placeholder="Nome">
                                    <label for="floatingNome">Nome</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 mb-3">
                            <div class="form-floating">
                                <input type="text" name="email" readonly value="{{ Auth::user()->email }}"
                                    class="form-control" id="floatingEmail" placeholder="Email">
                                    <label for="floatingEmail">Email</label>
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 text-center mt-4">
                        <div class="">
                            <button type="submit" class="btn btn-outline-success m-2">
                                <i class="fa fa-save me-2"></i>Actualizar
                            </button>
                        </div>
                    </div>
                </div>
               
            </form>

        </div>

    </section>
@endsection
