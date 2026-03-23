<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 09 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']                    = 'login/login_controller';
$route['404_override']                          = '';
$route['translate_uri_dashes']                  = FALSE;
$route['login']                                 = 'login/login_controller';
$route['autenticacion']                         = 'autenticacion/autenticacion_controller';
$route['logout']                                = 'logout/logout_controller';
$route['UsuariosRecuperaClave']                 = 'usuarios/usuarios_recupera_clave/usuarios_recupera_clave_controller';
$route['inicio']                                = 'inicio/inicio_controller';
$route['Inicio']                                = 'inicio/inicio_controller';
$route['Reglas']                                = 'reglas/reglas_controller';
$route['Productos']                             = 'productos/productos_controller';
$route['Contacto']                              = 'contacto/contacto_controller';
$route['UsuariosActualizarDatos']               = 'usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller';
$route['UsuariosRecuperaClaveNueva']            = 'usuarios/usuarios_recupera_clave/usuarios_recupera_clave_nueva_controller';
$route['Registromaestropintorinterno']         = 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller';
$route['Tarjetas']                              = 'tarjetas/tarjetas_controller'; 
$route['TarjetasAltas']                         = 'tarjetas/tarjetas_altas/tarjetas_altas_controller'; 


/*



$route['construccion']                          = 'construccion/construccion_controller';
$route['recuperaclave']                         = 'usuarios/usuarios_recupera_clave/usuarios_recupera_clave_controller';
$route['recuperacrearclave']                    = 'usuarios/usuarios_crea_clave/usuarios_crea_clave_controller';
$route['actualizardatos']                       = 'usuarios/usuarios_actualizar/usuarios_actualizar_datos_controller';

$route['UsuariosActualizarDatosValidaEmail']    = 'usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_validar_correo_token';
$route['Registromaestropintorexterno']          = 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller';
$route['Registroexitoso']                       = 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/registro_exitoso_maestro_pintor';
$route['Registromaestropintorexternodatos']     = 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_datosregistro_controller';
$route['Registromaestropintorinterno']          = 'usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller';
$route['Recompensas']                           = 'recompensas/recompensas_controller';
$route['CargaProductosPremios']                 = 'productos/productos_reposicion/productos_reposicion_carga_controller';
$route['RelacionPremiosProductos']              = 'productos/productos_reposicion/productos_reposicion_relacion_premios_productos_contoller';
$route['CargaPromociones']                      = 'ventas/ventas_promociones/ventas_promociones_cargas/ventas_promociones_cargas_controller';
$route['CorteAuditoriaVentas']                  = 'ventas/ventas_cortes/ventas_cortes_auditoria_ventas/ventas_cortes_auditoria_ventas_controller';
$route['CorteGanadoresVentas']                  = 'ventas/ventas_cortes/ventas_cortes_ganadores/ventas_cortes_ganadores_contoller';
$route['CorteVentasBimestral']                  = 'ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortes_bimestral_controller';
$route['DescargaReposicionProductos']           = 'productos/productos_reposicion/productos_reposicion_descarga/productos_reposicion_descarga_controller';
$route['RegistroTickets']                       = 'ventas/ventas_registro_ticket/ventas_registro_ticket_controller';
$route['RegistroVentasPromocion']               = 'ventas/ventas_promociones/ventas_promociones_controller';
$route['AuditoriaPrimera']                      = 'ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_controller';
$route['EnvioCorreos']                          = 'ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_controller';
$route['AuditoriaSegunda']                      = 'ventas/ventas_auditoria/ventas_auditoria_segunda/ventas_auditoria_segunda_controller';
$route['TicketsRechazados']                     = 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller';
$route['TicketsActualiza']                      = 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_actualiza_venta';
$route['AuditoriaPromociones']                  = 'ventas/ventas_auditoria/ventas_auditoria_promociones/ventas_auditoria_promociones_controller';
$route['ReposicionProductoCaptura']             = 'productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller';
$route['ReporteVentasPersonalTop']             = 'reportes/ventas/ventas_personal_top_controller';
$route['ReporteGanadores']                      = 'reportes/ventas/ventas_reporte_ganadores_controller';
$route['ReporteVentasRegistradas']             = 'reportes/ventas/ventas_registradas_controller/index';
$route['ReporteAuditoriaVentas']               = 'reportes/ventas/reportes_ventas_auditoria_controller';
$route['ReporteReposicionProductos']           = 'reportes/reposicion_productos/reporte_reposicion_productos_controller';
$route['CargaMultimedios']        = 'multimedios/multimedios_cargas_controller';
$route['DistribuidorasAdjsExcel']                   = 'distribuidora/adjs/cargas_adjs_excel_controller';
$route['DistribuidorasAdjsMail']                   = 'distribuidora/adjs/cargas_adjs_mail_controller';
$route['ReporteReposicionProductoZonas']= 'reportes/reposicion_productos/reporte_reposicion_producto_zona_controller';
$route['ReporteDistribuidoresAdmin1']          = 'reportes/distribuidores/reportes_distribuidores_admin1_controller/index';
$route['ReporteDistribuidoresAdmin1Buscar']    = 'reportes/distribuidores/reportes_distribuidores_admin1_controller/buscar';
$route['NoticiasCirculares']                    = 'noticias_circulares/noticias_circulares_controller';
$route['TutorialesAxaltaCDP']                      = 'tutoriales/tutoriales_externos/tutoriales_externos_controller';
$route['TutorialesInternos']                    = 'tutoriales/tutoriales_internos/tutoriales_internos_controller';
*/