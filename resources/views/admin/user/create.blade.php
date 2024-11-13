@extends('layouts.admin')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Informações Pessoais</h6>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="form-floating">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="floatingRepublica" placeholder="Nome">
                                <label for="floatingRepublica">Nome</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="form-floating">
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="floatingNacionalidade" placeholder="Email">
                                <label for="floatingNacionalidade">Email</label>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="form-floating">
                                <select class="form-select" name="role" id="floatingCargo">
                                    <option selected>Selecione o tipo de conta</option>
                                    <option value="admin">Administrador</option>
                                    <option value="user">user</option>
                                </select>
                                <label for="floatingCargo">Tipo de conta</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 mt-2">
                    <h6 class="mb-4">Segurança</h6>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 mb-3">
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingDocIdentificacao" placeholder="Identificação do Documento da Viagem">
                                <label for="floatingDocIdentificacao">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-3">
                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirmation" class="form-control" id="floatingNomeLocal" placeholder="Nome do Local">
                                <label for="floatingNomeLocal">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botão Centralizado -->
                    <div class="col-12 text-center mt-4">
                        <div class="">
                            <button type="submit" class="btn btn-outline-primary m-2">
                                <i class="fa fa-save me-2"></i>Guardar
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
            

    </div>
</div>
@endsection