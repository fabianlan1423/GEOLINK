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
$('#acceso').click(ingreso);



function ingreso(){
    
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
                    window.location.href = '/menu';
            }else{
                alert('Usuario no registrado en GEOLINK')
            }

        }


    });

}



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

$('#Password').on('keydown', function(event) {

if (event.key === 'Enter') {
    event.preventDefault();
    ingreso();
}

});