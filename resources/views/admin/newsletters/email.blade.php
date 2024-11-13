@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        @if (session('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>{{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h5 class="mb-4">Newsletter - E-mail</h5>
        <p>Total de e-mails: {{ $count }}</p>


        <form action="{{ route('newsletters.email.send') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12 col-lg-12 mb-3">
                <div class="form-floating">
                    <textarea name="message" class="form-control" id="floatingmessage" placeholder="Mensagem" style="height: 150px">{{ old('message') }}</textarea>
                    <label for="floatingmessage">Mensagem</label>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 mb-3">
                <div class="form-floating">
                    <input type="file" name="image" class="form-control" id="floatingimage" accept="image/*">
                    <label for="floatingimage">Anexar Imagem (opcional)</label>
                </div>
            </div>
        
            
            <button type="submit" class="btn btn-success">Enviar via E-mail</button>
        </form>

        <h4 class="mt-4">E-mails</h4>
        <ul>
            @foreach($emails as $email)
                <li>{{ $email }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
