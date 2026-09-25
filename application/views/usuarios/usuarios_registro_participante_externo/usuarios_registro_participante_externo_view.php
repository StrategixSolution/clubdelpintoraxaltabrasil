<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<section class="aviso-registro" lang="pt-BR" aria-labelledby="aviso-registro-titulo">
	<style>
		.aviso-registro {
			--aviso-rojo: #c82127;
			--aviso-texto: #333333;
			--aviso-suave: #f7f8fa;
			padding: 56px 20px;
			/* background-color: var(--aviso-suave); */
		}

		.aviso-registro__contenido {
			max-width: 820px;
			margin: 0 auto;
			padding: 42px 48px;
			background-color: #ffffff;
			border-top: 5px solid var(--aviso-rojo);
			border-radius: 8px;
			box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
			color: var(--aviso-texto);
		}

		.aviso-registro__encabezado {
			display: flex;
			align-items: center;
			gap: 14px;
			margin-bottom: 26px;
		}

		.aviso-registro__icono {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 42px;
			height: 42px;
			border-radius: 50%;
			background-color: var(--aviso-rojo);
			color: #ffffff;
			font-size: 22px;
		}

		.aviso-registro h1 {
			margin: 0;
			color: var(--aviso-rojo);
			font-size: 26px;
			font-weight: 700;
		}

		.aviso-registro p {
			margin: 0 0 18px;
			font-size: 16px;
			line-height: 1.7;
		}

		.aviso-registro__sac {
			margin: 28px 0 0;
			padding-top: 20px;
			border-top: 1px solid #e2e5e9;
			color: var(--aviso-rojo);
			font-weight: 700;
		}

		.aviso-registro__acciones {
			display: flex;
			justify-content: flex-end;
			margin-top: 28px;
		}

		.aviso-registro__boton {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			min-height: 42px;
			padding: 10px 22px;
			border: 2px solid var(--aviso-rojo);
			border-radius: 4px;
			background-color: var(--aviso-rojo);
			color: #ffffff;
			font-size: 14px;
			font-weight: 700;
			text-decoration: none;
			transition: background-color 0.2s ease, color 0.2s ease;
		}

		.aviso-registro__boton:hover,
		.aviso-registro__boton:focus {
			background-color: #ffffff;
			color: var(--aviso-rojo);
			text-decoration: none;
		}

		@media (max-width: 576px) {
			.aviso-registro {
				padding: 32px 14px;
			}

			.aviso-registro__contenido {
				padding: 30px 24px;
			}

			.aviso-registro h1 {
				font-size: 22px;
			}

			.aviso-registro p {
				font-size: 15px;
			}

			.aviso-registro__boton {
				width: 100%;
			}
		}
	</style>

	<div class="aviso-registro__contenido" role="alert">
		<div class="aviso-registro__encabezado">
			<span class="aviso-registro__icono" aria-hidden="true">!</span>
			<h1 id="aviso-registro-titulo">Aviso importante</h1>
		</div>
		<p>
			Estamos realizando ajustes técnicos em nossa plataforma de cadastro, o que temporariamente impede novos registros pelo sistema. Enquanto isso, os interessados devem procurar uma loja conveniada e solicitar ao balconista ou líder que realize o cadastro. O processo é rápido e garante participação na promoção bimestral.
		</p>
		<p>
			<strong>Importante:</strong> quem já possui cadastro continua acessando normalmente com e-mail e senha. Pedimos desculpas por qualquer inconveniente e comunicaremos a previsão de conclusão assim que disponível, por meio dos distribuidores parceiros e canais oficiais.
		</p>
		<p class="aviso-registro__sac">
			<i class="fas fa-phone-alt"></i> SAC: (11) 99112-5567 / Equipe Clube do Pintor Axalta Brasil.
		</p>
		<div class="aviso-registro__acciones">
			<a class="aviso-registro__boton" href="<?= base_url("Login") ?>">
				Ir para o início
			</a>
		</div>
	</div>
</section>