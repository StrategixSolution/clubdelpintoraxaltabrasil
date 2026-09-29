<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<form id="frmRegistroMaestroPintor" role="form" method="post" accept-charset="utf-8">
    <section id="registroMaestroPintor">
        <div class="panel-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>REGISTRO DE MAESTRO PINTOR</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-50">
                <div class="col-lg-12">
                    <p><b>NOTAS:</b></p>
                    <ul>
                        <li>Con el llenado de esta información se te asignará una tarjeta digital y un usuario y contraseña para ingresar a tu perfil.</li>
                        <li>Con el folio de tu tarjeta digital podrán registrar tus ventas en las tiendas participantes.</li>
                        <li>La información que tiene un asterisco es obligatoria.</li>
                    </ul>
                </div>
            </div>
            <div class="panel-white">
                <small><b><?= $this->lang->line('usuarios_registro_maestro_pintor_sub_datos_usuario') ?></b></small>
                <p>
                <div class="row row-validator">
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_nombre">* Nombre: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_nombre" id="txt_nombre" class="form-control txt-mayus" placeholder="Nombre" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3" id="div_segundo_nombre">
                        <div class="form-group">
                            <label for="txt_segundonombre">Segundo Nombre: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_segundonombre" id="txt_segundonombre" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_segundo_nombre') ?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_apellidopaterno">* Apellido Paterno: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_apellidopaterno" id="txt_apellidopaterno" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_apaterno') ?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_apellidomaterno">* Apellido Materno: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_apellidomaterno" id="txt_apellidomaterno" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_amaterno') ?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-validator">
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_celular">* Celular: <span data-toggle='tooltip' title='*10 CARACTERES *SOLO NÚMEROS *CAMPO OBLIGATORIO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_celular" id="txt_celular" class="form-control" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_celular') ?>" onKeyPress="return js_general_solo_numeros(event)" maxlength="10">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="cmb_compania">Compañía: <span data-toggle='tooltip' title='*COMPAÑÍA TELEFÓNICA'><i class="fas fa-question-circle"></i></span></label>
                            <select id="cmb_compania" name="cmb_compania" class="form-select"></select>
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_email">Email: <span data-toggle='tooltip' title='*FORMATO "usuario@dominio.com" *MÁXIMO 50 CARACTERES'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_email" id="txt_email" class="form-control" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_email') ?>" maxlength="100">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-validator">
                    <div class="col-lg-3">
                        <div>ENVIAR POR:</div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-check mt-0">
                            <input type="checkbox" id="usuarios_registro_maestro_pintor_view_chk_email"
                                name="usuarios_registro_maestro_pintor_view_chk_email" value="1" class="form-check-input">
                            <label for="" class="form-check-label"> CORREO ELECTRÓNICO</label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-check mt-0">
                            <input type="checkbox" id="usuarios_registro_maestro_pintor_view_chk_whatsapp"
                                name="usuarios_registro_maestro_pintor_view_chk_whatsapp" value="1" class="form-check-input">
                            <label for="chk_archivo" class="form-check-label"> WHATSAPP</label><br>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <small>(Dirección del taller en el que trabaja)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="dyncol col-lg-4">
                        <div class="form-group">
                            <label for="txt_calle">* Calle: <span data-toggle='tooltip' title='*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_calle" id="txt_calle" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_calle') ?>" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-2">
                        <div class="form-group">
                            <label for="txt_cp">* Código postal: <span data-toggle='tooltip' title='*4 A 5 CARACTERES *CAMPO OBLIGATORIO *SOLO NÚMEROS'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_cp" id="txt_cp" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_cp') ?>" onKeyPress="return js_general_solo_numeros(event,this)" maxlength="5">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_estado">* Estado: <span data-toggle='tooltip' title='MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_estado" id="txt_estado" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_estado') ?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_ciudad">* Ciudad: <span data-toggle='tooltip' title='MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_ciudad" id="txt_ciudad" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_ciudad') ?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_municipio">* Delegación o municipio: <span data-toggle='tooltip' title='MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_municipio" id="txt_municipio" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_municipio') ?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-3">
                        <div class="form-group">
                            <label for="txt_colonia">* Colonia: <span data-toggle='tooltip' title='*CAMPO OBLIGATORIO'><i class="fas fa-question-circle"></i></span></label>
                            <select name="txt_colonia" id="txt_colonia" class="form-select txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_colonia') ?>"></select>
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-2">
                        <div class="form-group">
                            <label for="txt_noext">* Número exterior: <span data-toggle='tooltip' title='MÁXIMO 50 CARACTERES *CAMPO OBLIGATORIO'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_noext" id="txt_noext" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_noext') ?>" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-2">
                        <div class="form-group">
                            <label for="txt_noint">Número Interior: <span data-toggle='tooltip' title='MÁXIMO 50 CARACTERES'><i class="fas fa-question-circle"></i></span></label>
                            <input type="text" name="txt_noint" id="txt_noint" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_noint') ?>" maxlength="50">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="dyncol col-lg-6">
                        <div class="form-group">
                            <label for="txt_distribuidor">* Distribuidor: <span data-toggle='tooltip' title='*CAMPO OBLIGATORIO'><i class="fas fa-question-circle"></i></span></label>
                            <select name="txt_distribuidor" id="txt_distribuidor" class="form-select" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_distribuidor') ?>" onKeyPress="return js_general_solo_texto(event,this)" required></select>
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="dyncol col-lg-6">
                        <div class="form-group">
                            <label for="txt_ubicacion">Ubicación de la tienda:</label>
                            <textarea name="txt_ubicacion" id="txt_ubicacion" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_registro_maestro_pintor_placeholder_ubicacion') ?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50" disabled></textarea>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="aceptartc" id="aceptartc" value="0">
                <input type="hidden" name="aceptarap" id="aceptarap" value="0">
                <div class="row justify-content-end mt-50 mb-20">
                    <div class="col-lg-2 col-6">
                        <a href="<?= funciones_strategix_version_url_random_base_url("Login") ?>">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-black">REGRESAR</button>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="d-grid gap-2">
                            <button type="submit" id="btn_registro_maestro_pintor_guardar" class="btn btn-axalta"><i class="far fa-save"></i> GUARDAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<div class="modal fade" id="aceptaTYCAPModal" tabindex="-1" role="dialog" aria-labelledby="aceptaTYCAPModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="aceptaTYCAPModalLabel">
                    Aviso de privacidad | Términos y condiciones
                </h5>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <p class="txt-center txt-12">Antes de continuar, es necesario que aceptes los términos y condiciones y el aviso de privacidad para poder participar en el programa de Club del Pintor.</p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="aceptartccheck">
                            <label class="form-check-label" for="aceptartccheck">
                                <b>Acepto los términos y condiciones</b>
                            </label>
                        </div>
                        <div class="txt-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#aceptatcRegMPExtModal">TÉRMINOS Y CONDICIONES</a>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="aceptarapcheck">
                            <label class="form-check-label" for="aceptarapcheck">
                                <b>Acepto el aviso de privacidad</b>
                            </label>
                        </div>
                        <div class="txt-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#aceptarapRegMPExtModal">AVISO DE PRIVACIDAD</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCancelarTYCAPRegMPExt">
                    Cancelar
                </button>
                <button type="button" class="btn btn-axalta" id="btnAceptarTYCAPRegMPExt">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="aceptatcRegMPExtModal" tabindex="-1" role="dialog" aria-labelledby="aceptatcRegMPExtModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="aceptatcRegMPExtModalLabel">
                    Términos y Condiciones
                </h5>
            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <div class="row">
                    <div class="col-lg-12" style="padding: 20px 20px;">
                        <p class="txt-justify txt-12">El uso de cualquier beneficio prestado por [Axalta Coating Systems, S. de R.L. de C.V.] (en lo sucesivo, “Axalta”), en relación con el Programa Club del Pintor (el “Programa”), constituye un contrato entre usted y Axalta. El Programa incentiva el desempeño de los distribuidores leales sobre los productos participantes de Axalta. Para participar en el Programa, es indispensable que conozca a detalle las Reglas de Uso del Programa.</p>

                        <p class="txt-justify txt-12">Los presentes Términos y Condiciones están dirigidos única y exclusivamente a los Clientes, a los Distribuidores y al personal de tienda, quienes serán los únicos responsables de cumplir con los mismos.</p>

                        <p class="txt-justify txt-12">Axalta podrá prestar los beneficios del Programa de manera independiente o, en el caso de los beneficios otorgados a los Clientes o al personal de tienda, podrá prestarlos a través de los Distribuidores participantes del Programa.</p>

                        <p class="txt-justify txt-12">Los términos “usted”, “usuario” y cualquier otro término análogo se refieren a las personas que acepten el contenido de los Términos y Condiciones y, por lo tanto, hagan uso del Programa.</p>

                        <p class="txt-justify txt-12">I. Consentimiento de los Términos y Condiciones</p>

                        <p class="txt-justify txt-12">Al crear una cuenta de usuario en esta aplicación APP CLUB DEL PINTOR AXALTA usted acepta: (i) utilizar la App Axalta y, en su caso, la Tarjeta Club del Pintor en cumplimiento con lo establecido en estos términos y condiciones del Programa (los “Términos del Programa”), (ii) el uso de nuestras cookies, en términos de nuestro Aviso de Privacidad, mismo que también se encuentra disponible en www.axalta.mx (el “Aviso de Privacidad”); (iii) haber leído y estar de acuerdo con las Reglas del Uso del Programa (conjuntamente con los Términos del Programa y el Aviso de Privacidad, los “Términos y Condiciones”) y (iv) haber leído y estar de acuerdo con los Términos y Condiciones.</p>

                        <p class="txt-justify txt-12">Tome en cuenta que si usted no acepta la totalidad de los Términos y Condiciones, para Axalta será imposible otorgarle los beneficios del Programa y por lo tanto, usted no podrá participar en el mismo. Axalta podrá modificar en cualquier momento, según lo requiera, los presentes Términos y Condiciones. Dicha modificación o actualización le será notificada a través de nuestra App Axalta o será publicada en www.axalta.mx. Tome en cuenta que el uso continuo de los beneficios del Programa y de nuestra App Axalta constituye su consentimiento expreso en relación con cualesquier modificación realizada a los presentes Términos y Condiciones.</p>

                        <p class="txt-justify txt-12">El uso del Programa es estrictamente personal e individual, por lo que usted se obliga a no utilizar el Programa para fines comerciales o beneficiar a terceros.</p>

                        <p class="txt-justify txt-12">II. Verificación de identidad</p>

                        <p class="txt-justify txt-12">El uso de su cuenta de usuario es estrictamente personal e intransferible y únicamente está autorizado a crear una sola cuenta de usuario. Cada inicio de sesión se entenderá como un consentimiento continuo del uso del Programa de conformidad con los presentes Términos y Condiciones.</p>

                        <p class="txt-justify txt-12">Usted se encuentra obligado a mantener la confidencialidad de su cuenta de usuario y contraseña. Usted es el único responsable de la actividad que se desarrolle en su cuenta de usuarios de la App Axalta o a través de ella. No es recomendable reutilizar la contraseña de su cuenta de Axalta en aplicaciones de terceros. Si detecta un uso no autorizado de su cuenta de Axalta o de su contraseña, por favor notifíquelo a Axalta al siguiente teléfono 50892147 CDMX y Área Metropolitana, desde la República (01 55) 50892147 o correo electrónico contacto@clubdelpintoraxalta.com.</p>

                        <p class="txt-justify txt-12">III. Uso de la Tarjeta Club del Pintor y demás beneficios del Programa</p>

                        <p class="txt-justify txt-12">Al contar con la Tarjeta Club del Pintor, necesaria para la identificación del Cliente para ser sujeto de los beneficios del Programa, el Cliente titular de la misma podrá comprar productos de Axalta a través de cualquiera de los Distribuidores participantes en el Programa, quienes además deberán proporcionar al Cliente los beneficios, aunque no haya sido dado de alta en determinado punto de venta. Los Distribuidores participantes serán aquellos autorizados por Axalta, cuya información podrá encontrase en www.axalta.mx. Usted es responsable de la actividad que se desarrolle a través de su Tarjeta Club del Pintor.</p>

                        <p class="txt-justify txt-12">Los premios generados para el personal de tienda y pintores serán adquiridos por el Axalta, bajo el presupuesto que Axalta asigne en su momento. La asignación de dichos premios en ningún momento se deberá entender como un sorteo o concurso y se regirá de conformidad con lo establecido en [Política de premio al personal de tienda].</p>

                        <p class="txt-justify txt-12">Los Distribuidores deberán instalar en sus sucursales el material de imagen asignado al Programa. En caso de pérdida, deberá dar aviso dentro de los 2 días hábiles siguientes al extravío de la Tarjeta Club del Pintor a Axalta o a cualquier Distribuidor, quien de inmediato cancelará la Tarjeta Club del Pintor y se iniciará el trámite para la reposición de su Tarjeta Club del Pintor. Usted es responsable de la actividad que se desarrolle durante y hasta el tiempo que no se dé aviso de dicha pérdida a Axalta o a cualquier Distribuidor.</p>

                        <p class="txt-justify txt-12">IV. Seguridad de la Información</p>

                        <p class="txt-justify txt-12">Axalta implementa medidas de seguridad administrativas, físicas y tecnológicas adecuadas para resguardar la información relativa a los Clientes que forman parte del Programa.</p>

                        <p class="txt-justify txt-12">Axalta no será responsable por cualquier daño, perjuicio o pérdida que usted sufra causados por un incumplimiento a cualquiera de sus obligaciones previstas en los presentes Términos y Condiciones, incluyendo el uso indebido de su contraseña o Tarjeta Club del Pintor.</p>

                        <p class="txt-justify txt-12">V. Continuidad del Programa</p>

                        <p class="txt-justify txt-12">Axalta implementa mecanismos adecuados para garantizar la continuidad del Programa. No obstante, Axalta podrá suspender el Programa en caso de requerimientos técnicos o legales, en cuyo caso, usted será notificado en tiempo y forma.</p>

                        <p class="txt-justify txt-12">VI. Obligaciones adicionales</p>

                        <p class="txt-justify txt-12">a) Veracidad de la información: Usted se obliga a entregar a Axalta información cierta, precisa, real, actualizada y completa, de conformidad con lo solicitado por el formato de registro de Axalta. Asimismo, usted se compromete a no entregar datos falsos en relación con su identidad y a mantener dicha información actualizada y cierta.</p>

                        <p class="txt-justify txt-12">b) Suspensión de los beneficios: Sin perjuicio de otras medidas, Axalta podrá suspender en forma temporal o inhabilitar definitivamente su tarjeta o iniciar las acciones que estime pertinentes en caso de que usted: (i) utilice el Programa para fines ilegales o en contravención con los Términos y Condiciones; (ii) realice actos dolosos o de mala fe; o (iii) utilice tecnología que oculte o esconda en la tarjeta a través de la cual sea beneficiario del Programa, de tal manera que usted actúe de manera anónima.</p>

                        <p class="txt-justify txt-12">VII. Uso de Información</p>

                        <p class="txt-justify txt-12">Su información personal será utilizada conforme a lo previsto en el Aviso de Privacidad, mismo que forma parte integrante de estos Términos y Condiciones.</p>

                        <p class="txt-justify txt-12">De conformidad con el Aviso de Privacidad, usted consiente que Axalta pueda utilizar toda la información, materiales o cualquier otro contenido obtenido por Axalta, ya sea directamente o a través de los Distribuidores (conjuntamente, la “Información”). Axalta podrá utilizar, modificar, analizar y distribuir la Información, siempre y cuando esta sea necesaria para otorgar los beneficios del Programa.</p>

                        <p class="txt-justify txt-12">VIII. Colaboración entre las partes</p>

                        <p class="txt-justify txt-12">Las partes se comprometen a actuar siempre de buena fe, por lo que deberán colaborar en cualquier procedimiento, reclamo o demanda de cualesquier otros usuarios o terceros derivados del incumplimiento de los presentes Términos y Condiciones.</p>

                        <p class="txt-justify txt-12">IX. Notificaciones</p>

                        <p class="txt-justify txt-12">Usted acepta que cualquier notificación sobre el Programa podrá ser entregada de manera electrónica, ya sea por correos electrónicos, mensajes de texto o cualquier otro medio electrónico o digital.</p>

                        <p class="txt-justify txt-12">X. Cesiones</p>

                        <p class="txt-justify txt-12">Usted se obliga a no ceder a un tercero los derechos y las obligaciones contenidas en los presentes Términos y Condiciones sin el consentimiento previo y por escrito dado por Axalta.</p>

                        <p class="txt-justify txt-12">XI. Revisiones y Auditorías</p>

                        <p class="txt-justify txt-12">Al cierre de cada mes, Axalta llevará a cabo auditorías sobre los comprobantes de las compras registrados para corroborar que el descuento del 10% en productos Axalta se esté otorgando a los Clientes.</p>

                        <p class="txt-justify txt-12">XII. Jurisdicción Aplicable y Ley Aplicable</p>

                        <p class="txt-justify txt-12">La validez, interpretación y cumplimiento de los presentes Términos y Condiciones se regirá por las leyes de los Estados Unidos Mexicanos. Cualquier controversia será sometida a los tribunales competentes de la Ciudad de México.</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-axalta" id="btnAceptarTCRegMPExt">
                    Aceptar
                </button>
            </div>

        </div>
    </div>
</div>


<!-- MODAL 2: AVISO DE PRIVACIDAD -->
<div class="modal fade" id="aceptarapRegMPExtModal" tabindex="-1" role="dialog" aria-labelledby="aceptarapRegMPExtModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="aceptarapRegMPExtModalLabel">
                    Aviso de Privacidad
                </h5>
            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <div class="row">
                    <div class="col-lg-12" style="padding: 20px 20px;">
                        <p class="txt-justify txt-12">
                            Al participar en el programa de lealtad Club del Pintor y como parte del proceso de registro al mismo, se le podrá solicitar el siguiente tipo de información, datos de identificación, datos de ubicación, de contacto y su imagen (fotografías o videos). Su información personal será tratada para identificarle y registrarle como participante del programa y participante de las promociones que realice Axalta, así como para contactarlo en caso de resultar ganador de nuestras promociones, además se podrá utilizar dicha información para fines, estadísticos, comerciales, promocionales y de publicidad.
                        </p>
                        <p class="txt-justify txt-12">
                            La sociedad responsable del tratamiento será, Axalta Coating Systems México, S. de R.L. de C.V (en adelante “Axalta”) con domicilio en Industria Eléctrica número 10, Colonia Industrial Barrientos, Tlalnepantla de Baz, C.P. 54015, Estado de México, México.
                        </p>
                        <p class="txt-justify txt-12">
                            Para conocer nuestro Aviso de Privacidad Integral, consulte el siguiente link <a href="https://www.axalta.com/mx/repintado-automotriz/contacto/privacidad/Privacidad-integral.html" target="_blank">Aviso de Privacidad Integral Axalta.</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-axalta" id="btnAceptarAPRegMPExt">
                    Aceptar
                </button>
            </div>

        </div>
    </div>
</div>


<script>
    var reiniciandoDistribuidorRegMPExt = false;

    $(document).ready(function() {
        if ($.fn.chosen) {
            $("#txt_distribuidor").chosen({
                width: '100%'
            });
        }

        $('#usuarios_registro_maestro_pintor_view_chk_email').prop('checked', true);
        /**************************************************************************************************************************************/
        $('#usuarios_registro_maestro_pintor_view_chk_email').on('change', function() {
            if ($('#usuarios_registro_maestro_pintor_view_chk_email').prop('checked')) {
                $('#usuarios_registro_maestro_pintor_view_chk_whatsapp').prop('checked', false).removeAttr('checked');
            }
        });
        $('#usuarios_registro_maestro_pintor_view_chk_whatsapp').on('change', function() {
            if ($('#usuarios_registro_maestro_pintor_view_chk_whatsapp').prop('checked')) {
                $('#usuarios_registro_maestro_pintor_view_chk_email').prop('checked', false).removeAttr('checked');
            }
        });

        usuarios_participantes_externo_alta_obtener_distribuidora();
        usuarios_participantes_externo_alta_obtener_companias_telefonicas();

        $(document).off('change.regMPExtCp', '#txt_cp');
        $(document).on('change.regMPExtCp', '#txt_cp', function() {
            let cp = parseFloat($(this).val());
            valida_cp(cp);
        });

        $(document).off('change.regMPExtDistribuidor', '#txt_distribuidor');
        $(document).on('change.regMPExtDistribuidor', '#txt_distribuidor', function() {

            if (reiniciandoDistribuidorRegMPExt === true) {
                return;
            }

            let idd = parseFloat($(this).val());

            limpiar_aceptaciones_documentos_registro_mp_externo();

            if (idd > 0) {
                usuarios_participantes_externo_alta_obtener_datos_distribuidora(idd);
            } else {
                $('#txt_ubicacion').empty().val("");
            }
        });

        $(document).off('click.regMPExtAceptarTC', '#btnAceptarTCRegMPExt');
        $(document).on('click.regMPExtAceptarTC', '#btnAceptarTCRegMPExt', function() {

            cerrar_modal_registro_mp_externo('aceptatcRegMPExtModal');

            setTimeout(function() {
                mostrar_modal_registro_mp_externo('aceptaTYCAPModal');
            }, 300);
        });

        $(document).off('click.regMPExtAceptarAP', '#btnAceptarAPRegMPExt');
        $(document).on('click.regMPExtAceptarAP', '#btnAceptarAPRegMPExt', function() {

            cerrar_modal_registro_mp_externo('aceptarapRegMPExtModal');

            setTimeout(function() {
                mostrar_modal_registro_mp_externo('aceptaTYCAPModal');
            }, 300);
        });

        $(document).off('click.regMPExtAceptarTYCAP', '#btnAceptarTYCAPRegMPExt');
        $(document).on('click.regMPExtAceptarTYCAP', '#btnAceptarTYCAPRegMPExt', function() {

            if (!$('#aceptartccheck').is(':checked') || !$('#aceptarapcheck').is(':checked')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aviso',
                    text: 'Debes aceptar los Términos y Condiciones y el Aviso de Privacidad para continuar.'
                });
                return false;
            }

            $('#aceptartc').val(1);
            $('#aceptarap').val(1);
            cerrar_modal_registro_mp_externo('aceptaTYCAPModal');
            $('#txt_distribuidor').prop('disabled', true);
            if ($.fn.chosen) {
                $('#txt_distribuidor').trigger('chosen:updated');
            }
        });






        $(document).off('click.regMPExtCancelarDocs', '#btnCancelarTYCAPRegMPExt');
        $(document).on('click.regMPExtCancelarDocs', '#btnCancelarTYCAPRegMPExt', function() {
            cancelar_aceptacion_documentos_registro_mp_externo();
        });

        $(document).off('click.regMPExtGuardar', '#btn_registro_maestro_pintor_guardar');
        $(document).on('click.regMPExtGuardar', '#btn_registro_maestro_pintor_guardar', function(event) {
            event.preventDefault();

            if (!documentos_aceptados_registro_mp_externo()) {
                mostrar_alerta_documentos_no_aceptados_registro_mp_externo();
                return false;
            }

            usuarios_participantes_externo_alta_validar_formulario();
        });

        $(document).off('submit.regMPExtForm', '#frmRegistroMaestroPintor');
        $(document).on('submit.regMPExtForm', '#frmRegistroMaestroPintor', function(event) {
            event.preventDefault();

            if (!documentos_aceptados_registro_mp_externo()) {
                mostrar_alerta_documentos_no_aceptados_registro_mp_externo();
                return false;
            }

            usuarios_participantes_externo_alta_validar_formulario();
            return false;
        });

        $('#frmRegistroMaestroPintor input, #frmRegistroMaestroPintor select, #frmRegistroMaestroPintor textarea').on('keyup change', function() {
            $('#frmRegistroMaestroPintor input, #frmRegistroMaestroPintor select, #frmRegistroMaestroPintor textarea').removeClass('is-invalid');
            $('#frmRegistroMaestroPintor .error').empty();
        });

    });


    function mostrar_modal_registro_mp_externo(id_modal) {

        const $modal = $('#' + id_modal);

        if ($modal.length === 0) {
            console.error('No existe el modal con ID:', id_modal);
            return;
        }

        /* Bootstrap 4 */
        if (typeof $.fn.modal === 'function') {
            $modal.modal({
                backdrop: 'static',
                keyboard: false,
                show: false
            });

            $modal.modal('show');
            return;
        }

        /* Bootstrap 5 */
        if (typeof bootstrap !== 'undefined' && typeof bootstrap.Modal !== 'undefined') {
            const modalElemento = document.getElementById(id_modal);
            let instanciaModal = null;

            if (typeof bootstrap.Modal.getOrCreateInstance === 'function') {
                instanciaModal = bootstrap.Modal.getOrCreateInstance(modalElemento, {
                    backdrop: 'static',
                    keyboard: false
                });
            } else {
                instanciaModal = bootstrap.Modal.getInstance(modalElemento) || new bootstrap.Modal(modalElemento, {
                    backdrop: 'static',
                    keyboard: false
                });
            }

            instanciaModal.show();
            return;
        }

        /* Fallback visual si el proyecto no tiene disponible el plugin JS de Bootstrap */
        abrir_modal_fallback_registro_mp_externo(id_modal);
    }


    function cerrar_modal_registro_mp_externo(id_modal) {

        const $modal = $('#' + id_modal);

        $('#' + id_modal).modal("hide");
    }


    function abrir_modal_fallback_registro_mp_externo(id_modal) {

        const $modal = $('#' + id_modal);

        $('.modal-backdrop[data-reg-mp-fallback="1"]').remove();

        $modal
            .attr('aria-hidden', 'false')
            .attr('aria-modal', 'true')
            .addClass('show')
            .css({
                display: 'block',
                paddingRight: '17px'
            });

        $('body')
            .addClass('modal-open')
            .append('<div class="modal-backdrop fade show" data-reg-mp-fallback="1"></div>');
    }


    function cerrar_modal_fallback_registro_mp_externo(id_modal) {

        const $modal = $('#' + id_modal);

        $modal
            .attr('aria-hidden', 'true')
            .removeAttr('aria-modal')
            .removeClass('show')
            .css({
                display: 'none',
                paddingRight: ''
            });

        $('.modal-backdrop[data-reg-mp-fallback="1"]').remove();

        if ($('.modal.show').length === 0) {
            $('body').removeClass('modal-open').css('padding-right', '');
        }
    }


    function limpiar_aceptaciones_documentos_registro_mp_externo() {
        $('#aceptartc').val(0);
        $('#aceptarap').val(0);
    }


    function documentos_aceptados_registro_mp_externo() {
        return parseInt($('#aceptartc').val(), 10) === 1 && parseInt($('#aceptarap').val(), 10) === 1;
    }


    function cancelar_aceptacion_documentos_registro_mp_externo() {

        limpiar_aceptaciones_documentos_registro_mp_externo();

        $('#aceptartccheck').prop('checked', false);
        $('#aceptarapcheck').prop('checked', false);

        cerrar_modal_registro_mp_externo('aceptaTYCAPModal');

        reiniciandoDistribuidorRegMPExt = true;

        if ($('#txt_distribuidor option[value="0"]').length > 0) {
            $('#txt_distribuidor').val('0');
        } else {
            $('#txt_distribuidor').val('');
        }

        if ($.fn.chosen) {
            $('#txt_distribuidor').trigger('chosen:updated');
        }

        $('#txt_ubicacion').empty().val("");

        setTimeout(function() {
            reiniciandoDistribuidorRegMPExt = false;
            mostrar_alerta_documentos_no_aceptados_registro_mp_externo();
        }, 300);
    }


    function mostrar_alerta_documentos_no_aceptados_registro_mp_externo() {
        Swal.fire({
            icon: 'warning',
            title: '',
            text: 'El proceso no puede continuar si no se aceptan ambos documentos.',
            confirmButtonColor: '#fd7e14',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false
        });
    }


    function usuarios_participantes_externo_alta_obtener_distribuidora() {
        $('#loader_panel').show();

        $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_cmb_distribuidora',
            dataType: 'json',
            data: {},
            success: function(data) {
                $('#txt_distribuidor').html(data);

                if ($.fn.chosen) {
                    $('#txt_distribuidor').trigger("chosen:updated");
                }
            },
            error: function(r) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }


    function usuarios_participantes_externo_alta_obtener_companias_telefonicas() {
        $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_cmb_telefonias',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_compania').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }


    function valida_cp(cp) {

        $("#txt_estado").val("");
        $("#txt_ciudad").val("");
        $("#txt_municipio").val("");
        $("#txt_colonia").html("");

        $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_valida_cp',
            dataType: 'json',
            data: {
                cp: cp
            },
            success: function(data) {

                if (data.estado && data.ciudad && data.municipio) {

                    $("#txt_estado").val(data.estado).prop("disabled", false);
                    $("#txt_ciudad").val(data.ciudad).prop("disabled", false);
                    $("#txt_municipio").val(data.municipio).prop("disabled", false);

                    let selectColonias = $("#txt_colonia");
                    selectColonias.empty();

                    if (data.colonias && data.colonias.length > 0) {
                        $.each(data.colonias, function(index, colonia) {
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
            error: function(data) {},
            complete: function() {}
        });
    }


    function usuarios_participantes_externo_alta_obtener_datos_distribuidora(idd) {
        mostrar_modal_registro_mp_externo('aceptaTYCAPModal');

        $("#txt_ubicacion").val("");

        var direccion = "";

        if (idd > 0) {

            $.ajax({
                type: 'POST',
                url: 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_participantes_externo_alta_obtener_datos_distribuidora',
                dataType: 'json',
                data: {
                    idd: idd
                },
                success: function(data) {

                    if (data.DistribuidorDetalleCalle) {
                        direccion += "CALLE " + data.DistribuidorDetalleCalle;
                    }

                    if (data.DistribuidorDetalleNumeroExterior) {
                        if (direccion !== "") direccion += " ";
                        direccion += "NO." + data.DistribuidorDetalleNumeroExterior;
                    }

                    if (data.DistribuidorDetalleColonia) {
                        if (direccion !== "") direccion += " ";
                        direccion += "COLONIA " + data.DistribuidorDetalleColonia;
                    }

                    if (data.DistribuidorDetalleMunicipio) {
                        if (direccion !== "") direccion += ", ";
                        direccion += data.DistribuidorDetalleMunicipio;
                    }

                    if (data.DistribuidorDetalleEstado) {
                        if (direccion !== "") direccion += ", ";
                        direccion += data.DistribuidorDetalleEstado;
                    }

                    if (data.DistribuidorDetalleCP) {
                        if (direccion !== "") direccion += " ";
                        direccion += "C.P. " + data.DistribuidorDetalleCP;
                    }

                    $('#txt_ubicacion').val(direccion);


                },
                error: function(data) {},
                complete: function() {}
            });
        }
    }


    function usuarios_participantes_externo_alta_validar_formulario() {

        $('.error').html("");

        if (!documentos_aceptados_registro_mp_externo()) {
            mostrar_alerta_documentos_no_aceptados_registro_mp_externo();
            return false;
        }

        $('#txt_distribuidor').prop('disabled', false);

        $.ajax({
            type: "POST",
            url: "usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_participantes_externo_alta_validar_formulario",
            data: $("#frmRegistroMaestroPintor").serialize(),
            dataType: "json",
            success: function(data) {

                $('#loader_panel').hide();

                switch (data) {
                    case 1:
                        usuarios_participantes_externo_alta_registro();
                        break;

                    default:
                        $.each(data, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).parents('.form-group').find('.error').html(value);
                        });
                        break;
                }
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
                $('#txt_distribuidor').prop('disabled', true);
            }
        });
    }


    function usuarios_participantes_externo_alta_registro() {

        $('.error').html(" ");
        $('#loader_panel').show();

        $("#btn_registro_maestro_pintor_guardar").attr('disabled', true);
        $('#txt_distribuidor').prop('disabled', false);

        $.ajax({
            type: "POST",
            url: "usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_participantes_externo_alta_registro",
            data: $("#frmRegistroMaestroPintor").serialize(),
            dataType: "json",
            success: function(data) {

                $('#loader_panel').hide();
                $("#btn_registro_maestro_pintor_guardar").attr('disabled', false);
                $('#txt_distribuidor').prop('disabled', true);

                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        text: 'El participante ha sido registrado',
                        confirmButtonColor: '#fd7e14',
                        confirmButtonText: 'Siguiente',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {

                            sessionStorage.setItem("tarjeta", data.tarjeta);
                            sessionStorage.setItem("usuario", data.usuario);
                            sessionStorage.setItem("contrasena", data.contrasena);

                            const url = `<?= funciones_strategix_version_url_random_base_url("Registromaestropintorexternodatos") ?>`;
                            window.location.href = url;
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '',
                        text: 'El usuario no pudo registrarse',
                        confirmButtonText: 'Ok',
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
                $('#txt_distribuidor').prop('disabled', true);
            },
            complete: function() {}
        });
    }
</script>