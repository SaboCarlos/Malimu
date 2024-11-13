@extends('layouts.admin')

@section('content')
    <div class="container">
        <h5 class="my-4">Detalhes da Solicitação</h5>
        
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $solicitacao->user->name }} - 
                    <span class="text-muted">{{ $solicitacao->user->email }}</span>
                </h5>
                <hr>
                <h6 class="card-title">{{ $solicitacao->assistant->full_name }} - 
                    <span class="text-muted">{{ $solicitacao->assistant->area_of_experience }}</span>
                </h6>
                <p class="card-text">Status do pagamento: 
                    <strong>{{ $solicitacao->status_pagamento }}</strong>
                </p>
                <hr>
                <p class="card-text">
                    @if($solicitacao->status_pagamento == 'pago')
                        <span class="text-success">Pagamento Confirmado</span>
                        <p>Contatos: {{ $solicitacao->assistant->contacts }} </p>
                    @else
                        <span class="text-warning">Pagamento Pendente</span>
                    @endif
                </p>

                <!-- Ações do administrador (Exemplo de aprovar ou rejeitar) -->
                @if($solicitacao->status_pagamento == 'pendente')
                    <form action="{{ route('solicitacoes.aprovar', $solicitacao->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Aprovar Pagamento</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
