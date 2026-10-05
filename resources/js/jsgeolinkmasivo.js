
//descarga de archivo de excel 
$('#descargaexcel').click(function (){

    descargaarchivo();

});

//adecuacion de tablas dato geom y creacion de index

function geomproyecto(){

    const estadocarguemasivo = $('#estadocarguemasivo'); 

$.ajax({

    url:'/geomproyec',
    method:'POST',
    data:{
            _token:$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){
        console.log('Creacion Geom exitosa en tabla proyectos'+response.mensaje)
        estadocarguemasivo.append('<br>&#10003; Creacion de llave para busqueda Exitosa ')
    },
    error:function(xhr){
        alert('Error en creacion geom tabla proyecto'+xhr.mensaje)
        estadocarguemasivo.append('<br>❌ Error en creacion de llave para busqueda')
    }

})


}


async function procesos(){

    const btnzc = $('#ZC');
    const btnza = $('#ZA');
    const btnnodo = $('#NODO');
    const btnfenix = $('#FENIX');
    const descargaexcel = $('#descargaexcel');
    const estadocarguemasivo = $('#estadocarguemasivo');
    const letraagua = $('#letraagua');

    try {

        descargaexcel.css('display','none')

        // ZONA CERRADA
        
        await truncatetabla();

        
        if(btnzc.is(':checked')){
            console.log('Ejecutando ZC');
            estadocarguemasivo.append("<br>⏳ Iniciando Zona Cerrada...");

            await zc();

        } else {
            estadocarguemasivo.append(
                "<br>🚨 Zona Cerrada no fue seleccionada para Calcular"
            );
        }


        // ZONA ABIERTA
        if(btnza.is(':checked')){
            console.log('Ejecutando ZA');
            estadocarguemasivo.append("<br>⏳ Iniciando Zona Abierta...");

            await za();

        } else {
            estadocarguemasivo.append(
                "<br>🚨 Zona abierta no fue seleccionada para Calcular"
            );
        }


        // NODO
        if(btnnodo.is(':checked')){
            console.log('Ejecutando NODO');
            estadocarguemasivo.append("<br>⏳ Iniciando Nodo...");

            await nodo();

        } else {
            estadocarguemasivo.append(
                "<br>🚨 Nodo no fue seleccionado para Calcular"
            );
        }


        // FENIX
        if(btnfenix.is(':checked')){
            console.log('Ejecutando FENIX');
            estadocarguemasivo.append("<br>⏳ Iniciando Nodo Fenix...");

            await nodofenix();

        } else {
            estadocarguemasivo.append(
                "<br>🚨 Nodo Fenix no fue seleccionado para Calcular"
            );
        }


        estadocarguemasivo.append(
            
            "<br><br>🏁 <b>Consulta masiva terminada.</b>"
            

            
        );
            descargaexcel.css('display','block')
            letraagua.css('display','none')

    } catch(error) {

        console.error('Error en procesos:', error);

        estadocarguemasivo.append(
            "<br>❌ El proceso se detuvo debido a un error."
        );
    }
}
//ejecucion za 
function descargaarchivo() {

    const estadocarguemasivo = $('#estadocarguemasivo');
    const inputArchivo = $('#cargaarchivo')[0];

    // Validar que haya archivo seleccionado
    if (!inputArchivo.files.length) {
        alert('Debe seleccionar un archivo.');
        return;
    }

    // Obtener solamente el nombre
    const cargaarchivo = inputArchivo.files[0].name;

    $.ajax({
        url: '/exportaarchivo',
        method: 'POST',
        data: {
            cargaarchivo: cargaarchivo,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function(response, status, xhr) {

            // Obtener el nombre enviado por Laravel
            let nombreArchivo = 'respuesta.csv';

            const disposition = xhr.getResponseHeader('Content-Disposition');

            if (disposition && disposition.indexOf('filename=') !== -1) {
                nombreArchivo = disposition
                    .split('filename=')[1]
                    .replace(/"/g, '');
            }

            // Crear descarga
            const blob = new Blob([response], {
                type: 'text/csv;charset=utf-8;'
            });

            const url = window.URL.createObjectURL(blob);

            const enlace = document.createElement('a');
            enlace.href = url;
            enlace.download = nombreArchivo;

            document.body.appendChild(enlace);
            enlace.click();
            enlace.remove();

            window.URL.revokeObjectURL(url);

            estadocarguemasivo.append(
                "<br>&#10003; Archivo generado correctamente"
            );
        },

        error: function(xhr) {

            console.error(xhr);

            let mensaje = 'Ocurrió un error al generar el archivo';

            estadocarguemasivo.append(
                "<br>❌ Error al generar el archivo"
            );

            alert(mensaje);
        }
    });
}
function truncatetabla(){

    const estadocarguemasivo = $('#estadocarguemasivo'); 
  
    
    return $.ajax({
        url:'/limpiatabla',
        method:'POST',
        data:{
            
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            
            estadocarguemasivo.append("<br>&#10003; Limpieza exitosa de tabla Respuestas")
           
        },
        error: function(xhr) { 
            console.error(xhr); 
            let mensaje = 'Ocurrió un error za'; 
            if (xhr.responseJSON && xhr.responseJSON.message) { 
                mensaje = xhr.responseJSON.message; 
            } 
            estadocarguemasivo.append("<br>❌ error en la limpieza de la tabla Respuestas")
            alert(mensaje); 
        }
    })


}
function za(){

    const estadocarguemasivo = $('#estadocarguemasivo'); 
    const cantza = $('#cantza').val(); 
    
    return $.ajax({
        url:'/zamasivo',
        method:'POST',
        data:{
            cantza:cantza,
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            
            estadocarguemasivo.append("<br>&#10003; "+response.data)
            estadocarguemasivo.append("<br>&#10003; "+response.eliminados)
            

        },
        error: function(xhr) { 
            console.error(xhr); 
            let mensaje = 'Ocurrió un error za'; 
            if (xhr.responseJSON && xhr.responseJSON.message) { 
                mensaje = xhr.responseJSON.message; 
            } 
            estadocarguemasivo.append("<br>❌ "+mensaje)
            alert(mensaje); 
        }
    })


}
// CONSULTA ZC
function nodo(){

     const estadocarguemasivo = $('#estadocarguemasivo'); 
     const cantnodo = $('#cantnodo').val(); 
    

    return $.ajax({
        url:'/nodomasivo',
        method:'POST',
        data:{
            cantnodo:cantnodo,
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
                        
            estadocarguemasivo.append("<br>&#10003; "+response.data)
            estadocarguemasivo.append("<br>&#10003; "+response.eliminados)
            
        },
        error: function(xhr) { 
            console.error(xhr); 
            let mensaje = 'Ocurrió un error Nodo'; 
            if (xhr.responseJSON && xhr.responseJSON.mensaje) { 
                mensaje = xhr.responseJSON.mensaje; 
            } 
            estadocarguemasivo.append("<br>❌ "+mensaje)
            alert(mensaje); 
        }
    })


}
function nodofenix(){

     const estadocarguemasivo = $('#estadocarguemasivo'); 
     const catnfenix = $('#cantfenix').val(); 
    

    return $.ajax({
        url:'/fenixmasivo',
        method:'POST',
        data:{
            catnfenix:catnfenix,
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
                        
            estadocarguemasivo.append("<br>&#10003; "+response.data)
            estadocarguemasivo.append("<br>&#10003; "+response.eliminados)
                       

        },
        error: function(xhr) { 
            console.error(xhr); 
            let mensaje = 'Ocurrió un error Nodo'; 
            if (xhr.responseJSON && xhr.responseJSON.mensaje) { 
                mensaje = xhr.responseJSON.mensaje; 
            } 
            estadocarguemasivo.append("<br>❌ "+mensaje)
            alert(mensaje); 
        }
    })


}
function zc(){

    const estadocarguemasivo = $('#estadocarguemasivo'); 
    const cantzc = $('#cantzc').val(); 
     
    return $.ajax({
        url:'/zcmasivo',
        method:'POST',
        data:{
            cantzc:cantzc,
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            
            estadocarguemasivo.append("<br>&#10003; "+response.data)
            
        },
        error: function(xhr) { 
            console.error(xhr); 
            let mensaje = 'Ocurrió un error zc'; 
            if (xhr.responseJSON && xhr.responseJSON.message) { 
                mensaje = xhr.responseJSON.message; 
            } 
            estadocarguemasivo.append("<br>❌ "+mensaje)
            alert(mensaje); 
        }
    })


}

// carga de archivo a base de datos postgresql 

$('#procesarinfo').on('click', async function (e){

    const estadocarguemasivo = $('#estadocarguemasivo');
    const btnza = $('#ZA')
    const letraagua  = $('#letraagua')
    e.preventDefault();

    const archivo = $('#cargaarchivo')[0].files[0];

    if(!archivo){
        alert('Seleccione Archivo a procesar');
        return
    }

    letraagua.css('display','block');

    const formdata = new FormData()

    formdata.append('archivo', archivo);

    try{

        estadocarguemasivo.text('Cargando Archivo A Bases De Datos ..... ');

        const respuesta  = await fetch('/carga-datos', {

            method: 'POST',
            body: formdata,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const resultado = await respuesta.json();

        estadocarguemasivo.text(resultado.mensaje)
        console.log('Inicia geom')
        geomproyecto();
        procesos();
        
        
            
        

        
    } catch (error){
        
        alert(error)
        console.log('Error en proceso: '+error)
        letraagua.css('display','none');
         estadocarguemasivo.text('Error cargando el archivo')    

    }

});


$('#btncargaarchivo').click(function() {

    const estadocarguemasivo = $('#estadocarguemasivo');

    estadocarguemasivo.text('Carga De Archivo')
    
    $('#cargaarchivo').click();

});

$('#cargaarchivo').change(function () {  

    const archivo = this.files[0];
    const nombrearchivo = $('#nombrearchivo');
    const estadocarguemasivo = $('#estadocarguemasivo');


    if(archivo){
        nombrearchivo.text(archivo.name +'\n'+archivo.size / (1024 * 1024) +' MB')
        estadocarguemasivo.text('Archivo '+archivo.name+' Listo para procesar')
    }

});


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
$('#Menu').click(function () {
   
    window.location.href = '/menu';
    
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