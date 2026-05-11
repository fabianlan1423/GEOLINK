<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>GEOLIK CONSULTA</title>
</head>
<body class="bod1">
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
            <div style="width:100%; margin-left: 25px; display:flex;">
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
                        
                    </div>
                    <div class="cuadro_consultas"><!--seleccion datos de consulta-->
                        <div>
                            <p style="color:white;">Direccion</p>
                        </div>
                        <div>
                            <input type="text" class="cuadro" id="direccion" name="direccion" placeholder="Direccion">
                            <label for="direccion">Direccion</label>
                        </div>
                        <div style="margin-top: -20px;">
                            <p style="color:white;">Localidad</p>
                        </div>
                        <div>
                            <input type="text" class="cuadro" id="Localidad" name="Localidad" placeholder="Localidad">
                            <label for="Localidad">Localidad</label>
                        </div>
                        <div style="width: 80%; text-align: center;">
                            <input class="btn_ingreso" type="button" id="consultadireccion" value="CONSULTAR">
                        </div>
                    </div>
                    <div class="cuadro_consultas"><!--Consulta Direccion-->
                        <div style="margin-top: -5px;">
                            <p style="color:white;">Latitud</p>
                        </div>
                        <div>
                            <input type="text" class="cuadro" id="Latitud" name="Latitud" placeholder="Latitud">
                            <label for="Latitud">Latitud</label>
                        </div>
                        <div style="margin-top: -20px;">
                            <p style="color:white;">Longitud</p>
                        </div>
                        <div>
                            <input type="text" class="cuadro" id="Longitud" name="Longitud" placeholder="Longitud">
                            <label for="Longitud">Longitud</label>
                        </div>
                        <div style="width: 80%; text-align: center;">
                            <input class="btn_ingreso" type="button" id="consultacoordenadas" value="CONSULTAR">
                        </div>
                    </div>
                    <div><!--Consulta Cordenedas-->

                    </div>
                </div>
                <div style="width:90%;"><!--cuadro mapa-->
                    <div class="cuadro_mapas ">
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
    

    

    <!--<a href="{{route('welcome')}}">link</a> forma de llamar a un hipervinculo dentro de laravel -->
</body>
</html>

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