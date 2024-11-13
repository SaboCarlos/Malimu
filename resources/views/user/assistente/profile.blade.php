@extends('layouts.util')
@section('title', 'Assistentes')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container">

                        <article class="article">

                            <div class="post-img">
                                <img src="{{ asset('storage/' . $assistant->profile) }}" alt="{{ $assistant->full_name }}"
                                    class="img-fluid">
                            </div>

                            <h2 class="title">{{ $assistant->full_name }} - <small>{{ $assistant->age }} anos</small> 
                                <span class="text-warning float-end text-capitalize"><i class="bi bi-check-circle"></i> {{ $assistant->availability}}</span>
                            </h2>
                            <strong>Classificação Geral: </strong>
                            <span class="stars">
                                @php
                                    $fullStars = floor($averageRating);  // Número de estrelas inteiras
                                    $halfStar = $averageRating - $fullStars >= 0.5;  // Verifica se precisa de meia estrela
                                @endphp
                            
                                <!-- Exibir estrelas inteiras -->
                                @for ($i = 1; $i <= $fullStars; $i++)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @endfor
                            
                                <!-- Exibir meia estrela, se necessário -->
                                @if ($halfStar)
                                    <i class="bi bi-star-half text-warning"></i>
                                @endif
                            
                                <!-- Estrelas vazias para completar o total de 5 -->
                                @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                                    <i class="bi bi-star text-muted"></i>
                                @endfor
                            </span>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a><time
                                                datetime="2020-01-01">
                                                {{ $assistant->created_at->format('d/m/Y') }}</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="blog-details.html">{{ $totalReviews }} Comentários</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                <p>
                                    {{ $assistant->experience_summary }}
                                </p>
                            </div>
                            <div class="meta-bottom">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a> {{ $assistant->area_of_experience }}</a></li>
                                </ul>

                            </div><!-- End meta bottom -->

                        </article>

                    </div>
                </section><!-- /Blog Details Section -->

            </div>

            <div class="col-lg-4 sidebar">

                <div class="widgets-container">
                    <!-- Dados Widget -->
                    <div class="categories-widget widget-item">
                        <h3 class="widget-title">Dados:</h3>
                        <p><i class="bi bi-gender-ambiguous"></i> {{ $assistant->gender }}</p>
                        <p><i class="bi bi-map"></i> {{ $assistant->province }}</p>
                        <p><i class="bi bi-pin-map"></i> {{ $assistant->district }}</p>
                    </div><!--/Dados Widget -->

                    <!-- Área de Experiência Widget -->
                    <div class="categories-widget widget-item">
                        <h3 class="widget-title">Área de Experiência:</h3>
                        <p class="text-uppercase"><i class="bi bi-folder"></i>
                            <strong>{{ $assistant->area_of_experience }}</strong></p>
                    </div><!--/Área de Experiência Widget -->

                    <!-- Formação Acadêmica e CertificaçõesWidget -->
                    <div class="categories-widget widget-item">

                        <h3 class="widget-title">Formação Académica e Certificações:</h3>
                        <ul class="mt-3">
                            @foreach (json_decode($assistant->academic_qualifications ?? '[]') as $qualification)
                                <li><i class="bi bi-arrow-right-circle"></i> {{ $qualification }}</li>
                            @endforeach
                        </ul>

                    </div><!--/Formação Acadêmica e CertificaçõesWidget -->

                    <!-- Habilidades Específicas Widget -->
                    <div class="categories-widget widget-item">

                        <h3 class="widget-title">Habilidades Específicas: </h3>
                        <ul class="mt-3">
                            @foreach (json_decode($assistant->skills ?? '[]') as $habilidades)
                                <li><i class="bi bi-arrow-right-circle"></i> {{ $habilidades }}</li>
                            @endforeach
                        </ul>

                    </div><!--/Habilidades Específicas Widget -->


                    <!-- Idiomas Widget -->
                    <div class="tags-widget widget-item mb-3">

                        <h3 class="widget-title">Idiomas Falados:</h3>
                        <ul>
                            @foreach (json_decode($assistant->idiomas ?? '[]') as $linguagens)
                                <li><a>{{$linguagens}}</a></li>
                            @endforeach
                        </ul>

                    </div><!--/Idiomas Widget -->

                    @if($solicitacao && $solicitacao->status_pagamento == 'pago')
                    <!-- Contatos visíveis se o pagamento estiver confirmado -->
                     <p><strong>Contatos:</strong> {{ $assistant->contacts }}</p>
                    @else
                        <!-- Botão para solicitar contatos caso o pagamento não esteja confirmado -->
                        <button type="button" class="btn btn-success w-100" onclick="solicitarContatos()">Solicitar Contatos</button>
                        <p class="text-danger mt-2">Pagamento pendente. Entre em contato com o suporte para concluir o pagamento.</p>
                        <p>Suporte: 876236329 / 842363295</p>
                    @endif
                


                </div>

            </div>

        </div>

        <!-- Blog Comments Section -->
        <section id="blog-comments" class="blog-comments section">
            <div class="col-lg-8">
                <div class="container">

                    <h4 class="comments-count">Avaliações dos Pesquisadores( {{ $totalReviews }} )</h4>
                    <p class="mt-2"><strong>Comentários:</strong></p>
                    @foreach ($reviews as $review)
                        <div id="comment-{{ $review->id }}" class="comment">
                            <div class="d-flex">
                                <div>
                                    <h5>
                                        <a>{{ $review->user->name }}</a>
                                        <span class="stars">
                                            <!-- Exibir as estrelas conforme a avaliação -->
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                            @endfor
                                        </span>
                                    </h5>
                                    <time datetime="{{ $review->created_at->format('Y-m-d') }}">
                                        {{ $review->created_at->format('d M, Y') }}
                                    </time>
                                    <p>{{ $review->comment }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach<!-- End comment #1 -->

                </div>

            </div>
        </section><!-- /Blog Comments Section -->
        <!-- Comment Form Section -->
        <section id="comment-form" class="comment-form section">
          <div class="col-lg-8">
            <div class="container ">
                @php
                    // Busca a avaliação existente para o produto atual e o usuário autenticado
                    $userReview = $assistant->reviews()->where('user_id', Auth::id())->first();
                @endphp
                <form action="{{ route('reviews.store', $assistant->id) }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="assistant_id" value="{{ $assistant->id }}">

                    <h4>Deixe Sua Avaliação</h4>
                    <p>Sua opinião é importante! Avaliar o assistente com quem você trabalhou ajuda outros usuários a fazerem boas escolhas e contribui para o crescimento do profissional. Campos obrigatórios estão marcados com *.</p>
                    @if (session('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>{{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                      <div class="col-12 col-md-12 text-center mb-3">
                        <div class="form-group">
                            <div class="rating-css">
                            <!-- Estrelas da avaliação (podem ser ajustadas dinamicamente) -->
                                <div class="star-icon">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" value="{{ $i }}" name="assistant_rating" id="rating{{ $i }}"
                                        {{ (isset($userReview) && $userReview->rating == $i) ? 'checked' : '' }}>
                                        <label for="rating{{ $i }}" class="bi bi-star-fill"></label>
                                    @endfor
                                </div>
                            </div>
                        </div>
  
                      </div>
                     
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <textarea name="comment" class="form-control" placeholder="Seu Comentario*">{{ $userReview->comment ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Avaliar</button>
                    </div>

                </form>

            </div>
          </div>
        </section><!-- /Comment Form Section -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       function solicitarContatos() {
            fetch("{{ route('solicitacao.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ assistant_id: "{{ $assistant->id }}" })
            })
            .then(response => {
                // Se a resposta não for um JSON válido, ela pode ser HTML (página de login, por exemplo)
                return response.text().then(text => {
                    try {
                        return JSON.parse(text); // Tenta parsear a resposta como JSON
                    } catch (e) {
                        throw new Error("Não foi possível processar a solicitação. Faça login.");
                    }
                });
            })
            .then(data => {
                // Se a resposta for um JSON válido, mostra a mensagem
                if (data.success) {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                } else {
                    Swal.fire({
                        title: 'Erro!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            })
            .catch(error => {
                // Se ocorrer um erro ao fazer o JSON.parse ou outro erro
                Swal.fire({
                    title: 'Erro!',
                    text: error.message || 'Ocorreu um erro inesperado.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            });
        }



    </script>
@endsection
