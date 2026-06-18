<div>    
    <p style="text-align: right;">
        <?PHP if ($this->input->post("s_mat")!="" and $this->input->post("s_mat")!=0) { 
            $URL = "pintor/grafica/".$this->input->post("s_mat");
            ?> 
            <a  href="<?=$URL?>"><img src="<?=base_url()?>assets/application/image/iconos/grafica.png" width="30"></a>&nbsp;
        <?PHP } ?>        
        <img src="<?=base_url()?>assets/application/image/iconos/excel.png" width="30"> &nbsp; 
        <a id="xls_pintores" class="btn btn-dark btn-sm" style="color: #FFFFFF">Descargar</a>
    </p>
</div>
<div style="text-align: right;">Total de pintores : <span id="count"><?=$count?></span></div><br>
<div class="wmd-view-topscroll">
    <div class="scroll-div5">
    </div>
</div>
<div class="wmd-view">
    <div class="scroll-div6">
        <div class="table-responsive">
            <table class='table' id="mi-tabla">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <?PHP if ($this->session->userdata('s_id_perfil') == 1 || $this->session->userdata('s_id_perfil') == 8 || $this->session->userdata('s_id_participante')==56){ ?> 
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>E-mail</th>
                        <?PHP } ?> 
                        <th>Perfil</th>                                             
                        <th>Celular</th>
                        <th>No. Tarjeta</th>
                        <th>Talla</th>
                        <th>Id Distribuidor</th>
                        <th>C&oacute;digo</th>
                        <th>Raz&oacute;n Social</th>
                        <th>Nombre Comercial</th>
                        <th>Regi&oacute;n</th>
                        <th>Ejecutivo</th>
                        <th>Ciudad / Estado</th>
                        <th>Estatus de Alta de Tienda</th>
                        <th>Actividad de Tienda</th>
                        <th>C&oacute;digo Postal Tienda</th>
                        <th>C&oacute;digo Postal Maestro Pintor</th>
                        <th>De Evento</th>
                        <th>Es Externo</th>
                        <th>Fecha de Registro</th>
                        <th>Tipo Tarjeta</th>                       
                        <th>Firma</th>
                        <th>Identificaci&oacute;n</th>
                        <?php
                        if($this->session->userdata('s_id_perfil')==1 || $this->session->userdata('s_id_perfil')==5 || $this->session->userdata('s_id_perfil') == 6 || $this->session->userdata('s_id_perfil')==9 || $this->session->userdata('s_id_perfil')==8){
                        ?>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?=$tabla?>
                </tbody>
            </table>
        </div>
    </div>
</div>