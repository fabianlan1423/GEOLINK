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
<body class="bod" style="min-height: 100vh;
            background-image: url('{{ asset('img/fondo_azul1.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">

    
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
            <div>
                <h3 style="color: white; font-weight: 600; font-family: math; margin-left: 5%; margin-top: 15px;">
                    CONSULTA MASIVA - GEOLINK
                </h3>
            </div>
            <div style="display: flex; gap: 10px; margin-top: 10px; justify-content: center;"><!--cuadro pincipal-->
                <div class="procesandoinformaicon" id="letraagua"><!--CUADRO DE CAGA DE PROCESO-->
                    
                    <section>
                        <div class="content">
                            <h2 style="font-family: system-ui;">GEOLINK</h2>
                            <h2 style="font-family: system-ui;">GEOLINK</h2>
                        </div>
                    </section>
                    <div class="loader">
                        <div class="inner one"></div>
                        <div class="inner two"></div>
                        <div class="inner three"></div>
                    </div>

                </div>
                <div class="cuadro1cargainfo"><!--cuadro de carga informacion-->
                    <div><!--TITULO-->
                        <div>
                            <h3 style="color: white; font-weight: 600; font-family: math; margin-left: 10%;">Tipos De Proceso</h3>
                        </div>
                        <hr class="lineadivision" style="margin-top: -5px;">
                        <div style=" display: flex; gap: 5px; margin-bottom: 5px; height: 40%; width: 100%; align-content: center; justify-self: center; padding-left: 2%; margin-top: 30px;">
                            <div class="cuadro_seleccion">
                                <div>
                                    <input type="number" id="cantza" value="2" class="cuadrocant">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="ZA" checked>
                                    <label class="form-check-label" for="ZA">ZA</label>
                                </div>
                            </div>
                            <div class="cuadro_seleccion">
                                <div>
                                    <input type="number" id="cantzc" value="1" class="cuadrocant">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="ZC" checked>
                                    <label class="form-check-label" for="ZC">ZC</label>
                                </div>
                            </div>
                            <div class="cuadro_seleccion">
                                <div>
                                    <input type="number" id="cantnodo" value="2" class="cuadrocant">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="NODO" checked>
                                    <label class="form-check-label" for="NODO">NODO</label>
                                </div>
                            </div>
                            <div class="cuadro_seleccion">
                                <div>
                                    <input type="number" id="cantfenix" value="2" class="cuadrocant">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="FENIX">
                                    <label class="form-check-label" for="FENIX">FENIX</label>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    
                    <div style="margin-top: 35px; margin-left: 35px;"><!--CUADRO DE CARGA DE DATOS-->
                        <div style="width: 100%;">
                            <div style="display: flex; gap: 5px;">
                                <div class="cargaarchivocirculo">
                                    <div class="cargaarchivocirculo1">
                                        <img src="\img\CARGA_ARCHIVO.png" alt="CARGAARCHIVO" id="btncargaarchivo" style="width: 40PX;">
                                        <input type="file" name="cargaarchivo" id="cargaarchivo" style="display: none;">
                                    </div>
                                </div>
                                <div style="width: 50%; margin: 0 auto; display: flex; justify-content: center; align-items: center;">
                                    <p style="color: white; margin: 0;" id="nombrearchivo">Nombre Archivo</p>
                                </div>
                            </div>
                            <div style="width: 100%; height: 20%; justify-self: center; margin-top: 45px; text-align-last: center;">
                                <button type="submit" id="procesarinfo"  class="button glow">
                                    Procesar
                                    <svg class="glow-container">
                                        <rect pathLength="100" stroke-linecap="round" class="glow-blur"></rect>
                                        <rect pathLength="100" stroke-linecap="round" class="glow-line"></rect>
                                    </svg>
                                </button>
                                
                            </div>

                        </div>
                        
                      
                    </div>

                </div>
                <div class="cuadrorespuestainfo"><!--cuadro para respuesta de informacion-->
                    <div>
                        <div style="display: flex;">
                            <div style="width: 80%;">
                                <h3  style="color: white; font-weight: 600; font-family: math; margin-left: 10%;">Estado De Proceso</h3>
                            </div>
                            
                        </div>  
                        
                        <hr class="lineadivision" style="margin-top: -5px;">
                    </div>
                    <div style="margin-left: 25px; display: flex; gap: 5px;">
                        <div style="width:80%;" >
                            <p id="estadocarguemasivo" class="txtoinformativo">Selecciona Documento Para Consulta Masiva</p>
                        </div>
                        <div style="width: 20%;">
                            <img id="descargaexcel" src="{{ asset('img/descarga_excel_masivo.png')}}" alt="geolinkimg" style="width: 45px; margin-top: -20px; display: none; cursor: pointer;">
                        </div>
                        
                    </div>
                </div>

            </div>

           
            
            
            
        </div>
    

    </div>

    
</body>
</html>

