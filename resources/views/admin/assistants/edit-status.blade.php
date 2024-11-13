@extends('layouts.admin')
@section('title', 'Atualizar Status')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Atualizar Status do Assistente
                    <a href="{{ route('assistants.index') }}" class="btn btn-outline-danger btn-sm float-end">
                        <i class="fa fa-minus me-2"></i>Voltar
                    </a>
                </h6>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 col-lg-6 mb-3">
                        <img src="{{ asset('storage/' . str_replace('public/', '', $assistant->profile)) }}" width="80px" alt="Imagem do perfil" class="d-block mt-2">
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <h5>Nome: {{$assistant->full_name}}, {{$assistant->contacts}}</h5>
                        <p>Idade: {{$assistant->age}}</p>
                        <p>Sexo: {{$assistant->gender}}</p>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <p>Província: {{$assistant->province}}</p>
                        <p>Distrito: {{$assistant->district}}</p>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <p>Área de Experiência: {{$assistant->area_of_experience}}</p>
                        <p>Disponibilidade: {{$assistant->availability}}</p>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <p>Habilidades Específicas: 
                            <ul>
                                @foreach(json_decode($assistant->skills ?? '[]') as $habilidades)
                                    <li>{{ $habilidades }}</li>
                                @endforeach
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <p>Formação Acadêmica e Certificações: 
                            <ul>
                                @foreach(json_decode($assistant->academic_qualifications ?? '[]') as $qualification)
                                    <li>{{ $qualification }}</li> 
                                @endforeach
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <p>{{$assistant->experience_summary}}</p>
                    </div>
                </div>
                <form action="{{ route('assistants.updateStatus', $assistant->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" name="status" id="floatingStatus">
                                    <option value="aceito" {{ $assistant->status == 'aceito' ? 'selected' : '' }}>Aceito</option>
                                    <option value="pendente" {{ $assistant->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="recusado" {{ $assistant->status == 'recusado' ? 'selected' : '' }}>Recusado</option>
                                </select>
                                <label for="floatingStatus">Status</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 text-center mb-3">
                            <button type="submit" class="btn btn-success m-2">
                                <i class="fa fa-save me-2"></i>Actualizar o Estado
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
