<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 17 jun. 2026 13:19:05 * 
 */

function carga_validacion_helper($tipo,$row){
    $error="";
    switch ($tipo) {
        case 1:
            $error.= (trim($row[0])=="")?strtoupper(utf8_decode("LA CELDA DESCRIPCIÓN ESTÁ VACÍA<br>")):NULL;
            $error.= (trim($row[1])=="")?strtoupper(utf8_decode("LA CELDA GMS ESTÁ VACÍA<br>")):NULL;
            $error.= (trim($row[2])=="")?strtoupper(utf8_decode("LA CELDA CÓDIGO ESTÁ VACÍA<br>")):NULL;
            $error.= (trim($row[3])=="")?strtoupper(utf8_decode("LA CELDA PRESENTACIÓN ESTÁ VACÍA<br>")):NULL;
            $error.= (trim($row[4])=="")?strtoupper(utf8_decode("LA CELDA PRECIO ESTÁ VACÍA<br>")):NULL;
            $error.= (is_numeric(trim($row[4])))?NULL:strtoupper(utf8_decode("LA CELDA PRECIO NO ES NÚMERICA<br>"));
            break;
        case 2: 
            $error.= (trim($row[0])=="")?strtoupper(utf8_decode("LA CELDA AÑO ESTÁ VACÍA<br>")):((is_numeric(trim($row[0])))?NULL:strtoupper(utf8_decode("LA CELDA AÑO NO ES NÚMERICA<br>")));
            $error.= (trim($row[1])=="")?strtoupper(utf8_decode("LA CELDA MES ESTÁ VACÍA<br>")):((is_numeric(trim($row[1])))?NULL:strtoupper(utf8_decode("LA CELDA MES NO ES NÚMERICA<br>")));
            $error.= (trim($row[2])=="")?strtoupper(utf8_decode("LA CELDA LUGAR ESTÁ VACÍA<br>")):((is_numeric(trim($row[2])))?NULL:strtoupper(utf8_decode("LA CELDA LUGAR NO ES NÚMERICA<br>")));
            $error.= (trim($row[3])=="")?strtoupper(utf8_decode("LA CELDA RANGO INICIAL ESTÁ VACÍA<br>")):((is_numeric(trim($row[3])))?NULL:strtoupper(utf8_decode("LA CELDA RANGO INICIAL NO ES NÚMERICA<br>")));
            $error.= (trim($row[4])=="")?strtoupper(utf8_decode("LA CELDA RANGO FINAL ESTÁ VACÍA<br>")):((is_numeric(trim($row[4])))?NULL:strtoupper(utf8_decode("LA CELDA RANGO FINAL NO ES NÚMERICA<br>")));
            $error.= ($row[3]>$row[4])?strtoupper(utf8_decode("EL VALOR INICIAL ES MAYOR QUE EL FINAL<br>")):NULL;
            break;
        case 3:
            $error.= (trim($row[0])=="")?strtoupper(utf8_decode("LA CELDA GMS ESTÁ VACÍA<br>")):NULL;
            $error.= (trim($row[1])=="")?strtoupper(utf8_decode("LA CELDA CÓDIGO ESTÁ VACÍA<br>")):NULL;
            $error.= (trim($row[2])=="")?strtoupper(utf8_decode("LA CELDA DESCRIPCIÓN ESTÁ VACÍA<br>")):NULL;
            $error.= (trim($row[3])=="")?strtoupper(utf8_decode("LA CELDA PRESENTACIÓN ESTÁ VACÍA<br>")):NULL;
            break;        
    }
    $error = substr ($error, 0, strlen($error) - 4);
    return $error;
}