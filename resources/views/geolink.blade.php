<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <div class='cuadrogeneral'>
        <div id="cuadropincipal2" class="transicion bienvenida">
            <div class="transicion" id="cuadrobienvenida" style="align-content: center; margin-left: 20px;">
                <div class="ordenlogo">
                    <div style="align-content: center;">
                        <img class="transicion" id="geolinkimg" src="{{ asset('img/icono_geolink.png')}}" alt="geolinkimg" style="width: 90px;">
                    </div>
                    <div style="align-content: center;">
                        <h2 style="color: white; font-weight: 600;">GEOLIK</h2>
                    </div>
                </div>
                <div>
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
            
        </div>
        <div id="cuadropincipalinfo" class="transicion cuadroprincipal">
            <div style="width:100%; margin-left: 35px; display:flex;">
                <div style="width:25%;"><!--cuadro consultas-->
                    <div class="cuadro_consultas">
                        <div style="display: flex; gap: 10px;">
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
                        
                   
                        <div>
                            <p style="color:white;">Direccion</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="direccion" placeholder="Direccion">
                            <label for="direccion">Direccion</label>
                        </div>
                        <br>
                        <select class="form-select form-select-lg mb-3" aria-label="Large select example" id='localidad'>
                            <option selected>Localidad</option>
                             @foreach($localidades as $localidad)
                             <option value="{{$localidad -> localidad}}">{{$localidad -> localidad}}</option>
                             @endforeach
                        </select>
                        <br>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="latitud" placeholder="Latitud">
                            <label for="latitud">Latitud</label>
                        </div>
                        <br>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="longitud" placeholder="Longitud">
                            <label for="longitud">Longitud</label>
                        </div>
                        <br>
                        <div style="width: 100%; text-align: center;">
                            <input class="btn_ingreso" type="button" id="consultacoordenadas" value="CONSULTAR">
                        </div>
                    </div>
                    <div><!--Consulta Cordenedas-->

                    </div>
                </div>
                <div style="width:90%; "><!--cuadro mapa-->
                    <div id="panel" style="display: flex; gap: 5px; color: white;"></div>
                    <div class="cuadro_mapas" id="map">
                    </div>
                    
                </div>
            </div>
            <br>
            <hr class="linea">
            <div> <!--Tabla De Respuestas-->
                    <table>
                        <thead>
                            <tr>
                                <td></td>
                                <td>ESTADO</td>
                                <td>ID</td>
                                <td>CTO/EMP</td>
                                <td>PUERTOS</td>
                                <td>DISTANCIA</td>
                                <td>OLT</td>
                                <td>NODO</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                            </tr>
                        </tbody>
                        
                    </table>
            </div>
            
        </div>
    

    </div>

    <!--<a href="{{route('welcome')}}">link</a> forma de llamar a un hipervinculo dentro de laravel -->
</body>
</html>

<script>
      var map = L.map('map').setView([4.696611, -74.070353], 18);
       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'OpenStreetMap'
        }).addTo(map);

    $('#consultacoordenadas').click(function(){
        ruta();

    });

    
    function ruta(){

        const latitud =  parseFloat($('#latitud').val());
        const longitud =  parseFloat($('#longitud').val());

      
        
       
        
        
        // ==========================
        // 2. CAPA DE RUTA
        // ==========================
        let routeLayer;

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

        L.marker([4.6973228, -74.0696999], { icon: startIcon })
            .addTo(map)
            .bindPopup("Inicio");

        L.marker([latitud, longitud], { icon: endIcon })
            .addTo(map)
            .bindPopup("Destino");
        
        
        // ==========================
        // 3. LLAMADA A OPENROUTESERVICE
        // ==========================
        fetch('https://api.openrouteservice.org/v2/directions/foot-walking/geojson', {
            method: 'POST',
            headers: {
                'Authorization': 'eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6Ijg0ZDdiZmZlYjBhZDQ2MjI5YmU4ZTE4Mzc1YWIxMDA3IiwiaCI6Im11cm11cjY0In0=',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                coordinates: [
                    [-74.0696999, 4.6973228],   // origen (lng, lat)
                    [longitud, latitud]    // destino (lng, lat)
                ]
            })
        })
        
        .then(res => res.json())
        .then(data => {
        
            // ==========================
            // 4. DIBUJAR RUTA EN MAPA
            // ==========================
            if (routeLayer) {
                map.removeLayer(routeLayer);
            }
        
            routeLayer = L.geoJSON(data, {
                style: {
                    color: 'red',
                    weight: 3
                }
            }).addTo(map);
        
        
            // ==========================
            // 5. CENTRAR MAPA EN RUTA
            // ==========================
            map.fitBounds(routeLayer.getBounds());
        
        
            // ==========================
            // 6. PANEL DE INSTRUCCIONES
            // ==========================
            let steps = data.features[0].properties.segments[0].steps;
        
            let totalDistance = data.features[0].properties.segments[0].distance;
            let totalDuration = data.features[0].properties.segments[0].duration;
        
            let html = "<h6>Indicaciones de ruta</h6>";
            html += `<p style="margin-left:15px; margin-right: 15px;"><b>Distancia:</b> ${(totalDistance / 1000).toFixed(2)} km</p>`;
            html += `<p><b>Tiempo:</b> ${(totalDuration / 60).toFixed(0)} min</p>`;
        /*  html += "<ol>";
        
            steps.forEach(step => {
                html += `<li>${step.instruction} (${step.distance.toFixed(0)} m)</li>`;
            });
        
            html += "</ol>";*/
        
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
   
    
   
}, 2000);

setTimeout(() => {
    $('#cuadropincipalinfo').css('opacity','100%')
}, 3000);






</script>