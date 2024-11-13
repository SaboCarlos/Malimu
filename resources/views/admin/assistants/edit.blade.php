@extends('layouts.admin')
@section('title','Adicionando Assistente')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Editando Assistente
                        <a href="{{ url('admin/assistentes')}}" class="btn btn-outline-danger btn-sm float-end"><i class="fa fa-minus me-2"></i>Voltar</a>
                    </h6>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('assistants.update', $assistant->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="{{ old('full_name', $assistant->full_name) }}" name="full_name" id="floatingNome" placeholder="Nome Completo">
                                    <label for="floatingNome">Nome Completo</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" value="{{ old('age', $assistant->age) }}" name="age" id="floatingIdade" placeholder="Idade">
                                    <label for="floatingIdade">Idade</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" value="{{ old('gender') }}" name="gender" id="floatingSexo">
                                        <option >Selecione o Sexo</option>
                                        <option value="masculino" {{ $assistant->gender == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="feminino" {{ $assistant->gender == 'feminino' ? 'selected' : '' }}>Feminino</option>
                                    </select>
                                    <label for="floatingSexo">Sexo</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-8 mb-3">
                                <div class="form-floating">
                                    <textarea name="experience_summary" class="form-control" id="floatingCausa" placeholder="Breve Resumo da Experiência">{{ old('experience_summary', $assistant->experience_summary) }}</textarea>
                                    <label for="floatingCausa">Breve Resumo da Experiência</label>
                                </div>
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
                            <input type="hidden" name="status" value="aceito">
                            <!-- Lista de Formação Acadêmica e Certificações -->
                            <div class="col-md-6 col-lg-6">
                                <div id="academic-qualifications-list">
                                    @if(!empty($assistant->academic_qualifications))
                                        @php
                                            // Verifica se academic_qualifications é uma string antes de decodificar
                                            $qualifications = is_string($assistant->academic_qualifications) 
                                                                ? json_decode($assistant->academic_qualifications, true) 
                                                                : $assistant->academic_qualifications;
                                        @endphp

                                        @if(is_array($qualifications))
                                            @foreach($qualifications as $qualification)
                                                <!-- Aqui você pode exibir as qualificações -->
                                                <p>{{ $qualification }}</p>
                                            @endforeach
                                        @else
                                            <p>No qualifications found.</p>
                                        @endif
                                    @endif

                                    @foreach(json_decode($assistant->academic_qualifications, true) as $qualification)
                                        <div class="col-md-6 col-lg-12 mb-3">
                                            <div class="form-floating">
                                            
                                                    <input type="text" class="form-control" name="academic_qualifications[]" id="floatingCertificação" value="{{ $qualification }}" placeholder="Certificação">
                                                    <label for="floatingCertificação">Formação Acadêmica e Certificações</label>
                                            
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6 col-lg-12 mb-3">
                                    <button type="button" class="btn btn-success btn-sm" onclick="addQualification()">Adicionar Certificação</button>
                                </div>
                            </div>
                             <!-- Lista de Habilidades Específicas -->
                            <div class="col-md-6 col-lg-6">
                                <div id="skills-list">
                                    @foreach(json_decode($assistant->skills, true) as $skill)
                                        <div class="col-md-6 col-lg-12 mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="skills[]" value="{{ $skill }}" id="floatingHabilidade" placeholder="Habilidade">
                                                <label for="floatingHabilidade">Habilidades Específicas</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6 col-lg-12 mb-3">
                                    <button type="button" class="btn btn-success btn-sm" onclick="addSkill()">Adicionar Habilidade</button>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select"  name="province" id="floatingprovince" onchange="updateDistricts()" required>
                                        <option value=" ">Selecione a Província</option>
                                        <option value="Cabo Delgado" {{ $assistant->province == 'Cabo Delgado' ? 'selected' : '' }}>Cabo Delgado</option>
                                        <option value="Gaza" {{ $assistant->province == 'Gaza' ? 'selected' : '' }}>Gaza</option>
                                        <option value="Inhambane" {{ $assistant->province == 'Inhambane' ? 'selected' : '' }}>Inhambane</option>
                                        <option value="Manica" {{ $assistant->province == 'Manica' ? 'selected' : '' }}>Manica</option>
                                        <option value="Maputo" {{ $assistant->province == 'Maputo' ? 'selected' : '' }}>Maputo</option>
                                        <option value="Maputo City" {{ $assistant->province == 'Maputo City' ? 'selected' : '' }}>Maputo City</option>
                                        <option value="Nampula" {{ $assistant->province == 'Nampula' ? 'selected' : '' }}>Nampula</option>
                                        <option value="Niassa" {{ $assistant->province == 'Niassa' ? 'selected' : '' }}>Niassa</option>
                                        <option value="Sofala" {{ $assistant->province == 'Sofala' ? 'selected' : '' }}>Sofala</option>
                                        <option value="Tete" {{ $assistant->province == 'Tete' ? 'selected' : '' }}>Tete</option>
                                        <option value="Zambézia" {{ $assistant->province == 'Zambézia' ? 'selected' : '' }}>Zambézia</option>
                                    </select>
                                    <label for="floatingprovince">Província</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="district" id="district">
                                        <option selected>Selecione o Distrito</option>
                                       
                                    </select>
                                    <label for="district">Distrito</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="area_of_experience" id="experience">
                                        
                                        <option value="saúde pública" {{ $assistant->area_of_experience == 'saúde pública' ? 'selected' : '' }}>saúde pública</option>
                                        <option value="educação" {{ $assistant->area_of_experience == 'educação' ? 'selected' : '' }}>educação</option>
                                        <option value="desenvolvimento comunitário" {{ $assistant->area_of_experience == 'desenvolvimento comunitário' ? 'selected' : '' }}>desenvolvimento comunitário</option>
                                       
                                    </select>
                                    <label for="experience">Área de Experiência </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="availability" id="availability">
                                        <option value="tempo integral" {{ $assistant->availability == 'tempo integral' ? 'selected' : '' }}>tempo integral</option>
                                        <option value="parcial" {{ $assistant->availability == 'parcial' ? 'selected' : '' }}>parcial</option>
                                        <option value="disponível para projectos específicos" {{ $assistant->availability == 'disponível para projectos específicos' ? 'selected' : '' }}>disponível para projectos específicos</option>
                                       
                                    </select>
                                    <label for="availability">Disponibilidade</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="{{ old('contacts', $assistant->contacts) }}" name="contacts" id="floatingcontacts" placeholder="Contactos">
                                    <label for="floatingcontacts">Contactos</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control {{ $errors->has('profile') ? 'is-invalid' : '' }}" 
                                           value="{{ old('profile', $assistant->profile) }}" id="floatingprofile" accept="image/*" name="profile" placeholder="Perfil">
                                    <label for="floatingprofile">Perfil</label>
                                    <small> Se nao quiser actualizar imagem,nao mexe aqui</small>
                                    @if ($errors->has('profile'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('profile') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Latitude -->
                        <div class="col-md-6 col-lg-6 mb-3">
                           
                            <input type="number" name="lat"  value="{{ old('lat', $assistente->lat ?? '') }}"  step="any" class="form-control" id="latitude" placeholder="Latitude" required>
                               
                        </div>
                    
                        <!-- Longitude -->
                        <div class="col-md-6 col-lg-6 mb-3">
                            <input type="number" name="lng" step="any" value="{{ old('lng', $assistente->lng ?? '') }}" class="form-control" id="longitude" placeholder="Longitude" required>
                        </div>
                           
                            
                        </div>
                        <div class="col-12 text-center mt-4">
                            <div>
                                <button type="submit" class="btn btn-success m-2">
                                    <i class="fa fa-save me-2"></i>Salvar Assistente
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
            const floatingDiv = document.createElement('div');
            floatingDiv.className = 'form-floating';
            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            input.name = 'academic_qualifications[]';
            input.placeholder = 'Certificação';
            const label = document.createElement('label');
            label.textContent = 'Formação Acadêmica e Certificações';
            floatingDiv.appendChild(input);
            floatingDiv.appendChild(label);
            colDiv.appendChild(floatingDiv);
            list.appendChild(colDiv);
        }
    
        function addSkill() {
            const list = document.getElementById('skills-list');
            const colDiv = document.createElement('div');
            colDiv.className = 'col-md-6 col-lg-12 mb-3';
            const floatingDiv = document.createElement('div');
            floatingDiv.className = 'form-floating';
            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            input.name = 'skills[]';
            input.placeholder = 'Habilidade';
            const label = document.createElement('label');
            label.textContent = 'Habilidades Específicas';
            floatingDiv.appendChild(input);
            floatingDiv.appendChild(label);
            colDiv.appendChild(floatingDiv);
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
                'Maputo':['Boane','Magude','Manhiça','Marracuene','Matutuíne','Moamba','Namaacha'],
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