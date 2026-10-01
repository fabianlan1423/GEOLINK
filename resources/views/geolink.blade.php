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
    <title>GEOLINK CONSULTA</title>
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
                    <p id="letbienvenida2" class= "transicion textobienvenida">CONSULTA PUNTO A PUNTO</p>
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
        <div  id="cuadropincipalinfo" class="transicion cuadroprincipal" style="justify-items: center; display: flex; gap: 5px;"><!--CUADRO PRINCIPAL V2 GEOLINK-->
            <div style="height: 85vh; display: flex; gap: 3px;">
                <div class="pestaniaaccesorapido"><!--Pestaña para acceso rapido-->
                    <div class="botonselectmaps">
                        <span class="titlemodif" data-tooltip="Consulta Por Coordenada">
                            <img 
                                id="iconocoordenada" 
                                src="{{ asset('img/busquedacoordenada.png')}}" 
                                alt="iconocoordenada" 
                                class="imgbtnmaps"
                            >
                        </span>
                    </div>
                    <div class="botonselectmaps">
                        <span class="titlemodif" data-tooltip="Consulta Por Coordenada">
                            <img id="iconodedireccion" src="{{ asset('img/busquedadireccion.png')}}" alt="iconodedireccion" class="imgbtnmaps titlemodif" data-tooltip1="Consulta Por Direccion">
                        </span>
                    </div>
                    <div class="botonselectmaps">
                        <span class="titlemodif" data-tooltip="Consulta Por Coordenada">
                            <img id="iconoexportexcel" src="{{ asset('img/export_excel.png')}}" alt="iconoexportexcel" class="imgbtnmaps titlemodif" data-tooltip2="Exportar Consulta Realizada">
                        </span>
                    </div>
                </div>
                <div class="cuadrobusqueda"><!--fron de consulta-->
                    <div style="height: 8%; display: flex; background: rgb(67 67 73 / 34%); padding: 5px 0px 3px 0px; border-radius: 8px;"><!--Principal-->
                        <div><!--TITULO-->
                            <h5 id="titulobusqueda" style="color: white; margin-left: 10px; width: 40%;">Coordenada</h5>
                        </div>
                        <div><!--RED-->
                            <div style="width: auto; height: 30px; align-self: flex-end; margin-left: 10px; display: flex; gap: 5px; width: 60%;">
                                <div style="display: flex; gap: 10px; align-items: baseline;">
                                    <p style="color: white;">COLTEL</p>
                                    <input type="checkbox" id="coltel" name="coltel" checked>
                                </div>
                                <div style="display: flex; gap: 10px; align-items: baseline;">
                                    <p style="color: white;">TIGO</p>
                                    <input type="checkbox" id="tigo" name="tigo" checked >
                                </div>
                                <div style="display: flex; gap: 10px; align-items: baseline;">
                                    <img src="{{ asset('img/retroceder.png')}}" alt="retroceder" style="margin-left: 20px; cursor: pointer; margin-top: 5px;">
                                </div>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                    <div><!--QUE ESTA CONSULTANDO-->
                        <div id="panel" style="display: flex; gap: 5px; color: white; padding: 0px; height: 10px; margin-bottom: -10px;">
                            
                        </div>  
                    </div>
                    <div id="cuadrodecoordenadas" class="recuadrosmaps" style="max-height: 15% !important; margin-top: 2px !important;">
                        <div class="form-floating mb-3 campo-pequeno" style="width:90%;">
                            <input type="text" class="form-control" id="datocoordenada" placeholder="datocoordenada" style="font-size: 12px;">
                            <label for="datocoordenada">Coordenadas</label>
                        </div>
                    </div> 
                    <div class="recuadrosmaps" id="cuadrodireccion" style="display: none; max-height: auto !important; margin-top: 2px !important;" >
                        <div class="form-floating mb-3 "  style="width: 90%;">
                            
                            <input type="text" class="form-control" id="direccion" placeholder="Direccion">
                            <label for="direccion">Direccion</label>
                        </div>
                        <div class="form-floating mb-3" style="width: 90%;">
                            <select class="form-select" id="localidad">
                                @foreach($localidades as $localidad)
                                    <option value="{{ $localidad->localidad }}">
                                        {{ $localidad->localidad }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="localidad">Localidad</label>
                        </div>
                    </div>
                    <div class="recuadrosmaps" id="cudroexcel" style="display: none; max-height: 15% !important; margin-top: 2px !important;" >
                          <!--SELECCION DE COLUMNAS A EXPORTAR EN INFORME DE EXCEL-->
                          
                    </div>
                     <div class="recuadrosmaps" id="cuadrorespuesta" style="text-align: -webkit-center; width: 100%; height: auto; max-height: 73% !important; margin-top: 2px !important;" ><!--CUADRO DE RESPUESTA AL USUARIO-->
                        <div style="width: 95%;">
                            <div class="lin1respu">
                                <div style="width: 20%; padding-left: 8px; background: #0a0aa163; border-radius: 8px 0px 0px 0px;">
                                    <p>ZA</p>
                                </div>
                                <div style="width: 40%; text-align: center;">
                                    <p>Mendio: FFTH</p>
                                </div>
                                <div style="width: 40%; text-align: center;">
                                    <p>Dist: 40.62 mtr</p>
                                </div>
                            </div>
                            <div class="lin2respu"><!--linea 1-->
                                <div style="width: 5%; text-align: center;">
                                    <input type="checkbox" value="" onchange="ruta(this)">
                                </div>
                                
                                <div style="width: 20%; text-align: center;">
                                    <p title="ID">ID: 990201</p>
                                </div>
                                <div style="width: 60%; text-align: center;">
                                    <p title="DESTINO">Dest: CGDOS-CT4/5-83-02</p>
                                </div>
                                
                                <div style="width: 10%; text-align: center;">
                                    <p title="PUERTOS DISPONIBLES">PD: 6</p>
                                </div>
                            </div>
                            <div class="lin3respu"><!--linea 2-->
                                <div>
                                    <p title="DIRECCION">CL 63 s KR 81 11 |</p>
                                </div>
                                <div>
                                    <p title="RED" >ONNET |</p>
                                </div>
                            </div>
                            <div class="lin4respu"><!--linea 2-->
                                <div>
                                    <p title="olt">OH_BOGALGDOC_I_7360_CentrodeGravedad2_3 | </p>
                                </div>
                                <div>
                                    <P title="NODO">|</P>
                                </div>
                            </div>
                        </div>
                    </div>
                    


                </div>

                <!-- <div style="display: flex; gap: 2px;">
                    <div class="pestania">
                        <p style="color: white;">Direccion</p>
                    </div>
                    <div class="pestania">
                        <p style="color: white;">Coordenadas</p>
                    </div>
                    
                </div> -->
                <!-- <div>
                    <div id="cuadrodedireccion" style="display: none;">
                        
                         
                    </div>
                    
                </div> -->

            </div>
            <div class="cuadro_mapas" id="map"><!--cuadro de mapa-->
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

        <div>
            <div style="width:100%; margin-left: 35px;">
                <div><!--CUADRO PRINCIPAL-->
                    <div><!--cuadro de busqueda-->

                    </div>
                    
                </div>
                <div><!--cuadro consultas-->
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
                       
                        <div id="busquedadireccion" class="recuadros" style="width: 40%; gap: 5px; margin-top: -15px !important; " ><!--CUADRO DE DIRECCION-->
                            
                            
                        </div>
                        <div style="width: 1px; border: solid 2px; border-color: white;"></div>
                        <div id="busquedacoordenada" style="display: flex; width: 30%; gap: 5px; justify-content: center;" class="recuadros"><!--CUADRO DE DIRECCION-->
                            
                            
                        </div>
                        <br>
                        <div style="width: 100%; text-align: center; width: 10%; align-content: center; margin-top: 20px;"><!--CUADRO DE DIRECCION-->
                            <input class="btn_ingreso" type="button" id="consultacoordenadas" value="CONSULTAR">
                        </div>
                        
                    </div>
                    <div><!--Consulta Cordenedas-->
                        
                    </div>
                </div>
                
            </div>
            <div id="cuadroaviso" class="cuadroaviso">
                
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
                                <th>MEDIO</th>
                                <th>COORDENADAS</th>
                                <th>ID</th>
                                <th>DESTINO</th>
                                <th>DIRECCION ASOCIADA</th>
                                <th>DIST</th>
                                <th>RED</th>
                                <th title="PUERTOS DISPONIBLES">PD</th>
                                <th>OLT/EQUIPO</th>
                                <th>NODO</th>
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


// iconoexportexcel iconodedireccion iconocoordenada

// $("img").each(function  () {

//     $ttttt   
     
 
// });
consultacolum();

function consultacolum(){

    $.ajax({
        url:'/consultacolum',
        method:'POST',
        data:{
             _token:$('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log(response.data);
            alert(JSON.stringify(response.data, null, 2));
        },
        error: function (xhr, error) { 

         }
    })

}

$("img").each(function () {  

    $(this).click(function (){

        let id = $(this).attr('id');
        const cuadrodecoordenadas = $('#cuadrodecoordenadas') 
        const cuadrodireccion = $('#cuadrodireccion') 
        const cudroexcel = $('#cudroexcel') 

        if(id == 'iconocoordenada'){
            cuadrodecoordenadas.css('display','block')
            cuadrodireccion.css('display','none')
            cudroexcel.css('display','none')
           
        }
        if (id == 'iconodedireccion') {
            cuadrodecoordenadas.css('display','none')
            cuadrodireccion.css('display','block')
            cudroexcel.css('display','none')
        }
        if (id == 'iconoexportexcel') {
            cuadrodecoordenadas.css('display','none')
            cuadrodireccion.css('display','none')
            cudroexcel.css('display','block')
        }

    })


})


$("p").each(function () {

     $(this).click(function () {
            let menubusqueda = $(this).text();

            if(menubusqueda == 'Direccion'){
                $('#cuadrodedireccion').css('display','block')
                $('#cuadrodecoordenadas').css('display','none')
            }
            if(menubusqueda == 'Coordenadas'){
                $('#cuadrodecoordenadas').css('display','block')
                $('#cuadrodedireccion').css('display','none')
            }
            
     
     
        });

   
});


$('#Menu').click(function () {
   
    window.location.href = '/menu';
    
  });


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
        
        alert('Ingrese usuario Y contraseña para acceder a GEOLINK')
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
    
    var mapaOSM = L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap contributors'
        }
    );

    var mapaSatelital = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
        {
            attribution: 'Proveedor de imágenes'
        }
    );

    var map = L.map('map', {
        center: [4.696611, -74.070353],
        zoom: 18,
        minZoom: 3,
        maxZoom: 18,
        layers: [mapaOSM]
    });

    

    L.control.layers({
        "Mapa    ": mapaOSM,
        "Satélite": mapaSatelital
    }, null, {
        position: 'bottomright'
    }).addTo(map);



    

   
    async function ejecutarConsultas(fenix) {

        try {
            
            await zc();
            await za();
            if (fenix.is(':checked')) {
                alert('zatigo')
                await zatigo();
            }
            await emp();
            await nodos();

            

            aplicarColumnas();

            console.log("Proceso terminado");

        } catch (error) {

            console.error(error);
            alert("Ocurrió un error durante las consultas.");

        }

    }

    async function consulta() {

        const direcc = $('#direccion').val().trim();
        const datocoordenada = $('#datocoordenada').val().trim();

     

        // ==========================================================
        // VALIDAR QUE EXISTA AL MENOS COORDENADA O DIRECCIÓN
        // ==========================================================

        if (!datocoordenada && !direcc) {

            alert('Ingrese datos de Coordenadas o Dirección para proceso GEOLINK');

            return;
        }

        // ==========================================================
        // VARIABLES DE COORDENADAS
        // ==========================================================

        let lat = '';
        let long = '';

        if (datocoordenada) {

            const coordenadas = datocoordenada.split(',');

            if (coordenadas.length < 2) {

                alert('Las coordenadas deben tener el formato: latitud,longitud');

                return;
            }

            lat = coordenadas[0].trim().replace(',', '.');
            long = coordenadas[1].trim().replace(',', '.');
        }

        const fenix = $('#tigo');

        limpiezarespuesta();
        limpiarRutas();
        $('#tbrespuesta tbody').empty();

        try {

            // ==========================================================
            // COORDENADAS
            // ==========================================================

            if (lat && long && !direcc) {

                console.log('1. Iniciando consultacoordenada');

                await consultacoordenada();

                console.log('2. consultacoordenada TERMINADA');

                await creaciongeom();

                console.log('3. creaciongeom TERMINADA');

                await ejecutarConsultas(fenix);

                console.log('4. ejecutarConsultas TERMINADA');

                return;
            }


            // ==========================================================
            // COORDENADAS + DIRECCIÓN
            // ==========================================================

            if (lat && long && direcc) {

                alert('Proceso prioriza búsqueda por COORDENADAS');

                $('#direccion').val('');

                console.log('1. Iniciando consultacoordenada');

                await consultacoordenada();

                console.log('2. consultacoordenada TERMINADA');

                await creaciongeom();

                console.log('3. creaciongeom TERMINADA');

                await ejecutarConsultas(fenix);

                console.log('4. ejecutarConsultas TERMINADA');

                return;
            }


            // ==========================================================
            // DIRECCIÓN
            // ==========================================================

            if (direcc && !lat && !long) {

                await consultacoordenada();

                await creaciongeom();

                await direccion();

                aplicarColumnas();

                return;
            }

        } catch (error) {

            console.error('ERROR GENERAL EN CONSULTA:', error);

            alert('Ocurrió un error durante el proceso de consulta.');
        }
    }
    
    
     $('#datocoordenada').on('keydown', function (e) {  

            if(e.key == 'Enter'){
                alert('ENTER')
                consulta()
            }

     });

    $('#localidad').change(function (){
            const direccion = $('#direccion').val()
           

            if(direccion == ''){
                alert('Ingrese una dirección antes de seleccionar la localidad para realizar la búsqueda.')
                $('#localidad').prop('selectedIndex',0)
                return
            }else{
                consulta()
            }

    });




    function limpiezarespuesta() {

        const cuadroconsulta = $('#cuadroaviso');

        cuadroconsulta
            .css('display', 'block')
            .text('Ejecutando Limpieza Tabla');

        return $.ajax({
            url: '/limpiezatbrespuesta',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        })
        .done(function(response) {

            console.log('Limpieza:', response);

            cuadroconsulta.text('Limpieza tabla exitosa.');

        })
        .fail(function(xhr) {

            console.error('Error limpieza:', xhr.responseText);

            cuadroconsulta.text('Error limpiando tabla.');

            throw new Error('Error en limpieza de tabla');

        });
    }
    function consultacoordenada() {

        const datocoordenada = $('#datocoordenada').val().trim();
        const coordenadas = datocoordenada.split(',');
        
        const latitud =  coordenadas[0].trim().replace(',', '.');
        const longitud =  coordenadas[1].trim().replace(',', '.');

        const direccion = $('#direccion').val();
        const localidad = $('#localidad').val();

        const cuadroconsulta = $('#cuadroaviso');

        cuadroconsulta
            .css('display', 'block')
            .text('Ejecutando consulta por coordenada.');

        return $.ajax({
            url: '/datosconsulta',
            type: 'POST',
            data: {
                id_pre: '1',
                latitud: latitud,
                longitud: longitud,
                direccion: direccion,
                localidad: localidad,
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        })
        .done(function(response) {

            console.log('Datos consulta:', response);

        })
        .fail(function(xhr) {

            console.error('Error datosconsulta:', xhr.responseText);

            cuadroconsulta.text(
                'Error cargando coordenadas de consulta'
            );

            throw new Error('Error en /datosconsulta');

        });
    }
    
    function creaciongeom() {

        const cuadroconsulta = $('#cuadroaviso');

        cuadroconsulta
            .css('display', 'block')
            .text('Creación de Geom para consulta...');

        console.log('================================');
        console.log('INICIANDO CREACION GEOM');
        console.log('================================');

        return $.ajax({
            url: '/geom',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        })
        .done(function(response) {

            console.log('================================');
            console.log('GEOM CREADA');
            console.log(response);
            console.log('================================');

            cuadroconsulta.text(
                response.mensaje || 'GEOM creada correctamente'
            );

        })
        .fail(function(xhr) {

            console.error('================================');
            console.error('ERROR CREANDO GEOM');
            console.error(xhr.status);
            console.error(xhr.responseText);
            console.error('================================');

            let mensaje = 'Ocurrió un error al crear la geometría.';

            if (xhr.responseJSON && xhr.responseJSON.mensaje) {
                mensaje = xhr.responseJSON.mensaje;
            }

            cuadroconsulta.text(mensaje);

            throw new Error('Error en /geom');

        });
    }
       

    function direccion(){


        const cuadroconsulta = $('#cuadroaviso');

        
        cuadroconsulta.text('Ejecutando consulta por Direccion.');

        return $.ajax({

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

                cuadroconsulta.text('Consulta Por Direccion Exitosa');
                cuadroconsulta.css('display','none')
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


        const cuadroconsulta = $('#cuadroaviso');

        cuadroconsulta.css('display','block');
        cuadroconsulta.text('Ejecutando consulta Zona Cerrada.');

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
                            <td></td>
                            <td>${item.grupo}</td>
                            
                        </tr>
                    `;

                    

                });

                $('#tbrespuesta tbody').html(html);
                aplicarColumnas();

                cuadroconsulta.text('Consulta Zona Cerrada Exitosa')
            }

        });

    }

    function emp(){

        const cuadroconsulta = $('#cuadroaviso');

        cuadroconsulta.css('display','block');
        cuadroconsulta.text('Ejecutando consulta Empalme.');

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
                                <td></td>
                                <td>${item.distancia}</td>
                                <td>${item.feeder}</td>
                                <td>${item.puertos}</td>
                                <td>${item.puertos}</td>
                                <td></td>
                                <td>${item.consultaemp}</td>
                                
                            </tr>
                        `;
                       
                        cuadroconsulta.text('Consulta Empalme Exitosa')

                    });
                    
                    $('#tbrespuesta tbody').append(html);
                    aplicarColumnas();

                }

            });

    }
    
    function za(){

        const cuadroconsulta = $('#cuadroaviso');

        cuadroconsulta.css('display','block');
        cuadroconsulta.text('Ejecutando consulta Zona Abierta.');

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

                        $('#cuadrorespuesta').append(`
                            <input type="text" id="${item.direccion_cli}" value="${item.direccion_cli}">
                        `);

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
                                <td></td>
                                <td>${item.grupo}</td>
                                
                            </tr>
                        `;

                    });
                   
                    $('#tbrespuesta tbody').append(html);
                    aplicarColumnas();


                    cuadroconsulta.text('Consulta Zona Abierta Exitosa')
                }

            });

    }
    
    function nodos(){

        const cuadroconsulta = $('#cuadroaviso');

        cuadroconsulta.css('display','block');
        cuadroconsulta.text('Ejecutando consulta Nodos.');

        const datocoordenada = $('#datocoordenada').val().trim();
        const coordenadas = datocoordenada.split(',');
        
        const latitud =  coordenadas[0].trim().replace(',', '.');
        const longitud =  coordenadas[1].trim().replace(',', '.');

        const lat = $('#datocoordenada');
        const long = $('#datocoordenada');

        return $.ajax({

            url:'/consultnodo',
            type:'POST',
            data:{

                _token:$('meta[name="csrf-token"]').attr('content')

            },

            success:function(response){
                console.log("NODO response:", response);

                if (!response || !Array.isArray(response.data)) {
                    console.error("NODO: respuesta inválida", response);
                    
                }
                    let html = '';

                    response.data.forEach(function(item){

                        html += `
                            <tr>
                                <td>
                                    <input type="checkbox" value="${item.coorde}" onchange="ruta(this)"/> 
                                </td>
                                <td>NODO</td>
                                <td>${item.coordenadas}</td>
                                <td>${item.ip}</td>
                                <td>${item.modelo}</td>
                                <td></td>
                                <td>${item.distancianodo}</td>
                                <td>${item.marca}</td>
                                <td></td>
                                <td>${item.nombre_equipo}</td>
                                <td>${item.anillo}</td>
                                <td>${item.consulta}</td>
                                
                            </tr>
                        `;

                    });
                   
                    $('#tbrespuesta tbody').append(html);
                    aplicarColumnas();

                    cuadroconsulta.text('Consulta Nodos Ejecutada Con Exito')
                    cuadroconsulta.css('display','none')
                }



        });



    }

    function zatigo(){

    const cuadroconsulta = $('#cuadroaviso');

    cuadroconsulta.css('display','block');
    cuadroconsulta.text('Ejecutando consulta Zona Abierta TIGO.');

    return $.ajax({

        url:'/zatigo',
        type:'POST',
        data:{

            _token:$('meta[name="csrf-token"]').attr('content') 
        },

        success:function(response){
            console.log("ZA TIGO response:", response);

                if (!response || !Array.isArray(response.data)) {
                    console.error("ZA TIGO: respuesta inválida", response);
                    
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
                                <td>${item.olt}</td>
                                <td>${item.armario}</td>
                                <td>${item.direccion_punto}</td>
                                <td>${item.op1distanciacto}</td>
                                <td></td>
                                <td>${item.estado_hilo}</td>
                                <td>${item.olt}</td>
                                <td>${item.central}</td>
                                <td>${item.grupo}</td>
                                
                            </tr>
                        `;

                    });
                
                    $('#tbrespuesta tbody').append(html);
                    aplicarColumnas();

                    cuadroconsulta.text('Consulta Zona Abierta Base Fenix Exitosa')
                    cuadroconsulta.css('display','none')
                },
                error:function(xhr){
                    console.log(xhr.status);
                    console.log(xhr.responseText);
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
            const datocoordenada = $('#datocoordenada').val().trim();
            const coordenadas = datocoordenada.split(',');
            
            const latitud =  parseFloat(coordenadas[0].trim().replace(',', '.'));
            const longitud =  parseFloat(coordenadas[1].trim().replace(',', '.'));

            
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