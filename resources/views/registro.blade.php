<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/jsregistrogeolink.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>GEOLINK REGISTRO</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
</head>
<body class="bod" style="min-height: 100vh;
            background-image: url('{{ asset('img/fondo.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">
    

    

    <div style="display: flex; justify-content: center; margin-top: 3%; width: 230vh;">
        <div class="cuadroregistro" id="cuadroderegistro">
            <div class="cuadro50porcen"><!--INGRESO-->
                <div id="ventanaingreso" style="width: 90%; justify-items: center;">
                    <div style="width: 80%">
                        <div style="margin-bottom: 20px; text-align: center; color: white; font-weight: 600 ;">
                            <h3 style="color:#6ec7ec;">GEOLINK</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="usuario" placeholder="Usuario">
                            <label for="usuario">Usuario</label>
                        </div>
                    </div>
                    <div style="width: 80%; ">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="Password" placeholder="Password">
                            <label for="Password">Password</label>
                        </div>
                    </div>
                    <div style = "display:flex; gap:5px; width: 80%;">
                        <div style="width: 70%;">
                            <p id="recuperadorcontrasenia" class="vinculos">Olvidaste tu contraseña</p>
                        </div>
                        <div style="width: 30%;">
                        <p id='registro' class="vinculos"> Registrate</p>
                        </div>
                    </div>
                    <div style="width: 80%; text-align: center; margin-top:25px;">
                        <input class="btn_ingreso" type="button" id="acceso" value="Ingresa">
                    </div>

                </div>
                <div id="ventanarecuperacion" style="width: 90%; justify-items: center; display: none;">
                    <div style="width: 80%">
                        <div style="margin-bottom: 20px; text-align: center; color: white; font-weight: 600 ;">
                            <h3 style="color:#6ec7ec;">GEOLINK</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="usuariorecuperacion" placeholder="usuariorecuperacion">
                            <label for="usuariorecuperacion">Usuario Registrado</label>
                        </div>
                        <div class="form-floating mb-3" style="padding: 0px !important; margin-bottom: 5px !important;" style="margin-bottom: 0px !important; padding-bottom: 9px !important;">
                            <input type="email" class="form-control" id="correo_usuariorecuperacion" placeholder="* Correo">
                            <label for="correo_usuariorecuperacion">* Correo Registrado</label>
                        </div>
                        <div style="width: 80%; display: flex; align-items: self-end;">
                            <div style="width: 40%;">
                                <p id='regresar' class="vinculos">Regresar</p>
                            </div>
                            <div style="width: 60%; text-align: center; margin-top:25px;">
                                <input id="btnregistrosds" class="btn_ingreso" type="button" value="Registro">
                            </div>    
                        </div>

                    </div>
                </div>

            </div>

            <div id='cuadrooculta' class="cuadro50porcen_oculta">
                <div style="display:flex; justify-content: center; gap:30px; margin-top: 20%;">
                    <div>
                        <img src="{{ asset('img/icono_geolink.png') }}" alt="iconogeolink" style="width: 70px;">
                    </div>
                    <div style="align-content: center;">
                        <h2 style="font-weight: 700; color:white;">GEOLINK</h2>
                    </div>
                </div>
                <div style="display:flex; justify-content: center; gap:30px; margin-top: 5%;">
                    <p style="font-weight: 700; color:white;">Network Path Discovery</p>
                </div>
            </div>
            <div class="cuadro50porcen"><!--REGISTRO USUARIO-->
            <div style="width: 90%; justify-items: center;">
                        <div style="text-align: left; margin-bottom: 20px; color: white; font-weight: 600 ;">
                            <h5 style="color:#6ec7ec;">REGISTRO GEOLIK</h5>
                        </div>
                    <div style="width: 80%">
                        <div class="form-floating mb-3" style="padding: 0px !important; margin-bottom: 5px !important;">
                            <input type="text" class="form-control" id="Nombre_usuario" placeholder="* Nombre Completo" style="margin-bottom: 0px !important; padding-bottom: 9px !important;">
                            <label for="Nombre_usuario">* Nombre</label>
                        </div>
                    </div>
                    <div style="width: 80%">
                        <div class="form-floating mb-3" style="padding: 0px !important; margin-bottom: 5px !important;" style="margin-bottom: 0px !important; padding-bottom: 9px !important;">
                            <input type="text" class="form-control" id="usuario_registrado" placeholder="* Usuario">
                            <label for="usuario_registrado">* Usuario</label>
                        </div>
                    </div>
                    <div style="width: 80%">
                        <div class="form-floating mb-3" style="padding: 0px !important; margin-bottom: 5px !important;" style="margin-bottom: 0px !important; padding-bottom: 9px !important;">
                            <input type="email" class="form-control" id="correo_usuario" placeholder="* Correo">
                            <label for="correo_usuario">* Correo</label>
                        </div>
                    </div>
                    <div style="width: 80%; ">
                        <div class="form-floating mb-3" style="padding: 0px !important; margin-bottom: 5px !important;" style="margin-bottom: 0px !important; padding-bottom: 9px !important;">
                            <input type="password" class="form-control" id="Password_usuario" placeholder="* Contraseña">
                            <label for="Password_usuario">* Contraseña</label>
                        </div>
                    </div>
                    <div style="width: 80%; ">
                        <div class="form-floating mb-3" style="padding: 0px !important; margin-bottom: 5px !important;" style="margin-bottom: 0px !important; padding-bottom: 9px !important;">
                            <input type="password" class="form-control" id="Password_verificado" placeholder="* Verifique Contraseña">
                            <label for="Password_verificado">* Verifique Contraseña</label>
                        </div>
                    </div>
                    <div style="width: 80%; display: flex; align-items: self-end;">
                        <div style="width: 40%;">
                            <p id='yatengousuario' class="vinculos">Ya Tengo Usuario</p>
                        </div>
                        <div style="width: 60%; text-align: center; margin-top:25px;">
                            <input id="btnregistro" class="btn_ingreso" type="button" value="Registro">
                        </div>    
                    </div>
                    
                    

                </div>
            </div>
        </div>
        <div>

        </div>
    </div>

    <!--<a href="{{route('welcome')}}">link</a> forma de llamar a un hipervinculo dentro de laravel -->
</body>
</html>

<script>

$('#recuperadorcontrasenia, #regresar').click(function (){

    const ventanaingreso = $('#ventanaingreso')
    const ventanarecuperacion = $('#ventanarecuperacion')

    const recuperadorcontrasenia = $('#recuperadorcontrasenia')

    if(ventanaingreso.css('display') === 'none'){
        
        ventanarecuperacion.css('opacity',0)
        ventanarecuperacion.toggleClass('girar')
        ventanaingreso.removeClass('girar')
        

        setTimeout(() => {
            ventanaingreso.css('display','block');
            ventanarecuperacion.css('display','none');
            ventanaingreso.css('opacity',1)
        }, 1000);

    } else{

        ventanaingreso.toggleClass('girar')
        ventanarecuperacion.removeClass('girar')
        ventanaingreso.css('opacity',0)
        

        setTimeout(() => {
            ventanaingreso.css('display','none');
            ventanarecuperacion.css('display','block');
            ventanarecuperacion.css('opacity',1)
        }, 2000);
    }

    
    



})

    

    



</script>

