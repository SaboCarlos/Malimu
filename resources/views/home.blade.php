@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h2 data-aos="fade-up" data-aos-delay="100">Consultoria e Desenvolvimento Comunitário</h2>
                    <p data-aos="fade-up" data-aos-delay="200">MALIMU oferece soluções personalizadas para o crescimento e
                        bem-estar das comunidades em Moçambique</p>
                </div>
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="300">
                    <form action="{{ route('newsletter.subscribe') }}" method="post" class="php-email-form">
                        @csrf
                        <div class="sign-up-form">
                            <input type="email" name="email" placeholder="Exemplo: email@exemplo.com">
                            <input type="submit" value="Inscrever-se">
                        </div>
                        
                    </form>
                    @if(session('success'))
                        <div class="sent-message">{{ session('success') }}</div>
                    @endif
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4">

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

            </div>

        </div>

    </section><!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-xl-center gy-5">

                <div class="col-xl-5 content">
                    <h3>Sobre nós</h3>
                    <h2>Conheça a MALIMU: Consultoria para o Desenvolvimento Social e Empresarial</h2>
                    <p>
                        A MALIMU é uma empresa de consultoria dedicada à comunicação, empreendedorismo social e
                        desenvolvimento comunitário. Com uma abordagem inovadora e focada no cliente,
                        oferecemos soluções personalizadas para apoiar a evolução e o sucesso dos nossos parceiros.

                        Ao longo da nossa jornada, a MALIMU tem contribuído significativamente para o fortalecimento de
                        organizações da sociedade civil e municípios, facilitando o crescimento
                        sustentável e o impacto positivo nas comunidades moçambicanas
                    </p>
                    <a href="#contact" class="read-more"><span>Contacte-nos</span><i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="col-xl-7">
                    <div class="row gy-4 icon-boxes">

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon-box">
                                <i class="bi bi-bullseye"></i>
                                <h3>Nossa Missão</h3>
                                <p>Oferecer serviços de alta qualidade através de estratégias flexíveis, pontuais e
                                    profissionais,
                                    sempre com o foco na satisfação do cliente e no fortalecimento das comunidades
                                    atendidas.</p>
                            </div>
                        </div> <!-- End Icon Box -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box">
                                <i class="bi bi-gem"></i>
                                <h3>Nossos Valores</h3>
                                <p>
                                    Comprometemo-nos com a ética, a transparência e a inovação, buscando constantemente
                                    maneiras de agregar
                                    valor e impactar positivamente a sociedade, enquanto garantimos a excelência em todos os
                                    nossos serviços
                                </p>
                            </div>
                        </div> <!-- End Icon Box -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box">
                                <i class="bi bi-eye"></i>
                                <h3>Nossa Visão</h3>
                                <p>
                                    Aspiramos ser uma instituição de referência no desenvolvimento de serviços de
                                    consultoria, contribuindo
                                    para o bem-estar dos moçambicanos e liderando iniciativas que promovam o progresso
                                    social e empresarial
                                </p>
                            </div>
                        </div> <!-- End Icon Box -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="icon-box">
                                <i class="bi bi-gear"></i>
                                <h3>Nossa Abordagem</h3>
                                <p>A abordagem adotada para nossos projetos é baseada em uma série de princípios, entre eles
                                    o comprometimento
                                    total com a missão. O período de prestação de serviço é visto como um momento de
                                    fidelização do cliente, com
                                    foco no relacionamento de longo prazo.</p>
                            </div>
                        </div> <!-- End Icon Box -->

                    </div>
                </div>

            </div>
        </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section dark-background">

        <img src="assets/img/stats-bg.jpg" alt="" data-aos="fade-in">

        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Clientes</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="151" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Projectos</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Horas de suporte</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Trabalhadores</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Serviços</h2>
            <p>Nossos Serviços de Consultoria Especializada</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-people"></i></div>
                        <div>
                            <h4 class="title"><a class="stretched-link">Consultoria Empresarial</a></h4>
                            <p class="description">Oferecemos consultoria especializada em negócios, projetando soluções
                                personalizadas para maximizar a eficiência e a rentabilidade das empresas em diversos
                                setores</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-graph-up-arrow"></i></div>
                        <div>
                            <h4 class="title"><a class="stretched-link">Análise de Dados</a></h4>
                            <p class="description">Nosso serviço de análise de dados ajuda as empresas a interpretar
                                informações cruciais, garantindo decisões informadas que fomentam crescimento sustentável e
                                inovação</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-sliders"></i></div>
                        <div>
                            <h4 class="title"><a class="stretched-link">Consultoria Six Sigma</a></h4>
                            <p class="description">Utilizamos técnicas Six Sigma para minimizar defeitos e variações,
                                promovendo uma cultura de qualidade e excelência operacional em todos os níveis da
                                organização</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-tree"></i></div>
                        <div>
                            <h4 class="title"><a class="stretched-link">Desenvolvimento Comunitário</a></h4>
                            <p class="description">Apoiamos projetos de desenvolvimento comunitário, promovendo iniciativas
                                que atendem às necessidades e aspirações da população local, focando em sustentabilidade e
                                empoderamento social.</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-rocket-takeoff"></i></div>
                        <div>
                            <h4 class="title"><a class="stretched-link">Desenvolvimento de Negócios</a></h4>
                            <p class="description">Adaptação de estratégias para promover o crescimento dos negócios.</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-megaphone"></i></div>
                        <div>
                            <h4 class="title"><a class="stretched-link">Marketing Social</a></h4>
                            <p class="description">Promoção de causas sociais através de campanhas de marketing
                                direcionadas.</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Item -->

            </div>


        </div>

    </section><!-- /Services Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Pessoal Chave</h2>
            <p>Especialistas dedicados que lideram e impulsionam a visão e crescimento da Malimu.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4 align-items-center features-item">
                <div class="col-lg-6 d-flex align-items-center features-img-bg" data-aos="zoom-out">
                    <img src="assets/img/pedro.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-5 d-flex justify-content-center flex-column" data-aos="fade-up">
                    <h3>Pedro Muiambo</h3>
                    <p>é o líder sénior e principal (proprietário) da MALIMU. Possui pós-graduação em Gestão e Estudos
                        Culturais e bacharelado em Economia.
                        Com mais de vinte anos de experiência
                        profissional em diversas áreas de desenvolvimento, nomeadamente gestão de projetos e negócios,
                        tornou-se uma figura chave nestas áreas.
                    </p>
                    <ul>
                        <li><i class="bi bi-check"></i> <span><b>Como planejador:</b> estratégico, Pedro desenvolve
                                estratégias de negócios abrangentes para atingir m
                                etas de longo prazo. Ele conduz análises SWOT,
                                identifica oportunidades de crescimento e formula planos viáveis ​​para melhorar o
                                desempenho dos negócios</span></li>
                        <li><i class="bi bi-check"></i><span><b>Análise Financeira:</b> Na análise financeira, Pedro avalia
                                dados financeiros para tomar decisões de
                                negócios informadas. Ele cria modelos financeiros, prepara previsões orçamentárias, avalia a
                                saúde financeira e identifica oportunidades
                                de redução de custos.</span></li>
                        <li><i class="bi bi-check"></i> <span><b>Projetos de Desenvolvimento Comunitário:</b> Para o
                                desenvolvimento comunitário, Pedro desenha e implementa
                                projetos que promovam o crescimento social e econômico. Ele colabora com as partes
                                interessadas locais, garante práticas sustentáveis
                                ​​e mede o impacto dos projetos para garantir que atendam às necessidades da
                                comunidade</span>.</li>
                    </ul>
                    <a class="btn btn-get-started align-self-start">Líder sênior e diretor
                    </a>
                </div>
            </div><!-- Features Item -->

            <div class="row gy-4 align-items-stretch justify-content-between features-item ">
                <div class="col-lg-6 d-flex align-items-center features-img-bg" data-aos="zoom-out">
                    <img src="assets/img/rogeiro.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-5 d-flex justify-content-center flex-column" data-aos="fade-up">
                    <h3>Rogério Paulo</h3>
                    <p>é um profissional altamente talentoso, formado em Estatística e mestre em Ciência de Dados e Análise
                        Avançada,
                        com especialização em Business Analytics. Ele também possui certificação Lean & Six Sigma Black
                        Belt.
                        Com mais de nove anos de experiência no mercado nacional e internacional, Rogério demonstrou
                        expertise em diversos domínios.
                    </p>
                    <ul>
                        <li><i class="bi bi-check"></i> <span><b>Consultor:</b> Trabalhou num projeto que envolve a
                                aplicação de modelos de preços hedónicos para estimar rendas efetivas
                                e imputadas de habitação utilizando os dados do censo habitacional de 2021 em Portugal,
                                através do INE Portugal.</span></li>
                        <li><i class="bi bi-check"></i><span><b>Especialista em Business Intelligence:</b> Contribuiu para
                                a BI4ALL Portugal, trazendo soluções inovadoras para melhorar a tomada de decisão baseada em
                                dados.</span></li>
                        <li><i class="bi bi-check"></i> <span><b>Analista de Dados & Negócios e Gestor de Projetos:</b>
                                Focado na melhoria contínua dos processos produtivos na Companhia Industrial da
                                Matola</span>.</li>
                        <li><i class="bi bi-check"></i> <span><b>Especialista em Master Data:</b> Gerenciei projetos de
                                master data na Premier FMCG South Africa</span>.</li>
                        <li><i class="bi bi-check"></i> <span><b>Especialista em Controle de Crédito:</b> Supervisionou as
                                operações de controle de crédito na Oceana Distribution Lda</span>.</li>
                        <li><i class="bi bi-check"></i> <span><b>Gestão de Activos e Passivos:</b> Destaque-se na gestão de
                                activos e passivos no Moza Banco</span>.</li>
                    </ul>
                    <a class="btn btn-get-started align-self-start">Consultor Sênior</a>
                </div>
            </div><!-- Features Item -->

        </div>

    </section><!-- /Features Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Portfólio</h2>
            <p>Empresas parceiras que confiaram na nossa expertise para projetos de sucesso</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
                        <img src="assets/img/portfolio/1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Joint</h4>
                            <a href="assets/img/portfolio/1.jpg" title="Joint" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item ">
                        <img src="assets/img/portfolio/16.png" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Frocom</h4>
                            <a href="assets/img/portfolio/16.png" title="Frocom" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item ">
                        <img src="assets/img/portfolio/14.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>PAANE</h4>
                            <a href="assets/img/portfolio/14.jpg" title="Branding 1" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item ">
                        <img src="assets/img/portfolio/4.png" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>ZWELA</h4>
                            <a href="assets/img/portfolio/4.png" title="ZWELA" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item ">
                        <img src="assets/img/portfolio/22.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>douleurs</h4>
                            <a href="assets/img/portfolio/22.jpg" title="douleurs" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
                        <img src="assets/img/portfolio/6.png" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Uniao europeia</h4>
                            <a href="assets/img/portfolio/6.png" title="Uniao europeia"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
                        <img src="assets/img/portfolio/7.png" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>HOPEM</h4>
                            <a href="assets/img/portfolio/7.png" title="HOPEM" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
                        <img src="assets/img/portfolio/27.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>ISCOS</h4>
                            <a href="assets/img/portfolio/27.jpg" title="ISCOS" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item">
                        <img src="assets/img/portfolio/12.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>nweti</h4>
                            <a href="assets/img/portfolio/12.jpg" title="nweti" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                    </div><!-- End Portfolio Item -->

                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

        <img src="assets/img/hero2.jpg" alt="">

        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Transforme sua Visão em Realidade</h3>
                        <p>Entre em contacto connosco para explorar como podemos ajudá-lo a atingir seus objetivos
                            estratégicos.</p>
                        <a class="cta-btn" href="#contact">Contacte-nos</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Call To Action Section -->


    <!-- Mapa -->
    <section id="team" class="pricing section light-background">

        <!-- Section Title -->
        <div class="container section-titles" data-aos="fade-up">
            <h2>Assistentes de Pesquisa</h2>
            <p>Profissionais dedicados a apoiar e otimizar processos de pesquisa e desenvolvimento.</p>
        </div><!-- End Section Title -->

        <div class="container contact" data-aos="zoom-in" data-aos-delay="100">

            <div class="row g-2 php-email-form">
                <div class="col-lg-12">
                    <div class="row mb-4">
                        <div class="col-6 col-md-6 col-lg-3 mb-3">
                            <select id="provincia-select" class="form-control">
                                <option value="">Pesquisar província</option>
                                <!-- Opções de distritos serão preenchidas dinamicamente -->
                            </select>
                        </div>

                        <div class="col-6 col-md-6 col-lg-3 mb-3">
                            <input type="text" id="search-district" class="form-control"
                                placeholder="Pesquisar distrito..." />
                        </div>

                        <div class="col-6 col-md-6 col-lg-3 mb-3">
                            <select id="gender-select" class="form-control">
                                <option value="">Selecione o gênero</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Feminino</option>
                            </select>
                        </div>

                        <div class="col-6 col-md-6 col-lg-3 mb-3">
                            <select id="age-range" class="form-control">
                                <option value="">faixa etária</option>
                                <option value="18-25">18-25 anos</option>
                                <option value="26-35">26-35 anos</option>
                                <option value="36-45">36-45 anos</option>
                                <option value="46+">46+ anos</option>
                            </select>
                        </div>
                        <div class="col-12 text-center">
                            <button id="search-button" class="btn btn-outline-success btn-sm-square btn-sm"><i class="bi bi-search"></i></button>
                            <button id="reset-filters" class="btn btn-outline-danger btn-sm-square btn-sm"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                      
                        <div class="col-6 col-md-6 col-lg-3">
                            
                        </div>
                    </div>


                </div>
                <div id="map"></div>

            </div>

        </div>

    </section><!-- /Mapa -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Estamos aqui para ajudar</h2>
            <p>Contacte-nos para discutir como podemos apoiar o seu projeto ou negócio.</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="200">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Endereço</h3>
                                <p>Rua Mateus Sansão Muthemba, 568</p>
                                <p>Maputo, Moçambique</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="300">
                                <i class="bi bi-telephone"></i>
                                <h3>Ligue para nós</h3>
                                <p>+258 84 236 3295</p>
                                <p>+258 87 623 6329</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="400">
                                <i class="bi bi-envelope"></i>
                                <h3>Envie-nos um e-mail</h3>
                                <p>malimu.lda@gmail.com</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="500">
                                <i class="bi bi-clock"></i>
                                <h3>Horário de funcionamento</h3>
                                <p>Segunda-feira - Sexta-feira</p>
                                <p>9:00AM - 05:00PM</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Primeiro Nome"
                                    required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    required="">
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" placeholder="Assunto"
                                    required="">
                            </div>

                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Mensagem" required=""></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Enviar mensagem</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection
