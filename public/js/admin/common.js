;

var common_ops = {
    init:function(){
        this.eventBind();
        this.setIconLight();
    },
    eventBind:function(){

    },
    setIconLight:function(){
        var pathname = window.location.pathname;
        var nav_name = null;
    },
    buildAdminUrl:function( path ,params){
        var url =   "/admin" + path;
        var _paramUrl = '';
        if( params ){
            _paramUrl = Object.keys(params).map(function(k) {
                return [encodeURIComponent(k), encodeURIComponent(params[k])].join("=");
            }).join('&');
            _paramUrl = "?"+_paramUrl;
        }
        return url + _paramUrl

    },



};

$(document).ready( function() {
    common_ops.init();
});