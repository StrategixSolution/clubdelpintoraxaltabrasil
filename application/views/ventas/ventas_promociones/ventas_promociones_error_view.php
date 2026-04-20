<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script>
    $(document).ready( function () {  
        Swal.fire({
            title: '',
            html: '<?=$msg?>',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?=$this->lang->line('ventas_promociones_controller_lang_js_btn_aceptar')?>',
            cancelButtonText: '',
            allowOutsideClick: false
        }).then((validacion) => {
                $(location).attr("href","<?=funciones_strategix_version_url_random_base_url("RegistroTickets")?>");
        });  
    });
</script>