<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/favicon.png')}}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css" rel="stylesheet')}}">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Main CSS File -->
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">

</head>
<body class="index-page">
    @include('layouts.inc.frontend.navbar')
        <main class="main">
            @yield('content')
        </main>
    @include('layouts.inc.frontend.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <!-- Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var map = L.map('map').setView([-18.665695, 35.529562], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Carregar dados GeoJSON de distritos de Moçambique
        axios.get('{{ asset('assets/js/mz.json') }}').then(response => {
            var provinces = response.data;

            L.geoJSON(provinces, {
                style: { color: "#3388ff", weight: 2 },
                onEachFeature: function(feature, layer) {
                    layer.on('click', function() {
                        selectDistrict(feature.properties.name);
                    });
                }
            }).addTo(map);

            var select = document.getElementById('provincia-select');
            provinces.features.forEach(district => {
                var option = document.createElement('option');
                option.value = district.properties.name;
                option.textContent = district.properties.name;
                select.appendChild(option);
            });

            addAssistantsMarkers();
        });

        function addAssistantsMarkers(province = '', district = '', gender = '', ageRange = '') {
            var params = {};
            
            if (province) params.province = province;  // Pode ser opcional, mas deve ser consistente
            if (district) params.district = district;  // Aqui estamos enviando o parâmetro 'district'
            if (gender) params.gender = gender;
            if (ageRange) params.age_range = ageRange;

            axios.get('/assistentes', { params: params }).then(response => {
                var assistants = response.data;

                map.eachLayer(layer => {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });

                assistants.forEach(assistant => {
                    var profileImageUrl = "{{ asset('storage') }}/" + assistant.profile;
                    var profileLink = "/assistente/" + assistant.id;

                    var marker = L.marker([assistant.lat, assistant.lng]).addTo(map)
                        .bindPopup(`
                            <b>${assistant.full_name}</b><br />
                            <img src="${profileImageUrl}" alt="${assistant.full_name}" style="width:100px; height:100px; border-radius: 50%;"><br />
                            ${assistant.age} anos - ${assistant.area_of_experience}<br>
                            <a href="${profileLink}">Ver Perfil</a>
                        `);
                });

          

                
            }).catch(error => console.error('Erro ao carregar assistentes:', error));
        }

        function selectDistrict(province) {
            var gender = document.getElementById('gender-select').value;
            var district = document.getElementById('search-district').value;
            var ageRange = document.getElementById('age-range').value;
            addAssistantsMarkers(province, district, gender, ageRange);
        }

        document.getElementById('provincia-select').addEventListener('change', function() {
            selectDistrict(this.value);
        });
        document.getElementById('search-button').addEventListener('click', function() {
            var district = document.getElementById('search-district').value.trim().toLowerCase();
            var gender = document.getElementById('gender-select').value;
            var ageRange = document.getElementById('age-range').value;

            addAssistantsMarkers('', district, gender, ageRange);
        });
        document.getElementById('reset-filters').addEventListener('click', function() {
            document.getElementById('provincia-select').value = '';
            document.getElementById('search-district').value = '';
            document.getElementById('gender-select').value = '';
            document.getElementById('age-range').value = '';
            addAssistantsMarkers('','', '', ''); // Limpa os assistentes
        });


    });

  </script>
    
</body>
</html>
