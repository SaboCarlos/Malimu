@extends('layouts.admin')

@section('content')
<div class="container">
    <h5 class="my-4">Solicitações de Assistentes</h5>
    
    @foreach ($solicitacoes as $solicitacao)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $solicitacao->user->name }} - 
                    <span class="text-muted">{{ $solicitacao->user->email }}</span>
                </h5>
                <h5 class="card-title">{{ $solicitacao->assistant->full_name }} - 
                    <span class="text-muted">{{ $solicitacao->assistant->area_of_experience }}</span>
                </h5>
                <p class="card-text">Status do pagamento: 
                    <strong class="text-info">{{ $solicitacao->status_pagamento }}</strong>
                </p>


                <p class="card-text">
                    @if($solicitacao->status_pagamento == 'pago')
                        <span class="text-success">Pagamento Confirmado</span>
                        <p>Contatos: {{ $solicitacao->assistant->contacts }}</p>
                    @else
                        <span class="text-warning">Pagamento Pendente</span>
                    @endif
                </p>

                <a href="{{ route('solicitacoes.show', $solicitacao->id) }}" class="btn btn-primary">Ver Detalhes</a>
            </div>
        </div>
    @endforeach
</div>
@endsection