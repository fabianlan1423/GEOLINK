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
        <div class="cuadroregistro" id="cuadroderegistro">
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
                            <p class="vinculos">Olvidaste tu contraseña</p>
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


$('#btnregistro').click(function (){

    const correo = $('#correo_usuario').val();

    $.ajax({

        url:'/existente',
        method: 'POST',
        data:{

            correo: correo,
        
            _token:$('meta[name="csrf-token"]').attr('content')
        },

        success:function(respuesta){
            console.log(respuesta.mensaje);
           if(respuesta.existe){
                alert('Usuario ya registrado en GEOLINK')
           }else{
                
                console.log('Creacion de usuario en proceso.')
                registro();
                
           }
            
        },
        error:function(xhr){

        alert(xhr.responseText);

        }

    });



});


$('#acceso').click(function (){

    const usuario = $('#usuario').val();
    const password = $('#Password').val();

    $.ajax({

        url:'/acceso',
        method: 'POST',
        data:{

            usuario:usuario,
            password:password,

            _token:$('meta[name="csrf-token"]').attr('content')


        },
        success:function(response){
            if(response.existe){
                    console.log('Usuario existente Acceso permitido')
                     window.location.href = '/geolink';
            }else{
                alert('Usuario no registrado en GEOLINK')
            }

        }


    });

});



function registro(){    

    const nombre = $('#Nombre_usuario').val()
    const usuario_registrado = $('#usuario_registrado').val()
    const usuariocreado = $('#usuario');
    const correo = $('#correo_usuario').val()
    const contrasenia1 = $('#Password_usuario').val()
    const contrasenia2 = $('#Password_verificado').val()

    
    if(contrasenia1.length < 8){
        alert('Contraseña debe tener al menos 8 caracteres')
        return;
    }

    if(!correo.includes('@') || !(correo.includes('.com') || correo.includes('.co'))){
        alert('Correo Electrónico no valido')
        return
    }

    if(contrasenia1 != contrasenia2){
        alert('Verificación de contraseña NO coinciden');
        return;
    }

    $.ajax({
        url:'/registro_usuario',
        type:'POST',
        data:{
            nombre:nombre,
            correo:correo,
            contrasenia1:contrasenia1,
            usuario_registrado:usuario_registrado,

            _token:$('meta[name="csrf-token"]').attr('content')

        },
        success:function(respuesta){
            alert('Usuario registrado con exito');

            $('#cuadrooculta').addClass('cuadro50porcen_dre');
            $('#cuadrooculta').removeClass('cuadro50porcen_izq');
            usuariocreado.val($('#usuario_registrado').val());
            $('#correo_usuario').val('');
            $('#usuario_registrado').val('');
            $('#Nombre_usuario').val('');
            $('#Password_usuario').val('');
            $('#Password_verificado').val('');
            
        },
        error:function(error){
            console.log(xhr.responseText);
            alert('Error en registro de usuario '+ error)
        }
    });

}



$('#registro').click(function(){

    $('#cuadrooculta').addClass('cuadro50porcen_izq');
    $('#cuadrooculta').removeClass('cuadro50porcen_dre');

    
});
$('#yatengousuario').click(function(){

    $('#cuadrooculta').addClass('cuadro50porcen_dre');
    $('#cuadrooculta').removeClass('cuadro50porcen_izq');
    
});



</script>