<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 09 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

function valida_menus($pagina,$perfilId){  
    $seguridad_menu = array();
    switch ($perfilId) {            
        case 1: 
            $seguridad_menu = array('Cero','Usuarios_participantes_cargar_cartas_auditorias_controller','Productos_reposicion_descarga_controller','Ventas_personal_top_controller','Ventas_reporte_ganadores_controller','Ventas_registradas_controller','Reporte_reposicion_productos_controller','Reporte_reposicion_producto_zona_controller','Reportes_distribuidores_admin1_controller','Tarjetas_controller','Tarjetas_altas_controller','Ventas_auditoria_promociones_controller');
            break;  // ADMINISTRADORES STRATEGIX
        case 2: 
            $seguridad_menu = array('Cero','Usuarios_participantes_cargar_cartas_auditorias_controller','Ventas_auditoria_primera_controller','Ventas_auditoria_envio_correos_controller','Ventas_auditoria_segunda_controller','Ventas_promociones_cargas_controller','Ventas_cortes_auditoria_ventas_controller','Ventas_cortes_ganadores_contoller','Productos_reposicion_descarga_controller','Ventas_personal_top_controller','Ventas_reporte_ganadores_controller','Recompensas_controller','Productos_reposicion_carga_controller','Productos_reposicion_relacion_premios_productos_contoller','Ventas_auditoria_primera_controller','Ventas_auditoria_envio_correos_controller','Ventas_auditoria_segunda_controller','Ventas_promociones_cargas_controller','Ventas_cortes_auditoria_ventas_controller','Ventas_cortes_ganadores_contoller','Multimedios_cargas_controller','Reporte_reposicion_productos_controller','Cargas_adjs_excel_controller','Cargas_adjs_mail_controller','Reporte_reposicion_producto_zona_controller','Reportes_distribuidores_admin1_controller','Tarjetas_controller','Tarjetas_altas_controller','Ventas_auditoria_promociones_controller');
            break; //ATENCIÓN A CLIENTES
        case 3: 
            $seguridad_menu = array('Cero','Ventas_personal_top_controller','Reporte_reposicion_productos_controller','Ventas_personal_top_controller','Ventas_reporte_ganadores_controller','Productos_reposicion_descarga_controller','Reportes_distribuidores_admin1_controller','Tarjetas_controller','Tarjetas_altas_controller');
            break; //ADMINISTRADORES AXALTA
        case 4: 
            $seguridad_menu = array('Cero','Reportes_distribuidores_admin1_controller');
            break; //GERENTE REGIONAL
        case 5: 
            $seguridad_menu = array('Cero','Reportes_distribuidores_admin1_controller');
            break; //EJECUTIVOS
        case 6: 
            $seguridad_menu = array('Cero','Ventas_registro_controller','Ventas_auditoria_rechazados_controller','Ventas_promociones_controller','Productos_reposicion_captura_controller','Reporte_reposicion_productos_controller','Ventas_registro_controller');
            break; //ADMINISTRADOR DE DISTRIBUIDOR
        case 7: 
            $seguridad_menu = array('Cero','Ventas_registro_controller','Ventas_auditoria_rechazados_controller','Ventas_promociones_controller','Productos_reposicion_captura_controller','Reporte_reposicion_productos_controller','Ventas_registro_controller');
            break; //PERSONAL DE TIENDA
        case 8: 
            $seguridad_menu = array('Cero','Usuarios_participantes_cargar_cartas_controller','Ventas_registro_controller','Ventas_auditoria_rechazados_controller','Ventas_promociones_controller','Productos_reposicion_captura_controller','Reporte_reposicion_productos_controller','Ventas_registro_controller');
            break; //RESPONSABLE DE TIENDA 
        case 9: 
            $seguridad_menu = array('Cero');
            break; //MAESTRO PINTOR         
    }   
//    echo "pertfil:".$perfilId."<br>";
//    echo "pagina:".$pagina."<br>";
//    print_r($seguridad_menu);
//    echo "<br>array_search:".array_search($pagina, $seguridad_menu);
    if (array_search($pagina, $seguridad_menu)==0){ redirect(funciones_strategix_version_url_random("Inicio")); }
    return false;
}
