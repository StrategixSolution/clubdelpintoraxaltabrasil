<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <section id="confirmacionRegistroMaestroPintor">
        <div class="panel-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>REGISTRO EXITOSO</h2>
                    </div>
                </div>
            </div>
        </div>  
        <div class="container">
            <div class="panel-secondary mt-50">
                <div class="row mt-20">
                    <div class="col-lg-6">
                        <canvas id="tarjetaCanvas" width="800" height="480" style="max-width: 100%; height: auto;"></canvas>
                        </div>
                    <div class="col-lg-6">
                        <h3>Este es el folio de tu tarjeta digital, asegúrate de tenerlo a la mano, podrás consultarlo también en tu perfil en la sección Mi tarjeta virtual. Recuerda que lo necesitarás para que puedan registrar tus compras.</h3>
                        <h4 class="mt-50">Para ingresar a tu perfil, estos son los accesos:</h4>
                        <p><b>NÚMERO DE TARJETA:</b> <span id="displayTarjetaTexto"></span></p> 
                        <p><b>USUARIO:</b> <span id="usuario"></span></p>
                        <p><b>CONTRASEÑA:</b> <span id="contrasena"></span></p>
                        <div class="txt-center">
                            <button type="button" class="btn btn-axalta" onclick="descargarTarjeta()">Descargar Tarjeta</button>
                        </div>
                        <h5 class="txt-center mt-20">¡Ingresa al sitio y conoce más sobre el programa!</h5>
                    </div>
                </div>      
            </div>      
            <div class="row mt-50">
                <div class="col-lg-12">
                    <ul>
                        <li>Esta tarjeta es de afiliación, personal e intransferible. La presente tarjeta no confiere a su portador y/o titular crédito alguno ni confiere la posibilidad de exigir el pago de cantidad alguna en efectivo de parte de Axalta. Axalta no será responsable en el caso de robo o extravío de la tarjeta, ni tampoco el mal uso que se haga de ella. El uso de la presente tarjeta es responsabilidad exclusiva del titular y/o portador de la misma. El uso de esta tarjeta constituye la aceptación de los términos y condiciones del programa. Axalta se reserva los derechos de modificar los términos y condiciones del servicio sin previo aviso.</li>
                        <li>Axalta y sus distribuidores se reservan el derecho a invitar al programa a quien consideren de conformidad con los términos y condiciones. La presente tarjeta es de afiliación y los beneficios derivados de ella, únicamente serán válidos en tiendas participantes, las mismas que cuentan con un identificador.</li>
                        <li>Para mayores informes sobre las políticas, términos y condiciones de este programa ingresa a www.axalta.mx o comunícate al 50892147 CDMX y Área Metropolitana, desde la República (01 55) 50892147</li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <!-- <a href="<?= base_url("Login") ?>"> <div class="d-grid gap-2"> -->
                    <a href="#"> <div class="d-grid gap-2">
                            <button type="button" class="btn btn-axalta" id="btnIrLogin">Aceptar</button>
                        </div>
                    </a>
                </div>
            </div>      
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tarjeta = sessionStorage.getItem("tarjeta");
            let usuario = sessionStorage.getItem("usuario");
            let contrasena = sessionStorage.getItem("contrasena");

            // URL de la imagen base de la tarjeta.
            // Asegúrate de que esta ruta sea correcta y accesible desde el navegador.
            const imagenBaseUrl = '<?= base_url("application/views/template/login/imagenes/tarjeta.png") ?>';
            
            // Validar que existan los datos; si no, redirigir al login
            if (!tarjeta || !usuario || !contrasena) {
                window.location.href = '<?= base_url("Login") ?>';
                return; // Importante para detener la ejecución si no hay datos
            } else {
                // Mostrar los datos de texto (si aún los quieres, si no, elimina estas líneas)
                $("#displayTarjetaTexto").html(tarjeta); 
                $("#usuario").html(usuario);
                $("#contrasena").html(contrasena);

                // **Lógica para dibujar la tarjeta en el canvas**
                const canvas = document.getElementById('tarjetaCanvas');
                const ctx = canvas.getContext('2d');
                const tarjetaImg = new Image();

                tarjetaImg.onload = function() {
                    canvas.width = tarjetaImg.width;
                    canvas.height = tarjetaImg.height;
                    ctx.drawImage(tarjetaImg, 0, 0);

                    // Configura la fuente, tamaño y color del texto
                    // **AJUSTA ESTOS VALORES PARA LA POSICIÓN Y ESTILO EN TU IMAGEN**
                    ctx.font = '80px Arial'; // Puedes probar con otros tamaños y fuentes (ej. 'bold 36px sans-serif')
                    ctx.fillStyle = 'white'; // Color del texto (negro)
                    ctx.textAlign = 'left'; // Alineación del texto

                    // Ajustar las coordenadas X e Y.
                    // Necesitarás experimentar para encontrar la posición exacta en tu imagen.
                    // La imagen 'tarjeta.jpg' subida tiene un espacio blanco en la parte superior izquierda.
                    // Estas son ESTIMACIONES, deberás probar y ajustar.
                    const xPos = 1850; // Medida desde la izquierda del canvas
                    const yPos = 700; // Medida desde la parte superior del canvas (es la línea base del texto)

                    // Dibuja el número de tarjeta
                    ctx.fillText(tarjeta, xPos, yPos);
                };

                tarjetaImg.onerror = function() {
                    console.error("No se pudo cargar la imagen de la tarjeta:", imagenBaseUrl);
                    // Opcional: Mostrar un mensaje de error en el canvas o en algún lugar de la página
                    const ctx = document.getElementById('tarjetaCanvas').getContext('2d');
                    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpia el canvas
                    ctx.fillStyle = 'red';
                    ctx.font = '20px Arial';
                    ctx.fillText('Error al cargar la tarjeta', 10, 50);
                };

                tarjetaImg.src = imagenBaseUrl; // Asigna la URL a la imagen
            }
        });

        $('#btnIrLogin').on('click', function(event) {
            Swal.fire({
                title: "",
                text: "Acepto los términos y condiciones de la tarjeta virtual",
                icon: "warning",
                showCancelButton: false,
                confirmButtonText: "Aceptar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "¡Gracias!",
                        html: "Te invitamos a conocer nuestro calendario de capacitaciones de Axalta dando clic en el siguiente link: <br><a href='https://www.axalta.com/mx/es_ES/capacitacion.html' target='_blank'>https://www.axalta.com/mx/es_ES/capacitacion.html</a>",
                        icon: "success",
                        confirmButtonText: "Aceptar"
                    }).then((result2) => {
                        if (result2.isConfirmed) {
                            
                            $.ajax({
                                type: 'POST',
                                url: '<?= base_url("usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_aceptar_registro") ?>',
                                dataType: 'json',
                                success: function(r){
                                    // opcional: console.log(r);
                                },
                                complete: function() {
                                    window.location.href = "<?= base_url('Login') ?>";
                                }
                            });

                        }
                    });
                }
            });
        });

        // Opcional: Función para descargar la tarjeta (no en el HTML original, pero es útil)
        function descargarTarjeta() {
            const canvas = document.getElementById('tarjetaCanvas');
            const link = document.createElement('a');
            link.download = `tarjeta_club_pintor_${sessionStorage.getItem('tarjeta') || 'generada'}.png`; 
            link.href = canvas.toDataURL('image/png'); // Convertir canvas a URL de imagen PNG
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
