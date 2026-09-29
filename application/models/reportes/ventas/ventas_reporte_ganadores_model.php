<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_reporte_ganadores_model extends Base_Model {

    public function __construct(){
        parent::__construct();
    }

    // AÑOS donde hay registros (GANADORES)
    public function ventas_reporte_ganadores_model_anios(){
        $SQL = "
            SELECT DISTINCT ReposicionProductoGanadorAnio AS anio
            FROM ReposicionesProductosGanadores
            ORDER BY anio DESC
        ";
        return $this->db->query($SQL)->result();
    }

    // Periodos bimestrales donde hay registros por año (regresa mes_fin: 2,4,6,8,10,12)
    public function ventas_reporte_ganadores_model_periodos_bimestrales($anio){
        $anio = (int)$anio;

        $SQL = "
            SELECT DISTINCT
                CASE
                    WHEN ReposicionProductoGanadorMes IN (1,2) THEN 2
                    WHEN ReposicionProductoGanadorMes IN (3,4) THEN 4
                    WHEN ReposicionProductoGanadorMes IN (5,6) THEN 6
                    WHEN ReposicionProductoGanadorMes IN (7,8) THEN 8
                    WHEN ReposicionProductoGanadorMes IN (9,10) THEN 10
                    WHEN ReposicionProductoGanadorMes IN (11,12) THEN 12
                END AS mes_fin
            FROM ReposicionesProductosGanadores
            WHERE ReposicionProductoGanadorAnio = $anio
            ORDER BY mes_fin ASC
        ";
        return $this->db->query($SQL)->result();
    }

    // Distribuidores existentes (activos y con fecha de activaci�n) -> para combo
    public function ventas_reporte_ganadores_model_distribuidores(){
        $SQL = "
            ;WITH DD_ULT AS (
                SELECT
                    DD.*,
                    ROW_NUMBER() OVER (
                        PARTITION BY DD.DistribuidorId
                        ORDER BY DD.DistribuidorDetalleId DESC
                    ) AS rn
                FROM DistribuidoresDetalles DD
            )
            SELECT
                DD.DistribuidorId AS ID_DISTRIBUIDOR,
                DD.DistribuidorDetalleCodigo AS CODIGO,
                CASE
                    WHEN LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500)), ''))) <> ''
                        THEN LTRIM(RTRIM(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500))))
                    ELSE LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), '')))
                END AS NOMBRE_COMERCIAL
            FROM DD_ULT DD
            WHERE DD.rn = 1
              AND DD.DistribuidorDetalleFechaBaja IS NULL
              AND DD.DistribuidorDetalleFechaActivacion IS NOT NULL
            ORDER BY DD.DistribuidorDetalleNombreComercial ASC
        ";
        return $this->db->query($SQL)->result();
    }

    // Data del reporte (GANADORES) -> basado en ReposicionesProductosGanadores (como el original MySQL)
 public function ventas_reporte_ganadores_model_datos($anio, $mesIni, $mesFin, $distId){
        $anio   = (int)$anio;
        $mesIni = (int)$mesIni;
        $mesFin = (int)$mesFin;
        $distId = (int)$distId;

        $filtroDist = "";
        if ($distId > 0){
            $filtroDist = " AND RG.DistribuidorId = $distId ";
        }

        // ✅ IMPORTANTE: el premio se configura por MES (normalmente el MES FIN del bimestre)
        // Ej: Sept-Oct => mesFin = 10, y en Premios el registro está en mes 10.
        $mesPremio = $mesFin;

        $SQL = "
            ;WITH DD_ULT AS (
                SELECT
                    DD.*,
                    ROW_NUMBER() OVER (
                        PARTITION BY DD.DistribuidorId
                        ORDER BY DD.DistribuidorDetalleId DESC
                    ) AS rn
                FROM DistribuidoresDetalles DD
                WHERE DD.DistribuidorDetalleFechaBaja IS NULL
                  AND DD.DistribuidorDetalleFechaActivacion IS NOT NULL
            )
            SELECT
                UD.UsuarioId AS ID_MAESTRO_PINTOR,

                LTRIM(RTRIM(ISNULL(UD.UsuarioDetalleNombre, ''))) AS MAESTRO_PINTOR,

                DD.DistribuidorId AS ID_DISTRIBUIDOR,
                ISNULL(CAST(DD.DistribuidorDetalleCodigo AS VARCHAR(20)),'') AS CODIGO,
                ISNULL(DD.DistribuidorDetalleNombreComercial,'') AS NOMBRE_COMERCIAL,
                'AXALTA' AS TIPO_DISTRIBUIDORA,

                -- Ejecutivo (perfil 7)
                ISNULL((
                    SELECT TOP 1
                        LTRIM(RTRIM(ISNULL(UD2.UsuarioDetalleNombre, '')))
                    FROM UsuariosDistribuidores UDIS
                    INNER JOIN Usuarios U2
                        ON U2.UsuarioId = UDIS.UsuarioId
                       AND U2.PerfilId = 7
                       AND U2.UsuarioFechaBajaDistribuidora IS NULL
                    INNER JOIN UsuariosDetalles UD2
                        ON UD2.UsuarioId = U2.UsuarioId
                       AND UD2.UsuarioDetalleFechaBaja IS NULL
                    WHERE UDIS.DistribuidorId = RG.DistribuidorId
                ), 'SIN EJECUTIVO') AS EJECUTIVO,

                (ISNULL(DD.DistribuidorDetalleCiudad,'') + ' / ' + ISNULL(CAST(DD.DistribuidorDetalleUnidadFederativa AS VARCHAR),'')) AS CIUDAD_ESTADO,

                ISNULL(RG.ReposicionProductoGanadorPremioLugar,'') AS LUGAR,

                -- OPCIONES por (AÑO + MES PREMIO + LUGAR)
                ISNULL((
                     CHAR(10) +
                    ISNULL(
                        STUFF((
                            SELECT
                                CHAR(10) + CAST(R2.ReposicionProductoPremioProductoRelacionNumero AS VARCHAR(10)) + '. ' +
                                ISNULL(PP.ReposicionProductoPremioProductoDescripcion,'')
                            FROM ReposicionesProductosPremios PR2
                            INNER JOIN ReposicionesProductosPremiosProductosRelaciones R2
                                ON PR2.ReposicionProductoPremioId = R2.ReposicionProductoPremioId
                               AND R2.ReposicionProductoPremioProductoRelacionFechaBaja IS NULL
                            INNER JOIN ReposicionesProductosPremiosProductos PP
                                ON PP.ReposicionProductoPremioProductoId = R2.ReposicionProductoPremioProductoId
                            WHERE PR2.ReposicionProductoPremioLugar = RG.ReposicionProductoGanadorPremioLugar
                              AND PR2.ReposicionProductoPremioAnio  = $anio
                              AND PR2.ReposicionProductoPremioMes   = $mesPremio
                            ORDER BY R2.ReposicionProductoPremioProductoRelacionNumero
                            FOR XML PATH(''), TYPE
                        ).value('.','NVARCHAR(MAX)'), 1, 1, ''), '')
                ), 'Elije solo una de las siguientes opciones') AS DESCRIPCION_PREMIO

            FROM ReposicionesProductosGanadores RG
            INNER JOIN UsuariosDetalles UD
                ON RG.UsuarioId = UD.UsuarioId
               AND UD.UsuarioDetalleFechaBaja IS NULL
            INNER JOIN DD_ULT DD
                ON RG.DistribuidorId = DD.DistribuidorId
               AND DD.rn = 1
            LEFT JOIN UnidadFederativas UF
                ON UF.UnidadFederativaId = DD.DistribuidorDetalleUnidadFederativa
            WHERE RG.ReposicionProductoGanadorAnio = $anio
              AND RG.ReposicionProductoGanadorMes IN ($mesIni, $mesFin)
              $filtroDist

            ORDER BY MAESTRO_PINTOR ASC
        ";

        return $this->db->query($SQL)->result();
    }


}