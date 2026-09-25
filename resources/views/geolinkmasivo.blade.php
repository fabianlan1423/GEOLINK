<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/jsgeolinkmasivo.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <title>GEOLIK CONSULTA</title>
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
                    <p id="letbienvenida2" class= "transicion textobienvenida">GEOLINK MASIVO</p>
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
                    
                    <div class="cuadro_mapas" id="map" style="height: 80vh !important;">
                        <div style="height: 5vh">
                            <h3 class="titulomasivo">
                                CONSULTA MASIVA DE DISPONIBILIDAD - GEOLINK
                            </h3>
                        </div>
                        <hr class="lineadivision">
                        <div style="width: 100%; display: flex; gap: 25px; height: 60vh;">
                            <div style="width: 30%; border-right: solid 2px; border-radius: 15px; border-color: #6ec7ec; align-content: center; text-align-last: center;">
                                <div style="height: 10%;">
                                    <h5 class="subtitulomasivo">SELECCIONE PROCESOS A CORRER</h5>
                                </div>
                                <div style="margin-bottom: 5px; height: 40%; width: 100%; align-content: center; justify-self: center; padding-left: 10%;">
                                    <div style="display: flex; gap: 15px;">
                                        <div>
                                            <input type="number" id="cantza" value="2" class="cuadrocant">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="ZA" checked>
                                            <label class="form-check-label" for="ZA">ZA</label>
                                        </div>
                                    </div>
                                    <div style="display: flex; gap: 15px; margin-top: 5px;">
                                        <div>
                                            <input type="number" id="cantzc" value="1" class="cuadrocant">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="ZC" checked>
                                            <label class="form-check-label" for="ZC">ZC</label>
                                        </div>
                                    </div>
                                    <div style="display: flex; gap: 15px; margin-top: 5px;">
                                        <div>
                                            <input type="number" id="cantnodo" value="2" class="cuadrocant">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="NODO" checked>
                                            <label class="form-check-label" for="NODO">NODO</label>
                                        </div>
                                    </div>
                                    <div style="display: flex; gap: 15px; margin-top: 5px;">
                                        <div>
                                            <input type="number" id="cantfenix" value="2" class="cuadrocant">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="FENIX">
                                            <label class="form-check-label" for="FENIX">FENIX</label>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div style="display: flex; gap: 15px; width: 100%; height: 30%; align-items: center; padding: 8px;">
                                    <div style="width: 20%;">
                                        <div class="cargaarchivocirculo">
                                            <div class="cargaarchivocirculo1">
                                                <img src="\img\CARGA_ARCHIVO.png" alt="CARGAARCHIVO" id="btncargaarchivo" style="width: 40PX;">
                                                <input type="file" name="cargaarchivo" id="cargaarchivo" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div style="align-content: center; width: 80%;">
                                        <p style="color: white;" id="nombrearchivo">Nombre Archivo</p>
                                    </div>
                                </div>
                                <div style="height: 20%;">
                                    <button type="submit" class="btndecarga" id="procesarinfo">Procesar</button>
                                </div>
                            </div>
                            <div style="width: 60%; "> <!--Recuadro informativo-->
                                <div>
                                    <div style="display: flex;">
                                        <div style="width: 80%;">
                                            <h3 class="subtitulomasivo">Estado De Proceso</h3>
                                        </div>
                                        <div style="width: 20%;">
                                            <img id="descargaexcel" src="{{ asset('img/Descarga_exel.png')}}" alt="geolinkimg" style="width: 45px; margin-top: -20px; display: none;">
                                        </div>
                                    </div>  
                                    
                                    <hr class="lineadivision" style="margin-top: -5px;">
                                </div>
                                <div>
                                    <p id="estadocarguemasivo" class="txtoinformativo">Selecciona Documento Para Consulta Masiva</p>
                                </div>
                            </div>
                        </div>

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

