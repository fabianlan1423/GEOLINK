<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>GEOLIK REGISTRO</title>
</head>
<body class="bod">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    

    <div style="display: flex; justify-content: center; margin-top: 10%;">
        <div class="cuadroregistro">
            <div class="cuadro50porcen"><!--INGRESO-->
                <div style="width: 90%; justify-items: center;">
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
                            <p class="vinculos">Olviste tu contrase</p>
                        </div>
                        <div style="width: 30%;">
                        <p id='registro' class="vinculos"> Registrate</p>
                        </div>
                    </div>
                    <div style="width: 80%; text-align: center; margin-top:25px;">
                        <input class="btn_ingreso" type="button" id="acceso" value="Ingresa">
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
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Nombre_usuario" placeholder="* Nombre Completo">
                            <label for="Nombre_usuario">* Nombre</label>
                        </div>
                    </div>
                    <div style="width: 80%">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="correo_usuario" placeholder="* Correo">
                            <label for="correo_usuario">* Correo</label>
                        </div>
                    </div>
                    <div style="width: 80%; ">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="Password_usuario" placeholder="* Contraseña">
                            <label for="Password_usuario">* Contraseña</label>
                        </div>
                    </div>
                    <div style="width: 80%; ">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="Password_verificado" placeholder="* Verifique Contraseña">
                            <label for="Password_verificado">* Verifique Contraseña</label>
                        </div>
                    </div>
                    <div style="width: 70%;">
                        <p id='yatengousuario' class="vinculos">Ya Tengo Usuario</p>
                    </div>
                    <div style="width: 80%; text-align: center; margin-top:25px;">
                        <input id="btnregistro" class="btn_ingreso" type="button" value="Registro">
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

$('#btnregistro').click(function (){

    const nombre = $('#Nombre_usuario').val()
    const correo = $('#correo_usuario').val()
    const contrasenia1 = $('#Password_usuario').val()
    const contrasenia2 = $('#Password_verificado').val()

    if(contrasenia1.length < 8){
        alert('Contraseña debe tener almenos 8 caracteres')
        return;
    }

    if(contrasenia1 != contrasenia2){
        alert('Contraseña no valida');
        return;
    }

    $.ajax({
        url:'/registro_usuario',
        type:'POST',
        data:{
            nombre:nombre,
            correo:correo,
            contrasenia1:contrasenia1,

            _token:$('meta[name="csrf-token"]').attr('content')

        },
        success:function(respuesta){
            alert('Usuario registrado con exito');
        },
        error:function(error){
            alert('Error en registro de usuario '+ error)
        },
        error:function(xhr){

        console.log(xhr.responseText);

        }
    });

});



$('#registro').click(function(){

    $('#cuadrooculta').addClass('cuadro50porcen_izq');
    $('#cuadrooculta').removeClass('cuadro50porcen_dre');

    
});
$('#yatengousuario').click(function(){

    $('#cuadrooculta').addClass('cuadro50porcen_dre');
    $('#cuadrooculta').removeClass('cuadro50porcen_izq');
    
});



</script>