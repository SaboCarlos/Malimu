@extends('layouts.admin')
@section('title','Adicionando Assistente')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Adicionando Assistente
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
                    <form action="{{ route('assistants.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="{{ old('full_name') }}" name="full_name" id="floatingNome" placeholder="Nome Completo">
                                    <label for="floatingNome">Nome Completo</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" value="{{ old('age') }}" name="age" id="floatingIdade" placeholder="Idade">
                                    <label for="floatingIdade">Idade</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="gender" id="floatingSexo">
                                        <option selected>Selecione o Sexo</option>
                                        <option value="masculino" {{ old('gender') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="femenino" {{ old('gender') == 'femenino' ? 'selected' : '' }}>Feminino</option>
                                    </select>
                                    <label for="floatingSexo">Sexo</label>
                                </div>
                            </div>                            
                            <div class="col-md-12 col-lg-8 mb-3">
                                <div class="form-floating">
                                    <textarea name="experience_summary" class="form-control" id="floatingCausa" placeholder="Breve Resumo da Experiência" style="height: 150px">{{ old('experience_summary') }}</textarea>
                                    <label for="floatingCausa">Breve Resumo da Experiência</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div id="idiomas-list">
                                    
                                        <div class="col-md-6 col-lg-12 mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="floatingIdiomas" name="idiomas[]"  placeholder="Idiomas">
                                                <label for="floatingIdiomas">idiomas</label>
                                            </div>
                                        </div>
                                    
                                </div>
                                <button type="button" class="btn btn-success btn-sm mb-3" onclick="addIdiomas()">Adicionar idiomas</button>
                            </div>
                            <input type="hidden" name="status" value="aceito">
                            <!-- Lista de Formação Acadêmica e Certificações -->
                            <div class="col-md-6 col-lg-6">
                                <div id="academic-qualifications-list">
                                    <div class="col-md-6 col-lg-12 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="academic_qualifications[]" id="floatingCertificação" placeholder="Certificação">
                                            <label for="floatingCertificação">Formação Acadêmica e Certificações</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 mb-3">
                                    <button type="button" class="btn btn-success btn-sm" onclick="addQualification()">Adicionar Certificação</button>
                                </div>
                            </div>
                             <!-- Lista de Habilidades Específicas -->
                            <div class="col-md-6 col-lg-6">
                                <div id="skills-list">
                                    <div class="col-md-6 col-lg-12 mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="skills[]" id="floatingHabilidade" placeholder="Habilidade">
                                            <label for="floatingHabilidade">Habilidades Específicas</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 mb-3">
                                    <button type="button" class="btn btn-success btn-sm" onclick="addSkill()">Adicionar Habilidade</button>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select"  name="province" id="floatingprovince" onchange="updateDistricts()" required>
                                        <option value="{{ old('province') }}">Selecione a Província</option>
                                        <option value="Cabo Delgado">Cabo Delgado</option>
                                        <option value="Gaza">Gaza</option>
                                        <option value="Inhambane">Inhambane</option>
                                        <option value="Manica">Manica</option>
                                        <option value="Maputo">Maputo</option>
                                        <option value="Maputo City">Maputo City</option>
                                        <option value="Nampula">Nampula</option>
                                        <option value="Niassa">Niassa</option>
                                        <option value="Sofala">Sofala</option>
                                        <option value="Tete">Tete</option>
                                        <option value="Zambézia">Zambézia</option>
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
                                        <option selected>Selecione Área de Experiência</option>
                                        <option value="saúde pública">saúde pública</option>
                                        <option value="educação">educação</option>
                                        <option value="desenvolvimento comunitário">desenvolvimento comunitário</option>
                                       
                                    </select>
                                    <label for="experience">Área de Experiência </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="availability" id="availability">
                                        <option selected>Selecione o disponibilidade</option>
                                        <option value="tempo integral">tempo integral</option>
                                        <option value="parcial">parcial</option>
                                        <option value="disponível para projectos específicos">disponível para projectos específicos</option>
                                       
                                    </select>
                                    <label for="availability">Disponibilidade</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="{{ old('contacts') }}" name="contacts" id="floatingcontacts" placeholder="Contactos">
                                    <label for="floatingcontacts">Contactos</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control {{ $errors->has('profile') ? 'is-invalid' : '' }}" 
                                           value="{{ old('profile') }}" id="floatingprofile" accept="image/*" name="profile" placeholder="Perfil">
                                    <label for="floatingprofile">Perfil</label>
                                    @if ($errors->has('profile'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('profile') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Latitude -->
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <input type="number" name="lat" id="floatingLatitude"  value="{{ old('lat', $assistente->lat ?? '') }}"  step="any" class="form-control" id="latitude" placeholder="Latitude" required>
                                    <label for="floatingLatitude">Latitude</label>
                                </div>
                            </div>
                        
                            <!-- Longitude -->
                            <div class="col-md-6 col-lg-6 mb-3">
                                <div class="form-floating">
                                    <input type="number" name="lng" step="any" id="floatingLongidade" value="{{ old('lng', $assistente->lng ?? '') }}" class="form-control" id="longitude" placeholder="Longitude" required>
                                    <label for="floatingLongidade">Longidade</label>
                                </div>
                            </div>
                            
                            <p><strong>Importante:</strong> O preenchimento das coordenadas de Latitude e Longitude é obrigatório. 
                                Para obter suas coordenadas, abra o Google Maps, clique com o botão direito no local desejado e selecione "O que há aqui?". 
                                As coordenadas aparecerão no final da página. Insira-as nos campos acima.
                            </p>  
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