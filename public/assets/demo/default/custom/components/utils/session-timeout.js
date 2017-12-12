var SessionTimeoutDemo=function(){
    var e=function(){
        $.sessionTimeout({
            title:"Ha expirado la sesión",
            message:"Debes iniciar nuevamente para continuar dentro de tuconsorcio.com.ar",
            keepAliveUrl: '/keepalive',
            redirUrl:"/",
            logoutUrl:"/logout",
            warnAfter:900000,
            redirAfter:1200000,//35e3
            ignoreUserActivity:!0,
            countdownMessage:"Redireccionando en {timer} segundos.",
            countdownBar:!1,
        });
        $('#session-timeout-dialog-logout').text('Salir');
        $('#session-timeout-dialog-keepalive').remove();
    };
    return{
        init:function(){
            e();
        }
    }
}();
jQuery(document).ready(function(){
    SessionTimeoutDemo.init();
});
