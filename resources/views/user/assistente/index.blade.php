@extends('layouts.util')
@section('title', ('Assistentes'))
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded contact h-100 p-4">
                <h3 class="mb-4"><strong>Dados Pessoais</strong></h3>
                @if (isset($assistente) && !empty($assistente->status))
                    @if ($assistente->status == 'pendente')
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i> Teu Cadastro está pendente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif ($assistente->status == 'aceito')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i> Teu Cadastro está aceito
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @else
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i> Teu Cadastro está recusado
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('informação.store') }}" method="POST" enctype="multipart/form-data" class="php-email-form">
                    @csrf
                    <div class="row">
                     
                        <!-- Nome Completo -->
                        <div class="col-md-6 col-lg-6 mb-3">
                            
                            <input type="text" class="form-control" value="{{ old('full_name', $assistente->full_name ?? '') }}" name="full_name" id="floatingNome" placeholder="Nome Completo">
                            
                        </div>

                        <!-- Idade -->
                        <div class="col-md-6 col-lg-3 mb-3">
                            
                            <input type="number" class="form-control" name="age" id="floatingIdade" placeholder="Idade" value="{{ old('age', $assistente->age ?? '') }}">
                                
                        </div>

                        <!-- Sexo -->
                        <div class="col-md-6 col-lg-3 mb-3">
                                <select class="form-select" name="gender" id="floatingSexo">
                                    <option value="">Selecione o Sexo</option>
                                    <option value="masculino" {{ old('gender', $assistente->gender ?? '') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="feminino" {{ old('gender', $assistente->gender ?? '') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                                </select> 
                        </div>

                        <!-- Breve Resumo da Experiência -->
                        <div class="col-md-12 col-lg-8 mb-3">
                          
                            <textarea name="experience_summary" class="form-control" id="floatingCausa" placeholder="Breve Resumo da Experiência" style="height: 150px;">{{ old('experience_summary', $assistente->experience_summary ?? '') }}</textarea>
                                
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div id="idiomas-list">
                                @foreach(json_decode($assistente->idiomas ?? '[]') as $liguagens)
                                    <div class="col-md-6 col-lg-12 mb-3">
                                        <input type="text" class="form-control" name="idiomas[]" value="{{ $liguagens ?? '' }}" placeholder="Idiomas">
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success btn-sm mb-3" onclick="addIdiomas()">Adicionar idiomas</button>
                        </div>

                        <!-- Campo oculto de status -->
                        <input type="hidden" name="status" value="pendente">

                        <!-- Lista de Formação Acadêmica e Certificações -->
                        <div class="col-md-6 col-lg-6">
                            <div id="academic-qualifications-list">
                                @foreach(json_decode($assistente->academic_qualifications ?? '[]') as $qualification)
                                    <div class="col-md-6 col-lg-12 mb-3">
                                       
                                        <input type="text" class="form-control" name="academic_qualifications[]" value="{{ $qualification }}" placeholder="Certificação">
                                            
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success btn-sm mb-3" onclick="addQualification()">Adicionar Certificação</button>
                        </div>

                        <!-- Lista de Habilidades Específicas -->
                        <div class="col-md-6 col-lg-6">
                            <div id="skills-list">
                                @foreach(json_decode($assistente->skills ?? '[]') as $habilidades)
                                    <div class="col-md-6 col-lg-12 mb-3">
                                     
                                        <input type="text" class="form-control" name="skills[]" value="{{ $habilidades }}" placeholder="Habilidade">
                                            
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success btn-sm mb-3" onclick="addSkill()">Adicionar Habilidade</button>
                        </div>

                        <div class="col-md-6 col-lg-6 mb-3">
                            
                                <select class="form-select"  name="province" id="floatingprovince" onchange="updateDistricts()" required>
                                    <option value="">Selecione a Província</option>
                                    <option value="Cabo Delgado" {{ old('province', $assistente->province ?? '') == 'Cabo Delgado' ? 'selected' : '' }}>Cabo Delgado</option>
                                    <option value="Gaza" {{ old('province', $assistente->province ?? '') == 'Gaza' ? 'selected' : '' }}>Gaza</option>
                                    <option value="Inhambane" {{ old('province', $assistente->province ?? '') == 'Inhambane' ? 'selected' : '' }}>Inhambane</option>
                                    <option value="Manica" {{ old('province', $assistente->province ?? '') == 'Manica' ? 'selected' : '' }}>Manica</option>
                                    <option value="Maputo" {{ old('province', $assistente->province ?? '') == 'Maputo' ? 'selected' : '' }}>Maputo</option>
                                    <option value="Maputo City" {{ old('province', $assistente->province ?? '') == 'Maputo City' ? 'selected' : '' }}>Maputo City</option>
                                    <option value="Nampula" {{ old('province', $assistente->province ?? '') == 'Nampula' ? 'selected' : '' }}>Nampula</option>
                                    <option value="Niassa" {{ old('province', $assistente->province ?? '') == 'Niassa' ? 'selected' : '' }}>Niassa</option>
                                    <option value="Sofala" {{ old('province', $assistente->province ?? '') == 'Sofala' ? 'selected' : '' }}>Sofala</option>
                                    <option value="Tete" {{ old('province', $assistente->province ?? '') == 'Tete' ? 'selected' : '' }}>Tete</option>
                                    <option value="Zambézia" {{ old('province', $assistente->province ?? '') == 'Zambézia' ? 'selected' : '' }}>Zambézia</option>
                                </select>
                               
                        </div>

                        <div class="col-md-6 col-lg-6 mb-3">
                          
                                <select class="form-select" name="district" id="district">
                                    <option value="{{ old('district', $assistente->district ?? '') }}">
                                        {{ $assistente->district ?? 'Selecione o Distrito' }}
                                    </option>
                                </select>
                                
                            
                        </div>

                        <!-- Área de Experiência -->
                        <div class="col-md-6 col-lg-6 mb-3">
                            
                                <select class="form-select" name="area_of_experience" id="experience">
                                    <option value="saúde pública" {{ ($assistente->area_of_experience ?? '') == 'saúde pública' ? 'selected' : '' }}>saúde pública</option>
                                    <option value="educação" {{ ($assistente->area_of_experience ?? '') == 'educação' ? 'selected' : '' }}>educação</option>
                                    <option value="desenvolvimento comunitário" {{ ($assistente->area_of_experience ?? '') == 'desenvolvimento comunitário' ? 'selected' : '' }}>desenvolvimento comunitário</option>
                                </select>
                               
                        </div>

                        <!-- Disponibilidade -->
                        <div class="col-md-6 col-lg-6 mb-3">
                           
                                <select class="form-select" name="availability" id="availability">
                                    <option value="tempo integral" {{ ($assistente->availability ?? '')== 'tempo integral' ? 'selected' : '' }}>tempo integral</option>
                                    <option value="parcial" {{ ($assistente->availability ?? '') == 'parcial' ? 'selected' : '' }}>parcial</option>
                                    <option value="disponível para projectos específicos" {{ ($assistente->availability ?? '') == 'disponível para projectos específicos' ? 'selected' : '' }}>disponível para projectos específicos</option>
                                </select>
                               
                        </div>

                        <!-- Contactos -->
                        <div class="col-md-6 col-lg-6 mb-3">
                            
                            <input type="text" class="form-control" value="{{ old('contacts', $assistente->contacts ?? '') }}" name="contacts" placeholder="Contactos">
                              
                        </div>

                        <!-- Perfil (Imagem) -->
                        <div class="col-md-6 col-lg-6 mb-3">
                            
                                <input type="file" class="form-control {{ $errors->has('profile') ? 'is-invalid' : '' }}" id="floatingProfile" accept="image/*" name="profile" placeholder="Perfil">
                                
                        
                                {{-- Verificar se o assistente tem uma imagem de perfil --}}
                                @if ($assistente && $assistente->profile)
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $assistente->profile)) }}" width="70px" alt="Imagem do perfil" class="d-block mt-2">
                                @endif
                        
                                @if ($errors->has('profile'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('profile') }}
                                    </div>
                                @endif
                           
                        </div>
                        <!-- Latitude -->
                        <div class="col-md-6 col-lg-6 mb-3">
                           
                            <input type="number" name="lat"  value="{{ old('lat', $assistente->lat ?? '') }}"  step="any" class="form-control" id="latitude" placeholder="Latitude" required>
                               
                        </div>
                    
                        <!-- Longitude -->
                        <div class="col-md-6 col-lg-6 mb-3">
                            <input type="number" name="lng" step="any" value="{{ old('lng', $assistente->lng ?? '') }}" class="form-control" id="longitude" placeholder="Longitude" required>
                        </div>
                        
                        <p><strong>Importante:</strong> O preenchimento das coordenadas de Latitude e Longitude é obrigatório. 
                            Para obter suas coordenadas, abra o Google Maps, clique com o botão direito no local desejado e selecione "O que há aqui?". 
                            As coordenadas aparecerão no final da página. Insira-as nos campos acima.
                        </p>
                        <!-- Botão de Submissão -->
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="m-2">
                                <i class="bi bi-save me-2"></i>Submeter
                            </button>
                        </div>

                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script>
    function addQualification() {
        const list = document.getElementById('academic-qualifications-list');
        const colDiv = document.createElement('div');
        colDiv.className = 'col-md-6 col-lg-12 mb-3';
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.name = 'academic_qualifications[]';
        input.placeholder = 'Certificação';
        colDiv.appendChild(input);
        list.appendChild(colDiv);
    }

    function addSkill() {
        const list = document.getElementById('skills-list');
        const colDiv = document.createElement('div');
        colDiv.className = 'col-md-6 col-lg-12 mb-3';
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.name = 'skills[]';
        input.placeholder = 'Habilidade';
        colDiv.appendChild(input);
        list.appendChild(colDiv);
    }

    function addIdiomas() {
        const list = document.getElementById('idiomas-list');
        const colDiv = document.createElement('div');
        colDiv.className = 'col-md-6 col-lg-12 mb-3';
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.name = 'idiomas[]';
        input.placeholder = 'Idiomas';
        colDiv.appendChild(input);
        list.appendChild(colDiv);
    }

    function updateDistricts() {
        const province = document.getElementById('floatingprovince').value;
        const districtSelect = document.getElementById('district');
        districtSelect.innerHTML = '';

        const districts = {
            'Cabo Delgado': ['Ancuabe', 'Balama', 'Chiúre', 'Ibo', 'Macomia', 'Mecúfi', 'Meluco', 'Mocímboa da Praia', 'Montepuez', 'Mueda', 'Muidumbe', 'Namuno', 'Nangade', 'Palma', 'Pemba', 'Quissanga'],
            'Gaza': ['Bilene', 'Chibuto', 'Chicualacuala', 'Chigubo', 'Chókwè', 'Guijá', 'Limpopo', 'Mabalane', 'Mandlakazi', 'Massangena', 'Massingir', 'Xai-Xai'],
            'Inhambane':['Funhalouro','Govuro','Homoíne','Inharrime','Inhassoro','Jangamo','Mabote','Massinga','Morrumbene','Panda','Vilankulo','Zavala'],
            'Manica':['Barué','Gondola','Guro','Macate','Machaze','Macossa','Manica','Mossurize','Sussundenga','Tambara','Chimoio'],
            'Maputo':['Boane','Matola','Magude','Manhiça','Marracuene','Matutuíne','Moamba','Namaacha'],
            'Maputo City':['Distrito Municipal de KaMavota','Distrito Municipal de KaMaxakeni','Distrito Municipal de KaMubukwana','Distrito Municipal de KaTembe','Distrito Municipal de KaNyaka'],
            'Nampula':['Angoche','Eráti','Ilha de Moçambique','Lalaua','Malema','Meconta','Mecubúri','Memba','Mogincual','Mogovolas','Moma','Monapo','Mossuril','Muecate','Murrupula','Nacala-a-Velha','Nacala Porto','Rapale','Ribáuè'],
            'Niassa':['Cuamba','Lago','Lichinga','Majune','Mandimba','Marrupa','Maúa','Mavago','Mecanhelas','Mecula','Metarica','Muembe','Ngauma','Sanga'],
            'Sofala':['Búzi','Caia','Chemba','Cheringoma','Chibabava','Dondo','Gorongosa','Machanga','Marínguè','Marromeu','Muanza','Beira'],
            'Tete':['Angónia','Cahora-Bassa','Changara','Chifunde','Chiuta','Macanga','Magoé','Marávia','Moatize','Mutarara','Tsangano','Zumbo'],
            'Zambézia':['Alto Molócuè','Chinde','Derre','Gilé','Gurué','Ile','Inhassunge','Lugela','Maganja da Costa','Milange','Mocuba','Mopeia','Morrumbala','Namacurra','Namarroi','Nicoadala','Pebane','Quelimane'],
        };

        if (districts[province]) {
            districts[province].forEach(district => {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    }
</script>
@endsection
