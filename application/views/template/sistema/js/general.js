/* 
 * Sistema Web Responsivo CDPBR 					*
 * @author	Strategic Solutions S.A. de C.V             	* 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Ene. 2024 09:00:00                        * 
 */
 
$(document).ready( function () { 
    $(".txt-mayus").keyup(function () { this.value = this.value.toLocaleUpperCase(); });
    $('[data-toggle="tooltip"]').tooltip({placement : 'top'}); 
});
function mayus(e) { e.value = e.value.toUpperCase(); }
function js_general_sistema_operativo() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;
    if (/windows phone/i.test(userAgent)) {
        return "Windows Phone";
    }
    if (/android/i.test(userAgent)) {
        return "Android";
    }
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "iOS";
    }
    return "unknown";
}
function js_general_solo_decimal(el, evt) { //onKeyPress="return js_general_solo_decimal(event)"
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot (thanks ddlab)
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}
function getSelectionStart(o) {
        if (o.createTextRange) {
                var r = document.selection.createRange().duplicate();
                r.moveEnd('character', o.value.length);
                if (r.text == '') return o.value.length;
                return o.value.lastIndexOf(r.text);
        } else return o.selectionStart;
}
function js_general_solo_numeros(e) { //onKeyPress="return js_general_solo_numeros(event)"
    if ((e.keyCode < 48) || (e.keyCode > 57)) 
    e.returnValue = false;   
}
function js_general_nit(e,t) { //onKeyPress="return js_general_solo_texto(event,this)"
    var regex = new RegExp("^[a-zA-Z0-9\\-]+$"); 
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode); 
    if (!regex.test(key)) { e.preventDefault(); return false; }
}
function js_general_solo_texto(e,t) { //onKeyPress="return js_general_solo_texto(event,this)"
    var regex = new RegExp("^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ]+$"); 
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode); 
    if (!regex.test(key)) { e.preventDefault(); return false; }
}
function js_general_solo_texto_espacios(e,t) { //onKeyPress="return js_general_solo_texto_espacios(event,this)"
    var regex = new RegExp("^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\\s]*$"); 
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode); 
    if (!regex.test(key)) { e.preventDefault(); return false; }
}
function js_general_solo_alfanumerico(e,t) { //onKeyPress="return js_general_solo_alfanumerico(event,this)"
    var regex = new RegExp("^[a-zA-Z0-9áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\\s]*$"); 
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode); 
    if (!regex.test(key)) { e.preventDefault(); return false; }
}
function js_general_valida_uploads_archivos(elemanto,formatos,js_general_msg_tamanio,js_general_msg_formato){
    var elemnto_id = '#'+elemanto;
    $(elemnto_id).on('change', function(){
        if (this.files[0].size>4194304){
            Swal.fire({ icon: 'error', allowOutsideClick:false, text: js_general_msg_tamanio});
            $('#'+this.id).val('').focus();
        } else {           
            var validExt = formatos;
            var ext = this.value.split('.').pop();
            if(validExt.indexOf(ext.toLowerCase()) == -1){
                Swal.fire({ icon: 'error',title: '',text: js_general_msg_formato});
                $('#'+this.id).val("").focus();
            } else {
                $('#'+this.id).html(this.files[0].name);
            }
        }
    });     
}
function js_general_valida_uploads_archivos_grandes(elemanto,formatos,js_general_msg_formato){
    var elemnto_id = '#'+elemanto;
    $(elemnto_id).on('change', function(){         
        var validExt = formatos;
        var ext = this.value.split('.').pop();
        if(validExt.indexOf(ext.toLowerCase()) == -1){
            Swal.fire({ icon: 'error',title: '',text: js_general_msg_formato});
            $('#'+this.id).val("").focus();
        } else {
            $('#'+this.id).html(this.files[0].name);
        }
    });     
}
function js_general_limpiar_errores(e){
    $(e).removeClass('is-invalid').addClass('');
    $(e).parents('.form-group').find('#error').html(" ");
}