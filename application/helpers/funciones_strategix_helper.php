<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 09 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

function funciones_strategix_normalizar_cadena($cadenaOrigen){
    $originales  = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadenaUTF8 = utf8_decode($cadenaOrigen);
    $cadenaStrtr = strtr($cadenaUTF8, utf8_decode($originales), $modificadas);
    $cadenaStrtolower = strtolower($cadenaStrtr);
    return utf8_encode($cadenaStrtolower);
}
function funciones_strategix_crear_password($length=0) {
    $cadena = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/%&$#';
    $Length = strlen($cadena);
    $password = '';
    for ($i = 0; $i < $length; $i++) { $password .= $cadena[rand(0, $Length - 1)]; }
    return $password;
}
function funciones_strategix_crear_user($txt_nom,$txt_ap,$Id) {        
    return funciones_strategix_normalizar_cadena(mb_strtolower(substr($txt_nom, 0, 1).substr(str_replace(" ", "_", $txt_ap),0,3))).$Id;  
}
function funciones_strategix_formato_fecha_hora_actual() {    
    $fecha_actual = date('Y-m-dTH:i:s');
    if(strpos($fecha_actual, "CST") !== false){
        $fecha_horario = str_replace("CST","T",$fecha_actual);
    } else if(strpos($fecha_actual, "MDT") !== false){ 
        $fecha_horario = str_replace("MDT","T",$fecha_actual);
    } else if(strpos($fecha_actual, "MST") !== false){ 
        $fecha_horario = str_replace("MST","T",$fecha_actual);        
    } else if(strpos($fecha_actual, "CDT") !== false){ 
        $fecha_horario = str_replace("CDT","T",$fecha_actual);
    } 
    return $fecha_horario;
}
function funciones_strategix_convertir_fecha_hora_actual($fecha_hora) {    
    $fecha = date('Y-m-dTH:i:s', strtotime($fecha_hora));
    if(strpos($fecha, "CST") !== false){
        $fecha_horario = str_replace("CST","T",$fecha);
    } else if(strpos($fecha, "MDT") !== false){ 
        $fecha_horario = str_replace("MDT","T",$fecha);
    } else if(strpos($fecha, "MST") !== false){ 
        $fecha_horario = str_replace("MST","T",$fecha);        
    } else if(strpos($fecha, "CDT") !== false){ 
        $fecha_horario = str_replace("CDT","T",$fecha);
    }  
    return $fecha_horario;
}
function funciones_strategix_fecha_hora_actual() {
    return date('Y').date('m').date('d').date('H').date('i').date('s');
}
function funciones_strategix_formato_fecha_actual() {
    return date('Y').date('m').date('d');
}
function funciones_strategix_formato_fecha_actual_txt() {
    return date('Y')."-".date('m')."-".date('d');
}
function funciones_strategix_anio() {
    return date('Y');
}
function funciones_strategix_mes() {
    return date('m');
}
function funciones_strategix_mes_numero_texto($m){//Obtener texto de Mes
    switch ($m) {
        case '1':   $mes = 'Janeiro';         break;
        case '2':   $mes = 'Fevereiro';       break;
        case '3':   $mes = 'Março';         break;
        case '4':   $mes = 'Abril';         break;
        case '5':   $mes = 'Maio';          break;
        case '6':   $mes = 'Junho';         break;
        case '7':   $mes = 'Julho';         break;
        case '8':   $mes = 'Agosto';        break;
        case '9':   $mes = 'Setembro';    break;
        case '10':  $mes = 'Outubro';       break;
        case '11':  $mes = 'Novembro';     break;
        case '12':  $mes = 'Dezembro';     break;       
    }
    return $mes;
}
function funciones_strategix_promedio_fechas_meses($fechaInicio,$fechaFin) {
    $datetime1=new DateTime($fechaInicio);
    $datetime2=new DateTime($fechaFin);
    $interval=$datetime2->diff($datetime1);
    $intervalMeses=$interval->format("%m");
    $intervalAnos = $interval->format("%y")*12;  
    $totalPromedio = $intervalMeses+$intervalAnos;
    return $totalPromedio;
}
function funciones_strategix_promedio_fechas_dias_naturales($fechaInicio,$fechaFin) {
    $datetime1=new DateTime($fechaInicio);
    $datetime2=new DateTime($fechaFin);
    $interval=$datetime2->diff($datetime1);
    $intervalMeses=$interval->format("%d");
    $intervalAnos = $interval->format("%m")*24;  
    $totalPromedio = $intervalMeses+$intervalAnos;
    return $totalPromedio;
}
function funciones_strategix_validar_formato_email($email){
    if (!empty($email)) {
        $regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        (!preg_match($regex, $email)) ? $response =  false : $response =  true;
    } else {
        $response = false;
    }
    return $response;
}
function funciones_strategix_promedio_fechas_dias_laborales($fechaInicio,$fechaFin) {
    $fechaInicio = new DateTime($fechaInicio);
    $fechaFin = new DateTime($fechaFin);

    // Inicializa el contador de días hábiles a 0
    $diasHabiles = 0;

    // Itera a través de cada día entre las dos fechas
    while ($fechaInicio <= $fechaFin) {
        // Si el día actual no es fin de semana (sábado o domingo), aumenta el contador de días hábiles
        if ($fechaInicio->format('N') < 6) {
            $diasHabiles++;
        }
        // Avanza al siguiente día
        $fechaInicio->modify('+1 day');
    }
    return $diasHabiles;
}
function funciones_strategix_promedio_fechas_minutos($fechaInicio,$fechaFin) {
    $datetime1=new DateTime($fechaInicio);
    $datetime2=new DateTime($fechaFin);
    $interval=$datetime2->diff($datetime1);
    $intervalminutos=$interval->format("%i");
    $intervalhoras = $interval->format("%H")*60;  
    $totalPromedio = $intervalminutos+$intervalhoras;
    return $totalPromedio;
}
function funciones_strategix_convertir_bytes($bytes, $to, $decimal_places = 1) {
    $formulas = array(
        'K' => number_format($bytes / 1024, $decimal_places),
        'M' => number_format($bytes / 1048576, $decimal_places),
        'G' => number_format($bytes / 1073741824, $decimal_places)
    );
    return isset($formulas[$to]) ? $formulas[$to] : 0;
}
function funciones_strategix_solo_numeros($cadena){
    return preg_replace('/[^0-9]/', '', $cadena);    
}
function funciones_strategix_version_url_random($pagina = ""){
    $uniqueId = substr(uniqid(rand(), TRUE),0,10);
    return $pagina.'?v='.$uniqueId.funciones_strategix_fecha_hora_actual();
}
function funciones_strategix_version_url_random_base_url($pagina = ""){
    $uniqueId = substr(uniqid(rand(), TRUE),0,10);
    return base_url($pagina.'?v='.$uniqueId.funciones_strategix_fecha_hora_actual());
}
function funciones_strategix_sitio_alias($link = ""){  
    return $link."_axalta_mx_3";
}
function funciones_strategix_valida_terminos_condiciones_aviso_privacidad_actualiza_datos($fecha){
    return (empty($fecha))?0:1;
}
function funciones_strategix_replace_html($texto){ 
    $texto = str_replace("&","&#38;",$texto);
    $texto = str_replace("!","&#33;",$texto);
    $texto = str_replace('"',"&#34;",$texto);
    $texto = str_replace("#","&#35;",$texto);
    $texto = str_replace("$","&#36;",$texto);
    $texto = str_replace("%","&#37;",$texto);
    $texto = str_replace("'","&#39;",$texto);
    $texto = str_replace("(","&#40;",$texto);
    $texto = str_replace(")","&#41;",$texto);
    $texto = str_replace("*","&#42;",$texto);
    $texto = str_replace("+","&#43;",$texto);
    $texto = str_replace(",","&#44;",$texto);
    $texto = str_replace("-","&#45;",$texto);
    $texto = str_replace(".","&#46;",$texto);
    $texto = str_replace("/","&#47;",$texto);  
    return $texto;
}
function funciones_strategix_replace_html_to_text($texto){   
    $texto = str_replace("&#38;","&",$texto);
    $texto = str_replace("&#33;","!",$texto);
    $texto = str_replace("&#34;",'"',$texto);
    $texto = str_replace("&#35;","#",$texto);
    $texto = str_replace("&#36;","$",$texto);
    $texto = str_replace("&#37;","%",$texto);
    $texto = str_replace("&#39;","'",$texto);
    $texto = str_replace("&#40;","(",$texto);
    $texto = str_replace("&#41;",")",$texto);
    $texto = str_replace("&#42;","*",$texto);
    $texto = str_replace("&#43;","+",$texto);
    $texto = str_replace("&#44;",",",$texto);
    $texto = str_replace("&#45;","-",$texto);
    $texto = str_replace("&#46;",".",$texto);
    $texto = str_replace("&#47;","/",$texto);  
    return $texto;
}
function function_strategix_excel_colums($end_column, $first_letters = ''){
    $columns = array();
    $length = strlen($end_column);
    $letters = range('A', 'Z');
    // Iterate over 26 letters.
    foreach ($letters as $letter) {
        // Paste the $first_letters before the next.
        $column = $first_letters . $letter;

        // Add the column to the final array.
        $columns[] = $column;

        // If it was the end column that was added, return the columns.
        if ($column == $end_column)
            return $columns;
    }
    // Add the column children.
    foreach ($columns as $column) {
        // Don't itterate if the $end_column was already set in a previous itteration.
        // Stop iterating if you've reached the maximum character length.
        if (!in_array($end_column, $columns) && strlen($column) < $length) {
            $new_columns = function_strategix_excel_colums($end_column, $column);
            // Merge the new columns which were created with the final columns array.
            $columns = array_merge($columns, $new_columns);
        }
    }
  return $columns;
}
function function_strategix_dias_laborales_anio($inicio, $fin,$arreglo_dias){
    foreach ($arreglo_dias as $rows) { $holidays[] = $rows["DiaFestivoFecha"]; }
    $start = new DateTime($inicio);
    $end = new DateTime($fin);

    //de lo contrario, se excluye la fecha de finalización (¿error?)
    $end->modify('+1 day');

    $interval = $end->diff($start);

    // total dias
    $days = $interval->days;

    // crea un período de fecha iterable (P1D equivale a 1 día)
    $period = new DatePeriod($start, new DateInterval('P1D'), $end);

    foreach($period as $dt) {
        $curr = $dt->format('D');

        // obtiene si es Sábado o Domingo
        if($curr == 'Sat' || $curr == 'Sun') {
            $days--;
        }elseif (in_array($dt->format('Y-m-d'), $holidays)) {
            $days--;
        }
    }
    return $days;
}
function function_strategix_ultimo_dia_mes($mes, $ano) {
    // Validamos que el mes y el año sean numéricos
    if (!is_numeric($mes) || !is_numeric($ano)) {
        return false;
    }
    
    // Obtenemos el último día del mes
    $ultimoDia = date('t', strtotime("$ano-$mes-01"));
    
    return $ultimoDia;
}
function funciones_strategix_convertir_fecha_primer_dia($fechaBD) {
    // Convertir la fecha de la base de datos en un objeto DateTime
    $fecha = new DateTime($fechaBD);
    
    // Formatear la fecha para que siempre tenga el primer día del mes
    $nuevaFecha = $fecha->format('Y-m-01');
    
    // Devolver la fecha formateada
    return $nuevaFecha;
}

function creatUserName($txt_nom,$txt_ap,$Id) {        
    return funciones_strategix_normalizar_cadena(mb_strtolower(substr($txt_nom, 0, 1).substr(str_replace(" ", "_", $txt_ap),0,3))).$Id;  
}
