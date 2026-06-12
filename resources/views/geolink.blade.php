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
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <title>GEOLIK CONSULTA</title>
</head>
<body class="bod1">
    <input type="hidden" name="usuarioactual" id="usuarioactual">
    <div class='cuadrogeneral'>
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
                    <p id="letbienvenida2" class= "transicion textobienvenida">Network Path Discovery</p>
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
                    <p id="salir" class="titulos_menu">Salir</p>
                </div>
               <!-- <div style="align-content: center;">
                    <a href="https://cdstorage.co/"><img class="transicion" style="width: 0px;" id="CDS" src="{{ asset('img/CDS_GEOLINK.png')}}" alt="geolinkimg" style="width: 90px;"></a>
                </div> -->
                
            </div>
            
        </div>
        <div id="cuadrotabladirecciones" class="cuadro_direcciones">
            <br>
            <div style="text-align: end; padding-right: 31px;">
                <button id="cierre" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            
            <div>
                <h2 style="margin-top: 25px; color: white;">DIRECCIONES ASOCIADAS A CTO</h2>
            </div>
            <div style="height: 50%;">
                <div class="miDiv">
                    <table id="datospordireccion" style="margin-top: 15px;">
                        <thead>
                            <tr>
                                <th>CTO</th>
                                <th>LOCALIDAD</th>
                                <th>DIRECCION CLI</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div id="cuadropincipalinfo" class="transicion cuadroprincipal">
            <div style="width:100%; margin-left: 35px; display:flex;">
                <div style="width:25%;"><!--cuadro consultas-->
                    <div class="cuadro_consultas">
                        <div style="display: none; gap: 10px;">
                            <div class="cuadroseleccion">
                                <input type="checkbox" name="linkt1t2" id="linkt1t2" style="width: 18px;">
                                <p style="color: white; margin-top: 10px; font-size:12px;">Link T1/T2</p>
                            </div>
                            <div class="cuadroseleccion">
                                <input type="checkbox" name="linkt3" id="linkt3" style="width: 18px;">
                                <p style="color: white; margin-top: 10px; font-size:12px;">Link T3</p>
                            </div>
                            <div class="cuadroseleccion">
                                <input type="checkbox" name="linkt4" id="linkt4" style="width: 18px;">
                                <p style="color: white; margin-top: 10px; font-size:12px;">Link T4 - FTTH</p>
                            </div>
                            
                        </div>
                        <hr>
                        <div style="display: flex; gap: 10px;">
                            <div id="btnbusquedaddireccion" class="botonconsultadireccioncoordenada"><!--direccion-->
                                <p style="color: white;">Direccion</p>
                            </div>
                            <div id="btnbusquedadcoordenada" class="botonconsultadireccioncoordenada"><!--coordenada-->
                                <p style="color: white;">Coordenada</p>
                            </div>
                        </div>
                        <hr style="color: white; margin-top: -1px; border: solid 2px; border-radius: 8px;">
                        <div id="busquedadireccion" style="display: none;" class="recuadros">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="direccion" placeholder="Direccion">
                                <label for="direccion">Direccion</label>
                            </div>
                            <br>
                            <select class="form-select form-select-lg mb-3" aria-label="Large select example" style="height: 59px;" id='localidad'>
                                <option selected>Localidad</option>
                                @foreach($localidades as $localidad)
                                <option value="{{$localidad -> localidad}}">{{$localidad -> localidad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="busquedacoordenada" style="display: block;" class="recuadros">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="latitud" placeholder="Latitud">
                                <label for="latitud">Latitud</label>
                            </div>
                            <br>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="longitud" placeholder="Longitud">
                                <label for="longitud">Longitud</label>
                            </div>
                        </div>
                        <br>
                        <div style="width: 100%; text-align: center;">
                            <input class="btn_ingreso" type="button" id="consultacoordenadas" value="CONSULTAR">
                        </div>
                        
                    </div>
                    <div><!--Consulta Cordenedas-->
                        <div><!--QUE ESTA CONSULTANDO-->
                            <div id="panel" style="display: flex; gap: 5px; color: white;"></div>  
                        </div>
                    </div>
                </div>
                <div style="width:75%; "><!--cuadro mapa-->
                    
                    <div class="cuadro_mapas" id="map">
                    </div>
                    
                    
                </div>
            </div>
            
            <br>
            <hr class="linea">
            <div style=" width: 100%; justify-items: center;"> <!--Tabla De Respuestas-->
                <div class="cuadro2" id="cuadrocolumnas"><!--seleccion de columnass-->
                    <div class="cuadro_selec">
                        <div style="display: flex; gap: 10px;">
                            <div>
                               <input type="checkbox" value="2" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">RED</p>
                            </div>
                        </div>
                         <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="3" class="chkColumna" >     
                            </div>
                            <div>
                                <p style="color: white;">COORDENADAS</p>
                            </div>
                        </div>
                         <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="4" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">ID_CTO</p>
                            </div>
                        </div>
                         <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="5" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">DESTINO</p>
                            </div>
                        </div>
                         <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="6" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">DIRECCION ASOCIADA</p>
                            </div>
                        </div>
                         <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="7" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">DIST</p>
                            </div>
                        </div>
                         <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="8" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">COINVERSOR</p>
                            </div>
                        </div>
                         <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="9" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">PD</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="10" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">OLT</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: -20px;">
                            <div>
                               <input type="checkbox" value="11" class="chkColumna" checked>     
                            </div>
                            <div>
                                <p style="color: white;">CONSULTA</p>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="solapa">
                        <p class="vertical">COLUMNAS</p>
                    </div>
                </div>
                <div>
                    <table id="tbrespuesta" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>VER</th>
                                <th>RED</th>
                                <th>COORDENADAS</th>
                                <th>ID_CTO</th>
                                <th>DESTINO</th>
                                <th>DIRECCION ASOCIADA</th>
                                <th>DIST</th>
                                <th>COINVERSOR</th>
                                <th title="PUERTOS DISPONIBLES">PD</th>
                                <th>OLT</th>
                                <th>CONSULTA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--<tr>
                                <td> <input type="checkbox" id="" value=""> </td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                            </tr>-->
                        </tbody>
                        
                    </table>
                </div>
            </div>
            
        </div>
    

    </div>

    <!--<a href="{{route('welcome')}}">link</a> forma de llamar a un hipervinculo dentro de laravel -->
</body>
</html>

<script>


function aplicarColumnas() {

    $('.chkColumna').each(function () {

        const numcol = parseInt($(this).val()) - 1;

        if ($(this).is(':checked')) {
            
            mostrar(numcol);
        } else {
            oculta(numcol);
        }

    });

}

aplicarColumnas();

$('.solapa').on('click', function(){
    $('#cuadrocolumnas').toggleClass('cuadro2vista');
});


$('.chkColumna').on('change', function() {

    const numcol = parseInt($(this).val()) - 1;

    if ($(this).is(':checked')) {
       mostrar(numcol);
    } else {
        oculta(numcol);
    }

});

function oculta(indice) {

    let filas = document.querySelectorAll('#tbrespuesta tr');

    filas.forEach(fila => {
        if (fila.cells[indice]) {
            fila.cells[indice].style.display = 'none';
        }
    });

}

function mostrar(indice) {

    let filas = document.querySelectorAll('#tbrespuesta tr');

    filas.forEach(fila => {
        if (fila.cells[indice]) {
            fila.cells[indice].style.display = '';
            // o 'table-cell'
        }
    });

}


function limpiarRutas() {

    Object.keys(rutas).forEach(id => {

        if (rutas[id].routeLayer) {
            map.removeLayer(rutas[id].routeLayer);
        }

        if (rutas[id].markerOrigen) {
            map.removeLayer(rutas[id].markerOrigen);
        }

        if (rutas[id].markerDestino) {
            map.removeLayer(rutas[id].markerDestino);
        }

    });

    rutas = {};

}

    $('#btnbusquedaddireccion').click(function(){

        $('#busquedacoordenada').css('display','none');
        $('#busquedadireccion').css('display','block');

    });
    $('#btnbusquedadcoordenada').click(function(){

        $('#busquedacoordenada').css('display','block');
        $('#busquedadireccion').css('display','none');

    });

    let usuario = "{{ session('usuario') }}";

    $('#usuarioactual').val(usuario);

    if($('#usuarioactual').val() === ''){
        
        alert('Ingrese usuario Y contraseña para acceder a GEOLIK')
        window.location.href = '/';
    }


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
    
     var map = L.map('map').setView([4.696611, -74.070353], 18);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'OpenStreetMap'
        }).addTo(map);

   

       
    $('#consultacoordenadas').click(function(){

        const direcc = $('#direccion').val();
        const lat = $('#latitud').val();
        const long = $('#longitud').val();

        limpiezarespuesta();
        limpiarRutas();
        
        if(!lat && !long && !direcc){
            alert('Ingrese datos de Coordenadas o Direccion para proceso GEOLIK')
        }
       

        if(lat && long && !direcc){

            $.when(
                consultacoordenada()
            ).done(function(){
                creaciongeom();
            });

            $.when(
                zc(),
                za(),
                emp()
            ).done(function(){

                aplicarColumnas();

            });
        }
        if(lat && long && direcc){
            alert('Proceso prioriza busqueda por COORDENADAS')
            $('#direccion').val('');
            $.when(
                consultacoordenada()
            ).done(function(){
                creaciongeom();
            });

            $.when(
                zc(),
                za(),
                emp()
            ).done(function(){

                aplicarColumnas();

            });
           
        }

        if(direcc && !lat && !long){
            $.when(
                consultacoordenada()
            ).done(function(){
                creaciongeom();
            });
            direccion();
            setTimeout(() => {
                aplicarColumnas()
            }, 1000);
        }


        
        
        

    });


    function limpiezarespuesta(){

        
        
        $.ajax({
           
            url:'/limpiezatbrespuesta',
            type: 'POST',
            data: {
                 _token:$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
               
                console.log(response)
            },
            error:function(xhr){

                console.log(xhr.responseText);

                alert(xhr.responseText);

            }
        });
 
    }
    function consultacoordenada(){

        const latitud = $('#latitud').val()
        const longitud = $('#longitud').val()
        const direccion = $('#direccion').val()
        const localidad = $('#localidad').val()
        
        $.ajax({
           
            url:'/datosconsulta',
            type: 'POST',
            data: {
                id_pre:'1',
                latitud: latitud,
                longitud: longitud,
                direccion: direccion,
                localidad: localidad,
                

                 _token:$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
               
                console.log(response)
            },
            error:function(xhr){

                console.log(xhr.responseText);

                alert(
                    'Error cargando coordenadas de consulta\n\n' +
                    xhr.responseText
                );

            }
            
        });
 
    }
    function creaciongeom(){
        $.ajax({

            url:'/geom',
            type:'POST',
            data:{
                _token:$('meta[name="csrf-token"]').attr('content')
             },

             success:function(response){
                console.log(response.mensaje);
             }

        });
    }
    function direccion(){

        $.ajax({

            url:'/pordireccion',
            type:'POST',
            data:{
                _token:$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                let html = '';

                response.data.forEach(function(item){

                    html += `
                        <tr>
                            <td></td>
                            <td>Direc Exacta<td>
                            <td>${item.coordenadas}</td>
                            <td>${item.id_cto1}</td>
                            <td>${item.op1cto}</td>
                            <td>${item.direccion_cli}</td>
                            <td>0</td>
                            <td>${item.op1feeder}</td>
                            <td>${item.op1dipscto}</td>
                            <td>${item.op1olt}</td>
                            <td>${item.grupo_cto}</td>
                            
                        </tr>
                    `;

                });

                $('#tbrespuesta tbody').html(html);
            }

        });

    }

    $('#cierre').click(function() {

        let panel = $('#cuadrotabladirecciones')

        panel.removeClass('mostrar');

    });


    function dato(valor) {

        let panel = $('#cuadrotabladirecciones')

        panel.addClass('mostrar');
       

     $.ajax({

        url:'/consult_direccion',
        type:'POST',
        data:{
            valor:valor,
            _token:$('meta[name="csrf-token"]').attr('content')

        },

        success:function(response){
            let html = '';

                response.data.forEach(function(item){

                    html += `
                        <tr>
                            <td>${item.cto}</td>
                            <td>${item.localidad}</td>
                            <td>${item.direccion_cli}</td>
                            
                        </tr>
                    `;

                });

                $('#datospordireccion tbody').html(html);
                aplicarColumnas();

        }
        


     });


    }

    function zc(){

        return $.ajax({

            url:'/zc',
            type:'POST',
            data: {
                  _token:$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
              
                console.log("ZC response:", response);

                if (!response || !Array.isArray(response.data)) {
                    console.error("ZC: respuesta inválida", response);
                    
                }

                let html = '';

                response.data.forEach(function(item){

                    html += `
                        <tr>
                            <td>
                                <input type="checkbox" value="${item.coorde}" onchange="ruta(this)"/>
                            </td>
                            <td>FTTH</td>
                            <td>${item.coordenadas}</td>
                            <td>${item.id_cto1}</td>
                            <td>${item.op1cto}</td>
                            <td>${item.direccion_cli}</td>
                            <td>${item.op1distanciacto}</td>
                            <td>${item.op1feeder}</td>
                            <td>${item.op1dipscto}</td>
                            <td>${item.op1olt}</td>
                            <td>${item.grupo}</td>
                            
                        </tr>
                    `;

                    

                });

                $('#tbrespuesta tbody').html(html);
                aplicarColumnas();
            }

        });

    }

    function emp(){

        return $.ajax({

            url:'/emp',
            type:'POST',
            data:{

                _token:$('meta[name="csrf-token"]').attr('content') 
            },
            success:function(response){
                console.log("EMP response:", response);

                if (!response || !Array.isArray(response.data)) {
                    console.error("EMP: respuesta inválida", response);
                    
                }
                    let html = '';

                    response.data.forEach(function(item){

                        html += `
                            <tr>
                                <td>
                                    <input type="checkbox" value="${item.coorde}" onchange="ruta(this)"/>
                                </td>
                                <td>FIBRA</td>
                                <td>${item.coordenadas}</td>
                                <td>${item.idemp}</td>
                                <td>${item.empalme}</td>
                                <td>${item.puertos}</td>
                                <td>${item.distancia}</td>
                                <td>${item.feeder}</td>
                                <td>${item.puertos}</td>
                                <td>${item.puertos}</td>
                                <td>${item.consultaemp}</td>
                                
                            </tr>
                        `;
                       

                    });
                    
                    $('#tbrespuesta tbody').append(html);
                    aplicarColumnas();

                }

            });

    }
    
    function za(){

        return $.ajax({

            url:'/za',
            type:'POST',
            data:{

                _token:$('meta[name="csrf-token"]').attr('content') 
            },
            success:function(response){
                console.log("ZA response:", response);

                if (!response || !Array.isArray(response.data)) {
                    console.error("ZA: respuesta inválida", response);
                    
                }
                    let html = '';

                    response.data.forEach(function(item){

                        html += `
                            <tr>
                                <td>
                                    <input type="checkbox" value="${item.coorde}" onchange="ruta(this)"/>
                                </td>
                                <td>FTTH</td>
                                <td>${item.coordenadas}</td>
                                <td>${item.id_cto1}</td>
                                <td><a href="#" onclick="dato('${item.op1cto}'); return false;">
                                        ${item.op1cto}
                                    </a>
                                </td>
                                <td>${item.direccion_cli}</td>
                                <td>${item.op1distanciacto}</td>
                                <td>${item.op1feeder}</td>
                                <td>${item.op1dipscto}</td>
                                <td>${item.op1olt}</td>
                                <td>${item.grupo}</td>
                                
                            </tr>
                        `;

                    });
                   
                    $('#tbrespuesta tbody').append(html);
                    aplicarColumnas();
                }

            });

    }
    
    let rutas = {};

        function ruta(checkbox){

            const id = $(checkbox).val();

            // ==========================
            // ELIMINAR RUTA
            // ==========================
            if(!$(checkbox).is(':checked')){

                if(rutas[id]){

                    map.removeLayer(rutas[id].routeLayer);

                    map.removeLayer(rutas[id].markerOrigen);

                    map.removeLayer(rutas[id].markerDestino);

                    delete rutas[id];

                }

                return;
            }

            // ==========================
            // COORDENADAS CLIENTE
            // ==========================
            const latitud = parseFloat($('#latitud').val());

            const longitud = parseFloat($('#longitud').val());

            // ==========================
            // COORDENADAS DESTINO
            // ==========================
            const coordenada = $(checkbox).val();

            console.log(coordenada);

            if(!coordenada){

                console.error('coordenada vacia');

                return;
            }

            const partes = coordenada.split(',');

            console.log(partes);

            if(partes.length < 3){

                console.error('Formato invalido');

                return;
            }

            const lng = parseFloat(partes[0].trim());

            const lat = parseFloat(partes[1].trim());

            const destino = partes[2].trim();

            console.log("ORIGEN:", lng, lat);

            console.log("DESTINO:", longitud, latitud);

            // ==========================
            // ICONOS
            // ==========================
            const startIcon = L.icon({

                iconUrl: 'https://png.pngtree.com/png-clipart/20250102/original/pngtree-3d-location-icon-vector-clipart-for-maps-and-apps-png-image_18740250.png',

                iconSize: [40, 40],

                iconAnchor: [20, 36]

            });

            const endIcon = L.icon({

                iconUrl: 'https://png.pngtree.com/png-clipart/20250701/original/pngtree-green-eco-friendly-3d-location-pin-with-drop-shadow-png-image_21234206.png',

                iconSize: [40, 40],

                iconAnchor: [20, 36]

            });

            // ==========================
            // MARCADORES
            // ==========================
            const markerOrigen = L.marker([lat, lng], {

                icon: startIcon

            }).addTo(map)

            .bindTooltip(destino, {

                permanent: true,

                direction: 'left',

                className: 'toolconexion'

            });

            const markerDestino = L.marker([latitud, longitud], {

                icon: endIcon

            }).addTo(map)

            .bindTooltip('Cliente', {

                permanent: false,

                direction: 'left'

            });

            // ==========================
            // FETCH LARAVEL
            // ==========================
            fetch('/ors/ruta', {

                method: 'POST',

                headers: {

                    'Content-Type': 'application/json',

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                body: JSON.stringify({

                    coordinates: [

                        [lng, lat],

                        [longitud, latitud]

                    ]

                })

            })

            .then(async res => {

                const data = await res.json();

                console.log('RESPUESTA API:', data);

                if(!res.ok){

                    throw new Error(
                        data.error ||
                        'Error al consultar ORS'
                    );

                }

                return data;

            })

            .then(data => {

               
        console.log("DATA COMPLETA:", data);

        if(!data.features){

            console.error("No existen features");

            console.log(data);

            return;
        }

        console.log("FEATURES:", data.features);

        console.log("GEOMETRY:", data.features[0].geometry);

        let segmento2 = data.features[0].properties.segments[0];

        let totalDistance2 = segmento2.distance;




                // ==========================
                // DIBUJAR RUTA
                // ==========================
                const routeLayer = L.geoJSON(data, {

                    style: {

                        color: 'red',
                        weight: 5

                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindTooltip(`${totalDistance2.toFixed(0)} m`);
                    }
                    
                    

                }).addTo(map);

                rutas[id] = {

                    routeLayer,

                    markerOrigen,

                    markerDestino

                };

                // ==========================
                // CENTRAR MAPA
                // ==========================
                map.fitBounds(routeLayer.getBounds());

                // ==========================
                // INFORMACIÓN
                // ==========================
                let segmento = data.features[0].properties.segments[0];

                let totalDistance = segmento.distance;

                let totalDuration = segmento.duration;

                let html = "";

                html += `
                    <p style="margin-left:15px; margin-right:15px;">
                        <b>Distancia:</b>
                        ${totalDistance2.toFixed(0)} metros
                    </p>
                `;

               /* html += `
                    <p>
                        <b>Tiempo:</b>
                        ${(totalDuration / 60).toFixed(0)} min
                    </p>
                `;*/

                document.getElementById("panel").innerHTML = html;

            })

            .catch(err => {

                console.error("Error al generar ruta:", err);

            });

        }
</script>

<script>
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