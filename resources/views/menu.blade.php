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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
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
                    <p id="letbienvenida2" class= "transicion textobienvenida">Network Path Discovery</p>
                </div>
                <div id="letbienvenida1" style="text-align: center; margin-top: 25px;">
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
            <div style="display: flex; gap: 0px;">
                <div class="barramenu"><!--Menu interactivo de la aplicacion-->
                    <div class="btnmenu">
                        <div style="display: flex; gap: 7px; padding-left: 13px;">
                            <div class="imagenboton">
                                <img class="transicion" id="geolinkimg" src="{{ asset('img/COORDENADA.png')}}" alt="geolinkimg" style="width: 25px;">
                            </div>
                            <div class="textoboton">
                                <p class="opcionesmenu">Consulta Punto A Punto</p>
                            </div>
                        </div>
                    </div>
                    <div class="btnmenu">
                        <div style="display: flex; gap: 7px; padding-left: 13px;">
                            <div class="imagenboton">
                                <img class="transicion" id="geolinkimg" src="{{ asset('img/Geolink_masivo.png')}}" alt="geolinkimg" style="width: 25px;">
                            </div>
                            <div class="textoboton">
                                <p class="opcionesmenu">Geolink Masivo</p>
                            </div>
                        </div>
                    </div>
                    <div class="btnmenu">
                        <div style="display: flex; gap: 7px; padding-left: 13px;">
                            <div class="imagenboton">
                                <img class="transicion" id="geolinkimg" src="{{ asset('img/global.png')}}" alt="geolinkimg" style="width: 25px;">
                            </div>
                            <div class="textoboton">
                                <p class="opcionesmenu">Mapa De Calor Disponibilidad</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="cuadroinicio" class="cuadroiniciomenu">
                    <div style="height: 90vh; border-radius: 10px; width: 28%;">
                        <video  muted autoplay playsinline loop  src="{{ asset('videos/inicio.mp4')}}" class="videoinicio"></video>
                    </div>
                    <div style="width: 72%;">
                        <div style="height: 25%;">
                            <h2 class="playfair">GEOLINK</h2>
                        </div>
                        <div style="height: 70%;">

                        </div>
                        <div style="height: 5%; text-align: end;  color: white;">
                            <p>V.2</p>
                        </div>
                    </div>
                    
                </div>
                
            </div>

            
            
        </div>
    

    </div>

    <!--<a href="{{route('welcome')}}">link</a> forma de llamar a un hipervinculo dentro de laravel -->
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

    $("p").each(function () {

        $(this).click(function () {
            let modulo = $(this).text();
            
            if (modulo === 'Consulta Punto A Punto') {
                window.location.href = '/geolink';

            } else if (modulo === 'Geolink Masivo') {
                window.location.href = '/geolinkmasivo';

            } else if (modulo === 'Mapa De Calor Disponibilidad') {
                window.location.href = '/mapacalor';
            }


        });

    });

   

    $('#porcenvideo').change(function () {

        const video = $('#video').get(0);
        const porcen = $(this).val();

        console.log('Altura seleccionada:', porcen);

        video.style.setProperty('height', porcen, 'important');

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