# cdpBrasil20260326_V4.bak — Análisis de Base de Datos

> Generado: 30 de marzo de 2026  
> Archivo: `BD\cdpBrasil20260326_V4.bak`

---

## Información General del Backup

| Campo | Valor |
|-------|-------|
| **Nombre BD** | `clubdelpintoraxaltabrasil` |
| **Servidor origen** | `LenovoLuisFe` |
| **Tipo de backup** | Completo (`FULL`) |
| **Fecha de backup** | 26/03/2026 12:28:17 |
| **Tamaño** | ~12.1 MB (12,674,048 bytes) |
| **Versión SQL Server** | SQL Server 2022 (RTM) 16.0.1000.6 |
| **Nivel de compatibilidad** | 160 |
| **Collation** | `Latin1_General_100_CI_AS` |
| **Modelo de recuperación** | `FULL` |
| **Usuario propietario** | `LenovoLuisFe\luisf` |

---

## Esquemas

| Esquema | Uso |
|---------|-----|
| `dbo` | Esquema principal — contiene todos los objetos de la aplicación |
| `guest`, `INFORMATION_SCHEMA`, `sys` | Esquemas del sistema (sin objetos propios) |
| `pruebas_clubdelpintoraxaltamexico`, `FandeliUser` | Residuos de migraciones anteriores (sin objetos) |

---

## Tablas (69 tablas en esquema `dbo`)

### Grupo: Cargas / Multimedia

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `Cargas` | `CargaId` IDENTITY | `CargaTipoId`, `CargaNombreArchivoOriginal`, `CargaNombreArchivoModificado`, `CargaFechaRegistro` |
| `CargasMultimedias` | `CargaMultimediaId` IDENTITY | `Ruta`, `Extension`, `Thumbnail`, `Texto`, `TipoId`, `ModuloId`, `VideoTipoId`, `FechaInicial`, `FechaFinal`, `Download` |
| `CargasMultimediasModulos` | `CargaMultimediaModuloId` IDENTITY | `CargaMultimediaModuloDescripcion` |
| `CargasMultimediasPerfiles` | `CargaMultimediaPerfil` IDENTITY | `CargaMultimediaId`, `PerfilId` |
| `CargasMultimediasTipos` | `CargaMultimediaTipoId` IDENTITY | `CargaMultimediaTipoDescripcion` |
| `CargasMultimediasVideosTipos` | `CargaMultimediaVideoTipoId` IDENTITY | `CargaMultimediaVideoTipoDescripcion` |
| `CargasPremiosProductos` | `CargaPremioProductoId` IDENTITY | `CargaId`, `Descripcion`, `GMS`, `Codigo`, `Presentacion`, `Precio`, `Observaciones` |
| `CargasRecompensas` | `CargaRecompensaId` IDENTITY | `CargaId`, `Anio`, `Mes`, `PremioLugar`, `RangoInicial`, `RangoFinal` |
| `CargasTipos` | `CargaTipoId` IDENTITY | `CargaTipoDescripcion` |
| `CargasVentasPromocionesDetalles` | `CargaVentaPromocionDetalleId` IDENTITY | `CargaId`, `GMC`, `Codigo`, `Descripcion`, `Presentacion` |

### Grupo: Control / Sistema

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `CompaniasCelulares` | `CompaniaCelularId` IDENTITY | `CompaniaCelularNombre` |
| `ControlModulos` | `ControlModuloId` IDENTITY | `ControlModuloNombre`, `ControlModuloEstatus` (smallint) |
| `LogRegistros` | `LogRegistroID` IDENTITY | `FechaCreacion`, `IP`, `SistemaOperativo`, `Host`, `UsuarioId`, `PaginaAccesadaId`, `AvisoCookie1/2` |
| `PaginaAccesadas` | `PaginaAccesadaId` IDENTITY | `PaginaAccesadaPagina`, `PaginaAccesadaDescripcion` |

### Grupo: Cortes / Bimestrales

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `Cortes` | `CorteId` IDENTITY | `CorteTipoId`, `Anio`, `Mes`, `FechaRegistro`, `CorteIdOtro` |
| `CortesBimestralesDistribuidores` | `CorteBimestralDistribuidorId` IDENTITY | `CorteId`, `DistribuidorDetalleId`, `DistribuidorId`, `Codigo`, `RazonSocial`, `RegionId`, `Estatus`, `CantidadTicktes`, `VentaMontoTicket` |
| `CortesBimestralesMaestrosPintores` | `CorteBimestralMaestroPintorId` IDENTITY | `CorteId`, `UsuarioIdMP`, `MaestroPintor`, `EstatusMaestroPintor`, `CantidadTickets`, `VentaMontoTicket`, `PremioLugar` |
| `CortesBimestralesPerfiles` | `CortesBimestralPerfilId` IDENTITY | `CorteId`, `PerfilId`, `PerfilDescripcion`, `CantidadTicktes`, `VentaMontoTicket` |
| `CortesBimestralesVentas` | `CorteBimestralVentaId` IDENTITY | `CorteId`, `VentaId`, `TarjetaId`, `UsuarioIdMP`, `VentaMontoTicket`, `Mes`, `VentaEstatus`, `VentaEstatusAuditoria` |
| `CortesCambioEstatusVentasAuditoria` | `CortesCambioEstatusVentasAuditoriaId` IDENTITY | `CorteId`, `VentaId`, `TarjetaId`, `TarjetaNumero`, `VentaNumeroTicket`, `VentaMontoTicket` |
| `CortesGanadores` | `CorteGanadorId` IDENTITY | `CorteId`, `Anio`, `Mes`, `PremioLugar`, `TotalSumaVentas`, `TotalCuentaVentas`, `TarjetaId`, `UsuarioId`, `DistribuidorId`, `RecompensaTipoId` |
| `CortesTipos` | `CorteTipoId` IDENTITY | `CorteTipoDescripcion` |

### Grupo: Distribuidores

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `Distribuidores` | `DistribuidorId` IDENTITY | `FechaAlta`, `FechaBaja`, `Matriz`, `DistribuidorSessionId` |
| `DistribuidoresActivasRE` | `DistribuidorActivaREId` IDENTITY | `DistribuidorId`, `FechaRegistro`, `FechaBaja`, `NombreRegistro` |
| `DistribuidoresActivos` | `DistribuidorActivoId` IDENTITY | `DistribuidorId`, `Anio`, `Mes`, `NoVentas`, `FechaRegistro` |
| `DistribuidoresDetalles` | `DistribuidorDetalleId` IDENTITY | `DistribuidorId`, `Codigo`, `RazonSocial`, `NombreComercial`, `CP`, `Estado`, `Ciudad`, `RFC`, `Telefono`, `Latitud`, `Longitud`, `RegionId`, `CategoriaId`, `EtapaId`, `FaceId`, `ProductoListaId`, `GrupoBonificacion`, `Lealtad` |
| `DistribuidoresDetallesCategorias` | `DistribuidorDetalleCategoriaId` IDENTITY | `Nombre` |
| `DistribuidoresDetallesEtapas` | `DistribuidorDetalleEtapaId` IDENTITY | `Nombre` |
| `DistribuidoresDetallesFaces` | `DistribuidorDetalleFaceId` IDENTITY | `Nombre` |
| `DistribuidoresDetallesProductosListas` | `DistribuidorDetalleProductoListaId` IDENTITY | `Nombre`, `ColorId` |
| `DistribuidoresDetallesRegiones` | `DistribuidorDetalleRegionId` IDENTITY | `Nombre` |

### Grupo: Productos

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `ProductosClases` | `ProductoClaseId` IDENTITY | `Descripcion`, `FechaRegistro`, `FechaBaja` |
| `ProductosDivisiones` | `ProductoDivisionId` IDENTITY | `Nombre` |
| `ProductosMarcas` | `ProductoMarcaId` IDENTITY | `ProductoClaseId`, `Descripcion`, `FechaRegistro`, `FechaBaja` |

### Grupo: Recompensas / Reposiciones

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `Recompensas` | `RecompensaId` IDENTITY | `Anio`, `Mes`, `PremioLugar`, `RangoInicial`, `RangoFinal`, `RecompensaTipoId` |
| `RecompensasTipos` | `RecompensaTipoId` IDENTITY | `Descripcion` |
| `ReposicionesProductosFotos` | `ReposicionProductoFotoId` IDENTITY | `Anio`, `Mes`, `FotoOriginal`, `FotoModificada`, `Extension`, `DistribuidorId`, `FotoTipoId` |
| `ReposicionesProductosFotosTipos` | `ReposicionProductoFotoTipoId` IDENTITY | `Descripcion` |
| `ReposicionesProductosGanadores` | `ReposicionProductoGanadorId` IDENTITY | `Anio`, `Mes`, `PremioLugar`, `TarjetaId`, `UsuarioId`, `DistribuidorId`, `TotalProductoPremio`, `TotalSumaVentas`, `TotalCuentaVentas`, `FechaEntregaTienda` |
| `ReposicionesProductosPremios` | `ReposicionProductoPremioId` IDENTITY | `Anio`, `Mes`, `PremioLugar`, `ProductoDivisionId` |
| `ReposicionesProductosPremiosProductos` | `ReposicionProductoPremioProductoId` IDENTITY | `Descripcion`, `GMS`, `Codigo`, `Presentacion`, `Precio` |
| `ReposicionesProductosPremiosProductosRelaciones` | `ReposicionProductoPremioProductoRelacionId` IDENTITY | `ReposicionProductoPremioId`, `ReposicionProductoPremioProductoId`, `Numero` |

### Grupo: Tarjetas

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `Tarjetas` | `TarjetaId` IDENTITY | `TarjetaNumero` (único), `DistribuidorId`, `UsuarioId`, `EstatusId`, `TipoId`, `DivisionId`, `Observaciones` |
| `TarjetasEstatus` | `TarjetaEstatusId` IDENTITY | `Descripcion` |
| `TarjetasFolios` | `TarjetaFolioId` IDENTITY | `Solicitante`, `No`, `FechaSolicitud`, `RangoSolicitado`, `TarjetaId`, `DistribuidorId`, `UsuarioId` |
| `TarjetasTipos` | `TarjetasTipoId` IDENTITY | `Descripcion` |

### Grupo: Usuarios

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `Perfiles` | `PerfilId` IDENTITY | `PerfilDescripcion` |
| `Usuarios` | `UsuarioId` IDENTITY | `PerfilId`, `TipoRegistroId`, `FechaRegistro`, `FechaBajaParticipante`, `FechaBajaDistribuidora`, `UsuarioSessionId` |
| `UsuariosDetalles` | `UsuarioDetalleId` IDENTITY | `UsuarioId`, `Nombre`, `ApellidoPaterno/Materno`, `Email`, `Celular`, `CompaniaId`, `RFC`, `CP/Estado/Ciudad`, `FechaNacimiento`, `INE`, `PuestoId`, `TallaId`, `NombreTaller` |
| `UsuariosDetallesPuestos` | `UsuarioDetallePuestoId` IDENTITY | `Descripcion` |
| `UsuariosDetallesTallas` | `UsuarioDetalleTallaId` IDENTITY | `Descripcion`, `Clave` |
| `UsuariosDistribuidores` | `UsuarioDistribuidorId` IDENTITY | `UsuarioId`, `DistribuidorId` |
| `UsuariosRecuperacionClave` | `UsuarioRecuperacionClaveId` IDENTITY | `UsuarioId`, `IP`, `ClaveAnterior`, `EmailTecleado`, `FechaRegistro`, `FechaCambio` |
| `UsuariosRegistroAccesos` | `UsuarioRegistroAccesoId` IDENTITY | `UsuarioId`, `IP`, `SistemaOperativo`, `FechaCreacion` |
| `UsuariosRegistroCookie` | `UsuarioRegistroCookieId` IDENTITY | `UsuarioId`, `IP`, `Token`, `FechaAcepto`, `FechaRegistro` |
| `UsuariosTiposRegistro` | `UsuarioTipoRegistroId` IDENTITY | `Descripcion` |

### Grupo: Ventas

| Tabla | PK | Columnas destacadas |
|-------|----|---------------------|
| `Ventas` | `VentaId` IDENTITY | `TarjetaNumero`, `DistribuidorDetalleId`, `UsuarioDetalleId`, `NumeroTicket`, `MontoTicketCapturado`, `MontoTicket`, `CantidadProductos`, `FotoTicket`, `TienePromocion`, `PromocionId`, `SessionId` |
| `VentasAuditorias` | `VentaAuditoriaId` IDENTITY | `VentaId`, `EstatusId`, `TipoId`, `EstatusOportunidadId`, `CorteId`, `FechaAudito`, `FechaEnvioCorreo`, `FechaEnvioCorreoCierre` |
| `VentasAuditoriasEnviosCorreosTipos` | `VentaAuditoriaEnvioCorreoTipoId` IDENTITY | `Descripcion` |
| `VentasAuditoriasEstatus` | `VentaAuditoriaEstatusId` IDENTITY | `Descripcion` |
| `VentasAuditoriasEstatusOportunidades` | `VentaAuditoriaEstatusOportunidadId` IDENTITY | `Descripcion` |
| `VentasAuditoriasObservaciones` | `VentaAuditoriaObservacionId` IDENTITY | `Descripcion`, `FechaBaja`, `FechaAlta`, `IDCaptura` |
| `VentasAuditoriasTipos` | `VentaAuditoriaTipoId` IDENTITY | `Descripcion` |
| `VentasDetalles` | `VentaDetalleId` IDENTITY | `VentaId`, `Monto`, `Cantidad`, `Total`, `Litros`, `ProductoMarcaId` |
| `VentasDetallesGalones` | `VentaDetalleGalonId` IDENTITY | `Descripcion`, `Equivalencia` |
| `VentasHistoricosRechazos` | `VentaHistoricoRechazoId` IDENTITY | `VentaId`, `TarjetaId`, `DistribuidorId`, `NumeroTicket`, `MontoTicket`, `FechaRegistro`, `SessionId` |
| `VentasPromociones` | `VentaPromocionId` IDENTITY | `Nombre`, `FechaInicio`, `FechaFin`, `FechaRegistro`, `FechaBaja` |
| `VentasPromocionesDetalles` | `VentaPromocionDetalleId` IDENTITY | `VentaPromocionId`, `GMC`, `Codigo`, `Descripcion`, `Presentacion` |
| `VentasUsuariosPromociones` | `VentaUsuarioPromocionId` IDENTITY | `VentaId`, `VentaPromocionDetalleId`, `Cantidad`, `FechaRegistro` |

---

## Vistas (1)

| Vista | Definición resumida |
|-------|---------------------|
| `dbo.vw_usuarios_dis` | `SELECT TOP 100% PERCENT` uniendo `Usuarios`, `Perfiles`, `UsuariosDetalles` y distribuidores. Retorna datos completos del usuario con perfil y distribuidor asociado. |

---

## Procedimientos Almacenados (1)

| Procedimiento | Definición |
|---------------|------------|
| `dbo.sp_control_modulos` | `UPDATE ControlModulos SET ControlModuloEstatus = 0 WHERE ControlModuloId = 1` |

---

## Funciones

No existen funciones escalares ni de tabla definidas por el usuario (`FN`, `IF`, `TF`).

---

## Relaciones de Clave Foránea (43 FKs)

| FK | Tabla Hijo | → | Tabla Padre | Columna |
|----|-----------|---|-------------|---------|
| `FK_CargasMultimedias_Modulos` | `CargasMultimedias` | → | `CargasMultimediasModulos` | `CargaMultimediaModuloId` |
| `FK_CargasMultimedias_VideosTipos` | `CargasMultimedias` | → | `CargasMultimediasVideosTipos` | `CargaMultimediaVideoTipoId` |
| `FK_CargasMultimediasPerfiles_Multimedias` | `CargasMultimediasPerfiles` | → | `CargasMultimedias` | `CargaMultimediaId` |
| `FK_CargasMultimediasPerfiles_Perfiles` | `CargasMultimediasPerfiles` | → | `Perfiles` | `PerfilId` |
| `FK_Cargas_CargasTipos` | `Cargas` | → | `CargasTipos` | `CargaTipoId` |
| `FK_Cortes_CortesTipos` | `Cortes` | → | `CortesTipos` | `CorteTipoId` |
| `FK_CortesBimestralesDistribuidores_Cortes` | `CortesBimestralesDistribuidores` | → | `Cortes` | `CorteId` |
| `FK_CortesBimestralesMaestrosPintores_Cortes` | `CortesBimestralesMaestrosPintores` | → | `Cortes` | `CorteId` |
| `FK_CortesBimestralesPerfiles_Cortes` | `CortesBimestralesPerfiles` | → | `Cortes` | `CorteId` |
| `FK_CortesBimestralesVentas_Cortes` | `CortesBimestralesVentas` | → | `Cortes` | `CorteId` |
| `FK_CortesGanadores_Cortes` | `CortesGanadores` | → | `Cortes` | `CorteId` |
| `FK_CortesGanadores_RecompensasTipos` | `CortesGanadores` | → | `RecompensasTipos` | `RecompensaTipoId` |
| `FK_CortesGanadores_Tarjetas` | `CortesGanadores` | → | `Tarjetas` | `TarjetaId` |
| `FK_CortesGanadores_Usuarios` | `CortesGanadores` | → | `Usuarios` | `UsuarioId` |
| `FK_DistribuidoresActivasRE_Distribuidores` | `DistribuidoresActivasRE` | → | `Distribuidores` | `DistribuidorId` |
| `FK_LogRegistros_PaginaAccesadas` | `LogRegistros` | → | `PaginaAccesadas` | `PaginaAccesadaId` |
| `FK_Recompensas_RecompensasTipos` | `Recompensas` | → | `RecompensasTipos` | `RecompensaTipoId` |
| `FK_ReposicionesProductosFotos_Distribuidores` | `ReposicionesProductosFotos` | → | `Distribuidores` | `DistribuidorId` |
| `FK_ReposicionesProductosFotos_Tipos` | `ReposicionesProductosFotos` | → | `ReposicionesProductosFotosTipos` | `FotoTipoId` |
| `FK_ReposicionesProductosGanadores_Distribuidores` | `ReposicionesProductosGanadores` | → | `Distribuidores` | `DistribuidorId` |
| `FK_ReposicionesProductosGanadores_RecompensasTipos` | `ReposicionesProductosGanadores` | → | `RecompensasTipos` | `RecompensaTipoId` |
| `FK_ReposicionesProductosGanadores_Tarjetas` | `ReposicionesProductosGanadores` | → | `Tarjetas` | `TarjetaId` |
| `FK_ReposicionesProductosGanadores_Usuarios` | `ReposicionesProductosGanadores` | → | `Usuarios` | `UsuarioId` |
| `FK_ReposicionesProductosPremios_ProductosDivisiones` | `ReposicionesProductosPremios` | → | `ProductosDivisiones` | `ProductoDivisionId` |
| `FK_RelPremProd_Premio` | `ReposicionesProductosPremiosProductosRelaciones` | → | `ReposicionesProductosPremios` | `ReposicionProductoPremioId` |
| `FK_RelPremProd_Producto` | `ReposicionesProductosPremiosProductosRelaciones` | → | `ReposicionesProductosPremiosProductos` | `ReposicionProductoPremioProductoId` |
| `FK_Tarjetas_Distribuidores` | `Tarjetas` | → | `Distribuidores` | `DistribuidorId` |
| `FK_Tarjetas_TarjetasEstatus` | `Tarjetas` | → | `TarjetasEstatus` | `TarjetaEstatusId` |
| `FK_Tarjetas_Usuarios` | `Tarjetas` | → | `Usuarios` | `UsuarioId` |
| `FK_TarjetasFolios_Tarjetas` | `TarjetasFolios` | → | `Tarjetas` | `TarjetaId` |
| `FK_Usuarios_Perfiles` | `Usuarios` | → | `Perfiles` | `PerfilId` |
| `FK_Usuarios_UsuariosTiposRegistro` | `Usuarios` | → | `UsuariosTiposRegistro` | `UsuarioTipoRegistroId` |
| `FK_UsuariosDetalles_CompaniasCelulares` | `UsuariosDetalles` | → | `CompaniasCelulares` | `CompaniaCelularId` |
| `FK_UsuariosDetalles_Usuarios` | `UsuariosDetalles` | → | `Usuarios` | `UsuarioId` |
| `FK_UsuariosDistribuidores_Distribuidores` | `UsuariosDistribuidores` | → | `Distribuidores` | `DistribuidorId` |
| `FK_UsuariosDistribuidores_Usuarios` | `UsuariosDistribuidores` | → | `Usuarios` | `UsuarioId` |
| `FK_UsuariosRecuperacionClave_Usuarios` | `UsuariosRecuperacionClave` | → | `Usuarios` | `UsuarioId` |
| `FK_UsuariosRegistroAccesos_Usuarios` | `UsuariosRegistroAccesos` | → | `Usuarios` | `UsuarioId` |
| `FK_VentasAuditorias_Cortes` | `VentasAuditorias` | → | `Cortes` | `CorteId` |
| `FK_VentasAuditorias_Estatus` | `VentasAuditorias` | → | `VentasAuditoriasEstatus` | `VentaAuditoriaEstatusId` |
| `FK_VentasAuditorias_EstatusOportunidades` | `VentasAuditorias` | → | `VentasAuditoriasEstatusOportunidades` | `VentaAuditoriaEstatusOportunidadId` |
| `FK_VentasAuditorias_Tipos` | `VentasAuditorias` | → | `VentasAuditoriasTipos` | `VentaAuditoriaTipoId` |
| `FK_VentasUsuariosPromociones_VentasPromocionesDetalles` | `VentasUsuariosPromociones` | → | `VentasPromocionesDetalles` | `VentaPromocionDetalleId` |

---

## Índices (119 en total)

| Tabla | Índice | Tipo |
|-------|--------|------|
| `Cargas` | `PK_Cargas` | CLUSTERED |
| `Cargas` | `IX_Cargas_CargaTipoId` | NONCLUSTERED |
| `CargasMultimedias` | `PK_CargasMultimedias` | CLUSTERED |
| `CargasMultimedias` | `IX_CargasMultimedias_ModuloId` | NONCLUSTERED |
| `CargasMultimedias` | `IX_CargasMultimedias_VideoTipoId` | NONCLUSTERED |
| `CargasMultimediasModulos` | `PK_CargasMultimediasModulos` | CLUSTERED |
| `CargasMultimediasPerfiles` | `PK_CargasMultimediasPerfiles` | CLUSTERED |
| `CargasMultimediasPerfiles` | `IX_CargasMultimediasPerfiles_MediaId` | NONCLUSTERED |
| `CargasMultimediasPerfiles` | `IX_CargasMultimediasPerfiles_PerfilId` | NONCLUSTERED |
| `CargasMultimediasTipos` | `PK_CargasMultimediasTipos` | CLUSTERED |
| `CargasMultimediasVideosTipos` | `PK_CargasMultimediasVideosTipos` | CLUSTERED |
| `CargasPremiosProductos` | `PK_CargasPremiosProductos` | CLUSTERED |
| `CargasRecompensas` | `PK_CargasRecompensas` | CLUSTERED |
| `CargasTipos` | `PK_CargasTipos` | CLUSTERED |
| `CargasVentasPromocionesDetalles` | `PK_CargasVentasPromocionesDetalles` | CLUSTERED |
| `CompaniasCelulares` | `PK_CompaniasCelulares` | CLUSTERED |
| `ControlModulos` | `PK_ControlModulos` | CLUSTERED |
| `Cortes` | `PK_Cortes` | CLUSTERED |
| `Cortes` | `IX_Cortes_CorteTipoId` | NONCLUSTERED |
| `CortesBimestralesDistribuidores` | `PK_CortesBimestralDistribuidores` | CLUSTERED |
| `CortesBimestralesDistribuidores` | `IX_CortesBimestralDist_CorteId` | NONCLUSTERED |
| `CortesBimestralesMaestrosPintores` | `PK_CortesBimeastralMaestrosPintores` | CLUSTERED |
| `CortesBimestralesMaestrosPintores` | `IX_CortesBimestralMP_CorteId` | NONCLUSTERED |
| `CortesBimestralesPerfiles` | `PK_CortesBimestralesPerfiles` | CLUSTERED |
| `CortesBimestralesPerfiles` | `IX_CortesBimestralPerf_CorteId` | NONCLUSTERED |
| `CortesBimestralesVentas` | `PK_CortesBimestralVentas` | CLUSTERED |
| `CortesBimestralesVentas` | `IX_CortesBimestralesVentas_CorteId` | NONCLUSTERED |
| `CortesBimestralesVentas` | `IX_CortesBimestralesVentas_DistribuidorId` | NONCLUSTERED |
| `CortesBimestralesVentas` | `IX_CortesBimestralesVentas_UsuarioIdMP` | NONCLUSTERED |
| `CortesCambioEstatusVentasAuditoria` | `PK_CortesCambioEstatusVentasAuditoria` | CLUSTERED |
| `CortesGanadores` | `PK_CortesGanadores` | CLUSTERED |
| `CortesGanadores` | `IX_CortesGanadores_CorteId_DistribuidorId` | NONCLUSTERED |
| `CortesGanadores` | `IX_CortesGanadores_RecompensaTipoId` | NONCLUSTERED |
| `CortesGanadores` | `IX_CortesGanadores_TarjetaId` | NONCLUSTERED |
| `CortesGanadores` | `IX_CortesGanadores_UsuarioId` | NONCLUSTERED |
| `CortesTipos` | `PK_CortesTipos` | CLUSTERED |
| `Distribuidores` | `PK_Distribuidores` | CLUSTERED |
| `DistribuidoresActivasRE` | `PK_DistribuidoresActivasRE` | CLUSTERED |
| `DistribuidoresActivasRE` | `IX_DistribuidoresActivasRE_DistribuidorId` | NONCLUSTERED |
| `DistribuidoresActivos` | `PK_DistribuidoresActivos` | CLUSTERED |
| `DistribuidoresDetalles` | `PK_DistribuidoresDetalles` | CLUSTERED |
| `DistribuidoresDetallesCategorias` | `PK_DistribuidoresDetallesCategorias` | CLUSTERED |
| `DistribuidoresDetallesEtapas` | `PK_DistribuidoresDetallesEtapas` | CLUSTERED |
| `DistribuidoresDetallesFaces` | `PK_DistribuidoresDetallesFaces` | CLUSTERED |
| `DistribuidoresDetallesProductosListas` | `PK_DistribuidoresDetallesProductosListas` | CLUSTERED |
| `DistribuidoresDetallesRegiones` | `PK_DistribuidoresDetallesRegiones` | CLUSTERED |
| `LogRegistros` | `PK_LogRegistros` | CLUSTERED |
| `LogRegistros` | `IX_LogRegistros_UsuarioId` | NONCLUSTERED |
| `LogRegistros` | `IX_LogRegistros_Fecha` | NONCLUSTERED |
| `LogRegistros` | `IX_LogRegistros_PaginaAccesadaId` | NONCLUSTERED |
| `PaginaAccesadas` | `PK_PaginaAccesadas` | CLUSTERED |
| `Perfiles` | `PK_Perfiles` | CLUSTERED |
| `ProductosClases` | `PK_ProductosClases` | CLUSTERED |
| `ProductosDivisiones` | `PK_ProductoDivisiones` | CLUSTERED |
| `ProductosMarcas` | `PK_ProductosMarcas` | CLUSTERED |
| `Recompensas` | `PK_Recompensas` | CLUSTERED |
| `Recompensas` | `IX_Recompensas_RecompensaTipoId` | NONCLUSTERED |
| `RecompensasTipos` | `PK_RecompensasTipos` | CLUSTERED |
| `ReposicionesProductosFotos` | `PK_ReposicionesProductosFotos` | CLUSTERED |
| `ReposicionesProductosFotos` | `IX_ReposFotos_Dist_Anio_Mes` | NONCLUSTERED |
| `ReposicionesProductosFotos` | `IX_ReposFotos_FotoTipoId` | NONCLUSTERED |
| `ReposicionesProductosFotosTipos` | `PK_ReposicionesProductosFotosTipos` | CLUSTERED |
| `ReposicionesProductosGanadores` | `PK_ReposicionesProductosGanadores` | CLUSTERED |
| `ReposicionesProductosGanadores` | `IX_ReposGanadores_Dist_Anio_Mes` | NONCLUSTERED |
| `ReposicionesProductosGanadores` | `IX_ReposGanadores_RecompensaTipoId` | NONCLUSTERED |
| `ReposicionesProductosGanadores` | `IX_ReposGanadores_TarjetaId` | NONCLUSTERED |
| `ReposicionesProductosGanadores` | `IX_ReposGanadores_UsuarioId` | NONCLUSTERED |
| `ReposicionesProductosPremios` | `PK_ReposicionesProductosPremios` | CLUSTERED |
| `ReposicionesProductosPremios` | `IX_ReposPremios_ProductoDivisionId` | NONCLUSTERED |
| `ReposicionesProductosPremiosProductos` | `PK_ReposicionProductoPremioProducto` | CLUSTERED |
| `ReposicionesProductosPremiosProductosRelaciones` | `PK_ReposicionesProductosPremiosProductosRelaciones` | CLUSTERED |
| `ReposicionesProductosPremiosProductosRelaciones` | `IX_ReposPremProdRel_PremioId` | NONCLUSTERED |
| `ReposicionesProductosPremiosProductosRelaciones` | `IX_ReposPremProdRel_ProductoId` | NONCLUSTERED |
| `Tarjetas` | `PK_Tarjetas` | CLUSTERED |
| `Tarjetas` | `UIX_Tarjetas_Numero` | NONCLUSTERED (ÚNICO) |
| `Tarjetas` | `IX_Tarjetas_UsuarioId` | NONCLUSTERED |
| `Tarjetas` | `IX_Tarjetas_DistribuidorId` | NONCLUSTERED |
| `Tarjetas` | `IX_Tarjetas_TarjetaEstatusId` | NONCLUSTERED |
| `TarjetasEstatus` | `PK_TarjetasEstatus` | CLUSTERED |
| `TarjetasFolios` | `PK_TarjetasFolios` | CLUSTERED |
| `TarjetasFolios` | `IX_TarjetasFolios_TarjetaId` | NONCLUSTERED |
| `TarjetasTipos` | `PK_TarjetasTipos` | CLUSTERED |
| `Usuarios` | `PK_Usuarios` | CLUSTERED |
| `Usuarios` | `IX_Usuarios_PerfilId` | NONCLUSTERED |
| `Usuarios` | `IX_Usuarios_TipoRegistroId` | NONCLUSTERED |
| `UsuariosDetalles` | `PK_UsuariosDetalles` | CLUSTERED |
| `UsuariosDetalles` | `IX_UsuariosDetalles_CompaniaId` | NONCLUSTERED |
| `UsuariosDetalles` | `IX_UsuariosDetalles_Email` | NONCLUSTERED |
| `UsuariosDetalles` | `IX_UsuariosDetalles_UsuarioId` | NONCLUSTERED |
| `UsuariosDetallesPuestos` | `PK_UsuariosDetallesPuestos` | CLUSTERED |
| `UsuariosDetallesTallas` | `PK_UsuariosTallas` | CLUSTERED |
| `UsuariosDistribuidores` | `PK_UsuariosDistribuidoras` | CLUSTERED |
| `UsuariosDistribuidores` | `IX_UsuariosDistribuidores_DistribuidorId` | NONCLUSTERED |
| `UsuariosDistribuidores` | `IX_UsuariosDistribuidores_UsuarioId` | NONCLUSTERED |
| `UsuariosRecuperacionClave` | `PK_UsuariosRecuperacionClave` | CLUSTERED |
| `UsuariosRecuperacionClave` | `IX_UsuariosRecuperacionClave_UsuarioId` | NONCLUSTERED |
| `UsuariosRegistroAccesos` | `PK_UsuariosRegistroAccesos` | CLUSTERED |
| `UsuariosRegistroAccesos` | `IX_UsuariosRegistroAccesos_UsuarioId` | NONCLUSTERED |
| `UsuariosRegistroCookie` | `PK_UsuariosRegistroCookies` | CLUSTERED |
| `UsuariosTiposRegistro` | `PK_UsuariosTiposRegistro` | CLUSTERED |
| `Ventas` | `PK_Ventas` | CLUSTERED |
| `VentasAuditorias` | `PK_VentasAuditorias` | CLUSTERED |
| `VentasAuditorias` | `IX_VentasAuditorias_VentaId` | NONCLUSTERED |
| `VentasAuditorias` | `IX_VentasAuditorias_EstatusId` | NONCLUSTERED |
| `VentasAuditorias` | `IX_VentasAuditorias_CorteId` | NONCLUSTERED |
| `VentasAuditorias` | `IX_VentasAuditorias_EstatusOportunidadId` | NONCLUSTERED |
| `VentasAuditorias` | `IX_VentasAuditorias_TipoId` | NONCLUSTERED |
| `VentasAuditoriasEnviosCorreosTipos` | `PK_VentasAuditoriasEnviosCorreosTipos` | CLUSTERED |
| `VentasAuditoriasEstatus` | `PK_VentasAuditoriasEstatus` | CLUSTERED |
| `VentasAuditoriasEstatusOportunidades` | `PK_VentasAuditoriasOportunidadesEstatus` | CLUSTERED |
| `VentasAuditoriasObservaciones` | `PK_VentasAuditoriasObservaciones` | CLUSTERED |
| `VentasAuditoriasTipos` | `PK_VentasAuditoriasTipos` | CLUSTERED |
| `VentasDetalles` | `PK_VentasDetalles` | CLUSTERED |
| `VentasDetallesGalones` | `PK_VentasDetallesGalones` | CLUSTERED |
| `VentasHistoricosRechazos` | `PK_VentasHistoricosRechazos` | CLUSTERED |
| `VentasPromociones` | `PK_VentasPromociones` | CLUSTERED |
| `VentasPromocionesDetalles` | `PK_VentasPromocionesDetalles` | CLUSTERED |
| `VentasUsuariosPromociones` | `PK_VentasUsuariosPromociones` | CLUSTERED |
| `VentasUsuariosPromociones` | `IX_VentasUsuariosPromo_PromoDetalleId` | NONCLUSTERED |

---

## Script DELETE + RESEED ordenado por dependencias FK

> **Criterio de orden:** Se eliminan primero las tablas hijo (que tienen FK apuntando
> a otras tablas de la lista) y al final las tablas padre. Se respeta el orden topológico
> derivado de las 43 FK constraints existentes.

```sql
USE [clubdelpintoraxaltabrasil];
GO

-- ============================================================
-- PASO 1: Tablas hoja (sin dependencias hacia otras en la lista)
-- ============================================================

-- Cargas de multimedia y sus relaciones
DELETE FROM dbo.CargasMultimediasPerfiles;
DELETE FROM dbo.Cargas;
DELETE FROM dbo.CargasPremiosProductos;
DELETE FROM dbo.CargasRecompensas;
DELETE FROM dbo.CargasVentasPromocionesDetalles;

-- Cortes bimestrales (todos referencian Cortes)
DELETE FROM dbo.CortesBimestralesDistribuidores;
DELETE FROM dbo.CortesBimestralesMaestrosPintores;
DELETE FROM dbo.CortesBimestralesPerfiles;
DELETE FROM dbo.CortesBimestralesVentas;
DELETE FROM dbo.CortesCambioEstatusVentasAuditoria;

-- CortesGanadores (referencia Cortes, Tarjetas y Usuarios)
DELETE FROM dbo.CortesGanadores;

-- Distribuidores hijos
DELETE FROM dbo.DistribuidoresActivasRE;
DELETE FROM dbo.DistribuidoresActivos;
DELETE FROM dbo.DistribuidoresDetalles;

-- Tarjetas hijas (TarjetasFolios referencia Tarjetas)
DELETE FROM dbo.TarjetasFolios;

-- Logs
DELETE FROM dbo.LogRegistros;

-- Recompensas
DELETE FROM dbo.Recompensas;

-- Reposiciones hijas
DELETE FROM dbo.ReposicionesProductosFotos;
DELETE FROM dbo.ReposicionesProductosGanadores;
DELETE FROM dbo.ReposicionesProductosPremiosProductosRelaciones;

-- Usuarios hijos
DELETE FROM dbo.UsuariosDetalles;
DELETE FROM dbo.UsuariosDistribuidores;
DELETE FROM dbo.UsuariosRecuperacionClave;
DELETE FROM dbo.UsuariosRegistroAccesos;
DELETE FROM dbo.UsuariosRegistroCookie;

-- Ventas y auditorías (VentasAuditorias referencia Cortes)
DELETE FROM dbo.VentasAuditorias;
DELETE FROM dbo.Ventas;
DELETE FROM dbo.VentasDetalles;
DELETE FROM dbo.VentasHistoricosRechazos;
DELETE FROM dbo.VentasUsuariosPromociones;
DELETE FROM dbo.VentasPromociones;

-- ============================================================
-- PASO 2: Tablas intermedias
-- (Tarjetas debe eliminarse ANTES que Distribuidores y Usuarios)
-- ============================================================

DELETE FROM dbo.Tarjetas;
DELETE FROM dbo.CargasMultimedias;
DELETE FROM dbo.Cortes;
DELETE FROM dbo.ReposicionesProductosPremios;
DELETE FROM dbo.ReposicionesProductosPremiosProductos;
DELETE FROM dbo.VentasPromocionesDetalles;

-- ============================================================
-- PASO 3: Tablas padre (referenciadas por las ya eliminadas)
-- ============================================================

DELETE FROM dbo.Distribuidores;
DELETE FROM dbo.Usuarios;

-- ============================================================
-- RESEED de identidades
-- ============================================================

DBCC CHECKIDENT ('Cargas', RESEED, 0);
DBCC CHECKIDENT ('CargasMultimedias', RESEED, 0);
DBCC CHECKIDENT ('CargasMultimediasPerfiles', RESEED, 0);
DBCC CHECKIDENT ('CargasPremiosProductos', RESEED, 0);
DBCC CHECKIDENT ('CargasRecompensas', RESEED, 0);
DBCC CHECKIDENT ('CargasVentasPromocionesDetalles', RESEED, 0);
DBCC CHECKIDENT ('Cortes', RESEED, 0);
DBCC CHECKIDENT ('CortesBimestralesDistribuidores', RESEED, 0);
DBCC CHECKIDENT ('CortesBimestralesMaestrosPintores', RESEED, 0);
DBCC CHECKIDENT ('CortesBimestralesPerfiles', RESEED, 0);
DBCC CHECKIDENT ('CortesBimestralesVentas', RESEED, 0);
DBCC CHECKIDENT ('CortesCambioEstatusVentasAuditoria', RESEED, 0);
DBCC CHECKIDENT ('CortesGanadores', RESEED, 0);
DBCC CHECKIDENT ('Distribuidores', RESEED, 0);
DBCC CHECKIDENT ('DistribuidoresActivasRE', RESEED, 0);
DBCC CHECKIDENT ('DistribuidoresActivos', RESEED, 0);
DBCC CHECKIDENT ('DistribuidoresDetalles', RESEED, 0);
DBCC CHECKIDENT ('LogRegistros', RESEED, 0);
DBCC CHECKIDENT ('Recompensas', RESEED, 0);
DBCC CHECKIDENT ('ReposicionesProductosFotos', RESEED, 0);
DBCC CHECKIDENT ('ReposicionesProductosGanadores', RESEED, 0);
DBCC CHECKIDENT ('ReposicionesProductosPremios', RESEED, 0);
DBCC CHECKIDENT ('ReposicionesProductosPremiosProductos', RESEED, 0);
DBCC CHECKIDENT ('ReposicionesProductosPremiosProductosRelaciones', RESEED, 0);
DBCC CHECKIDENT ('Tarjetas', RESEED, 0);
DBCC CHECKIDENT ('TarjetasFolios', RESEED, 0);
DBCC CHECKIDENT ('Usuarios', RESEED, 0);
DBCC CHECKIDENT ('UsuariosDetalles', RESEED, 0);
DBCC CHECKIDENT ('UsuariosDistribuidores', RESEED, 0);
DBCC CHECKIDENT ('UsuariosRecuperacionClave', RESEED, 0);
DBCC CHECKIDENT ('UsuariosRegistroAccesos', RESEED, 0);
DBCC CHECKIDENT ('UsuariosRegistroCookie', RESEED, 0);
DBCC CHECKIDENT ('Ventas', RESEED, 0);
DBCC CHECKIDENT ('VentasAuditorias', RESEED, 0);
DBCC CHECKIDENT ('VentasDetalles', RESEED, 0);
DBCC CHECKIDENT ('VentasHistoricosRechazos', RESEED, 0);
DBCC CHECKIDENT ('VentasPromociones', RESEED, 0);
DBCC CHECKIDENT ('VentasPromocionesDetalles', RESEED, 0);
DBCC CHECKIDENT ('VentasUsuariosPromociones', RESEED, 0);
```

---

*Archivo generado automáticamente a partir del backup `cdpBrasil20260326_V4.bak` — 30/03/2026*
