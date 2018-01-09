////////////////////////////////////////////////////////////////////////////////
var cadaXminutos = 60 * 1000 * 1;
////////////////////////////////////////////////////////////////////////////////


var requestPost = function(formId, cUrl, params){
    console.debug('requestPost',formId, cUrl, params);
    $.ajax({
        type: "POST",
        url: cUrl,
        data: params,
        success: function( data ) {
            $('.modal').modal('hide');
            toastr.success("Acción ejecutada con exito!");
            console.info('OK > requestPost', data);
            $('.modal form')[0].reset();
        },
        error:function(err, ){
            $('.modal').modal('hide');
            toastr.error("Ocurrió un problema, por favor contactate con soporte@tuconsorcio.com.ar");
            console.error('ERROR > requestPost', formId, err);
        }
    });
}//requestPost

var requestGet = function(formId, cUrl, Id){
    console.debug('requestGet',formId, cUrl, Id);
    $.getJSON(cUrl+'/'+Id, function( data ) {
        console.info('getJSON > ', data);
        return data;
    });
}//requestGet

var requestCustom = function(formId, cUrl, Id){
    console.debug('requestCustom',formId, cUrl, Id);
    $('.modal form input[name="tiempo"]').val('');
    $.ajax({
        type: "GET",
        url: cUrl+'/'+Id,
        success: function( data ) {
            if(data && data.length>0){
                $('.modal form input[name="tiempo"]').val(data[0].pro_fecha+' '+data[0].pro_hora);
                $('.modal form input[type="submit"]').attr('data-id', data[0].pro_id);
                console.info('OK > requestCustom', data);
                toastr.success("Acción ejecutada con exito!");
            }
        },
        error:function(err){
            //console.error('ERROR > requestCustom', err);
            //toastr.error("Ha ocurrido un problema, intentalo nuevamente o contacta a soporte.");
        }
    });
}//requestCustom

var requestJson = function(cUrl, Id){
    console.debug('requestJson', cUrl, Id);
    return $.getJSON(cUrl+'/'+Id, function( data ) {
        console.info('getJSON > ', data);
        return data;
    });
}//requestJson

var borrar = function(cUrl, Id){
    console.debug('requestGet', cUrl, Id);
    if (confirm("Desea eliminar este registro?")) {
        toastr.success("Acción ejecutada con exito!");
        console.info('requestDelete > OK');
        setTimeout(function(){
            window.location='/'+cUrl+'/'+Id+'/delete';
        },3000);
    } else {
        //toastr.info("Acción abortada!");
    }
}//requestGet

var mostrar = function(id){
    $.getJSON('alertas/json/'+id, function( data ) {
        var d = data.results;
        $('#mostrar').modal('show');
        $('#mostrar .modal-title').html(d.ale_asunto);
        $('#mostrar .modal-body').html(d.ale_cuerpo);
        console.log('mostrar > requestJson', d.ale_id);
    });
}

var move = function(url){
    window.location=url;
}

var importar = function(id){
    $('#importar').modal('show');
    $('#importar form #_id').val(id);
    console.log('importar > _id', id);
};

var masivos = function(id){
    $('#masivos').modal('show');
    $('#masivos form #_id').val(id);
    console.log('masivos > _id', id);
};

var send = function(id){
    $('#enviar').modal('show');
    $('#enviar form #_id').val(id);
    console.log('send > _id', id);
};
var agenda = function(id, ruta){
    $('#programar').modal('show');
    $('#programar form #_id').val(id);
    startTime();
    requestCustom('programar', '/'+ ruta +'/programado', id);
    console.log('agenda > _id', id);
};
var passwords = function(id){
    $('#passwords').modal('show');
    $('#passwords form #_id').val(id);
    console.log('passwords > _id', id);
};
var getData = function(tipo){
    $.getJSON('/comprobar/'+tipo, function( data ) {
        console.log('getData()', tipo, moment().unix());
        var d = data.results;
        for(var i = 0; i<d.length; i++){
            var status = parseFloat(d[i].pro_enviado);
            if(status==0) {
                $('#programado'+d[i].pro_envio+" i").addClass('text-success');
                //console.log('programado', '#programado'+d[i].pro_envio);
            } else {
                $('#programado'+d[i].pro_envio+" i").removeClass('text-success');
            }
        }
    });
};
var eliminar = function(ruta,id,campo,archivo){
    $.getJSON('/archivos/eliminar/'+ruta+'/'+id+'/'+campo+'/'+archivo, function( data ) {
        console.log('Eliminado', moment().unix(), data);
        toastr.success("Acción ejecutada con exito!");
        setTimeout(function(){
            location.reload();
        },1000);
    });
};
var setStatus = function(ruta,id){
    $.getJSON('/'+ruta+'/'+id, function( data ) {
        console.log('Status', ruta, id, data);
        if(data && data.lenght>0){
            toastr.success("Acción ejecutada con exito!");
            setTimeout(function(){
                location.reload();
            },1000);
        } else {
            toastr.error("Ha ocurrido un problema, por favor, contacta a soporte@tuconsorio.com.ar");
        }
    });
};

// Calendario
var getCalendar = function(values){
    //https://fullcalendar.io/docs/
    //var data = "<?=json_encode($results)?>";
    $('#calendar').fullCalendar({
        locale: 'es',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listDay,listWeek,month'
        },
        views: {
            listDay: { buttonText: 'Diario' },
            listWeek: { buttonText: 'Semana' }
        },
        defaultView: 'month',
        //defaultDate: '2017-11-12',
        navLinks: true,
        eventClick: function(calEvent, jsEvent, view) {
            $('#calendario').modal('show');
            //$('#calendario .modal-title').html('Fecha: '+ calEvent.start);
            $('#calendario .modal-body').html('Evento: '+calEvent.title);
            $(this).css('background-color', 'red');
        },
        events: values
    });
}

function today() {
    var days = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    var months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiempre','Octubre','Noviembre','Diciembre'];
    var today = new Date();
    var d = today.getHours();
    var m = today.getMonth();
    var y = today.getFullYear()();
    m = checkTime(m);
    s = checkTime(s);
    $('#hoy').html('Hoy es '+ d + " / " + m + " / " + y);
}
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    $('.modal .help-block span').html(' Hora actual: '+ h + ":" + m + ":" + s);
    //console.log( h + ":" + m);
    var t = setTimeout(startTime, 1000);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

var getAll=function(){
    getData('masivos');
    getData('envios');
    getData('alertas');
}

var toSelect = function(container,value,data,keyTag,labelTag,disabled){
    $('#'+container).replaceWith('<select id="'+container+'" name="'+container+'" class="form-control"></select>');
    var values = "";
    for(var i = 0; i < data.length; i++){
        values += '<option value="'+ data[i][keyTag] +'">'+ data[i][labelTag] +'</option>';
    }
    $('#'+container).append(values);
    if(value){
        $('#'+container).val(value);
    }
    if(disabled){
        $('#'+container).attr('disabled','disabled');
    }
}

////////////////////////////////////////////////////////////////////////////////
$(function(){
    // tooltips
    $('[data-toggle="tooltip"]').tooltip();

    //consorcios
    $('#contacto').on('click', function () {
        $('#m_quick_sidebar_toggle').click();
    });
    $('#btnSidebar').on('click', function (event) {
        event.preventDefault();
        var formId = "#comentar";
        var cUrl = "/comentarios/send";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            com_propietario : $('#com_propietario').val(),
            com_email : $('#com_email').val(),
            com_telefono : $('#com_telefono').val(),
            com_departamento : $('#com_departamento').val(),
            com_consulta : $('#com_comentarios').val(),
            com_consorcio :  $('#com_consorcio').val(),
            com_inmobiliaria :  $('#com_inmobiliaria').val(),
        }
        console.info('Sidebar', params);
        $.ajax({
            type: "POST",
            url: cUrl,
            data: params,
            success: function( data ) {
                $('.modal').modal('hide');
                console.info('OK > Sidebar', data);
                $(formId)[0].reset();
                $('#m_quick_sidebar_toggle').click();
                toastr.success("Gracias por escribirnos, a la brevedad te responderemos");
            },
            error:function(err){
                $('#m_quick_sidebar_toggle').click();
                console.error('ERROR > Sidebar', err);
                toastr.error("Ocurrió un problema, por favor contactate con soporte@tuconsorcio.com.ar");
            }
        });
    });

    // Alertas
    $('#btnSoloAlertas').on('click', function (event) {
        event.preventDefault();
        var formId = "#enviar";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            _id : $(formId +' #_id').val(),
            email : $(formId +' #email').val(),
            custom: 1,
        }
        var cUrl = "/alertas/inmediato";
        requestPost('alertas', cUrl, params);
    });
    $('#btnAllAlertas').on('click', function (event) {
        event.preventDefault();
        var formId = "#enviar";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            _id : $(formId +' #_id').val(),
            custom: 0,
        }
        var cUrl = "/alertas/inmediato";
        requestPost('alertas', cUrl, params);
    });
    $('#btnProgramarAlertas').on('click', function (event) {
        event.preventDefault();
        var formId = "#programar";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            _id : $(formId +' #_id').val(),
            tiempo: $(formId +' input[name="tiempo"]').val(),
        }
        var cUrl = "/alertas/programar";
        requestPost('alertas', cUrl, params);
    });
    $('#btnAnularAlertas').on('click', function (event) {
        event.preventDefault();
        var formId = "#programar";
        var cUrl = "/alertas/cancelar";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            pro_id : $(this).attr('data-id'),
        }
        requestPost(formId, cUrl, params);
        setTimeout(function(){
            location.reload();
        },3000);
    });

    // Envios de Expensas
    $('#btnSoloEnvio').on('click', function (event) {
        event.preventDefault();
        var params = {
            _token : $('input[name="_token"]').val(),
            _id : $('#_id').val(),
            email : $('#email').val(),
            custom: 1,
        }
        var cUrl = "/envios/inmediato";
        requestPost('expensas', cUrl, params);
    });
    $('#btnAllEnvio').on('click', function (event) {
        event.preventDefault();
        var params = {
            _token : $('input[name="_token"]').val(),
            _id : $('#_id').val(),
            custom: 0,
        }
        var cUrl = "/envios/inmediato";
        requestPost('expensas', cUrl, params);
    });
    $('#btnProgramar').on('click', function (event) {
        event.preventDefault();
        var formId = "#programar";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            _id : $(formId +' #_id').val(),
            tiempo: $(formId +' input[name="tiempo"]').val(),
        }
        var cUrl = "/envios/programar";
        console.info('expensas', params)
        requestPost('expensas', cUrl, params);
    });
    $('#btnAnularEnvios').on('click', function (event) {
        event.preventDefault();
        var formId = "#programar";
        var cUrl = "/envios/cancelar";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            pro_id : $(this).attr('data-id'),
        }
        requestPost(formId, cUrl, params);
        setTimeout(function(){
            location.reload();
        },3000);
    });

    // Alertas Masivas
    $('#btnSoloAlertasM').on('click', function (event) {
        event.preventDefault();
        var formId = "#alertas_masivas";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            _id : $(formId +' #_id').val(),
            email : $(formId +' #email').val(),
            custom: 1,
        }
        var cUrl = "/masivos/inmediato";
        //console.log('btnSoloAlertas', params);
        requestPost('masivos', cUrl, params);
    });
    $('#btnAllAlertasM').on('click', function (event) {
        event.preventDefault();var formId = "#alertas_masivas";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            _id : $(formId +' #_id').val(),
            custom: 0,
        }
        var cUrl = "/masivos/inmediato";
        requestPost('masivos', cUrl, params);
    });
    $('#btnProgramarAlertasM').on('click', function (event) {
        event.preventDefault();
        var formId = "#programar #alertas_masivas";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            _id : $(formId +' #_id').val(),
            tiempo: $(formId +' input[name="tiempo"]').val(),
        }
        var cUrl = "/masivos/programar";
        requestPost('masivos', cUrl, params);
    });
    $('#btnAnularAlertasM').on('click', function (event) {
        event.preventDefault();
        var formId = "#programar #alertas_masivas";
        var cUrl = "/masivos/cancelar";
        var params = {
            _token : $(formId +' input[name="_token"]').val(),
            pro_id : $(this).attr('data-id'),
        }
        requestPost(formId, cUrl, params);
    });

    $('#btnSoloPassword').on('click', function (event) {
        event.preventDefault();
        var params = {
            _token : $('input[name="_token"]').val(),
            _id : $('#_id').val(),
            email : $('#email').val(),
            custom: 1,
        }
        var cUrl = "/propietarios/passwords";
        requestPost('passwords', cUrl, params);
    });
    $('#btnAllPassword').on('click', function (event) {
        event.preventDefault();
        var params = {
            _token : $('input[name="_token"]').val(),
            _id : $('#_id').val(),
            custom: 0,
        }
        var cUrl = "/propietarios/passwords";
        requestPost('passwords', cUrl, params);
    });

    // getAll();
    // setTimeout(function(){
    //     //getAll.init();
    //     getAll();
    // }, cadaXminutos) // cada 5 minutoss

});// End
