
let usuario = [];

function contrasenia(){
    
    const vercontrasenia = $('#vercontrasenia')
    const Password = $('#Password')
    if (Password.attr('type') === 'password' ) {
        vercontrasenia.attr("src","img/ocultar_contrasenia.png")
        
        Password.attr('type','text')
    }else{
        
        vercontrasenia.attr("src","img/ver_contrasenia.png")
        Password.attr('type','password')
    }


}
function contraseniaverificada(){
    
    const vercontrasenia = $('#vistaPassword_usuario')
    const Password = $('#Password_usuario')
    if (Password.attr('type') === 'password' ) {
        vercontrasenia.attr("src","img/ocultar_contrasenia.png")
        
        Password.attr('type','text')
    }else{
        
        vercontrasenia.attr("src","img/ver_contrasenia.png")
        Password.attr('type','password')
    }


}
function contraseniaverificada2(){
    
    const vercontrasenia = $('#vistaPassword_usuario2')
    const Password = $('#Password_verificado')
    if (Password.attr('type') === 'password' ) {
        vercontrasenia.attr("src","img/ocultar_contrasenia.png")
        
        Password.attr('type','text')
    }else{
        
        vercontrasenia.attr("src","img/ver_contrasenia.png")
        Password.attr('type','password')
    }


}
function contraseniaverificada3(){
    
    const vercontrasenia = $('#verrecuperacionPassword')
    const Password = $('#recuperacionPassword')
    if (Password.attr('type') === 'password' ) {
        vercontrasenia.attr("src","img/ocultar_contrasenia.png")
        
        Password.attr('type','text')
    }else{
        
        vercontrasenia.attr("src","img/ver_contrasenia.png")
        Password.attr('type','password')
    }


}
function contraseniaverificada4(){
    
    const vercontrasenia = $('#verrecuperacionPassword2')
    const Password = $('#recuperacionPassword2')
    if (Password.attr('type') === 'password' ) {
        vercontrasenia.attr("src","img/ocultar_contrasenia.png")
        
        Password.attr('type','text')
    }else{
        
        vercontrasenia.attr("src","img/ver_contrasenia.png")
        Password.attr('type','password')
    }


}

$('#vercontrasenia').click(contrasenia);
$('#vistaPassword_usuario').click(contraseniaverificada);
$('#vistaPassword_usuario2').click(contraseniaverificada2);
$('#verrecuperacionPassword').click(contraseniaverificada3);
$('#verrecuperacionPassword2').click(contraseniaverificada4);

function consultausuario() {

    const correo = $('#correo_usuariorecuperacion').val().trim();
    

    return $.ajax({

        url: '/consuluser',
        method: 'POST',

        data: {
            correo: correo,
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function(response) {

            console.log('Respuesta:', response);

            if (response.data && response.data.length > 0) {

                const usuarioEncontrado = response.data[0];

                usuario = [
                    usuarioEncontrado.id,
                    usuarioEncontrado.nombre,
                    usuarioEncontrado.correo,
                    usuarioEncontrado.usuario
                ];

                corre();

              
            } else {

                console.log('No se encontró ningún usuario con ese correo');
                alert('Correo no registrado en GEOLINK. Verifica el correo ingresado.')

            }
        },

        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}


function nuevacontrasenia() {
    
    const recuperacionPassword = $('#recuperacionPassword').val();
    const recuperacionPassword2 = $('#recuperacionPassword2').val();
    const divneuvacontrase = $('#divneuvacontrase');

    return $.ajax({

        url:'/recupass',
        method:'POST',
        data:{
            usuario:usuario[0],
            recuperacionPassword:recuperacionPassword,
            recuperacionPassword2:recuperacionPassword2,
            nomusuario:usuario[3],

             _token: $('meta[name="csrf-token"]').attr('content')

        },

        success: function(response){
                alert(response.mensaje)
                divneuvacontrase.css('display','none')
                accusousuario();
        },
       error: function(xhr) {
            let respuesta = JSON.parse(xhr.responseText);
            alert(respuesta.mensaje);
        }

    });


}


$('#btnnuevopass').click(nuevacontrasenia)

function accusousuario(){
    const ventanaingreso = $('#ventanaingreso')
    const ventanarecuperacion = $('#ventanarecuperacion')

    const inputcorreorecuperacion = $('#inputcorreorecuperacion')
    const inputcodigoderecuperacion = $('#inputcodigoderecuperacion')
    const mensaje = $('#mensaje')
    const btnregistrosds = $('#btnregistrosds')

    inputcorreorecuperacion.css('display','block')
    inputcodigoderecuperacion.css('display','none')
    mensaje.css('display','none')
    btnregistrosds.val('Registro')

    
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
}

function corre(){

        let codigo = Math.floor(Math.random() * 9000) + 1000
        let mensaje  = $('#mensaje');
        let inputcorreorecuperacion  = $('#inputcorreorecuperacion');
        let inputcodigoderecuperacion  = $('#inputcodigoderecuperacion');
        let btnregistrosds  = $('#btnregistrosds');
        let correousuario = usuario[2];


       
        $.ajax({
        url: '/enviar-correo',
        type: 'POST',

        data: {
            correo: correousuario,
            mensaje: 'Hola, este es tu codigo de recuperacion de contraseña para GEOLINK',
            codigo: codigo,
            iduser: usuario[0],
            solicitado: usuario[3],


            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function(respuesta) {

            console.log(respuesta);

            if (respuesta.exito) {
                mensaje.css('display','flex')
                inputcorreorecuperacion.css('display','none')
                inputcodigoderecuperacion.css('display','block')
                btnregistrosds.val('Aceptar')
            }
        },

        error: function(xhr) {
            console.log(xhr.responseText);
            alert('Error al enviar el correo');
        }
    });
}

function verificacion(){

    const datorecuperacion = $('#codigorecuperacion').val();
    const idusuario = usuario[0];
    const divneuvacontrase = $('#divneuvacontrase')


    return $.ajax({
        url:'/consultarecupearacion',
        method:'POST',
        data: {
            datorecuperacion:datorecuperacion,
            idusuario:idusuario,
             _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            if(response.estado){
                alert('Codigo Verificado! Ingresa contraseña Nueva de usuario.')
                divneuvacontrase.css('display','block')


            }else{
                alert('Verifica Codigo de recuperacion. Codigo Invalido')
                return
            }
        },
        error: function(xhr){
            console.log(xhr.responseText)
        }
    })


}

$('p').click(function() {

    const valor = $(this).text();
    const inputcorreorecuperacion = $('#inputcorreorecuperacion');
    const inputcodigoderecuperacion = $('#inputcodigoderecuperacion');
    const btnregistrosds = $('#btnregistrosds');
    const mensaje = $('#mensaje');

    if(valor === 'Ya tengo un codigo'){
        inputcorreorecuperacion.css('display','none')
        inputcodigoderecuperacion.css('display','block')
        mensaje.css('display','flex')
        btnregistrosds.val('Aceptar')
    }
 
});

$('#btnregistrosds').click( function (){

    const valor = $('#btnregistrosds').val();

    if(valor === 'Registro'){
        consultausuario()
    }
    if(valor === 'Aceptar'){
        verificacion()
    }


});

$('#btnregistro').click(function (){

    const correo = $('#correo_usuario').val().trim().toLowerCase();
    const user = $('#usuario_registrado').val().trim().toLowerCase();
    alert(user)
    alert(correo)

    $.ajax({

        url:'/existente',
        method: 'POST',
        data:{

            correo: correo,
            user: user,

        
            _token:$('meta[name="csrf-token"]').attr('content')
        },

        success:function(respuesta){
            console.log(respuesta.mensaje);
           if(respuesta.existe){
                alert('Usuario ya registrado en GEOLINK')
                    $('#cuadrooculta').addClass('cuadro50porcen_dre');
                    $('#cuadrooculta').removeClass('cuadro50porcen_izq');
                    recupracontras()
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
    
    const usuario = $('#usuario').val().trim().toLowerCase();
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
    const usuario_registrado = $('#usuario_registrado').val().trim().toLowerCase()
    const usuariocreado = $('#usuario');
    const correo = $('#correo_usuario').val().trim().toLowerCase()
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

function recupracontras(){

    const ventanaingreso = $('#ventanaingreso')
    const ventanarecuperacion = $('#ventanarecuperacion')

    
    ventanaingreso.css('display','none')

    if(ventanaingreso.css('display') === 'none'){
        
         ventanaingreso.toggleClass('girar')
        ventanarecuperacion.removeClass('girar')
        ventanaingreso.css('opacity',0)
        

        setTimeout(() => {
            ventanaingreso.css('display','none');
            ventanarecuperacion.css('display','block');
            ventanarecuperacion.css('opacity',1)
        }, 500);
    }
}