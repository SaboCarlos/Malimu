@extends('layouts.util')

@section('content')
  <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
                <h1>Start Moz Biz</h1>
                <p class="mb-0">Se você deseja receber nossa newsletter diretamente no WhatsApp, forneça seu número de WhatsApp e e-mail para cadastro.</p>
            </div>
            </div>
        </div>
        </div>
    </div>
  <!-- End Page Title -->
  
  <!-- Newsletter Subscription Form -->
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <form id="newsletterForm" method="POST" action="{{ route('newsletter.subscribe') }}">
                @csrf
                <div class="mb-3">
                    <label for="whatsapp" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="whatsapp" name="name" placeholder="Seu nome" required>
                </div>
                <div class="mb-3">
                    <label for="whatsapp" class="form-label">Número do WhatsApp</label>
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="Exemplo: +258 123 456 789" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Exemplo: email@exemplo.com" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Inscrever-se na Newsletter</button>
            </form>
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        </div>
    </div>
  <!-- End Newsletter Subscription Form -->
@endsection