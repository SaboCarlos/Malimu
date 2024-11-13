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

        <h5 class="mb-4">Newsletter - WhatsApp</h5>
        <p>Total de contatos: {{ $count }}</p>
        <form action="{{ route('newsletters.whatsapp.send') }}" method="POST">
            @csrf
            <div class="col-md-12 col-lg-12 mb-3">
                <div class="form-floating">
                    <textarea name="message" class="form-control" id="floatingmessage" placeholder="Mensagem" style="height: 150px">{{ old('message') }}</textarea>
                    <label for="floatingmessage">Mensagem</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Enviar via WhatsApp</button>
        </form>
        <div class="table-responsive">
            <h6 class="mt-4">Contatos</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name ?? 'N/A' }}</td>
                            <td>{{ $contact->whatsapp }}</td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>

</div>
@endsection
