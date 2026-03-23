<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form id="frmRegistroMaestroPintor" role="form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <section id="registroMaestroPintor">
        <div class="panel-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 pt-40">
                        <h2>REGISTRO DE MAESTRO PINTOR0000</h2>
                    </div>
                </div>
            </div>
        </div>  
        <div class="container">
            <div class="panel-white">
                <small><b><?=$this->lang->line('usuarios_registro_maestro_pintor_sub_datos_usuario')?></b></small>
                <p>
                <div class="row row-validator">
                    <div class="dyncol col-lg-3">
                            <div class="form-group">
                                <label for="cmb_distribuidor">Distribuidor:</label><br>
                                <select id="cmb_distribuidor" name="cmb_distribuidor" class="form-select"></select>
                            </div>
                        </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_nombre">Nombre: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_nombre" id="txt_nombre" class="form-control txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_nombre')?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3" id="div_segundo_nombre">
                        <div class="form-group">
                            <label for="txt_segundonombre">Segundo Nombre: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_segundonombre" id="txt_segundonombre" class="form-control txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_segundo_nombre')?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_apellidopaterno">Apellido Paterno: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_apellidopaterno" id="txt_apellidopaterno" class="form-control txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_apaterno')?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-validator">
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_apellidomaterno">Apellido Materno: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_apellidomaterno" id="txt_apellidomaterno" class="form-control txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_amaterno')?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3" >
                        <div class="form-group">
                            <label for="txt_celular">Celular: <span data-toggle='tooltip' title='*10 CARACTERES *SOLO NÚMEROS *CAMPO OBLIGATORIO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_celular" id="txt_celular" class="form-control" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_celular')?>" onKeyPress="return js_general_solo_numeros(event)" maxlength="10">
                            <div class="error"></div>
                        </div>
                    </div>                    
                    <div class="dyncol col-lg-2">
                        <div class="form-group">
                            <label for="txt_cp">Código postal: <span data-toggle='tooltip' title='*4 A 5 CARACTERES *CAMPO OBLIGATORIO *SOLO NÚMEROS'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_cp" id="txt_cp" class="form-control txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_cp')?>" onKeyPress="return js_general_solo_numeros(event,this)" maxlength="5">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_estado">Estado: <span data-toggle='tooltip' title='MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_estado" id="txt_estado" class="form-control txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_estado')?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_ciudad">Ciudad: <span data-toggle='tooltip' title='MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_ciudad" id="txt_ciudad" class="form-control txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_ciudad')?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_municipio">Delegación o municipio: <span data-toggle='tooltip' title='MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_municipio" id="txt_municipio" class="form-control txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_municipio')?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_colonia">Colonia: <span data-toggle='tooltip' title='*CAMPO OBLIGATORIO'><i class="fas fa-question-circle"></i></span></label>
                            <select name="txt_colonia" id="txt_colonia" class="form-select txt-mayus" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_colonia')?>"></select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                    <div class="row row-validator">
                        <div class="col-lg-4"><b>SELECCIONA UNA OPCIÓN PARA AGREGAR LA FOTO DEL INE DEL MAESTRO PINTOR:</b></div>
                        <div class="col-md-3">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="chk_camara" name="chk_camara" value="1">
                                <label for="chk_camara"> CÁMARA</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="chk_archivo" name="chk_archivo" value="1">
                                <label for="chk_archivo"> ARCHIVO</label>
                            </div>
                            <br>
                        </div>
                    </div> 
                <div class="row mt-30">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="txt-qr">NÚMERO DE TARJETA: <span data-toggle='tooltip' title='*CAMPO OBLIGATORIO *ESCANEA EL NÚMERO CON TU CÁMARA O ESCRIBE SOLO NÚMEROS MÁXIMO 6 DÍGITOS'><i class="fas fa-question-circle"></i></span></label>
                            <div class="input-group">
                                <input type="text" name="txt-qr" id="txt-qr" class="form-control" placeholder="NÚMERO DE TARJETA"  onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off"  onKeyPress='return js_general_solo_numeros(event)'>
                                <button type="button" id="tarjeta_view_btn_qr" class="btn btn-axalta-sm"><span class="iconify" data-icon="bi:qr-code"></span></button>
                            </div>
                            <div class="error"></div>
                        </div>
                        <div id="div_datos_maestro_pintor"></div>
                    </div>  
                    <div class="col-lg-6" id="div_ine_foto">
                        <div class="form-group">
                            <label for="txt_ine_foto">FOTO INE: <span data-toggle='tooltip' title='*DA CLICK EN EL ICONO PARA ACTIVAR LA CÁMARA *CAMPO OBLIGATORIO'><i class="fas fa-question-circle"></i></span></label>
                            <div class="input-group">
                                <input type="text" name="txt_ine_foto" id="txt_ine_foto" value="<?=$this->session->userdata('s_ine_foto');?>" class="form-control" placeholder="INE"  onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off"  disabled >
                                <button type="button" id="ine_view_boton_guardar_foto" class="btn btn-axalta-sm"><i class="fas fa-camera"></i></button>
                            </div>
                            <div class="error"></div>
                        </div>
                    </div>          
                    <div class="col-lg-6" id="div_ine_archivo" style="display: none;">
                        <div class="form-group">
                            <label for="txt_ine_archivo">INE: <span data-toggle='tooltip' title='EL FORMATO DEL ARCHIVO DEBE SER PDF, PNG, JPG, JPEG Y SU TAMAÑO MENOR A 4MB.'><i class="fas fa-question-circle"></i></span></label>
                            <input type="file" name="txt_ine_archivo" id="txt_ine_archivo" class="form-control" placeholder="INE">
                            <small class="txt-10"><b>Verifica que la foto no sea borrosa. Archivos permitidos PDF, JPG, PNG, JPEG (El archivo no debe superar 4 MB)</b></small>
                            <div class="error"></div>
                        </div>
                    </div>   
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 txt-center">
                        <div class="form-group">
                            <button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#TerminosModal">TÉRMINOS Y CONDICIONES</button>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aceptoTerminosChk" value="option1">
                                <label class="form-check-label" for="aceptoTerminosChk">Acepto términos</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 txt-center">
                        <div class="form-group">
                            <button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#AvisoModal">AVISO DE PRIVACIDAD</button>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aceptoAvisoChk" value="option1">
                                <label class="form-check-label" for="aceptoAvisoChk">Acepto aviso de privacidad</label>
                            </div>
                        </div>
                    </div>
                </div>        
                <div class="row justify-content-end mt-50">
                    <div class="col-lg-2 col-6">
                      <!--  <input type="hidden" name="txt_distribuidor" id="txt_distribuidor" value="">-->
                        <input type="hidden" name="idu" id="idu" value="<?=$this->session->userdata(funciones_strategix_sitio_alias("s_usuario_id"));?>">
                        <button type="submit" id="btn_registro_maestro_pintor_guardar" class="btn btn-axalta" disabled><i class="far fa-save"></i> GUARDAR</button>
                    </div>     
                </div>                      
            </div>              
        </div>
    </section>
</form>
<?php
    $this->load->view('modals/usuario_registro_mp_interno/usuario_registro_mp_interno_terminos_condiciones');
    $this->load->view('modals/usuario_registro_mp_interno/usuario_registro_mp_interno_aviso_privacidad');
?>
<script>

    $(document).ready(function() {

        $("#tarjeta_view_btn_qr").click(function(){ ine_view_js_modal_qr(); });
        $("#ine_view_boton_guardar_foto").click(function(){ ine_view_js_camara(); });

        $('#txt-qr').on('change', function(){ ine_view_js_valida_qr(); });        
        $('#chk_camara').prop('checked',true);
        js_general_valida_uploads_archivos('txt_ine_archivo',['pdf','png','jpg','jpeg'],'EL ARCHIVO SUPERA EL LÍMITE PERMITIDO','SOLO SE PERMITEN ARCHIVOS CON EXTENSIÓN PDF, PNG, JPG O JPEG');     


        let iduser = $("#idu").val();
        usuarios_participantes_interno_alta_obtener_distribuidora(iduser);
        $("#txt_cp").change(function(){
            let cp = parseFloat($(this).val());
            valida_cp(cp);
        });

        verificarCheckboxes();
        $('#aceptoTerminosChk, #aceptoAvisoChk').on('change', function() {
            verificarCheckboxes();
        });


        $("#btn_registro_maestro_pintor_guardar").click(function(){
            event.preventDefault();
            usuarios_participantes_interno_alta_validar_formulario();
        });


        $('#frmRegistroMaestroPintor input, #frmRegistroMaestroPintor select, #frmRegistroMaestroPintor textarea').on('keyup change', function() {

            $('#frmRegistroMaestroPintor input, #frmRegistroMaestroPintor select, #frmRegistroMaestroPintor textarea').removeClass('is-invalid');
            $('#frmRegistroMaestroPintor .error').empty();
        });

        $('#chk_camara').on('change', function(){
            if($('#chk_camara').prop('checked',true)){
                $('#chk_archivo').prop('checked',false).removeAttr('checked').val('0');               
                $('#ine_view_boton_guardar_foto').prop('disabled',false);
                $('#txt_ine_foto').prop('disabled',false);
                $('#txt_ine_foto').val('<?=$this->session->userdata('s_ine_foto');?>');
                $('#txt_ine_archivo').prop('disabled',true);
                $('#chk_camara').val('1');
                $('#txt_ine_archivo').removeClass('is-invalid').addClass('');
                $('#txt_ine_archivo').parents('.form-group').find('#error').html(" ");
                $('#txt_ine_foto').removeClass('is-invalid').addClass('');
                $('#txt_ine_foto').parents('.form-group').find('#error').html(" ");
                $('#div_ine_archivo').hide(); 
                $('#ine_view_boton_guardar_foto').show();
                $('#div_ine_foto').show();
                $("#txt_ine_foto").attr('disabled',true);
            }
        });
        $('#chk_archivo').on('change', function(){
            if($('#chk_archivo').prop('checked',true)){
                $('#chk_camara').prop('checked',false).removeAttr('checked').val('0');
                $('#txt_ine_archivo').prop('disabled',false);       
                $('#ine_view_boton_guardar_foto').prop('disabled',true);
                $('#txt_ine_archivo').val('');
                $('#btn_registro_maestro_pintor_modal_identificacion').val('');
                $('#chk_archivo').val('1');
                $('#txt_ine_foto').removeClass('is-invalid').addClass('');
                $('#txt_ine_foto').parents('.form-group').find('#error').html(" ");
                $('#txt_ine_archivo').removeClass('is-invalid').addClass('');
                $('#txt_ine_archivo').parents('.form-group').find('#error').html(" ");
                $('#ine_view_boton_guardar_foto').hide();
                $('#div_ine_foto').hide();
                $('#div_ine_archivo').show();
                $('#txt_ine_foto').val('');
                ine_view_js_valida_session_foto();
                $("#txt_ine_archivo").attr('disabled',false);  
            }
        });

    });

    function usuarios_participantes_interno_alta_obtener_distribuidora(iduser) {
        $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller/usuarios_registro_mp_interno_controller_cmb_distribuidora',
            dataType: 'json',
            data: {
                iduser:iduser
            },
            success: function(data) {
             //   $("#txt_distribuidor").val(data.distribuidor);
             $('#cmb_distribuidor').html(data);
            },
            error: function(r) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
    
    function valida_cp(cp){
        $("#txt_estado").val("");
        $("#txt_ciudad").val("");
        $("#txt_municipio").val("");
        $("#txt_colonia").html("");
        $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_valida_cp',
            dataType: 'json',
            data: {cp:cp},
            success: function(data){   
            if(data.estado && data.ciudad && data.municipio){
                $("#txt_estado").val(data.estado).prop("disabled", false);
                $("#txt_ciudad").val(data.ciudad).prop("disabled", false);
                $("#txt_municipio").val(data.municipio).prop("disabled", false);

                let selectColonias = $("#txt_colonia");
                selectColonias.empty();

                if(data.colonias && data.colonias.length > 0){
                    $.each(data.colonias, function(index, colonia){
                        selectColonias.append(`<option value="${colonia}">${colonia}</option>`);
                    });
                    selectColonias.prop("disabled", false);
                } else {
                    $("#txt_colonia").prop("disabled", true);
                }
            } else {
                $("#txt_estado").val("").prop("disabled", true);
                $("#txt_ciudad").val("").prop("disabled", true);
                $("#txt_municipio").val("").prop("disabled", true);
                $("#txt_cp").parents('.form-group').find('.error').html("Código Postal no encontrado o incompleto.");
                $("#txt_cp").addClass('is-invalid');
                $("#txt_colonia").prop("disabled", true);
            }
            },
            error: function(data){ },
            complete: function(){  }
        });
    }

    function usuarios_participantes_interno_alta_validar_formulario() {
        $('.error').html("");
        $('#txt_ine_foto').prop('disabled', false);
        $.ajax({
            type: "POST",
            url: "usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller/usuarios_participantes_interno_alta_validar_formulario",
            data: $("#frmRegistroMaestroPintor").serialize(),
            dataType: "json",
            success: function(data) {
                $('#loader_panel').hide();
                switch (data) {
                    case 1:
                        console.log(data);
                        usuarios_participantes_interno_alta_registro();
                        break;
                    default:
                        $.each(data, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).parents('.form-group').find('.error').html(value);
                            $('#aceptoTerminosChk').prop('checked',false);
                            $('#aceptoAvisoChk').prop('checked',false);
                            $("#btn_registro_maestro_pintor_guardar").attr('disabled', true);
                        });
                        break;
                }
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

function usuarios_participantes_interno_alta_registro() {
    $("#btn_registro_maestro_pintor_guardar").attr('disabled', true);
    $("#txt_ine_foto").attr("disabled", false);

    var foto = $('#txt_ine_foto').val();
    var archivo = $('#txt_ine_archivo').val();
    $('#loader_panel').show();

    if (ine_valida_foto_archivo(foto,archivo)==1){
        
        var formData = new FormData($("#frmRegistroMaestroPintor")[0]);
        $.ajax({
            type: "POST",
            url: "usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller/usuarios_participantes_interno_alta_registro",
            data: formData,
            dataType: "json", 
            cache: false,      
            contentType: false,
            processData: false,
            success: function(response) { // Cambia 'data' a 'response' para mayor claridad
                $('#loader_panel').hide();
                $("#btn_registro_maestro_pintor_guardar").attr('disabled', false); 

                // **CAMBIO CRÍTICO AQUÍ: DE SWITCH A IF/ELSE**
                if (response.success === true) {
                    if (response.redirect_url) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro Completado!',
                            text: response.message || 'El participante ha sido registrado exitosamente.',
                            confirmButtonColor: '#fd7e14',
                            confirmButtonText: 'Aceptar', 
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(location).attr("href","<?=funciones_strategix_version_url_random_base_url("Inicio")?>");
                            }
                        });
                    } else {
                        Swal.fire({ icon: 'success', title: '¡Maestro pintor registrado exitosamente!', text: response.message || 'Participante registrado, pero sin URL de redirección.' });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Registro',
                        text: response.message || 'No se pudo guardar al participante.',
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error AJAX en registro:", textStatus, errorThrown, jqXHR.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error Inesperado',
                    text: 'Hubo un error inesperado durante el registro. Inténtalo de nuevo. ' + (jqXHR.responseText || ''),
                });
                $("#btn_registro_maestro_pintor_guardar").attr('disabled', false);
                $('#loader_panel').hide();
            },
            complete: function() {
                // ...
            }
        });
    }else{
        $('#loader_panel').hide();
        ventas_registro_ticket_view_js_valida_campos();
    }
}

function verificarCheckboxes() {
        const aceptoTerminos = $('#aceptoTerminosChk').is(':checked');
        const aceptoAviso = $('#aceptoAvisoChk').is(':checked');

        const botonGuardar = $('#btn_registro_maestro_pintor_guardar');

        if (aceptoTerminos && aceptoAviso) {
            botonGuardar.prop('disabled', false);
        } else {
            botonGuardar.prop('disabled', true);
        }
    }










function ine_view_js_valida_session_foto(){
    //ine_view_js_limpiar_errores('#div_ine_foto'); 
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller/ine_controller_valida_session_foto',
        dataType: 'json',
        data: {id:0},
        success: function(data){
            $('#div_ine_foto').val('');
        },
        error: function(data){},
        complete: function(){ $('#loader_panel').hide();}
    });
}    
function ine_view_js_valida_qr(){
    var code_qr =  $('#txt-qr').val();
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller/usuario_registro_mp_interno_controller_qr_retorno',
        dataType: 'json',
        data: {code_qr:code_qr},
        success: function(data){
            if (data.resultado==0){
                Swal.fire({ icon: 'error',title: '',text: 'EL NÚMERO DE TARJETA NO EXISTE O YA ESTÁ ASIGNADA'}); 
                $("#txt-qr").val('');
                $("#div_datos_maestro_pintor").html('');
                //$("#div_detalle").hide();
                $("#div_maestro_pintor").hide();
            } else {                    
                Swal.fire({ icon: 'success',title: '',text: 'TARJETA VÁLIDA'});
                $("#txt-qr").val(data.qr);                    
//                   $("#div_detalle").show();
            }
        },
        error: function(data){},
        complete: function(){ $('#loader_panel').hide();}
    });
}
function ine_view_js_modal_qr(){
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller/ine_controller_qr_modal',
        dataType: 'json',
        data: {id:0},
        success: function(data){
            $('#myModal').html(data).modal('show');
        },
        error: function(data){},
        complete: function(){ $('#loader_panel').hide();}
    });
}
function ine_view_js_camara(){    
    //ine_view_js_limpiar_errores('#txt_ine_foto');        
     $('#loader_panel').show();
    switch (js_general_sistema_operativo()){
        case "iOS": var modal = 1; break;
        default: var modal = 2; break;
    }    
    $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller/ine_controller_modal_foto',
            dataType: 'json',
            data: {modal:modal},
            success: function(data){
                $('#myModal').html(data).modal('show');
            },
            error: function(data){console.log(data); },
            complete: function(){$('#loader_panel').hide();}
    });
} 

function ine_valida_foto_archivo(foto,archivo){
    var validacion = 1;
    if (foto=="" && archivo==""){ 
        validacion = 0;
        if (foto==""){  
            $('#txt_ine_foto').addClass('is-invalid');
            $('#txt_ine_foto').parents('.form-group').find('.error').html('EL CAMPO INE ES OBLIGATORIO');                
        }
        if (archivo==""){ 
            $('#txt_ine_archivo').addClass('is-invalid');
            $('#txt_ine_archivo').parents('.form-group').find('#.error').html('EL CAMPO INE ES OBLIGATORIO');
        }
    } else if (foto!="" && archivo==""){ validacion = 1;
    } else if (foto=="" && archivo!=""){ validacion = 1; }
    return validacion;
}
</script>
