<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <title>GEOLINK CONSULTA</title>
</head>
<body class="bod1">
    
    <input type="hidden" name="usuarioactual" id="usuarioactual">
    <div class='cuadrogeneral'>
        <div id="enejecucion" class="cuadrocargapuntocaliente">
            <div class="spinner-grow" role="status" style="width: 150px; height: 150px;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p style="font-weight: 700; font-size: 25px;">Cargando Disponibilidad CTO ...</p>
        </div>
        <div id="cuadropincipal2" class="transicion bienvenida">

            <div class="transicion" id="cuadrobienvenida" style="align-content: center; margin-left: 20px;">
                <div class="ordenlogo">
                    <div style="align-content: center;">
                        <img class="transicion" id="geolinkimg" src="{{ asset('img/icono_geolink.png')}}" alt="geolinkimg" style="width: 90px;">
                    </div>
                    <div style="align-content: center;">
                        <h2 style="color: white; font-weight: 600;">GEOLINK</h2>
                    </div>
                </div>
                <div style="   text-align-last: start;">
                    <p id="letbienvenida2" class= "transicion textobienvenida">MAPA CALOR</p>
                </div>
                <div id="letbienvenida1" style="text-align: center; margin-top: 35px;">
                    <div class="spinner-border spiner" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div id="letbienvenida" style="text-align: center; margin-top: 15px; font-size: 20px; color: white; font-weight: 600;">
                    <p>Bienvenido</p>
                </div>
                
            </div>
            <div  id="menuprincipal" class="transicion" style="display: flex; gap: 35px; opacity: 0%; ">
                
                <div style="align-content: center; margin-right: 15px;">
                    <p id="Menu" class="titulos_menu">Menu</p>
                </div>
                <div style="align-content: center; margin-right: 15px;">
                    <p id="salir" class="titulos_menu">Salir</p>
                </div>
               <!-- <div style="align-content: center;">
                    <a href="https://cdstorage.co/"><img class="transicion" style="width: 0px;" id="CDS" src="{{ asset('img/CDS_GEOLINK.png')}}" alt="geolinkimg" style="width: 90px;"></a>
                </div> -->
                
            </div>
            
        </div>
       

        <div id="cuadropincipalinfo" class="transicion cuadroprincipal">
            <div style="width:100%; margin-left: 35px; display:flex;">
               
                <div style="width:100%; "><!--cuadro mapa-->
                    
                    <div class="cuadro_mapas" id="map" style="height: 600px !important;">
                    </div>
                    
                    
                </div>
            </div>
            <div id="cuadroaviso" class="cuadroaviso">
                
            </div>
            
            <br>
            <hr class="linea">
            
            
        </div>
    

    </div>

    
</body>
</html>



<script>
    // llamado de usuario conectado
    let usuario = "{{ session('usuario') }}";

    $('#usuarioactual').val(usuario);

    if($('#usuarioactual').val() === ''){
        
        alert('Ingrese usuario Y contraseña para acceder a GEOLIK')
        window.location.href = '/';
    }

// reinicio pagina por desconexion
    let timeout;

    function resetTimer() {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            $('#usuarioactual').val('');
            alert('Su sesión ha expirado por inactividad');
            window.location.href = '/';
        }, 15 * 60 * 1000); // 15 minutos
    }

    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('keypress', resetTimer);
    document.addEventListener('click', resetTimer);

    resetTimer();



    $('#salir').click(function(){

        $.ajax({
            url:'/logout',
            method:'POST',
            data:{
                _token:$('meta[name="csrf-token"]').attr('content')
            },
            success:function(){

                window.location.href = '/';

            }
        });

    });

    $('#Menu').click(function () {
   
        window.location.href = '/menu';
        
    });





var map = L.map('map').setView([4.696611, -74.070353], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'OpenStreetMap'
}).addTo(map);

// Cargar el contorno de Colombia
fetch('colombia.geojson')
    .then(response => response.json())
    .then(data => {
        var colombia = L.geoJSON(data, {
            style: {
                color: '#000000',
                weight: 3,
                fill: false
            }
        }).addTo(map);

        // Ajustar el mapa al contorno de Colombia
        map.fitBounds(colombia.getBounds());
    });


$(window).scrollTop(0);
$('html, body').scrollTop(0);

$('#registro').click(function(){

    $('#cuadrooculta').addClass('cuadro50porcen_izq');
    $('#cuadrooculta').removeClass('cuadro50porcen_dre');

    
});
$('#yatengousuario').click(function(){

    $('#cuadrooculta').addClass('cuadro50porcen_dre');
    $('#cuadrooculta').removeClass('cuadro50porcen_izq');
    
});



function coordenadas() {

    setTimeout(() => {
        $('#enejecucion').css('display','block');
    }, 3005);

    

    const renderer = L.canvas({
        padding: 0.5
    });

    let pagina = 1;
    let totalPuntos = 0;

    function cargarPagina() {

        console.log('Solicitando página:', pagina);
        


        $.ajax({
            url: '/carga_coordenadas',
            type: 'POST',
            dataType: 'json',

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                pagina: pagina
            },

            success: function(response) {

                console.log(
                    'Página:',
                    response.pagina,
                    'Puntos:',
                    response.cantidad
                );

                totalPuntos += response.cantidad;

                response.data.forEach(function(item) {

                    const lat = parseFloat(item.lat_equipo);
                    const lng = parseFloat(item.long_equipo);

                    if (isNaN(lat) || isNaN(lng)) {
                        return;
                    }

                    L.circleMarker([lat, lng], {

                        renderer: renderer,

                        radius: 5,

                        color: item.color,

                        fillColor: item.color,

                        fillOpacity: 0.8,

                        weight: 1

                    }).bindTooltip(
                    'Puertos libres: ' + item.puertos_libres_cto,
                    {
                        permanent: false,
                        direction: 'top',
                        sticky: true
                    }
                ).addTo(map);


                    // L.circleMarker([lat, lng], {
                    //     renderer: renderer,
                    //     radius: 8,
                    //     color: item.color,
                    //     fillColor: item.color,
                    //     fillOpacity: 0.20,
                    //     weight: 0
                    // }).addTo(map);

                });

                console.log(
                    'Total de puntos graficados:',
                    totalPuntos
                );

                // ¿Hay más puntos?
                if (response.hay_mas) {

                    pagina++;

                    // Esperamos un poco y cargamos la siguiente página
                    setTimeout(function() {
                        cargarPagina();
                    }, 100);

                } else {

                    console.log(
                        'FINALIZADO. Total:',
                        totalPuntos
                    );
                    $('#enejecucion').css('display','none');    
                    alert(
                        'Carga finalizada. Total de puntos: ' +
                        totalPuntos
                    );
                }
            },

            error: function(xhr) {

                console.error(
                    'Error cargando página ' + pagina,
                    xhr.status
                );

                console.error(xhr.responseText);

            }
        });
    }

    // Iniciar carga
    cargarPagina();
}

coordenadas();

setTimeout(() => {
   
    $('#cuadropincipal2')
    .removeClass('bienvenida')
    .addClass('conversioncuadro_cuadrobienvenida');
    $('#cuadropincipal2').addClass('conversioncuadro_cuadrobienvenida_icono');
    $('#letbienvenida').css('display','none')
    $('#letbienvenida1').css('display','none')
    $('#geolinkimg').css('width','4dvh')
    $('.textobienvenida').css('margin-top','0px')
    $('#letbienvenida2').css('font-size','1dvh')
    $('#CDS').css('width','170px');
    $('#cuadrobienvenida').css('width','85%');
    $('#menuprincipal').css('opacity','100%')
  
   
    
   
}, 2000);

setTimeout(() => {
    $('#cuadropincipalinfo').css('opacity','100%')
}, 3000);






</script>