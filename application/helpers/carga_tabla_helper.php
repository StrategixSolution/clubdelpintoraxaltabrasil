<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 17 jun. 2026 13:19:05 * 
 */

function carga_tabla_helper($tipo,$row,$error,$CargaId){
    $lista="";
    switch ($tipo) {
        case 1:
            $error_var = utf8_encode(strtoupper(str_replace("'", "", $error)));
            $row0 = ($row[0]!="")?$row[0]:"&nbsp";
            $row1 = ($row[1]!="")?$row[1]:"&nbsp";
            $row2 = ($row[2]!="")?$row[2]:"&nbsp";
            $row3 = ($row[3]!="")?$row[3]:"&nbsp";
            $row4 = ($row[4]!="")?$row[4]:"&nbsp";
            $error_row = ($error_var!="")?$error_var:"&nbsp";
            $lista= '<tr>'.PHP_EOL.'
                <td>'.$CargaId.'</td>'.PHP_EOL.'
                <td>'.$row0.'</td>'.PHP_EOL.'
                <td>'.$row1.'</td>'.PHP_EOL.'
                <td>'.$row2.'</td>'.PHP_EOL.'
                <td>'.$row3.'</td>'.PHP_EOL.'
                <td>$ '.$row4.'</td>'.PHP_EOL.'
                <td>'.$error_row.'</td>'.PHP_EOL.'                                                                               
            </tr>'.PHP_EOL ;
            return $lista;
            break;
        case 2: 
            $error_var = utf8_encode(strtoupper(str_replace("'", "", $error)));
            $row0 = ($row[0]!="")?utf8_encode(strtoupper($row[0])):"&nbsp";
            $row1 = ($row[1]!="")?utf8_encode(strtoupper($row[1])):"&nbsp";
            $row2 = ($row[2]!="")?utf8_encode(strtoupper($row[2])):"&nbsp";
            $row3 = ($row[3]!="")?utf8_encode(strtoupper($row[3])):"&nbsp";
            $row4 = ($row[4]!="")?utf8_encode(strtoupper($row[4])):"&nbsp";
            $error_row = ($error_var!="")?$error_var:"&nbsp";
            $lista= '<tr>'.PHP_EOL.'
                <td>'.$CargaId.'</td>'.PHP_EOL.'
                <td>'.$row0.'</td>'.PHP_EOL.'
                <td>'.$row1.'</td>'.PHP_EOL.'
                <td>'.$row2.'</td>'.PHP_EOL.'
                <td>'.$row3.'</td>'.PHP_EOL.'
                <td>$ '.$row4.'</td>'.PHP_EOL.'
                <td>'.$error_row.'</td>'.PHP_EOL.'                                                                               
            </tr>'.PHP_EOL ;
            return $lista;       
            break;
        case 3: 
            $error_var = utf8_encode(strtoupper(str_replace("'", "", $error)));
            $row0 = ($row[0]!="")?utf8_encode(strtoupper($row[0])):"&nbsp";
            $row1 = ($row[1]!="")?utf8_encode(strtoupper($row[1])):"&nbsp";
            $row2 = ($row[2]!="")?(strtoupper($row[2])):"&nbsp";
            $row3 = ($row[3]!="")?utf8_encode(strtoupper($row[3])):"&nbsp";
            $error_row = ($error_var!="")?$error_var:"&nbsp";
            $lista= '<tr>'.PHP_EOL.'
                <td>'.$CargaId.'</td>'.PHP_EOL.'
                <td>'.$row0.'</td>'.PHP_EOL.'
                <td>'.$row1.'</td>'.PHP_EOL.'
                <td>'.$row2.'</td>'.PHP_EOL.'
                <td>'.$row3.'</td>'.PHP_EOL.'
                <td>'.$error_row.'</td>'.PHP_EOL.'                                                                               
            </tr>'.PHP_EOL ;
            return $lista;       
            break;        
    }
}