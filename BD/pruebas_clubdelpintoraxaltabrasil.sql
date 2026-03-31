USE [master]
GO
/****** Object:  Database [pruebas_clubdelpintoraxaltabrasil]    Script Date: 18/03/2026 12:57:09 p. m. ******/
CREATE DATABASE [pruebas_clubdelpintoraxaltabrasil]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'pruebas_clubdelpintoraxaltabrasil', SIZE = 73728KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'pruebas_clubdelpintoraxaltabrasil_log', SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [pruebas_clubdelpintoraxaltabrasil].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET ARITHABORT OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET  DISABLE_BROKER 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET RECOVERY FULL 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET  MULTI_USER 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET DB_CHAINING OFF 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET DELAYED_DURABILITY = DISABLED 
GO
EXEC sys.sp_db_vardecimal_storage_format N'pruebas_clubdelpintoraxaltabrasil', N'ON'
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET QUERY_STORE = ON
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200)
GO
USE [pruebas_clubdelpintoraxaltabrasil]
GO
/****** Object:  User [pruebas_CDPBrasilUser]    Script Date: 18/03/2026 12:57:09 p. m. ******/
CREATE USER [pruebas_CDPBrasilUser] FOR LOGIN [pruebas_CDPBrasilUser] WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  Table [dbo].[DistribuidoresDetalles]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DistribuidoresDetalles](
	[DistribuidorDetalleId] [int] IDENTITY(1,1) NOT NULL,
	[DistribuidorId] [int] NOT NULL,
	[DistribuidorDetalleCodigo] [int] NOT NULL,
	[DistribuidorDetalleRazonSocial] [varchar](128) NOT NULL,
	[DistribuidorDetalleNombreComercial] [varchar](128) NULL,
	[DistribuidorDetalleCP] [varchar](16) NULL,
	[DistribuidorDetalleEstado] [varchar](128) NULL,
	[DistribuidorDetalleCiudad] [varchar](128) NULL,
	[DistribuidorDetalleMunicipio] [varchar](128) NULL,
	[DistribuidorDetalleColonia] [varchar](128) NULL,
	[DistribuidorDetalleCalle] [varchar](128) NULL,
	[DistribuidorDetalleNumeroExterior] [varchar](20) NULL,
	[DistribuidorDetalleNumeroInterior] [varchar](20) NULL,
	[DistribuidorDetalleReferencia] [nvarchar](max) NULL,
	[DistribuidorDetalleRFC] [varchar](20) NULL,
	[DistribuidorDetalleTelefono] [varchar](64) NULL,
	[DistribuidorDetalleLatitud] [varchar](20) NULL,
	[DistribuidorDetalleLongitud] [varchar](20) NULL,
	[DistribuidorDetalleFechaAlta] [datetime] NOT NULL,
	[DistribuidorDetalleUsuarioIdCapturo] [int] NOT NULL,
	[DistribuidorDetalleFechaBaja] [datetime] NULL,
	[DistribuidorDetalleUsuarioIdBaja] [int] NULL,
	[DistribuidorDetalleRegionId] [int] NULL,
	[DistribuidorDetalleCategoriaId] [int] NULL,
	[DistribuidorDetalleEtapaId] [int] NULL,
	[DistribuidorDetalleFaceId] [int] NULL,
	[DistribuidorDetalleProductoListaId] [int] NULL,
	[DistribuidorDetalleGrupoBonificacion] [varchar](50) NULL,
	[DistribuidorDetalleLealtad] [varchar](4) NULL,
	[DistribuidorDetalleEvento] [int] NULL,
	[DistribuidorDetallesessionId] [int] NOT NULL,
	[DistribuidorDetalleFechaActivacion] [datetime] NULL,
 CONSTRAINT [PK_DistribuidoresDetalles] PRIMARY KEY CLUSTERED 
(
	[DistribuidorDetalleId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Perfiles]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Perfiles](
	[PerfilId] [int] IDENTITY(1,1) NOT NULL,
	[PerfilDescripcion] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Perfiles] PRIMARY KEY CLUSTERED 
(
	[PerfilId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Usuarios]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Usuarios](
	[UsuarioId] [int] IDENTITY(1,1) NOT NULL,
	[UsuarioFechaActualizoDatos] [datetime] NULL,
	[UsuarioFechaAceptoTerminos] [datetime] NULL,
	[UsuarioFechaAceptoAvisoPrivacidad] [datetime] NULL,
	[UsuarioFechaAceptoTerminosTarjetaDigital] [datetime] NULL,
	[UsuarioFechaAceptoAvisoPrivacidadTarjetaDigital] [datetime] NULL,
	[UsuarioFechaRegistro] [datetime] NOT NULL,
	[UsuarioFechaBajaParticipante] [datetime] NULL,
	[UsuarioFechaBajaDistribuidora] [datetime] NULL,
	[UsuarioFechaEnvioMailRegistro] [datetime] NULL,
	[UsuarioCapturaId] [int] NOT NULL,
	[UsuarioBajaParticipanteUsuarioId] [int] NULL,
	[UsuarioBajaDistribuidoraUsuarioId] [int] NULL,
	[UsuarioTipoRegistroId] [int] NOT NULL,
	[PerfilId] [int] NOT NULL,
	[UsuarioSessionId] [varchar](34) NOT NULL,
 CONSTRAINT [PK_Usuarios] PRIMARY KEY CLUSTERED 
(
	[UsuarioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsuariosDetalles]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsuariosDetalles](
	[UsuarioDetalleId] [int] IDENTITY(1,1) NOT NULL,
	[UsuarioId] [int] NOT NULL,
	[UsuarioDetalleNombre] [varchar](100) NOT NULL,
	[UsuarioDetalleSegundoNombre] [varchar](50) NULL,
	[UsuarioDetalleApellidos] [varchar](50) NOT NULL,
	[UsuarioDetalleApellidoMaterno] [varchar](50) NULL,
	[UsuarioDetalleUsuario] [varchar](50) NOT NULL,
	[UsuarioDetalleClave] [varchar](70) NOT NULL,
	[UsuarioDetalleEmail] [varchar](60) NOT NULL,
	[UsuarioDetalleTelefono] [varchar](20) NULL,
	[UsuarioDetalleExtension] [varchar](10) NULL,
	[UsuarioDetalleCelular] [varchar](20) NOT NULL,
	[UsuarioDetalleCompaniaCelularId] [int] NULL,
	[UsuarioDetalleRFC] [varchar](50) NULL,
	[UsuarioDetalleCP] [varchar](16) NULL,
	[UsuarioDetalleEstado] [varchar](128) NULL,
	[UsuarioDetalleCiudad] [varchar](128) NULL,
	[UsuarioDetalleMunicipio] [varchar](128) NULL,
	[UsuarioDetalleColonia] [varchar](128) NULL,
	[UsuarioDetalleCalle] [varchar](128) NULL,
	[UsuarioDetalleExterior] [varchar](20) NULL,
	[UsuarioDetalleInterior] [varchar](20) NULL,
	[UsuarioDetallePersonasTaller] [varchar](32) NULL,
	[UsuarioDetalleAutosPorsemana] [varchar](32) NULL,
	[UsuarioDetallePuestoId] [int] NULL,
	[UsuarioDetalleTallaId] [int] NULL,
	[UsuarioDetalleFechaRegistro] [datetime] NOT NULL,
	[UsuarioDetalleUsuarioIdRegistro] [int] NULL,
	[UsuarioDetalleFechaBaja] [datetime] NULL,
	[UsuarioDetalleUsuarioIdBaja] [int] NULL,
	[UsuarioDetalleArchivoIdentificacion] [varchar](200) NULL,
	[UsuarioDetalleArchivoFirma] [varchar](200) NULL,
	[UsuarioDetalleObservaciones] [nvarchar](max) NULL,
	[UsuarioDetalleFechaNacimiento] [date] NULL,
	[UsuarioDetalleINE] [varchar](300) NULL,
	[UsuarioDetalleSessionId] [varchar](34) NOT NULL,
 CONSTRAINT [PK_UsuariosDetalles] PRIMARY KEY CLUSTERED 
(
	[UsuarioDetalleId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsuariosDistribuidores]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsuariosDistribuidores](
	[UsuarioDistribuidorId] [int] IDENTITY(1,1) NOT NULL,
	[UsuarioId] [int] NOT NULL,
	[DistribuidorId] [int] NOT NULL,
 CONSTRAINT [PK_UsuariosDistribuidoras] PRIMARY KEY CLUSTERED 
(
	[UsuarioDistribuidorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  View [dbo].[vw_usuarios_dis]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[vw_usuarios_dis]
AS
SELECT TOP (100) PERCENT dbo.Usuarios.UsuarioId, dbo.Usuarios.UsuarioFechaActualizoDatos, dbo.Perfiles.PerfilId, dbo.Perfiles.PerfilDescripcion, dbo.UsuariosDetalles.UsuarioDetalleNombre, 
                  dbo.UsuariosDetalles.UsuarioDetalleSegundoNombre, dbo.UsuariosDetalles.UsuarioDetalleApellidos, dbo.UsuariosDetalles.UsuarioDetalleApellidoMaterno, dbo.UsuariosDetalles.UsuarioDetalleUsuario, 
                  dbo.UsuariosDetalles.UsuarioDetalleClave, dbo.UsuariosDetalles.UsuarioDetalleEmail, dbo.DistribuidoresDetalles.DistribuidorDetalleId, dbo.DistribuidoresDetalles.DistribuidorId, dbo.DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                  dbo.DistribuidoresDetalles.DistribuidorDetalleRazonSocial, dbo.DistribuidoresDetalles.DistribuidorDetalleNombreComercial
FROM     dbo.Usuarios INNER JOIN
                  dbo.UsuariosDetalles ON dbo.Usuarios.UsuarioId = dbo.UsuariosDetalles.UsuarioId INNER JOIN
                  dbo.Perfiles ON dbo.Usuarios.PerfilId = dbo.Perfiles.PerfilId LEFT OUTER JOIN
                  dbo.UsuariosDistribuidores ON dbo.Usuarios.UsuarioId = dbo.UsuariosDistribuidores.UsuarioId LEFT OUTER JOIN
                  dbo.DistribuidoresDetalles ON dbo.UsuariosDistribuidores.DistribuidorId = dbo.DistribuidoresDetalles.DistribuidorId
WHERE  (dbo.Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (dbo.Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (dbo.UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND 
                  (dbo.DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL)
GO
/****** Object:  Table [dbo].[Cargas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Cargas](
	[CargaId] [int] IDENTITY(1,1) NOT NULL,
	[CargaTipoId] [int] NOT NULL,
	[CargaNombreArchivoOriginal] [varchar](300) NOT NULL,
	[CargaNombreArchivoModificado] [varchar](300) NOT NULL,
	[CargaUsuarioIdRegistro] [int] NOT NULL,
	[CargaFechaRegistro] [datetime] NOT NULL,
 CONSTRAINT [PK_Cargas] PRIMARY KEY CLUSTERED 
(
	[CargaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasMultimedias]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasMultimedias](
	[CargaMultimediaId] [int] IDENTITY(1,1) NOT NULL,
	[CargaMultimediaRuta] [varchar](250) NOT NULL,
	[CargaMultimediaExtension] [varchar](50) NOT NULL,
	[CargaMultimediaThumbnail] [varchar](250) NULL,
	[CargaMultimediaTexto] [varchar](max) NULL,
	[CargaMultimediaTipoId] [varchar](100) NULL,
	[CargaMultimediaFechaRegistro] [datetime] NOT NULL,
	[CargaMultimediaUsuarioId] [int] NOT NULL,
	[CargaMultimediaFechaBaja] [datetime] NULL,
	[CargaMultimediaModuloId] [int] NULL,
	[CargaMultimediaVideoTipoId] [int] NULL,
	[CargaMultimediaFechaInicial] [date] NOT NULL,
	[CargaMultimediaFechaFinal] [date] NOT NULL,
	[CargaMultimediaDownload] [int] NULL,
 CONSTRAINT [PK_CargasMultimedias] PRIMARY KEY CLUSTERED 
(
	[CargaMultimediaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasMultimediasModulos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasMultimediasModulos](
	[CargaMultimediaModuloId] [int] IDENTITY(1,1) NOT NULL,
	[CargaMultimediaModuloDescripcion] [varchar](50) NOT NULL,
 CONSTRAINT [PK_CargasMultimediasModulos] PRIMARY KEY CLUSTERED 
(
	[CargaMultimediaModuloId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasMultimediasPerfiles]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasMultimediasPerfiles](
	[CargaMultimediaPerfil] [int] IDENTITY(1,1) NOT NULL,
	[CargaMultimediaId] [int] NOT NULL,
	[PerfilId] [int] NOT NULL,
 CONSTRAINT [PK_CargasMultimediasPerfiles] PRIMARY KEY CLUSTERED 
(
	[CargaMultimediaPerfil] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasMultimediasTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasMultimediasTipos](
	[CargaMultimediaTipoId] [int] IDENTITY(1,1) NOT NULL,
	[CargaMultimediaTipoDescripcion] [varchar](50) NOT NULL,
 CONSTRAINT [PK_CargasMultimediasTipos] PRIMARY KEY CLUSTERED 
(
	[CargaMultimediaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasMultimediasVideosTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasMultimediasVideosTipos](
	[CargaMultimediaVideoTipoId] [int] IDENTITY(1,1) NOT NULL,
	[CargaMultimediaVideoTipoDescripcion] [varchar](50) NOT NULL,
 CONSTRAINT [PK_CargasMultimediasVideosTipos] PRIMARY KEY CLUSTERED 
(
	[CargaMultimediaVideoTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasPremiosProductos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasPremiosProductos](
	[CargaPremioProductoId] [int] IDENTITY(1,1) NOT NULL,
	[CargaId] [int] NULL,
	[CargaPremioProductoDescripcion] [varchar](200) NULL,
	[CargaPremioProductoGMS] [varchar](200) NULL,
	[CargaPremioProductoCodigo] [varchar](200) NULL,
	[CargaPremioProductoPresentacion] [varchar](200) NULL,
	[CargaPremioProductoPrecio] [varchar](200) NULL,
	[CargaPremioProductoFechaRegistro] [datetime] NOT NULL,
	[CargaPremioProductoUsuarioIdRegistro] [int] NOT NULL,
	[CargaPremioProductoObservaciones] [varchar](200) NULL,
 CONSTRAINT [PK_CargasPremiosProductos] PRIMARY KEY CLUSTERED 
(
	[CargaPremioProductoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasRecompensas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasRecompensas](
	[CargaRecompensaId] [int] IDENTITY(1,1) NOT NULL,
	[CargaId] [int] NOT NULL,
	[CargaRecompensaAnio] [varchar](200) NULL,
	[CargaRecompensaMes] [varchar](200) NULL,
	[CargaRecompensaPremioLugar] [varchar](200) NULL,
	[CargaRecompensaRangoInicial] [varchar](200) NULL,
	[CargaRecompensaRangoFinal] [varchar](200) NULL,
	[CargaRecompensaFechaRegistro] [datetime] NOT NULL,
	[CargaRecompensaUsuarioIdRegistro] [int] NOT NULL,
	[CargaRecompensObservaciones] [varchar](200) NULL,
 CONSTRAINT [PK_CargasRecompensas] PRIMARY KEY CLUSTERED 
(
	[CargaRecompensaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasTipos](
	[CargaTipoId] [int] IDENTITY(1,1) NOT NULL,
	[CargaTipoDescripcion] [varchar](100) NOT NULL,
	[UsuarioIdRegistro] [int] NULL,
	[CargaTipoFechaRegistro] [datetime] NULL,
 CONSTRAINT [PK_CargasTipos] PRIMARY KEY CLUSTERED 
(
	[CargaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CargasVentasPromocionesDetalles]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CargasVentasPromocionesDetalles](
	[CargaVentaPromocionDetalleId] [int] IDENTITY(1,1) NOT NULL,
	[CargaId] [int] NOT NULL,
	[CargaVentaPromocionDetalleGMC] [varchar](30) NOT NULL,
	[CargaVentaPromocionDetalleCodigo] [varchar](20) NOT NULL,
	[CargaVentaPromocionDetalleDescripcion] [varchar](150) NOT NULL,
	[CargaVentaPromocionDetallePresentacion] [varchar](20) NOT NULL,
	[CargaVentaPromocionDetalleFechaAlta] [datetime] NOT NULL,
	[CargaVentaPromocionDetalleUsuarioIdRegistro] [int] NOT NULL,
	[CargaVentaPromocionDetalleObservaciones] [varchar](200) NULL,
 CONSTRAINT [PK_CargasVentasPromocionesDetalles] PRIMARY KEY CLUSTERED 
(
	[CargaVentaPromocionDetalleId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CompaniasCelulares]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CompaniasCelulares](
	[CompaniaCelularId] [int] IDENTITY(1,1) NOT NULL,
	[CompaniaCelularNombre] [varchar](50) NULL,
 CONSTRAINT [PK_CompaniasCelulares] PRIMARY KEY CLUSTERED 
(
	[CompaniaCelularId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ControlModulos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ControlModulos](
	[ControlModuloId] [int] IDENTITY(1,1) NOT NULL,
	[ControlModuloNombre] [varchar](100) NOT NULL,
	[ControlModuloEstatus] [smallint] NOT NULL,
 CONSTRAINT [PK_ControlModulos] PRIMARY KEY CLUSTERED 
(
	[ControlModuloId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Cortes]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Cortes](
	[CorteId] [int] IDENTITY(1,1) NOT NULL,
	[CorteTipoId] [int] NOT NULL,
	[CorteAnio] [int] NULL,
	[CorteMes] [int] NULL,
	[CorteFechaRegistro] [datetime] NOT NULL,
	[CorteUsuarioIdRegistro] [int] NOT NULL,
	[CorteIdOtro] [int] NULL,
 CONSTRAINT [PK_Cortes] PRIMARY KEY CLUSTERED 
(
	[CorteId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CortesBimestralesDistribuidores]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CortesBimestralesDistribuidores](
	[CorteBimestralDistribuidorId] [int] IDENTITY(1,1) NOT NULL,
	[CorteId] [int] NOT NULL,
	[CorteBimestralDistribuidorDistribuidorDetalleId] [int] NOT NULL,
	[CorteBimestralDistribuidorDistribuidorId] [int] NOT NULL,
	[CorteBimestralDistribuidorDistribuidorDetalleCodigo] [int] NOT NULL,
	[CorteBimestralDistribuidorDistribuidorDetalleRazonSocial] [varchar](128) NOT NULL,
	[CorteBimestralDistribuidorDistribuidorDetalleNombreComercial] [varchar](128) NOT NULL,
	[CorteBimestralDistribuidorDistribuidorDetalleRegionId] [int] NOT NULL,
	[CorteBimestralDistribuidorDistribuidorDetalleRegionNombre] [varchar](50) NOT NULL,
	[CorteBimestralDistribuidorDistribuidorEstatus] [varchar](10) NOT NULL,
	[CorteBimestralDistribuidorCantidadTicktes] [int] NOT NULL,
	[CorteBimestralDistribuidorVentaMontoTicket] [decimal](18, 2) NOT NULL,
	[CorteBimestralDistribuidorFechaRegistroCorte] [datetime] NOT NULL,
	[CorteBimestralDistribuidorUsuarioIdRegistroCorte] [int] NOT NULL,
 CONSTRAINT [PK_CortesBimestralDistribuidores] PRIMARY KEY CLUSTERED 
(
	[CorteBimestralDistribuidorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CortesBimestralesMaestrosPintores]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CortesBimestralesMaestrosPintores](
	[CorteBimestralMaestroPintorId] [int] IDENTITY(1,1) NOT NULL,
	[CorteId] [int] NOT NULL,
	[CorteBimestralMaestroPintorDistribuidorDetalleId] [int] NOT NULL,
	[CorteBimestralMaestroPintorDistribuidorId] [int] NOT NULL,
	[CorteBimestralMaestroPintorDistribuidorDetalleCodigo] [int] NOT NULL,
	[CorteBimestralMaestroPintorDistribuidorDetalleRazonSocial] [varchar](128) NOT NULL,
	[CorteBimestralMaestroPintorDistribuidorDetalleNombreComercial] [varchar](128) NOT NULL,
	[CorteBimestralMaestroPintorDistribuidorEstatus] [varchar](10) NOT NULL,
	[CorteBimestralMaestroPintorDistribuidorDetalleRegionId] [int] NOT NULL,
	[CorteBimestralMaestroPintorDistribuidorDetalleRegionNombre] [varchar](50) NOT NULL,
	[CorteBimestralMaestroPintorUsuarioDetalleIdMP] [int] NOT NULL,
	[CorteBimestralMaestroPintorUsuarioIdMP] [int] NOT NULL,
	[CorteBimestralMaestroPintorMaestroPintor] [varchar](max) NOT NULL,
	[CorteBimestralMaestroPintorEstatusMaestroPintor] [varchar](10) NOT NULL,
	[CorteBimestralMaestroPintorCantidadTickets] [int] NOT NULL,
	[CorteBimestralMaestroPintorVentaMontoTicket] [decimal](18, 2) NOT NULL,
	[ReposicionProductoGanadorPremioLugar] [int] NULL,
	[CorteBimestralMaestroPintorFechaRegistroCorte] [datetime] NOT NULL,
	[CorteBimestralMaestroPintorUsuarioIdRegistroCorte] [int] NOT NULL,
 CONSTRAINT [PK_CortesBimeastralMaestrosPintores] PRIMARY KEY CLUSTERED 
(
	[CorteBimestralMaestroPintorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CortesBimestralesPerfiles]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CortesBimestralesPerfiles](
	[CortesBimestralPerfilId] [int] IDENTITY(1,1) NOT NULL,
	[CorteId] [int] NOT NULL,
	[CortesBimestralPerfilDistribuidorDetalleId] [int] NOT NULL,
	[CortesBimestralPerfilDistribuidorId] [int] NOT NULL,
	[CortesBimestralPerfilDistribuidorDetalleCodigo] [int] NOT NULL,
	[CortesBimestralPerfilDistribuidorDetalleRazonSocial] [varchar](128) NOT NULL,
	[CortesBimestralPerfilDistribuidorDetalleNombreComercial] [varchar](128) NOT NULL,
	[CortesBimestralPerfilDistribuidorDetalleRegionId] [int] NOT NULL,
	[CortesBimestralPerfilDistribuidorDetalleRegionNombre] [varchar](50) NOT NULL,
	[CortesBimestralPerfilDistribuidorEstatus] [varchar](10) NOT NULL,
	[CortesBimestralPerfilDetalleUsuarioIdRegistro] [int] NOT NULL,
	[CortesBimestralPerfilDetalleUsuarioRegistroNombre] [varchar](max) NOT NULL,
	[CortesBimestralPerfilDistribuidorPerfilId] [int] NOT NULL,
	[CortesBimestralPerfilDistribuidorPerfilDescripcion] [varchar](50) NOT NULL,
	[CortesBimestralPerfilDetalleUsuarioRegistroEstatus] [varchar](10) NULL,
	[CortesBimestralPerfilDistribuidorCantidadTicktes] [int] NOT NULL,
	[CortesBimestralPerfilDistribuidorVentaMontoTicket] [decimal](18, 2) NOT NULL,
	[CortesBimestralPerfilDistribuidorUsuarioIdRegistroCorte] [int] NOT NULL,
	[CortesBimestralPerfilDistribuidorFechaRegistroCorte] [datetime] NOT NULL,
 CONSTRAINT [PK_CortesBimestralesPerfiles] PRIMARY KEY CLUSTERED 
(
	[CortesBimestralPerfilId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CortesBimestralesVentas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CortesBimestralesVentas](
	[CorteBimestralVentaId] [int] IDENTITY(1,1) NOT NULL,
	[CorteId] [int] NOT NULL,
	[CorteBimestralVentaTarjetaId] [int] NOT NULL,
	[CorteBimestralVentaVentaId] [int] NOT NULL,
	[CorteBimestralVentaUsuarioDetalleId] [int] NOT NULL,
	[CorteBimestralVentaUsuarioIdMP] [int] NOT NULL,
	[CorteBimestralVentaNombreMaestroPintor] [varchar](max) NOT NULL,
	[CorteBimestralVentaUsuarioIdMPEstatus] [varchar](10) NOT NULL,
	[CorteBimestralVentaDistribuidorDetalleId] [int] NOT NULL,
	[CorteBimestralVentaDistribuidorId] [int] NOT NULL,
	[CorteBimestralVentaDistribuidorDetalleCodigo] [int] NOT NULL,
	[CorteBimestralVentaDistribuidorDetalleRazonSocial] [varchar](128) NOT NULL,
	[CorteBimestralVentaDistribuidorDetalleNombreComercial] [varchar](128) NOT NULL,
	[CorteBimestralVentaDistribuidorDetalleRegionId] [int] NOT NULL,
	[CorteBimestralVentaDistribuidorDetalleRegionNombre] [varchar](50) NOT NULL,
	[CorteBimestralVentaDistribuidorDetalleEstatus] [varchar](10) NULL,
	[CorteBimestralVentaVentaNumeroTicket] [varchar](30) NOT NULL,
	[CorteBimestralVentaVentaMontoTicket] [decimal](18, 2) NOT NULL,
	[CorteBimestralVentaMes] [varchar](10) NOT NULL,
	[CorteBimestralVentaVentaEstatus] [varchar](7) NOT NULL,
	[CorteBimestralVentaVentaEstatusAuditoria] [varchar](50) NOT NULL,
	[CorteBimestralVentaFechaRegistro] [datetime] NOT NULL,
	[CorteBimestralVentaFechaCorte] [datetime] NOT NULL,
	[CorteBimestralVentaUsuarioIdCorte] [int] NOT NULL,
 CONSTRAINT [PK_CortesBimestralVentas] PRIMARY KEY CLUSTERED 
(
	[CorteBimestralVentaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CortesCambioEstatusVentasAuditoria]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CortesCambioEstatusVentasAuditoria](
	[CortesCambioEstatusVentasAuditoriaId] [int] IDENTITY(1,1) NOT NULL,
	[CortesCambioEstatusVentaAuditoriaUsuarioIdRegistro] [int] NOT NULL,
	[CortesCambioEstatusVentaAuditoriaUsuarioFechaRegistro] [datetime] NOT NULL,
	[CorteId] [int] NOT NULL,
	[VentaId] [int] NOT NULL,
	[TarjetaId] [int] NOT NULL,
	[TarjetaNumero] [varchar](50) NULL,
	[VentaUsuarioIdMP] [int] NULL,
	[VentaUsuarioNombreMP] [varchar](250) NULL,
	[DistribuidorId] [int] NOT NULL,
	[DistribuidorDetalleId] [int] NOT NULL,
	[DistribuidorDetalleCodigo] [int] NOT NULL,
	[DistribuidorDetalleRazonSocial] [varchar](128) NOT NULL,
	[DistribuidorDetalleNombreComercial] [varchar](128) NOT NULL,
	[UsuarioDetalleId] [int] NOT NULL,
	[VentaNumeroTicket] [varchar](30) NOT NULL,
	[VentaMontoTicket] [decimal](18, 2) NOT NULL,
	[VentaFotoTicket] [varchar](100) NOT NULL,
	[VentaFechaRegistro] [datetime] NOT NULL,
	[VentaUsuarioIdRegistro] [int] NOT NULL,
	[VentaUsuarioNombreRegistro] [varchar](250) NULL,
	[VentaFechaBaja] [datetime] NULL,
	[VentaUsuarioIdBaja] [int] NULL,
	[VentaTienePromocion] [int] NULL,
	[VentaSessionId] [varchar](34) NOT NULL,
 CONSTRAINT [PK_CortesCambioEstatusVentasAuditoria] PRIMARY KEY CLUSTERED 
(
	[CortesCambioEstatusVentasAuditoriaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CortesGanadores]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CortesGanadores](
	[CorteGanadorId] [int] IDENTITY(1,1) NOT NULL,
	[CorteId] [int] NOT NULL,
	[CorteGanadorAnio] [int] NOT NULL,
	[CorteGanadorMes] [int] NOT NULL,
	[CorteGanadorPremioLugar] [int] NOT NULL,
	[CorteGanadorTotalSumaVentas] [decimal](18, 2) NOT NULL,
	[CorteGanadorTotalCuentaVentas] [int] NOT NULL,
	[CorteGanadorFechaRegistro] [datetime] NOT NULL,
	[CorteGanadorUsuarioIdRegistro] [int] NOT NULL,
	[CorteGanadorUsuarioNombreRegistro] [nvarchar](max) NOT NULL,
	[DistribuidorId] [int] NOT NULL,
	[RecompensaTipoId] [int] NOT NULL,
	[DistribuidorDetalleCodigo] [int] NOT NULL,
	[DistribuidorDetalleNombreComercial] [varchar](128) NOT NULL,
	[TarjetaId] [int] NOT NULL,
	[UsuarioId] [int] NOT NULL,
	[UsuarioNombre] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_CortesGanadores] PRIMARY KEY CLUSTERED 
(
	[CorteGanadorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CortesTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CortesTipos](
	[CorteTipoId] [int] IDENTITY(1,1) NOT NULL,
	[CorteTipoDescripcion] [varchar](300) NULL,
 CONSTRAINT [PK_CortesTipos] PRIMARY KEY CLUSTERED 
(
	[CorteTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Distribuidores]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Distribuidores](
	[DistribuidorId] [int] IDENTITY(1,1) NOT NULL,
	[DistribuidorFechaAlta] [datetime] NOT NULL,
	[DistribuidorUsuarioIdCapturo] [int] NOT NULL,
	[DistribuidorFechaBaja] [datetime] NULL,
	[DistribuidorUsuarioIdBaja] [int] NULL,
	[DistribuidorMatriz] [int] NULL,
	[DistribuidorSessionId] [int] NOT NULL,
 CONSTRAINT [PK_Distribuidores] PRIMARY KEY CLUSTERED 
(
	[DistribuidorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DistribuidoresActivasRE]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DistribuidoresActivasRE](
	[DistribuidorActivaREId] [int] IDENTITY(1,1) NOT NULL,
	[DistribuidorId] [int] NOT NULL,
	[DistribuidorActivaREFechaRegistro] [datetime] NOT NULL,
	[DistribuidorActivaREFechaBaja] [datetime] NULL,
	[DistribuidorActivaRENombreRegistro] [nvarchar](100) NULL,
 CONSTRAINT [PK_DistribuidoresActivasRE] PRIMARY KEY CLUSTERED 
(
	[DistribuidorActivaREId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DistribuidoresDetallesCategorias]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DistribuidoresDetallesCategorias](
	[DistribuidorDetalleCategoriaId] [int] IDENTITY(1,1) NOT NULL,
	[DistribuidorDetalleCategoriaNombre] [varchar](20) NOT NULL,
 CONSTRAINT [PK_DistribuidoresDetallesCategorias] PRIMARY KEY CLUSTERED 
(
	[DistribuidorDetalleCategoriaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DistribuidoresDetallesEtapas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DistribuidoresDetallesEtapas](
	[DistribuidorDetalleEtapaId] [int] IDENTITY(1,1) NOT NULL,
	[DistribuidorDetalleEtapaNombre] [varchar](20) NOT NULL,
 CONSTRAINT [PK_DistribuidoresDetallesEtapas] PRIMARY KEY CLUSTERED 
(
	[DistribuidorDetalleEtapaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DistribuidoresDetallesFaces]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DistribuidoresDetallesFaces](
	[DistribuidorDetalleFaceId] [int] IDENTITY(1,1) NOT NULL,
	[DistribuidorDetalleFaceNombre] [varchar](80) NOT NULL,
 CONSTRAINT [PK_DistribuidoresDetallesFaces] PRIMARY KEY CLUSTERED 
(
	[DistribuidorDetalleFaceId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DistribuidoresDetallesProductosListas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DistribuidoresDetallesProductosListas](
	[DistribuidorDetalleProductoListaId] [int] IDENTITY(1,1) NOT NULL,
	[DistribuidorDetalleProductoListaNombre] [varchar](5) NOT NULL,
	[DistribuidorDetalleProductoListaColorId] [int] NOT NULL,
 CONSTRAINT [PK_DistribuidoresDetallesProductosListas] PRIMARY KEY CLUSTERED 
(
	[DistribuidorDetalleProductoListaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DistribuidoresDetallesRegiones]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DistribuidoresDetallesRegiones](
	[DistribuidorDetalleRegionId] [int] IDENTITY(1,1) NOT NULL,
	[DistribuidorDetalleRegionNombre] [varchar](50) NOT NULL,
 CONSTRAINT [PK_DistribuidoresDetallesRegiones] PRIMARY KEY CLUSTERED 
(
	[DistribuidorDetalleRegionId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[LogRegistros]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[LogRegistros](
	[LogRegistroID] [int] IDENTITY(1,1) NOT NULL,
	[LogRegistroFechaCreacion] [datetime] NOT NULL,
	[LogRegistroIP] [varchar](20) NULL,
	[LogRegistroSistemaOperativo] [varchar](50) NULL,
	[LogRegistroHost] [varchar](200) NULL,
	[UsuarioId] [int] NULL,
	[LogRegistroParentId] [int] NULL,
	[PaginaAccesadaId] [int] NOT NULL,
	[LogRegistroAvisoCookie1] [datetime] NULL,
	[LogRegistroAvisoCookie2] [datetime] NULL,
 CONSTRAINT [PK_LogRegistros] PRIMARY KEY CLUSTERED 
(
	[LogRegistroID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PaginaAccesadas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PaginaAccesadas](
	[PaginaAccesadaId] [int] IDENTITY(1,1) NOT NULL,
	[PaginaAccesadaPagina] [varchar](20) NOT NULL,
	[PaginaAccesadaDescripcion] [varchar](200) NOT NULL,
 CONSTRAINT [PK_PaginaAccesadas] PRIMARY KEY CLUSTERED 
(
	[PaginaAccesadaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ProductosDivisiones]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ProductosDivisiones](
	[ProductoDivisionId] [int] IDENTITY(1,1) NOT NULL,
	[ProductoDivisionNombre] [varchar](20) NOT NULL,
 CONSTRAINT [PK_ProductoDivisiones] PRIMARY KEY CLUSTERED 
(
	[ProductoDivisionId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Recompensas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Recompensas](
	[RecompensaId] [int] IDENTITY(1,1) NOT NULL,
	[RecompensaAnio] [int] NOT NULL,
	[RecompensaMes] [int] NOT NULL,
	[RecompensaPremioLugar] [int] NOT NULL,
	[RecompensaRangoInicial] [int] NOT NULL,
	[RecompensaRangoFinal] [int] NOT NULL,
	[RecompensaFechaRegistro] [datetime] NOT NULL,
	[RecompensaUsuarioIdRegistro] [int] NOT NULL,
	[RecompensaFechaBaja] [datetime] NULL,
	[RecompensaUsuarioIdBaja] [int] NULL,
	[RecompensaTipoId] [int] NOT NULL,
 CONSTRAINT [PK_Recompensas] PRIMARY KEY CLUSTERED 
(
	[RecompensaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[RecompensasTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[RecompensasTipos](
	[RecompensaTipoId] [int] IDENTITY(1,1) NOT NULL,
	[RecompensaTipoDescripcion] [varchar](9) NOT NULL,
 CONSTRAINT [PK_RecompensasTipos] PRIMARY KEY CLUSTERED 
(
	[RecompensaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReposicionesProductosFotos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReposicionesProductosFotos](
	[ReposicionProductoFotoId] [int] IDENTITY(1,1) NOT NULL,
	[ReposicionProductoFotoAnio] [int] NOT NULL,
	[ReposicionProductoFotoMes] [int] NOT NULL,
	[ReposicionProductoFotoOriginal] [varchar](300) NOT NULL,
	[ReposicionProductoFotoModificada] [varchar](300) NOT NULL,
	[ReposicionProductoFotoFechaRegistro] [datetime] NOT NULL,
	[ReposicionProductoFotoUsuarioIdCapturo] [int] NOT NULL,
	[ReposicionProductoFotoExtencion] [varchar](4) NOT NULL,
	[DistribuidorId] [int] NOT NULL,
	[ReposicionProductoFotoTipoId] [int] NOT NULL,
 CONSTRAINT [PK_ReposicionesProductosFotos] PRIMARY KEY CLUSTERED 
(
	[ReposicionProductoFotoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReposicionesProductosFotosTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReposicionesProductosFotosTipos](
	[ReposicionProductoFotoTipoId] [int] IDENTITY(1,1) NOT NULL,
	[ReposicionProductoFotoTipoDescripcion] [varchar](50) NULL,
 CONSTRAINT [PK_ReposicionesProductosFotosTipos] PRIMARY KEY CLUSTERED 
(
	[ReposicionProductoFotoTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReposicionesProductosGanadores]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReposicionesProductosGanadores](
	[ReposicionProductoGanadorId] [int] IDENTITY(1,1) NOT NULL,
	[ReposicionProductoGanadorAnio] [int] NOT NULL,
	[ReposicionProductoGanadorMes] [int] NOT NULL,
	[ReposicionProductoGanadorPremioLugar] [int] NOT NULL,
	[ReposicionProductoGanadorFechaRegistro] [datetime] NOT NULL,
	[ReposicionProductoGanadorUsuarioIdRegistro] [int] NOT NULL,
	[ReposicionProductoGanadorUsuarioNombreRegistro] [nvarchar](max) NOT NULL,
	[ReposicionProductoGanadorFechaEntregaTienda] [date] NULL,
	[ReposicionProductoGanadorFechaEntregaRegistro] [datetime] NULL,
	[ReposicionProductoGanadorUsuarioIdEntregaTienda] [int] NULL,
	[ReposicionProductoGanadorUsuarioNombreEntregaTienda] [nvarchar](max) NULL,
	[ReposicionProductoGanadorTotalProductoPremio] [decimal](18, 2) NULL,
	[ReposicionProductoGanadorTotalSumaVentas] [decimal](18, 2) NULL,
	[ReposicionProductoGanadorTotalCuentaVentas] [int] NULL,
	[ReposicionProductoGanadorObservaciones] [nvarchar](max) NULL,
	[ReposicionProductoPremioProductoId] [int] NULL,
	[DistribuidorId] [int] NOT NULL,
	[DistribuidorDetalleCodigo] [int] NOT NULL,
	[DistribuidorDetalleNombreComercial] [varchar](200) NOT NULL,
	[TarjetaId] [int] NOT NULL,
	[RecompensaTipoId] [int] NOT NULL,
	[UsuarioId] [int] NOT NULL,
	[UsuarioNombre] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_ReposicionesProductosGanadores] PRIMARY KEY CLUSTERED 
(
	[ReposicionProductoGanadorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReposicionesProductosPremios]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReposicionesProductosPremios](
	[ReposicionProductoPremioId] [int] IDENTITY(1,1) NOT NULL,
	[ReposicionProductoPremioAnio] [int] NOT NULL,
	[ReposicionProductoPremioMes] [int] NOT NULL,
	[ReposicionProductoPremioLugar] [int] NOT NULL,
	[ReposicionProductoPremioFechaRegistro] [datetime] NULL,
	[ReposicionProductoPremioUsuarioIdRegistro] [int] NOT NULL,
	[ProductoDivisionId] [int] NOT NULL,
 CONSTRAINT [PK_ReposicionesProductosPremios] PRIMARY KEY CLUSTERED 
(
	[ReposicionProductoPremioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReposicionesProductosPremiosProductos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReposicionesProductosPremiosProductos](
	[ReposicionProductoPremioProductoId] [int] IDENTITY(1,1) NOT NULL,
	[ReposicionProductoPremioProductoDescripcion] [varchar](300) NOT NULL,
	[ReposicionProductoPremioProductoGMS] [varchar](50) NOT NULL,
	[ReposicionProductoPremioProductoCodigo] [varchar](20) NOT NULL,
	[ReposicionProductoPremioProductoPresentacion] [varchar](30) NOT NULL,
	[ReposicionProductoPremioProductoPrecio] [decimal](18, 2) NOT NULL,
	[ReposicionProductoPremioProductoFechaRegistro] [datetime] NOT NULL,
	[ReposicionProductoPremioProductoUsuarioIdRegistro] [int] NULL,
	[ReposicionProductoPremioProductoFechaBaja] [datetime] NULL,
	[ReposicionProductoPremioProductoUsuarioIdBaja] [datetime] NULL,
 CONSTRAINT [PK_ReposicionProductoPremioProducto] PRIMARY KEY CLUSTERED 
(
	[ReposicionProductoPremioProductoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReposicionesProductosPremiosProductosRelaciones]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReposicionesProductosPremiosProductosRelaciones](
	[ReposicionProductoPremioProductoRelacionId] [int] IDENTITY(1,1) NOT NULL,
	[ReposicionProductoPremioId] [int] NOT NULL,
	[ReposicionProductoPremioProductoId] [int] NOT NULL,
	[ReposicionProductoPremioProductoRelacionNumero] [int] NOT NULL,
	[ReposicionProductoPremioProductoRelacionFechaRegistro] [datetime] NOT NULL,
	[ReposicionProductoPremioProductoRelacionUsuarioIdRegistro] [int] NULL,
	[ReposicionProductoPremioProductoRelacionFechaBaja] [datetime] NULL,
	[ReposicionProductoPremioProductoRelacionUsuarioIdBaja] [int] NULL,
 CONSTRAINT [PK_ReposicionesProductosPremiosProductosRelaciones] PRIMARY KEY CLUSTERED 
(
	[ReposicionProductoPremioProductoRelacionId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Tarjetas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Tarjetas](
	[TarjetaId] [int] IDENTITY(1,1) NOT NULL,
	[TarjetaNumero] [varchar](32) NOT NULL,
	[DistribuidorId] [int] NULL,
	[UsuarioId] [int] NULL,
	[TarjetaEstatusId] [int] NOT NULL,
	[TarjetaFechaRegistro] [datetime] NOT NULL,
	[TarjetaUsuarioIdCaptura] [int] NOT NULL,
	[TarjetaFechaBaja] [datetime] NULL,
	[TarjetaUsuarioIdBaja] [int] NULL,
	[TarjetaFechaAsigno] [datetime] NULL,
	[TarjetaUsuarioIdAsigno] [int] NULL,
	[TarjetasTipoId] [int] NULL,
	[observaciones] [varchar](300) NULL,
 CONSTRAINT [PK_Tarjetas] PRIMARY KEY CLUSTERED 
(
	[TarjetaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TarjetasEstatus]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TarjetasEstatus](
	[TarjetaEstatusId] [int] IDENTITY(1,1) NOT NULL,
	[TarjetaEstatusDescripcion] [varchar](30) NOT NULL,
 CONSTRAINT [PK_TarjetasEstatus] PRIMARY KEY CLUSTERED 
(
	[TarjetaEstatusId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TarjetasFolios]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TarjetasFolios](
	[TarjetaFolioId] [int] IDENTITY(1,1) NOT NULL,
	[TarjetaFolioSolicitante] [varchar](100) NOT NULL,
	[TarjetaFolioNo] [varchar](10) NOT NULL,
	[TarjetaFolioFechaSolicitud] [date] NOT NULL,
	[TarjetaFolioCreador] [varchar](100) NOT NULL,
	[TarjetaFolioRangoSolicitado] [varchar](20) NOT NULL,
	[TarjetaFolioFechaRegistro] [datetime] NOT NULL,
	[TarjetaFolioFechaEnvio] [date] NULL,
	[TarjetaId] [int] NULL,
	[TarjetaNumero] [varchar](32) NULL,
	[DistribuidorId] [int] NULL,
	[UsuarioId] [int] NULL,
	[TarjetaFechaRegistro] [datetime] NULL,
	[TarjetaUsuarioIdCaptura] [int] NULL,
	[PaisId] [int] NULL,
 CONSTRAINT [PK_TarjetasFolios] PRIMARY KEY CLUSTERED 
(
	[TarjetaFolioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TarjetasTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TarjetasTipos](
	[TarjetasTipoId] [int] IDENTITY(1,1) NOT NULL,
	[TarjetasTipoDescripcion] [varchar](7) NOT NULL,
 CONSTRAINT [PK_TarjetasTipos] PRIMARY KEY CLUSTERED 
(
	[TarjetasTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsuariosRecuperacionClave]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsuariosRecuperacionClave](
	[UsuarioRecuperacionClaveId] [int] IDENTITY(1,1) NOT NULL,
	[UsuarioId] [int] NOT NULL,
	[UsuarioRecuperacionClaveIP] [varchar](50) NOT NULL,
	[UsuarioRecuperacionClaveFechaRegistro] [datetime] NOT NULL,
	[UsuarioRecuperacionClaveAnterior] [varchar](70) NOT NULL,
	[UsuarioRecuperacionClaveEmailTecleado] [varchar](50) NOT NULL,
	[UsuarioRecuperacionClaveCaptchaSession] [varchar](50) NOT NULL,
	[UsuarioRecuperacionClaveCaptchaTextBox] [varchar](50) NOT NULL,
	[UsuarioRecuperacionClaveSessionId] [varchar](50) NOT NULL,
	[UsuarioRecuperacionClaveFechaCambio] [datetime] NULL,
 CONSTRAINT [PK_UsuariosRecuperacionClave] PRIMARY KEY CLUSTERED 
(
	[UsuarioRecuperacionClaveId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsuariosRegistroAccesos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsuariosRegistroAccesos](
	[UsuarioRegistroAccesoId] [int] IDENTITY(1,1) NOT NULL,
	[UsuarioId] [int] NOT NULL,
	[UsuarioRegistroAccesoIP] [varchar](20) NOT NULL,
	[UsuarioRegistroAccesoSistemaOperativo] [varchar](50) NOT NULL,
	[UsuarioRegistroAccesoFechaCreacion] [datetime] NOT NULL,
 CONSTRAINT [PK_UsuariosRegistroAccesos] PRIMARY KEY CLUSTERED 
(
	[UsuarioRegistroAccesoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsuariosRegistroCookie]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsuariosRegistroCookie](
	[UsuarioRegistroCookieId] [int] IDENTITY(1,1) NOT NULL,
	[UsuarioId] [int] NOT NULL,
	[UsuarioRegistroCookieIP] [varchar](20) NOT NULL,
	[UsuarioRegistroCookieSistemaOperativo] [varchar](50) NOT NULL,
	[UsuarioRegistroCookieToken] [varchar](100) NOT NULL,
	[UsuarioRegistroCookieFechaAcepto] [datetime] NULL,
	[UsuarioRegistroCookieFechaRegistro] [datetime] NOT NULL,
 CONSTRAINT [PK_UsuariosRegistroCookies] PRIMARY KEY CLUSTERED 
(
	[UsuarioRegistroCookieId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsuariosTiposRegistro]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsuariosTiposRegistro](
	[UsuarioTipoRegistroId] [int] IDENTITY(1,1) NOT NULL,
	[UsuarioTipoRegistroDescripcion] [varchar](50) NOT NULL,
 CONSTRAINT [PK_UsuariosTiposRegistro] PRIMARY KEY CLUSTERED 
(
	[UsuarioTipoRegistroId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Ventas]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Ventas](
	[VentaId] [int] IDENTITY(1,1) NOT NULL,
	[TarjetaId] [int] NOT NULL,
	[TarjetaNumero] [varchar](50) NULL,
	[VentaUsuarioIdMP] [int] NULL,
	[VentaUsuarioNombreMP] [varchar](250) NULL,
	[DistribuidorId] [int] NOT NULL,
	[DistribuidorDetalleId] [int] NOT NULL,
	[DistribuidorDetalleCodigo] [int] NOT NULL,
	[DistribuidorDetalleRazonSocial] [varchar](128) NOT NULL,
	[DistribuidorDetalleNombreComercial] [varchar](128) NOT NULL,
	[UsuarioDetalleId] [int] NOT NULL,
	[VentaNumeroTicket] [varchar](30) NOT NULL,
	[VentaMontoTicket] [decimal](18, 2) NOT NULL,
	[VentaFotoTicket] [varchar](100) NOT NULL,
	[VentaFechaRegistro] [datetime] NOT NULL,
	[VentaUsuarioIdRegistro] [int] NOT NULL,
	[VentaUsuarioNombreRegistro] [varchar](250) NULL,
	[VentaFechaBaja] [datetime] NULL,
	[VentaUsuarioIdBaja] [int] NULL,
	[VentaTienePromocion] [int] NULL,
	[VentaSessionId] [varchar](34) NOT NULL,
 CONSTRAINT [PK_Ventas] PRIMARY KEY CLUSTERED 
(
	[VentaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasAuditorias]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasAuditorias](
	[VentaAuditoriaId] [int] IDENTITY(1,1) NOT NULL,
	[VentaId] [int] NOT NULL,
	[UsuarioIdCapturo] [int] NOT NULL,
	[VentaAuditoriaEstatusId] [int] NOT NULL,
	[VentaAuditoriaTipoId] [int] NOT NULL,
	[VentaAuditoriaEstatusOportunidadId] [int] NOT NULL,
	[VentaAuditoriaObservacionId] [int] NULL,
	[VentaAuditoriaFechaRegistro] [datetime] NOT NULL,
	[VentaAuditoriaFechaBaja] [datetime] NULL,
	[VentaAuditoriaFechaAudito] [datetime] NULL,
	[VentaAuditoriaUsuarioAudito] [int] NULL,
	[VentaAuditoriaFechaEnvioCorreo] [datetime] NULL,
	[VentaAuditoriaUsuarioIdEnvioCorreo] [int] NULL,
	[VentaAuditoriaEnvioCorreoTipoId] [int] NULL,
	[VentaAuditoriaFechaEnvioCorreoCierre] [datetime] NULL,
	[VentaAuditoriaFechaActualizado] [datetime] NULL,
	[CorteId] [int] NULL,
 CONSTRAINT [PK_VentasAuditorias] PRIMARY KEY CLUSTERED 
(
	[VentaAuditoriaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasAuditoriasEnviosCorreosTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasAuditoriasEnviosCorreosTipos](
	[VentaAuditoriaEnvioCorreoTipoId] [int] IDENTITY(1,1) NOT NULL,
	[VentaAuditoriaEnvioCorreoTipoDescripcion] [varchar](50) NOT NULL,
 CONSTRAINT [PK_VentasAuditoriasEnviosCorreosTipos] PRIMARY KEY CLUSTERED 
(
	[VentaAuditoriaEnvioCorreoTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasAuditoriasEstatus]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasAuditoriasEstatus](
	[VentaAuditoriaEstatusId] [int] IDENTITY(1,1) NOT NULL,
	[VentaAuditoriaEstatusDescripcion] [varchar](50) NOT NULL,
 CONSTRAINT [PK_VentasAuditoriasEstatus] PRIMARY KEY CLUSTERED 
(
	[VentaAuditoriaEstatusId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasAuditoriasEstatusOportunidades]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasAuditoriasEstatusOportunidades](
	[VentaAuditoriaEstatusOportunidadId] [int] IDENTITY(1,1) NOT NULL,
	[VentaAuditoriaEstatusOportunidadDescripcion] [varchar](50) NOT NULL,
 CONSTRAINT [PK_VentasAuditoriasOportunidadesEstatus] PRIMARY KEY CLUSTERED 
(
	[VentaAuditoriaEstatusOportunidadId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasAuditoriasObservaciones]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasAuditoriasObservaciones](
	[VentaAuditoriaObservacionId] [int] IDENTITY(1,1) NOT NULL,
	[VentaAuditoriaObservacionDescripcion] [varchar](100) NOT NULL,
	[VentaAuditoriaObservacionFechaBaja] [datetime] NULL,
	[VentaAuditoriaObservacionFechaAlta] [datetime] NULL,
	[VentaAuditoriaObservacionIDCaptura] [int] NULL,
 CONSTRAINT [PK_VentasAuditoriasObservaciones] PRIMARY KEY CLUSTERED 
(
	[VentaAuditoriaObservacionId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasAuditoriasTipos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasAuditoriasTipos](
	[VentaAuditoriaTipoId] [int] IDENTITY(1,1) NOT NULL,
	[VentaAuditoriaTipoDescripcion] [varchar](30) NOT NULL,
 CONSTRAINT [PK_VentasAuditoriasTipos] PRIMARY KEY CLUSTERED 
(
	[VentaAuditoriaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasHistoricosRechazos]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasHistoricosRechazos](
	[VentaHistoricoRechazoId] [int] IDENTITY(1,1) NOT NULL,
	[VentaId] [int] NOT NULL,
	[TarjetaId] [int] NOT NULL,
	[TarjetaNumero] [varchar](50) NOT NULL,
	[VentaUsuarioIdMP] [int] NOT NULL,
	[VentaUsuarioNombreMP] [varchar](250) NOT NULL,
	[DistribuidorId] [int] NOT NULL,
	[DistribuidorDetalleId] [int] NOT NULL,
	[DistribuidorDetalleCodigo] [int] NOT NULL,
	[DistribuidorDetalleRazonSocial] [varchar](128) NOT NULL,
	[DistribuidorDetalleNombreComercial] [varchar](128) NOT NULL,
	[UsuarioDetalleId] [int] NOT NULL,
	[VentaNumeroTicket] [varchar](30) NOT NULL,
	[VentaMontoTicket] [decimal](18, 2) NOT NULL,
	[VentaFotoTicket] [varchar](100) NOT NULL,
	[VentaFechaRegistro] [datetime] NOT NULL,
	[VentaUsuarioIdRegistro] [int] NOT NULL,
	[VentaUsuarioNombreRegistro] [varchar](250) NULL,
	[VentaFechaBaja] [datetime] NULL,
	[VentaUsuarioIdBaja] [int] NULL,
	[VentaSessionId] [varchar](34) NOT NULL,
	[VentaHistoricoRechazoFechaRegistro] [datetime] NOT NULL,
	[VentaHistoricoRechazoUsuarioIdRegistro] [int] NOT NULL,
	[VentaHistoricoRechazoSessionId] [varchar](34) NOT NULL,
 CONSTRAINT [PK_VentasHistoricosRechazos] PRIMARY KEY CLUSTERED 
(
	[VentaHistoricoRechazoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasPromociones]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasPromociones](
	[VentaPromocionId] [int] IDENTITY(1,1) NOT NULL,
	[VentaPromocionNombre] [varchar](50) NOT NULL,
	[VentaPromocionFechaRegistro] [datetime] NOT NULL,
	[VentaPromocionFechaBaja] [datetime] NULL,
	[VentaPromocionFechaInicio] [date] NOT NULL,
	[VentaPromocionFechaFin] [date] NOT NULL,
	[UsuarioIdCapturo] [int] NULL,
 CONSTRAINT [PK_VentasPromociones] PRIMARY KEY CLUSTERED 
(
	[VentaPromocionId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasPromocionesDetalles]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasPromocionesDetalles](
	[VentaPromocionDetalleId] [int] IDENTITY(1,1) NOT NULL,
	[VentaPromocionId] [int] NOT NULL,
	[VentaPromocionDetalleGMC] [varchar](20) NOT NULL,
	[VentaPromocionDetalleCodigo] [varchar](20) NOT NULL,
	[VentaPromocionDetalleDescripcion] [varchar](100) NOT NULL,
	[VentaPromocionDetallePresentacion] [varchar](10) NOT NULL,
	[VentaPromocionDetalleFechaAlta] [datetime] NOT NULL,
	[VentaPromocionDetalleFechaBaja] [datetime] NULL,
 CONSTRAINT [PK_VentasPromocionesDetalles] PRIMARY KEY CLUSTERED 
(
	[VentaPromocionDetalleId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[VentasUsuariosPromociones]    Script Date: 18/03/2026 12:57:09 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[VentasUsuariosPromociones](
	[VentaUsuarioPromocionId] [int] IDENTITY(1,1) NOT NULL,
	[VentaUsuarioPromocionFechaRegistro] [datetime] NOT NULL,
	[VentaId] [int] NOT NULL,
	[VentaPromocionDetalleId] [int] NOT NULL,
	[VentaUsuarioPromocionCantidad] [int] NOT NULL,
 CONSTRAINT [PK_VentasUsuariosPromociones] PRIMARY KEY CLUSTERED 
(
	[VentaUsuarioPromocionId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[CargasMultimediasModulos] ON 

INSERT [dbo].[CargasMultimediasModulos] ([CargaMultimediaModuloId], [CargaMultimediaModuloDescripcion]) VALUES (1, N'POPUPS')
INSERT [dbo].[CargasMultimediasModulos] ([CargaMultimediaModuloId], [CargaMultimediaModuloDescripcion]) VALUES (2, N'NOTÍCIAS E CIRCULARES')
INSERT [dbo].[CargasMultimediasModulos] ([CargaMultimediaModuloId], [CargaMultimediaModuloDescripcion]) VALUES (3, N'TUTORIAIS')
SET IDENTITY_INSERT [dbo].[CargasMultimediasModulos] OFF
GO
SET IDENTITY_INSERT [dbo].[CargasMultimediasTipos] ON 

INSERT [dbo].[CargasMultimediasTipos] ([CargaMultimediaTipoId], [CargaMultimediaTipoDescripcion]) VALUES (1, N'VÍDEO')
INSERT [dbo].[CargasMultimediasTipos] ([CargaMultimediaTipoId], [CargaMultimediaTipoDescripcion]) VALUES (2, N'PDF')
INSERT [dbo].[CargasMultimediasTipos] ([CargaMultimediaTipoId], [CargaMultimediaTipoDescripcion]) VALUES (3, N'IMAGEM')
SET IDENTITY_INSERT [dbo].[CargasMultimediasTipos] OFF
GO
SET IDENTITY_INSERT [dbo].[CargasMultimediasVideosTipos] ON 

INSERT [dbo].[CargasMultimediasVideosTipos] ([CargaMultimediaVideoTipoId], [CargaMultimediaVideoTipoDescripcion]) VALUES (1, N'TODOS')
INSERT [dbo].[CargasMultimediasVideosTipos] ([CargaMultimediaVideoTipoId], [CargaMultimediaVideoTipoDescripcion]) VALUES (2, N'INTERNO')
INSERT [dbo].[CargasMultimediasVideosTipos] ([CargaMultimediaVideoTipoId], [CargaMultimediaVideoTipoDescripcion]) VALUES (3, N'EXTERNO')
SET IDENTITY_INSERT [dbo].[CargasMultimediasVideosTipos] OFF
GO
SET IDENTITY_INSERT [dbo].[CargasTipos] ON 

INSERT [dbo].[CargasTipos] ([CargaTipoId], [CargaTipoDescripcion], [UsuarioIdRegistro], [CargaTipoFechaRegistro]) VALUES (1, N'Controle de Registros', 1, CAST(N'2026-03-01T19:23:52.000' AS DateTime))
INSERT [dbo].[CargasTipos] ([CargaTipoId], [CargaTipoDescripcion], [UsuarioIdRegistro], [CargaTipoFechaRegistro]) VALUES (2, N'Vencedores', 1, CAST(N'2026-03-01T01:40:06.000' AS DateTime))
SET IDENTITY_INSERT [dbo].[CargasTipos] OFF
GO
SET IDENTITY_INSERT [dbo].[CompaniasCelulares] ON 

INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (1, N'Telcel')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (2, N'Unefón')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (3, N'AT&T')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (4, N'Movistar')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (5, N'Bait')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (6, N'Virgin Mobile')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (7, N'Freedompop')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (8, N'Flash Mobile')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (9, N'Weex')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (10, N'Cierto')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (11, N'Maz Tiempo')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (12, N'Oxxo')
INSERT [dbo].[CompaniasCelulares] ([CompaniaCelularId], [CompaniaCelularNombre]) VALUES (13, N'Otro')
SET IDENTITY_INSERT [dbo].[CompaniasCelulares] OFF
GO
SET IDENTITY_INSERT [dbo].[ControlModulos] ON 

INSERT [dbo].[ControlModulos] ([ControlModuloId], [ControlModuloNombre], [ControlModuloEstatus]) VALUES (1, N'SUBSTITUIÇÃO_PRODUTO', 1)
SET IDENTITY_INSERT [dbo].[ControlModulos] OFF
GO
SET IDENTITY_INSERT [dbo].[CortesTipos] ON 

INSERT [dbo].[CortesTipos] ([CorteTipoId], [CorteTipoDescripcion]) VALUES (1, N'AUDITORIA DE MUDANÇA DE STATUS DE VENDAS')
INSERT [dbo].[CortesTipos] ([CorteTipoId], [CorteTipoDescripcion]) VALUES (2, N'GERAÇÃO DE VENCEDORES')
INSERT [dbo].[CortesTipos] ([CorteTipoId], [CorteTipoDescripcion]) VALUES (3, N'TRIBUNAL DE VENDAS BIMENSAL')
INSERT [dbo].[CortesTipos] ([CorteTipoId], [CorteTipoDescripcion]) VALUES (4, N'CORTE DE VENDAS DA PROMOÇÃO')
SET IDENTITY_INSERT [dbo].[CortesTipos] OFF
GO
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesCategorias] ON 

INSERT [dbo].[DistribuidoresDetallesCategorias] ([DistribuidorDetalleCategoriaId], [DistribuidorDetalleCategoriaNombre]) VALUES (1, N'A')
INSERT [dbo].[DistribuidoresDetallesCategorias] ([DistribuidorDetalleCategoriaId], [DistribuidorDetalleCategoriaNombre]) VALUES (2, N'B')
INSERT [dbo].[DistribuidoresDetallesCategorias] ([DistribuidorDetalleCategoriaId], [DistribuidorDetalleCategoriaNombre]) VALUES (3, N'C')
INSERT [dbo].[DistribuidoresDetallesCategorias] ([DistribuidorDetalleCategoriaId], [DistribuidorDetalleCategoriaNombre]) VALUES (4, N'D')
INSERT [dbo].[DistribuidoresDetallesCategorias] ([DistribuidorDetalleCategoriaId], [DistribuidorDetalleCategoriaNombre]) VALUES (5, N'SEM CATEGORIA')
INSERT [dbo].[DistribuidoresDetallesCategorias] ([DistribuidorDetalleCategoriaId], [DistribuidorDetalleCategoriaNombre]) VALUES (6, N'E')
INSERT [dbo].[DistribuidoresDetallesCategorias] ([DistribuidorDetalleCategoriaId], [DistribuidorDetalleCategoriaNombre]) VALUES (7, N'F')
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesCategorias] OFF
GO
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesEtapas] ON 

INSERT [dbo].[DistribuidoresDetallesEtapas] ([DistribuidorDetalleEtapaId], [DistribuidorDetalleEtapaNombre]) VALUES (1, N'Sem etapas')
INSERT [dbo].[DistribuidoresDetallesEtapas] ([DistribuidorDetalleEtapaId], [DistribuidorDetalleEtapaNombre]) VALUES (2, N'Axalta em turnê')
INSERT [dbo].[DistribuidoresDetallesEtapas] ([DistribuidorDetalleEtapaId], [DistribuidorDetalleEtapaNombre]) VALUES (3, N'Reynosa')
INSERT [dbo].[DistribuidoresDetallesEtapas] ([DistribuidorDetalleEtapaId], [DistribuidorDetalleEtapaNombre]) VALUES (4, N'Eles vão adicionar')
INSERT [dbo].[DistribuidoresDetallesEtapas] ([DistribuidorDetalleEtapaId], [DistribuidorDetalleEtapaNombre]) VALUES (5, N'Planilhas')
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesEtapas] OFF
GO
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesFaces] ON 

INSERT [dbo].[DistribuidoresDetallesFaces] ([DistribuidorDetalleFaceId], [DistribuidorDetalleFaceNombre]) VALUES (1, N'Fase 1')
INSERT [dbo].[DistribuidoresDetallesFaces] ([DistribuidorDetalleFaceId], [DistribuidorDetalleFaceNombre]) VALUES (2, N'Fase 2')
INSERT [dbo].[DistribuidoresDetallesFaces] ([DistribuidorDetalleFaceId], [DistribuidorDetalleFaceNombre]) VALUES (3, N'Fase 3')
INSERT [dbo].[DistribuidoresDetallesFaces] ([DistribuidorDetalleFaceId], [DistribuidorDetalleFaceNombre]) VALUES (4, N'Fase 4')
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesFaces] OFF
GO
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesProductosListas] ON 

INSERT [dbo].[DistribuidoresDetallesProductosListas] ([DistribuidorDetalleProductoListaId], [DistribuidorDetalleProductoListaNombre], [DistribuidorDetalleProductoListaColorId]) VALUES (1, N'D1', 2)
INSERT [dbo].[DistribuidoresDetallesProductosListas] ([DistribuidorDetalleProductoListaId], [DistribuidorDetalleProductoListaNombre], [DistribuidorDetalleProductoListaColorId]) VALUES (2, N'D2', 1)
INSERT [dbo].[DistribuidoresDetallesProductosListas] ([DistribuidorDetalleProductoListaId], [DistribuidorDetalleProductoListaNombre], [DistribuidorDetalleProductoListaColorId]) VALUES (3, N'D3', 1)
INSERT [dbo].[DistribuidoresDetallesProductosListas] ([DistribuidorDetalleProductoListaId], [DistribuidorDetalleProductoListaNombre], [DistribuidorDetalleProductoListaColorId]) VALUES (4, N'D9', 2)
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesProductosListas] OFF
GO
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesRegiones] ON 

INSERT [dbo].[DistribuidoresDetallesRegiones] ([DistribuidorDetalleRegionId], [DistribuidorDetalleRegionNombre]) VALUES (1, N'Centro-Oeste')
INSERT [dbo].[DistribuidoresDetallesRegiones] ([DistribuidorDetalleRegionId], [DistribuidorDetalleRegionNombre]) VALUES (2, N'Nordeste')
INSERT [dbo].[DistribuidoresDetallesRegiones] ([DistribuidorDetalleRegionId], [DistribuidorDetalleRegionNombre]) VALUES (3, N'Norte')
INSERT [dbo].[DistribuidoresDetallesRegiones] ([DistribuidorDetalleRegionId], [DistribuidorDetalleRegionNombre]) VALUES (4, N'Nenhuma região')
INSERT [dbo].[DistribuidoresDetallesRegiones] ([DistribuidorDetalleRegionId], [DistribuidorDetalleRegionNombre]) VALUES (5, N'Sudeste')
INSERT [dbo].[DistribuidoresDetallesRegiones] ([DistribuidorDetalleRegionId], [DistribuidorDetalleRegionNombre]) VALUES (6, N'Sul')
SET IDENTITY_INSERT [dbo].[DistribuidoresDetallesRegiones] OFF
GO
SET IDENTITY_INSERT [dbo].[PaginaAccesadas] ON 

INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (1, N'axaltafacebook', N'Página de destino do Facebook')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (2, N'RegistroMaestroPinto', N'Registro de Pintor Mestre Externo')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (3, N'tarjetaMPE', N'Termos e Condições do Cartão Virtual')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (4, N'DatosMPE', N'Entrega de acesso ao mestre pintor externo')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (5, N'thankyoupage', N' Página de agradecimento')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (6, N'login', N'Conecte-se')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (7, N'axaltalatam', N'fanpage Axalta latam')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (8, N'axaltaMX', N'página de fãs da axalta MX')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (9, N'rempfacebook', N'Registro de Mestre Pintor Externo Facebook')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (10, N'rempgoogle', N'Registro de pintor mestre externo do Google')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (11, N'rempweb', N'Registro externo do Web Master Painter')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (12, N'axaltafacebook', N'Página de destino do Facebook')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (13, N'RegistroMaestroPinto', N'Registro de Pintor Mestre Externo')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (14, N'tarjetaMPE', N'Termos e Condições do Cartão Virtual')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (15, N'DatosMPE', N'Entrega de acesso ao mestre pintor externo')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (16, N'thankyoupage', N' Página de agradecimento')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (17, N'login', N'Conecte-se')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (18, N'axaltalatam', N'fanpage Axalta latam')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (19, N'axaltaMX', N'página de fãs da axalta MX')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (20, N'rempfacebook', N'Registro de Mestre Pintor Externo Facebook')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (21, N'rempgoogle', N'Registro de pintor mestre externo do Google')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (22, N'rempweb', N'Registro externo do Web Master Painter')
INSERT [dbo].[PaginaAccesadas] ([PaginaAccesadaId], [PaginaAccesadaPagina], [PaginaAccesadaDescripcion]) VALUES (23, N'rgacp', N'Registe-se e ganhe no Axalta Painters Club')
SET IDENTITY_INSERT [dbo].[PaginaAccesadas] OFF
GO
SET IDENTITY_INSERT [dbo].[Perfiles] ON 

INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (1, N'ADMINISTRADORES DA STRATEGIX')
INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (2, N'ATENDIMENTO AO CLIENTE')
INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (3, N'ADMINISTRADORES DA AXALTA')
INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (4, N'GERENTE REGIONAL')
INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (5, N'EXECUTIVOS')
INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (6, N'GERENTE DISTRIBUIDOR')
INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (7, N'EQUIPE DA LOJA')
INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (8, N'GERENTE DE LOJA')
INSERT [dbo].[Perfiles] ([PerfilId], [PerfilDescripcion]) VALUES (9, N'MESTRE PINTOR')
SET IDENTITY_INSERT [dbo].[Perfiles] OFF
GO
SET IDENTITY_INSERT [dbo].[ProductosDivisiones] ON 

INSERT [dbo].[ProductosDivisiones] ([ProductoDivisionId], [ProductoDivisionNombre]) VALUES (1, N'Arquitetônico')
INSERT [dbo].[ProductosDivisiones] ([ProductoDivisionId], [ProductoDivisionNombre]) VALUES (2, N'Automotivo')
INSERT [dbo].[ProductosDivisiones] ([ProductoDivisionId], [ProductoDivisionNombre]) VALUES (3, N'Produtos')
SET IDENTITY_INSERT [dbo].[ProductosDivisiones] OFF
GO
SET IDENTITY_INSERT [dbo].[RecompensasTipos] ON 

INSERT [dbo].[RecompensasTipos] ([RecompensaTipoId], [RecompensaTipoDescripcion]) VALUES (1, N'MENSAL')
INSERT [dbo].[RecompensasTipos] ([RecompensaTipoId], [RecompensaTipoDescripcion]) VALUES (2, N'BIMENSAL')
SET IDENTITY_INSERT [dbo].[RecompensasTipos] OFF
GO
SET IDENTITY_INSERT [dbo].[ReposicionesProductosFotosTipos] ON 

INSERT [dbo].[ReposicionesProductosFotosTipos] ([ReposicionProductoFotoTipoId], [ReposicionProductoFotoTipoDescripcion]) VALUES (1, N'FOTO')
INSERT [dbo].[ReposicionesProductosFotosTipos] ([ReposicionProductoFotoTipoId], [ReposicionProductoFotoTipoDescripcion]) VALUES (2, N'ASSINATURA')
SET IDENTITY_INSERT [dbo].[ReposicionesProductosFotosTipos] OFF
GO
SET IDENTITY_INSERT [dbo].[TarjetasEstatus] ON 

INSERT [dbo].[TarjetasEstatus] ([TarjetaEstatusId], [TarjetaEstatusDescripcion]) VALUES (1, N'PENDENTE DE ATRIBUIÇÃO')
INSERT [dbo].[TarjetasEstatus] ([TarjetaEstatusId], [TarjetaEstatusDescripcion]) VALUES (2, N'ATRIBUÍDO')
INSERT [dbo].[TarjetasEstatus] ([TarjetaEstatusId], [TarjetaEstatusDescripcion]) VALUES (3, N'LANÇAMENTO DO PINTOR MESTRE')
INSERT [dbo].[TarjetasEstatus] ([TarjetaEstatusId], [TarjetaEstatusDescripcion]) VALUES (4, N'CANCELADO POR SUBSTITUIÇÃO')
INSERT [dbo].[TarjetasEstatus] ([TarjetaEstatusId], [TarjetaEstatusDescripcion]) VALUES (5, N'CANCELADO POR ERRO')
INSERT [dbo].[TarjetasEstatus] ([TarjetaEstatusId], [TarjetaEstatusDescripcion]) VALUES (6, N'INATIVO')
SET IDENTITY_INSERT [dbo].[TarjetasEstatus] OFF
GO
SET IDENTITY_INSERT [dbo].[TarjetasTipos] ON 

INSERT [dbo].[TarjetasTipos] ([TarjetasTipoId], [TarjetasTipoDescripcion]) VALUES (1, N'FÍSICA')
INSERT [dbo].[TarjetasTipos] ([TarjetasTipoId], [TarjetasTipoDescripcion]) VALUES (2, N'DIGITAL')
SET IDENTITY_INSERT [dbo].[TarjetasTipos] OFF
GO
SET IDENTITY_INSERT [dbo].[Usuarios] ON 

INSERT [dbo].[Usuarios] ([UsuarioId], [UsuarioFechaActualizoDatos], [UsuarioFechaAceptoTerminos], [UsuarioFechaAceptoAvisoPrivacidad], [UsuarioFechaAceptoTerminosTarjetaDigital], [UsuarioFechaAceptoAvisoPrivacidadTarjetaDigital], [UsuarioFechaRegistro], [UsuarioFechaBajaParticipante], [UsuarioFechaBajaDistribuidora], [UsuarioFechaEnvioMailRegistro], [UsuarioCapturaId], [UsuarioBajaParticipanteUsuarioId], [UsuarioBajaDistribuidoraUsuarioId], [UsuarioTipoRegistroId], [PerfilId], [UsuarioSessionId]) VALUES (1, CAST(N'2026-03-11T17:33:03.000' AS DateTime), NULL, NULL, NULL, NULL, CAST(N'2026-03-11T15:53:39.000' AS DateTime), NULL, NULL, NULL, 0, NULL, NULL, 1, 2, N'1')
SET IDENTITY_INSERT [dbo].[Usuarios] OFF
GO
SET IDENTITY_INSERT [dbo].[UsuariosDetalles] ON 

INSERT [dbo].[UsuariosDetalles] ([UsuarioDetalleId], [UsuarioId], [UsuarioDetalleNombre], [UsuarioDetalleSegundoNombre], [UsuarioDetalleApellidos], [UsuarioDetalleApellidoMaterno], [UsuarioDetalleUsuario], [UsuarioDetalleClave], [UsuarioDetalleEmail], [UsuarioDetalleTelefono], [UsuarioDetalleExtension], [UsuarioDetalleCelular], [UsuarioDetalleCompaniaCelularId], [UsuarioDetalleRFC], [UsuarioDetalleCP], [UsuarioDetalleEstado], [UsuarioDetalleCiudad], [UsuarioDetalleMunicipio], [UsuarioDetalleColonia], [UsuarioDetalleCalle], [UsuarioDetalleExterior], [UsuarioDetalleInterior], [UsuarioDetallePersonasTaller], [UsuarioDetalleAutosPorsemana], [UsuarioDetallePuestoId], [UsuarioDetalleTallaId], [UsuarioDetalleFechaRegistro], [UsuarioDetalleUsuarioIdRegistro], [UsuarioDetalleFechaBaja], [UsuarioDetalleUsuarioIdBaja], [UsuarioDetalleArchivoIdentificacion], [UsuarioDetalleArchivoFirma], [UsuarioDetalleObservaciones], [UsuarioDetalleFechaNacimiento], [UsuarioDetalleINE], [UsuarioDetalleSessionId]) VALUES (1, 1, N'LUIS', N'FELIPE', N'RANGEL', N'MARTINEZ', N'lrangel', N'7f91e8a4b648b0125b15dc5a3b6466f9f4906d92c72bea9bd6be92c853bebda2', N'luis.rangel@strategix.com.mx', N'', N'', N'5526745070', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CAST(N'2026-03-11T15:53:39.000' AS DateTime), 1, CAST(N'2026-03-11T17:07:09.413' AS DateTime), 1, NULL, NULL, NULL, NULL, NULL, N'1')
INSERT [dbo].[UsuariosDetalles] ([UsuarioDetalleId], [UsuarioId], [UsuarioDetalleNombre], [UsuarioDetalleSegundoNombre], [UsuarioDetalleApellidos], [UsuarioDetalleApellidoMaterno], [UsuarioDetalleUsuario], [UsuarioDetalleClave], [UsuarioDetalleEmail], [UsuarioDetalleTelefono], [UsuarioDetalleExtension], [UsuarioDetalleCelular], [UsuarioDetalleCompaniaCelularId], [UsuarioDetalleRFC], [UsuarioDetalleCP], [UsuarioDetalleEstado], [UsuarioDetalleCiudad], [UsuarioDetalleMunicipio], [UsuarioDetalleColonia], [UsuarioDetalleCalle], [UsuarioDetalleExterior], [UsuarioDetalleInterior], [UsuarioDetallePersonasTaller], [UsuarioDetalleAutosPorsemana], [UsuarioDetallePuestoId], [UsuarioDetalleTallaId], [UsuarioDetalleFechaRegistro], [UsuarioDetalleUsuarioIdRegistro], [UsuarioDetalleFechaBaja], [UsuarioDetalleUsuarioIdBaja], [UsuarioDetalleArchivoIdentificacion], [UsuarioDetalleArchivoFirma], [UsuarioDetalleObservaciones], [UsuarioDetalleFechaNacimiento], [UsuarioDetalleINE], [UsuarioDetalleSessionId]) VALUES (5, 1, N'LKJHGF', N'LKJH', N'KJHFGH', N'MARTINEZ', N'lrangel', N'7f91e8a4b648b0125b15dc5a3b6466f9f4906d92c72bea9bd6be92c853bebda2', N'luis.rangel@strategix.com.mx', N'', NULL, N'9999999999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CAST(N'2026-03-11T17:07:09.390' AS DateTime), 1, CAST(N'2026-03-11T17:43:25.353' AS DateTime), 1, NULL, NULL, N'PRIMERA ACTUALIZACION DE DATOS', NULL, NULL, N'f985a689c669ee5577a4ea1a1feb839e')
INSERT [dbo].[UsuariosDetalles] ([UsuarioDetalleId], [UsuarioId], [UsuarioDetalleNombre], [UsuarioDetalleSegundoNombre], [UsuarioDetalleApellidos], [UsuarioDetalleApellidoMaterno], [UsuarioDetalleUsuario], [UsuarioDetalleClave], [UsuarioDetalleEmail], [UsuarioDetalleTelefono], [UsuarioDetalleExtension], [UsuarioDetalleCelular], [UsuarioDetalleCompaniaCelularId], [UsuarioDetalleRFC], [UsuarioDetalleCP], [UsuarioDetalleEstado], [UsuarioDetalleCiudad], [UsuarioDetalleMunicipio], [UsuarioDetalleColonia], [UsuarioDetalleCalle], [UsuarioDetalleExterior], [UsuarioDetalleInterior], [UsuarioDetallePersonasTaller], [UsuarioDetalleAutosPorsemana], [UsuarioDetallePuestoId], [UsuarioDetalleTallaId], [UsuarioDetalleFechaRegistro], [UsuarioDetalleUsuarioIdRegistro], [UsuarioDetalleFechaBaja], [UsuarioDetalleUsuarioIdBaja], [UsuarioDetalleArchivoIdentificacion], [UsuarioDetalleArchivoFirma], [UsuarioDetalleObservaciones], [UsuarioDetalleFechaNacimiento], [UsuarioDetalleINE], [UsuarioDetalleSessionId]) VALUES (6, 1, N'LUIS', N'RANGEL', N'MARTINEZ', N'MARTINEZ', N'lrangel', N'7f91e8a4b648b0125b15dc5a3b6466f9f4906d92c72bea9bd6be92c853bebda2', N'luis.rangel@strategix.com.mx', N'', NULL, N'5526745070', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CAST(N'2026-03-11T17:43:25.330' AS DateTime), 1, CAST(N'2026-03-18T10:51:37.963' AS DateTime), 1, NULL, NULL, N'PRIMERA ACTUALIZACION DE DATOS', NULL, NULL, N'7dbc1d09505853617319c10634ebb586')
INSERT [dbo].[UsuariosDetalles] ([UsuarioDetalleId], [UsuarioId], [UsuarioDetalleNombre], [UsuarioDetalleSegundoNombre], [UsuarioDetalleApellidos], [UsuarioDetalleApellidoMaterno], [UsuarioDetalleUsuario], [UsuarioDetalleClave], [UsuarioDetalleEmail], [UsuarioDetalleTelefono], [UsuarioDetalleExtension], [UsuarioDetalleCelular], [UsuarioDetalleCompaniaCelularId], [UsuarioDetalleRFC], [UsuarioDetalleCP], [UsuarioDetalleEstado], [UsuarioDetalleCiudad], [UsuarioDetalleMunicipio], [UsuarioDetalleColonia], [UsuarioDetalleCalle], [UsuarioDetalleExterior], [UsuarioDetalleInterior], [UsuarioDetallePersonasTaller], [UsuarioDetalleAutosPorsemana], [UsuarioDetallePuestoId], [UsuarioDetalleTallaId], [UsuarioDetalleFechaRegistro], [UsuarioDetalleUsuarioIdRegistro], [UsuarioDetalleFechaBaja], [UsuarioDetalleUsuarioIdBaja], [UsuarioDetalleArchivoIdentificacion], [UsuarioDetalleArchivoFirma], [UsuarioDetalleObservaciones], [UsuarioDetalleFechaNacimiento], [UsuarioDetalleINE], [UsuarioDetalleSessionId]) VALUES (7, 1, N'LUIS', N'RANGEL', N'MARTINEZ', N'MARTINEZ', N'lrangel', N'7f91e8a4b648b0125b15dc5a3b6466f9f4906d92c72bea9bd6be92c853bebda2', N'luis.rangel@strategix.com.mx', N'', NULL, N'5526745070', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CAST(N'2026-03-18T10:51:37.983' AS DateTime), 1, NULL, NULL, NULL, NULL, N'CREADO AUTAMATICAMENTE AL MODIFICAR LA CLAVE', NULL, NULL, N'1371b9a3864bfe7cd31ee99a1c807aeb')
SET IDENTITY_INSERT [dbo].[UsuariosDetalles] OFF
GO
SET IDENTITY_INSERT [dbo].[UsuariosRecuperacionClave] ON 

INSERT [dbo].[UsuariosRecuperacionClave] ([UsuarioRecuperacionClaveId], [UsuarioId], [UsuarioRecuperacionClaveIP], [UsuarioRecuperacionClaveFechaRegistro], [UsuarioRecuperacionClaveAnterior], [UsuarioRecuperacionClaveEmailTecleado], [UsuarioRecuperacionClaveCaptchaSession], [UsuarioRecuperacionClaveCaptchaTextBox], [UsuarioRecuperacionClaveSessionId], [UsuarioRecuperacionClaveFechaCambio]) VALUES (1, 1, N'127.0.0.1', CAST(N'2026-03-17T20:15:06.790' AS DateTime), N'7f91e8a4b648b0125b15dc5a3b6466f9f4906d92c72bea9bd6be92c853bebda2', N'luis.rangel@strategix.com.mx', N'RECAPTCHAV3', N'SE DIO DE BAJA POR PETICION NUEVA', N'b6e27bad090844b4ab27d59781f2b3af', CAST(N'2026-03-17T20:40:58.900' AS DateTime))
INSERT [dbo].[UsuariosRecuperacionClave] ([UsuarioRecuperacionClaveId], [UsuarioId], [UsuarioRecuperacionClaveIP], [UsuarioRecuperacionClaveFechaRegistro], [UsuarioRecuperacionClaveAnterior], [UsuarioRecuperacionClaveEmailTecleado], [UsuarioRecuperacionClaveCaptchaSession], [UsuarioRecuperacionClaveCaptchaTextBox], [UsuarioRecuperacionClaveSessionId], [UsuarioRecuperacionClaveFechaCambio]) VALUES (2, 1, N'127.0.0.1', CAST(N'2026-03-17T20:40:58.907' AS DateTime), N'7f91e8a4b648b0125b15dc5a3b6466f9f4906d92c72bea9bd6be92c853bebda2', N'luis.rangel@strategix.com.mx', N'RECAPTCHAV3', N'SE DIO DE BAJA POR PETICION NUEVA', N'a93826a4370698f46d51b5e51301188e', CAST(N'2026-03-17T20:43:50.930' AS DateTime))
INSERT [dbo].[UsuariosRecuperacionClave] ([UsuarioRecuperacionClaveId], [UsuarioId], [UsuarioRecuperacionClaveIP], [UsuarioRecuperacionClaveFechaRegistro], [UsuarioRecuperacionClaveAnterior], [UsuarioRecuperacionClaveEmailTecleado], [UsuarioRecuperacionClaveCaptchaSession], [UsuarioRecuperacionClaveCaptchaTextBox], [UsuarioRecuperacionClaveSessionId], [UsuarioRecuperacionClaveFechaCambio]) VALUES (3, 1, N'127.0.0.1', CAST(N'2026-03-17T20:43:50.940' AS DateTime), N'7f91e8a4b648b0125b15dc5a3b6466f9f4906d92c72bea9bd6be92c853bebda2', N'luis.rangel@strategix.com.mx', N'RECAPTCHAV3', N'SE DIO DE BAJA POR PETICION NUEVA', N'18af46421b9ff47956997c2fb4d59043', CAST(N'2026-03-18T10:13:48.420' AS DateTime))
INSERT [dbo].[UsuariosRecuperacionClave] ([UsuarioRecuperacionClaveId], [UsuarioId], [UsuarioRecuperacionClaveIP], [UsuarioRecuperacionClaveFechaRegistro], [UsuarioRecuperacionClaveAnterior], [UsuarioRecuperacionClaveEmailTecleado], [UsuarioRecuperacionClaveCaptchaSession], [UsuarioRecuperacionClaveCaptchaTextBox], [UsuarioRecuperacionClaveSessionId], [UsuarioRecuperacionClaveFechaCambio]) VALUES (4, 1, N'127.0.0.1', CAST(N'2026-03-18T10:13:48.427' AS DateTime), N'7f91e8a4b648b0125b15dc5a3b6466f9f4906d92c72bea9bd6be92c853bebda2', N'luis.rangel@strategix.com.mx', N'RECAPTCHAV3', N'RECAPTCHAV3', N'1371b9a3864bfe7cd31ee99a1c807aeb', CAST(N'2026-03-18T10:51:37.990' AS DateTime))
SET IDENTITY_INSERT [dbo].[UsuariosRecuperacionClave] OFF
GO
SET IDENTITY_INSERT [dbo].[UsuariosRegistroAccesos] ON 

INSERT [dbo].[UsuariosRegistroAccesos] ([UsuarioRegistroAccesoId], [UsuarioId], [UsuarioRegistroAccesoIP], [UsuarioRegistroAccesoSistemaOperativo], [UsuarioRegistroAccesoFechaCreacion]) VALUES (1, 1, N'127.0.0.1', N'Windows 10', CAST(N'2026-03-11T12:47:54.173' AS DateTime))
INSERT [dbo].[UsuariosRegistroAccesos] ([UsuarioRegistroAccesoId], [UsuarioId], [UsuarioRegistroAccesoIP], [UsuarioRegistroAccesoSistemaOperativo], [UsuarioRegistroAccesoFechaCreacion]) VALUES (2, 1, N'127.0.0.1', N'Windows 10', CAST(N'2026-03-11T12:49:34.043' AS DateTime))
INSERT [dbo].[UsuariosRegistroAccesos] ([UsuarioRegistroAccesoId], [UsuarioId], [UsuarioRegistroAccesoIP], [UsuarioRegistroAccesoSistemaOperativo], [UsuarioRegistroAccesoFechaCreacion]) VALUES (3, 1, N'127.0.0.1', N'Windows 10', CAST(N'2026-03-11T13:06:14.860' AS DateTime))
INSERT [dbo].[UsuariosRegistroAccesos] ([UsuarioRegistroAccesoId], [UsuarioId], [UsuarioRegistroAccesoIP], [UsuarioRegistroAccesoSistemaOperativo], [UsuarioRegistroAccesoFechaCreacion]) VALUES (4, 1, N'127.0.0.1', N'Windows 10', CAST(N'2026-03-11T17:17:12.393' AS DateTime))
INSERT [dbo].[UsuariosRegistroAccesos] ([UsuarioRegistroAccesoId], [UsuarioId], [UsuarioRegistroAccesoIP], [UsuarioRegistroAccesoSistemaOperativo], [UsuarioRegistroAccesoFechaCreacion]) VALUES (5, 1, N'127.0.0.1', N'Windows 10', CAST(N'2026-03-11T17:42:47.383' AS DateTime))
INSERT [dbo].[UsuariosRegistroAccesos] ([UsuarioRegistroAccesoId], [UsuarioId], [UsuarioRegistroAccesoIP], [UsuarioRegistroAccesoSistemaOperativo], [UsuarioRegistroAccesoFechaCreacion]) VALUES (6, 1, N'127.0.0.1', N'Windows 10', CAST(N'2026-03-17T10:33:09.507' AS DateTime))
INSERT [dbo].[UsuariosRegistroAccesos] ([UsuarioRegistroAccesoId], [UsuarioId], [UsuarioRegistroAccesoIP], [UsuarioRegistroAccesoSistemaOperativo], [UsuarioRegistroAccesoFechaCreacion]) VALUES (7, 1, N'127.0.0.1', N'Windows 10', CAST(N'2026-03-17T10:38:21.410' AS DateTime))
INSERT [dbo].[UsuariosRegistroAccesos] ([UsuarioRegistroAccesoId], [UsuarioId], [UsuarioRegistroAccesoIP], [UsuarioRegistroAccesoSistemaOperativo], [UsuarioRegistroAccesoFechaCreacion]) VALUES (8, 1, N'127.0.0.1', N'Windows 10', CAST(N'2026-03-18T10:51:54.453' AS DateTime))
SET IDENTITY_INSERT [dbo].[UsuariosRegistroAccesos] OFF
GO
SET IDENTITY_INSERT [dbo].[UsuariosRegistroCookie] ON 

INSERT [dbo].[UsuariosRegistroCookie] ([UsuarioRegistroCookieId], [UsuarioId], [UsuarioRegistroCookieIP], [UsuarioRegistroCookieSistemaOperativo], [UsuarioRegistroCookieToken], [UsuarioRegistroCookieFechaAcepto], [UsuarioRegistroCookieFechaRegistro]) VALUES (1, 1, N'127.0.0.1', N'Windows 10', N'CDPBR20250401COOKIE', CAST(N'2026-03-11T12:47:54.000' AS DateTime), CAST(N'2026-03-11T12:47:54.187' AS DateTime))
SET IDENTITY_INSERT [dbo].[UsuariosRegistroCookie] OFF
GO
SET IDENTITY_INSERT [dbo].[UsuariosTiposRegistro] ON 

INSERT [dbo].[UsuariosTiposRegistro] ([UsuarioTipoRegistroId], [UsuarioTipoRegistroDescripcion]) VALUES (1, N'INTERNO')
INSERT [dbo].[UsuariosTiposRegistro] ([UsuarioTipoRegistroId], [UsuarioTipoRegistroDescripcion]) VALUES (2, N'EXTERNO')
SET IDENTITY_INSERT [dbo].[UsuariosTiposRegistro] OFF
GO
SET IDENTITY_INSERT [dbo].[VentasAuditoriasEnviosCorreosTipos] ON 

INSERT [dbo].[VentasAuditoriasEnviosCorreosTipos] ([VentaAuditoriaEnvioCorreoTipoId], [VentaAuditoriaEnvioCorreoTipoDescripcion]) VALUES (1, N'SIMPLES')
INSERT [dbo].[VentasAuditoriasEnviosCorreosTipos] ([VentaAuditoriaEnvioCorreoTipoId], [VentaAuditoriaEnvioCorreoTipoDescripcion]) VALUES (2, N'MÚLTIPLO')
SET IDENTITY_INSERT [dbo].[VentasAuditoriasEnviosCorreosTipos] OFF
GO
SET IDENTITY_INSERT [dbo].[VentasAuditoriasEstatus] ON 

INSERT [dbo].[VentasAuditoriasEstatus] ([VentaAuditoriaEstatusId], [VentaAuditoriaEstatusDescripcion]) VALUES (1, N'PENDENTE')
INSERT [dbo].[VentasAuditoriasEstatus] ([VentaAuditoriaEstatusId], [VentaAuditoriaEstatusDescripcion]) VALUES (2, N'APROVADO')
INSERT [dbo].[VentasAuditoriasEstatus] ([VentaAuditoriaEstatusId], [VentaAuditoriaEstatusDescripcion]) VALUES (3, N'RECUSADO')
SET IDENTITY_INSERT [dbo].[VentasAuditoriasEstatus] OFF
GO
SET IDENTITY_INSERT [dbo].[VentasAuditoriasEstatusOportunidades] ON 

INSERT [dbo].[VentasAuditoriasEstatusOportunidades] ([VentaAuditoriaEstatusOportunidadId], [VentaAuditoriaEstatusOportunidadDescripcion]) VALUES (1, N'PRIMEIRA CHANCE')
INSERT [dbo].[VentasAuditoriasEstatusOportunidades] ([VentaAuditoriaEstatusOportunidadId], [VentaAuditoriaEstatusOportunidadDescripcion]) VALUES (2, N'SEGUNDA CHANCE')
SET IDENTITY_INSERT [dbo].[VentasAuditoriasEstatusOportunidades] OFF
GO
SET IDENTITY_INSERT [dbo].[VentasAuditoriasObservaciones] ON 

INSERT [dbo].[VentasAuditoriasObservaciones] ([VentaAuditoriaObservacionId], [VentaAuditoriaObservacionDescripcion], [VentaAuditoriaObservacionFechaBaja], [VentaAuditoriaObservacionFechaAlta], [VentaAuditoriaObservacionIDCaptura]) VALUES (1, N'A data do ticket não pertence ao mês atual', NULL, CAST(N'2026-10-20T00:00:00.000' AS DateTime), 20)
INSERT [dbo].[VentasAuditoriasObservaciones] ([VentaAuditoriaObservacionId], [VentaAuditoriaObservacionDescripcion], [VentaAuditoriaObservacionFechaBaja], [VentaAuditoriaObservacionFechaAlta], [VentaAuditoriaObservacionIDCaptura]) VALUES (2, N'O bilhete não contém produtos Axalta', NULL, CAST(N'2026-10-20T00:00:00.000' AS DateTime), 20)
INSERT [dbo].[VentasAuditoriasObservaciones] ([VentaAuditoriaObservacionId], [VentaAuditoriaObservacionDescripcion], [VentaAuditoriaObservacionFechaBaja], [VentaAuditoriaObservacionFechaAlta], [VentaAuditoriaObservacionIDCaptura]) VALUES (3, N'A foto do ingresso está desfocada ou não é um ingresso', NULL, CAST(N'2026-10-20T00:00:00.000' AS DateTime), 20)
INSERT [dbo].[VentasAuditoriasObservaciones] ([VentaAuditoriaObservacionId], [VentaAuditoriaObservacionDescripcion], [VentaAuditoriaObservacionFechaBaja], [VentaAuditoriaObservacionFechaAlta], [VentaAuditoriaObservacionIDCaptura]) VALUES (4, N'Não contém número do bilhete', NULL, CAST(N'2026-10-20T00:00:00.000' AS DateTime), 20)
INSERT [dbo].[VentasAuditoriasObservaciones] ([VentaAuditoriaObservacionId], [VentaAuditoriaObservacionDescripcion], [VentaAuditoriaObservacionFechaBaja], [VentaAuditoriaObservacionFechaAlta], [VentaAuditoriaObservacionIDCaptura]) VALUES (5, N'Não contém valor do ingresso', NULL, CAST(N'2026-02-07T12:42:21.000' AS DateTime), 12427)
INSERT [dbo].[VentasAuditoriasObservaciones] ([VentaAuditoriaObservacionId], [VentaAuditoriaObservacionDescripcion], [VentaAuditoriaObservacionFechaBaja], [VentaAuditoriaObservacionFechaAlta], [VentaAuditoriaObservacionIDCaptura]) VALUES (6, N'Fatura duplicada', NULL, CAST(N'2026-02-07T12:43:03.000' AS DateTime), 12427)
INSERT [dbo].[VentasAuditoriasObservaciones] ([VentaAuditoriaObservacionId], [VentaAuditoriaObservacionDescripcion], [VentaAuditoriaObservacionFechaBaja], [VentaAuditoriaObservacionFechaAlta], [VentaAuditoriaObservacionIDCaptura]) VALUES (7, N'O ingresso não contém data', NULL, CAST(N'2026-02-07T12:43:03.000' AS DateTime), 12427)
INSERT [dbo].[VentasAuditoriasObservaciones] ([VentaAuditoriaObservacionId], [VentaAuditoriaObservacionDescripcion], [VentaAuditoriaObservacionFechaBaja], [VentaAuditoriaObservacionFechaAlta], [VentaAuditoriaObservacionIDCaptura]) VALUES (8, N'O número do bilhete registrado não corresponde ao bilhete carregado', NULL, CAST(N'2026-02-07T12:43:03.000' AS DateTime), 12427)
SET IDENTITY_INSERT [dbo].[VentasAuditoriasObservaciones] OFF
GO
SET IDENTITY_INSERT [dbo].[VentasAuditoriasTipos] ON 

INSERT [dbo].[VentasAuditoriasTipos] ([VentaAuditoriaTipoId], [VentaAuditoriaTipoDescripcion]) VALUES (1, N'VALOR REPETIDO')
INSERT [dbo].[VentasAuditoriasTipos] ([VentaAuditoriaTipoId], [VentaAuditoriaTipoDescripcion]) VALUES (2, N'VALOR MÁXIMO 10.000')
INSERT [dbo].[VentasAuditoriasTipos] ([VentaAuditoriaTipoId], [VentaAuditoriaTipoDescripcion]) VALUES (3, N'ALEATÓRIO')
INSERT [dbo].[VentasAuditoriasTipos] ([VentaAuditoriaTipoId], [VentaAuditoriaTipoDescripcion]) VALUES (4, N'APROVADO AUTOMATICAMENTE')
INSERT [dbo].[VentasAuditoriasTipos] ([VentaAuditoriaTipoId], [VentaAuditoriaTipoDescripcion]) VALUES (5, N'ENTRE NA AUDITORIA')
SET IDENTITY_INSERT [dbo].[VentasAuditoriasTipos] OFF
GO
/****** Object:  Index [IX_Cargas_CargaTipoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Cargas_CargaTipoId] ON [dbo].[Cargas]
(
	[CargaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CargasMultimedias_ModuloId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CargasMultimedias_ModuloId] ON [dbo].[CargasMultimedias]
(
	[CargaMultimediaModuloId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CargasMultimedias_VideoTipoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CargasMultimedias_VideoTipoId] ON [dbo].[CargasMultimedias]
(
	[CargaMultimediaVideoTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CargasMultimediasPerfiles_MediaId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CargasMultimediasPerfiles_MediaId] ON [dbo].[CargasMultimediasPerfiles]
(
	[CargaMultimediaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CargasMultimediasPerfiles_PerfilId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CargasMultimediasPerfiles_PerfilId] ON [dbo].[CargasMultimediasPerfiles]
(
	[PerfilId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Cortes_CorteTipoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Cortes_CorteTipoId] ON [dbo].[Cortes]
(
	[CorteTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesBimestralDist_CorteId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesBimestralDist_CorteId] ON [dbo].[CortesBimestralesDistribuidores]
(
	[CorteId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesBimestralMP_CorteId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesBimestralMP_CorteId] ON [dbo].[CortesBimestralesMaestrosPintores]
(
	[CorteId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesBimestralPerf_CorteId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesBimestralPerf_CorteId] ON [dbo].[CortesBimestralesPerfiles]
(
	[CorteId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesBimestralesVentas_CorteId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesBimestralesVentas_CorteId] ON [dbo].[CortesBimestralesVentas]
(
	[CorteId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [IX_CortesBimestralesVentas_DistribuidorId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesBimestralesVentas_DistribuidorId] ON [dbo].[CortesBimestralesVentas]
(
	[CorteBimestralVentaDistribuidorId] ASC,
	[CorteBimestralVentaMes] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesBimestralesVentas_UsuarioIdMP]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesBimestralesVentas_UsuarioIdMP] ON [dbo].[CortesBimestralesVentas]
(
	[CorteBimestralVentaUsuarioIdMP] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesGanadores_CorteId_DistribuidorId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesGanadores_CorteId_DistribuidorId] ON [dbo].[CortesGanadores]
(
	[CorteId] ASC,
	[DistribuidorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesGanadores_RecompensaTipoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesGanadores_RecompensaTipoId] ON [dbo].[CortesGanadores]
(
	[RecompensaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesGanadores_TarjetaId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesGanadores_TarjetaId] ON [dbo].[CortesGanadores]
(
	[TarjetaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_CortesGanadores_UsuarioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_CortesGanadores_UsuarioId] ON [dbo].[CortesGanadores]
(
	[UsuarioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_DistribuidoresActivasRE_DistribuidorId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_DistribuidoresActivasRE_DistribuidorId] ON [dbo].[DistribuidoresActivasRE]
(
	[DistribuidorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_LogRegistros_Fecha]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_LogRegistros_Fecha] ON [dbo].[LogRegistros]
(
	[LogRegistroFechaCreacion] DESC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_LogRegistros_PaginaAccesadaId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_LogRegistros_PaginaAccesadaId] ON [dbo].[LogRegistros]
(
	[PaginaAccesadaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_LogRegistros_UsuarioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_LogRegistros_UsuarioId] ON [dbo].[LogRegistros]
(
	[UsuarioId] ASC
)
INCLUDE([LogRegistroFechaCreacion],[PaginaAccesadaId]) 
WHERE ([UsuarioId] IS NOT NULL)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Recompensas_RecompensaTipoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Recompensas_RecompensaTipoId] ON [dbo].[Recompensas]
(
	[RecompensaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposFotos_Dist_Anio_Mes]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposFotos_Dist_Anio_Mes] ON [dbo].[ReposicionesProductosFotos]
(
	[DistribuidorId] ASC,
	[ReposicionProductoFotoAnio] ASC,
	[ReposicionProductoFotoMes] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposFotos_FotoTipoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposFotos_FotoTipoId] ON [dbo].[ReposicionesProductosFotos]
(
	[ReposicionProductoFotoTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposGanadores_Dist_Anio_Mes]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposGanadores_Dist_Anio_Mes] ON [dbo].[ReposicionesProductosGanadores]
(
	[DistribuidorId] ASC,
	[ReposicionProductoGanadorAnio] ASC,
	[ReposicionProductoGanadorMes] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposGanadores_RecompensaTipoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposGanadores_RecompensaTipoId] ON [dbo].[ReposicionesProductosGanadores]
(
	[RecompensaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposGanadores_TarjetaId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposGanadores_TarjetaId] ON [dbo].[ReposicionesProductosGanadores]
(
	[TarjetaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposGanadores_UsuarioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposGanadores_UsuarioId] ON [dbo].[ReposicionesProductosGanadores]
(
	[UsuarioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposPremios_ProductoDivisionId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposPremios_ProductoDivisionId] ON [dbo].[ReposicionesProductosPremios]
(
	[ProductoDivisionId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposPremProdRel_PremioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposPremProdRel_PremioId] ON [dbo].[ReposicionesProductosPremiosProductosRelaciones]
(
	[ReposicionProductoPremioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_ReposPremProdRel_ProductoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_ReposPremProdRel_ProductoId] ON [dbo].[ReposicionesProductosPremiosProductosRelaciones]
(
	[ReposicionProductoPremioProductoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Tarjetas_DistribuidorId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Tarjetas_DistribuidorId] ON [dbo].[Tarjetas]
(
	[DistribuidorId] ASC
)
WHERE ([DistribuidorId] IS NOT NULL)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Tarjetas_TarjetaEstatusId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Tarjetas_TarjetaEstatusId] ON [dbo].[Tarjetas]
(
	[TarjetaEstatusId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Tarjetas_UsuarioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Tarjetas_UsuarioId] ON [dbo].[Tarjetas]
(
	[UsuarioId] ASC
)
INCLUDE([TarjetaEstatusId],[DistribuidorId]) 
WHERE ([UsuarioId] IS NOT NULL)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UIX_Tarjetas_Numero]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE UNIQUE NONCLUSTERED INDEX [UIX_Tarjetas_Numero] ON [dbo].[Tarjetas]
(
	[TarjetaNumero] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_TarjetasFolios_TarjetaId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_TarjetasFolios_TarjetaId] ON [dbo].[TarjetasFolios]
(
	[TarjetaId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Usuarios_PerfilId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Usuarios_PerfilId] ON [dbo].[Usuarios]
(
	[PerfilId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Usuarios_TipoRegistroId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Usuarios_TipoRegistroId] ON [dbo].[Usuarios]
(
	[UsuarioTipoRegistroId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_UsuariosDetalles_CompaniaId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_UsuariosDetalles_CompaniaId] ON [dbo].[UsuariosDetalles]
(
	[UsuarioDetalleCompaniaCelularId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [IX_UsuariosDetalles_Email]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_UsuariosDetalles_Email] ON [dbo].[UsuariosDetalles]
(
	[UsuarioDetalleEmail] ASC
)
WHERE ([UsuarioDetalleFechaBaja] IS NULL)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_UsuariosDetalles_UsuarioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_UsuariosDetalles_UsuarioId] ON [dbo].[UsuariosDetalles]
(
	[UsuarioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_UsuariosDistribuidores_DistribuidorId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_UsuariosDistribuidores_DistribuidorId] ON [dbo].[UsuariosDistribuidores]
(
	[DistribuidorId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_UsuariosDistribuidores_UsuarioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_UsuariosDistribuidores_UsuarioId] ON [dbo].[UsuariosDistribuidores]
(
	[UsuarioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_UsuariosRecuperacionClave_UsuarioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_UsuariosRecuperacionClave_UsuarioId] ON [dbo].[UsuariosRecuperacionClave]
(
	[UsuarioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_UsuariosRegistroAccesos_UsuarioId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_UsuariosRegistroAccesos_UsuarioId] ON [dbo].[UsuariosRegistroAccesos]
(
	[UsuarioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Ventas_DistribuidorId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Ventas_DistribuidorId] ON [dbo].[Ventas]
(
	[DistribuidorId] ASC
)
INCLUDE([VentaFechaRegistro],[VentaMontoTicket],[TarjetaId]) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Ventas_FechaRegistro]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Ventas_FechaRegistro] ON [dbo].[Ventas]
(
	[VentaFechaRegistro] ASC
)
INCLUDE([TarjetaId],[DistribuidorId],[VentaMontoTicket]) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Ventas_TarjetaId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Ventas_TarjetaId] ON [dbo].[Ventas]
(
	[TarjetaId] ASC
)
INCLUDE([VentaFechaRegistro],[VentaMontoTicket],[DistribuidorId]) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_Ventas_UsuarioIdMP]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_Ventas_UsuarioIdMP] ON [dbo].[Ventas]
(
	[VentaUsuarioIdMP] ASC
)
WHERE ([VentaUsuarioIdMP] IS NOT NULL)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_VentasAuditorias_CorteId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_VentasAuditorias_CorteId] ON [dbo].[VentasAuditorias]
(
	[CorteId] ASC
)
WHERE ([CorteId] IS NOT NULL)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_VentasAuditorias_EstatusId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_VentasAuditorias_EstatusId] ON [dbo].[VentasAuditorias]
(
	[VentaAuditoriaEstatusId] ASC
)
INCLUDE([VentaId],[VentaAuditoriaFechaRegistro]) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_VentasAuditorias_EstatusOportunidadId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_VentasAuditorias_EstatusOportunidadId] ON [dbo].[VentasAuditorias]
(
	[VentaAuditoriaEstatusOportunidadId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_VentasAuditorias_TipoId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_VentasAuditorias_TipoId] ON [dbo].[VentasAuditorias]
(
	[VentaAuditoriaTipoId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_VentasAuditorias_VentaId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_VentasAuditorias_VentaId] ON [dbo].[VentasAuditorias]
(
	[VentaId] ASC
)
INCLUDE([VentaAuditoriaEstatusId],[VentaAuditoriaFechaRegistro],[CorteId]) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [IX_VentasUsuariosPromo_PromoDetalleId]    Script Date: 18/03/2026 12:57:10 p. m. ******/
CREATE NONCLUSTERED INDEX [IX_VentasUsuariosPromo_PromoDetalleId] ON [dbo].[VentasUsuariosPromociones]
(
	[VentaPromocionDetalleId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Cargas] ADD  CONSTRAINT [DF_Cargas_CargaFechaRegistro]  DEFAULT (getdate()) FOR [CargaFechaRegistro]
GO
ALTER TABLE [dbo].[CargasMultimedias] ADD  DEFAULT (getdate()) FOR [CargaMultimediaFechaRegistro]
GO
ALTER TABLE [dbo].[CargasMultimedias] ADD  DEFAULT ((0)) FOR [CargaMultimediaDownload]
GO
ALTER TABLE [dbo].[CargasPremiosProductos] ADD  CONSTRAINT [DF_CargasPremiosProductos_CargaPremioProductoFechaRegistro]  DEFAULT (getdate()) FOR [CargaPremioProductoFechaRegistro]
GO
ALTER TABLE [dbo].[CargasRecompensas] ADD  CONSTRAINT [DF_CargasRecompensas_CargaRecompensaFechaRegistro]  DEFAULT (getdate()) FOR [CargaRecompensaFechaRegistro]
GO
ALTER TABLE [dbo].[CargasTipos] ADD  CONSTRAINT [DF_CargasTipos_CargaTipoFechaRegistro]  DEFAULT (getdate()) FOR [CargaTipoFechaRegistro]
GO
ALTER TABLE [dbo].[CargasVentasPromocionesDetalles] ADD  CONSTRAINT [DF_CargasVentasPromocionesDetalles_CargasVentasPromocionesDetallesFechaAlta]  DEFAULT (getdate()) FOR [CargaVentaPromocionDetalleFechaAlta]
GO
ALTER TABLE [dbo].[Cortes] ADD  CONSTRAINT [DF_Cortes_CorteFechaRegistro]  DEFAULT (getdate()) FOR [CorteFechaRegistro]
GO
ALTER TABLE [dbo].[CortesBimestralesDistribuidores] ADD  CONSTRAINT [DF_CortesBimestralDistribuidores_CorteBimestralDistribuidorFechaRegistroCorte]  DEFAULT (getdate()) FOR [CorteBimestralDistribuidorFechaRegistroCorte]
GO
ALTER TABLE [dbo].[CortesBimestralesMaestrosPintores] ADD  CONSTRAINT [DF_CortesBimestralMaestrosPintores_CorteBimestralMaestroPintorFechaRegistroCorte]  DEFAULT (getdate()) FOR [CorteBimestralMaestroPintorFechaRegistroCorte]
GO
ALTER TABLE [dbo].[CortesBimestralesPerfiles] ADD  CONSTRAINT [DF_CortesBimestralesPerfiles_CortesBimestralPerfilDistribuidorFechaRegistroCorte]  DEFAULT (getdate()) FOR [CortesBimestralPerfilDistribuidorFechaRegistroCorte]
GO
ALTER TABLE [dbo].[CortesBimestralesVentas] ADD  CONSTRAINT [DF_CortesBimestralVentas_CorteBimestralVentaFechaCorte]  DEFAULT (getdate()) FOR [CorteBimestralVentaFechaCorte]
GO
ALTER TABLE [dbo].[CortesCambioEstatusVentasAuditoria] ADD  CONSTRAINT [DF_CortesCambioEstatusVentasAuditoria_CortesCambioEstatusVentaAuditoriaUsuarioFechaRegistro]  DEFAULT (getdate()) FOR [CortesCambioEstatusVentaAuditoriaUsuarioFechaRegistro]
GO
ALTER TABLE [dbo].[CortesGanadores] ADD  CONSTRAINT [DF_CortesGanadores_CorteGanadorFechaRegistro]  DEFAULT (getdate()) FOR [CorteGanadorFechaRegistro]
GO
ALTER TABLE [dbo].[Distribuidores] ADD  CONSTRAINT [DF_Distribuidores_DistribuidorFechaAlta]  DEFAULT (getdate()) FOR [DistribuidorFechaAlta]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__5DCAEF64]  DEFAULT (NULL) FOR [DistribuidorDetalleNombreComercial]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__5EBF139D]  DEFAULT (NULL) FOR [DistribuidorDetalleCP]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__5FB337D6]  DEFAULT (NULL) FOR [DistribuidorDetalleEstado]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__60A75C0F]  DEFAULT (NULL) FOR [DistribuidorDetalleCiudad]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__619B8048]  DEFAULT (NULL) FOR [DistribuidorDetalleMunicipio]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__628FA481]  DEFAULT (NULL) FOR [DistribuidorDetalleColonia]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__6383C8BA]  DEFAULT (NULL) FOR [DistribuidorDetalleCalle]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__6477ECF3]  DEFAULT (NULL) FOR [DistribuidorDetalleNumeroExterior]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__656C112C]  DEFAULT (NULL) FOR [DistribuidorDetalleNumeroInterior]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__6754599E]  DEFAULT (NULL) FOR [DistribuidorDetalleTelefono]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__6EF57B66]  DEFAULT (NULL) FOR [DistribuidorDetalleLatitud]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF__Distribui__Distr__6FE99F9F]  DEFAULT (NULL) FOR [DistribuidorDetalleLongitud]
GO
ALTER TABLE [dbo].[DistribuidoresDetalles] ADD  CONSTRAINT [DF_DistribuidoresDetalles_DistribuidorDetalleFechaAlta]  DEFAULT (getdate()) FOR [DistribuidorDetalleFechaAlta]
GO
ALTER TABLE [dbo].[LogRegistros] ADD  CONSTRAINT [DF_LogRegistros_Fecha]  DEFAULT (getdate()) FOR [LogRegistroFechaCreacion]
GO
ALTER TABLE [dbo].[Recompensas] ADD  CONSTRAINT [DF_Recompensas_RecompensaFechaRegistro]  DEFAULT (getdate()) FOR [RecompensaFechaRegistro]
GO
ALTER TABLE [dbo].[Recompensas] ADD  CONSTRAINT [DF__Recompens__Recom__1C873BEC]  DEFAULT (NULL) FOR [RecompensaTipoId]
GO
ALTER TABLE [dbo].[RecompensasTipos] ADD  CONSTRAINT [DF__Recompens__Recom__1A9EF37A]  DEFAULT (NULL) FOR [RecompensaTipoDescripcion]
GO
ALTER TABLE [dbo].[ReposicionesProductosFotos] ADD  CONSTRAINT [DF_ReposicionesProductosFotos_ReposicionProductoFotoFechaRegistro]  DEFAULT (getdate()) FOR [ReposicionProductoFotoFechaRegistro]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__3CF40B7E]  DEFAULT (NULL) FOR [ReposicionProductoGanadorAnio]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__3DE82FB7]  DEFAULT (NULL) FOR [ReposicionProductoGanadorMes]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__3EDC53F0]  DEFAULT (NULL) FOR [ReposicionProductoGanadorPremioLugar]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF_ReposicionesProductosGanadores_ReposicionProductoGanadorFechaRegistro]  DEFAULT (getdate()) FOR [ReposicionProductoGanadorFechaRegistro]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__3FD07829]  DEFAULT (NULL) FOR [ReposicionProductoGanadorUsuarioIdRegistro]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__40C49C62]  DEFAULT (NULL) FOR [ReposicionProductoGanadorFechaEntregaTienda]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__41B8C09B]  DEFAULT (NULL) FOR [ReposicionProductoGanadorUsuarioIdEntregaTienda]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__42ACE4D4]  DEFAULT (NULL) FOR [ReposicionProductoGanadorTotalProductoPremio]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__43A1090D]  DEFAULT (NULL) FOR [ReposicionProductoGanadorTotalSumaVentas]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__44952D46]  DEFAULT (NULL) FOR [ReposicionProductoGanadorTotalCuentaVentas]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Repos__467D75B8]  DEFAULT (NULL) FOR [ReposicionProductoPremioProductoId]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Distr__477199F1]  DEFAULT (NULL) FOR [DistribuidorId]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] ADD  CONSTRAINT [DF__Reposicio__Recom__4865BE2A]  DEFAULT (NULL) FOR [RecompensaTipoId]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremios] ADD  CONSTRAINT [DF_ReposicionesProductosPremios_ReposicionProductoPremioFechaRegistro]  DEFAULT (getdate()) FOR [ReposicionProductoPremioFechaRegistro]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremios] ADD  CONSTRAINT [DF__Reposicio__Produ__251C81ED]  DEFAULT (NULL) FOR [ProductoDivisionId]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductos] ADD  CONSTRAINT [DF__Reposicio__Repos__2AD55B43]  DEFAULT (NULL) FOR [ReposicionProductoPremioProductoDescripcion]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductos] ADD  CONSTRAINT [DF__Reposicio__Repos__2BC97F7C]  DEFAULT (NULL) FOR [ReposicionProductoPremioProductoGMS]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductos] ADD  CONSTRAINT [DF__Reposicio__Repos__2CBDA3B5]  DEFAULT (NULL) FOR [ReposicionProductoPremioProductoCodigo]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductos] ADD  CONSTRAINT [DF__Reposicio__Repos__2DB1C7EE]  DEFAULT (NULL) FOR [ReposicionProductoPremioProductoPresentacion]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductos] ADD  CONSTRAINT [DF__Reposicio__Repos__2EA5EC27]  DEFAULT (NULL) FOR [ReposicionProductoPremioProductoPrecio]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductos] ADD  CONSTRAINT [DF_ReposicionProductoPremioProducto_ReposicionProductoPremioProductoFechaRegistro]  DEFAULT (getdate()) FOR [ReposicionProductoPremioProductoFechaRegistro]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductosRelaciones] ADD  CONSTRAINT [DF_ReposicionesProductosPremiosProductosRelaciones_ReposicionProductoPremioProductoRelacionFechaRegistro]  DEFAULT (getdate()) FOR [ReposicionProductoPremioProductoRelacionFechaRegistro]
GO
ALTER TABLE [dbo].[Tarjetas] ADD  CONSTRAINT [DF__Tarjetas__Tarjet__628FA481]  DEFAULT (NULL) FOR [TarjetaNumero]
GO
ALTER TABLE [dbo].[Tarjetas] ADD  CONSTRAINT [DF__Tarjetas__Distri__6383C8BA]  DEFAULT (NULL) FOR [DistribuidorId]
GO
ALTER TABLE [dbo].[Tarjetas] ADD  CONSTRAINT [DF__Tarjetas__Usuari__6477ECF3]  DEFAULT (NULL) FOR [UsuarioId]
GO
ALTER TABLE [dbo].[Tarjetas] ADD  CONSTRAINT [DF__Tarjetas__Tarjet__656C112C]  DEFAULT (NULL) FOR [TarjetaEstatusId]
GO
ALTER TABLE [dbo].[Tarjetas] ADD  CONSTRAINT [DF_Tarjetas_TarjetaFechaRegistro]  DEFAULT (getdate()) FOR [TarjetaFechaRegistro]
GO
ALTER TABLE [dbo].[Tarjetas] ADD  CONSTRAINT [DF__Tarjetas__Tarjet__66603565]  DEFAULT (NULL) FOR [TarjetaUsuarioIdCaptura]
GO
ALTER TABLE [dbo].[Tarjetas] ADD  CONSTRAINT [DF__Tarjetas__Tarjet__6754599E]  DEFAULT (NULL) FOR [TarjetaFechaBaja]
GO
ALTER TABLE [dbo].[Tarjetas] ADD  CONSTRAINT [DF__Tarjetas__Tarjet__68487DD7]  DEFAULT (NULL) FOR [TarjetaUsuarioIdBaja]
GO
ALTER TABLE [dbo].[TarjetasFolios] ADD  CONSTRAINT [DF_TarjetasFolios_TarjetaFolioFechaRegistro]  DEFAULT (getdate()) FOR [TarjetaFolioFechaRegistro]
GO
ALTER TABLE [dbo].[Usuarios] ADD  CONSTRAINT [DF_usuarios_UsuarioFechaRegistro]  DEFAULT (getdate()) FOR [UsuarioFechaRegistro]
GO
ALTER TABLE [dbo].[UsuariosDetalles] ADD  CONSTRAINT [UsuarioDetalleFechaRegistro]  DEFAULT (getdate()) FOR [UsuarioDetalleFechaRegistro]
GO
ALTER TABLE [dbo].[UsuariosRecuperacionClave] ADD  CONSTRAINT [DF_UsuariosRecuperacionClave_UsuarioRecuperacionFechaRegistro]  DEFAULT (getdate()) FOR [UsuarioRecuperacionClaveFechaRegistro]
GO
ALTER TABLE [dbo].[UsuariosRegistroAccesos] ADD  CONSTRAINT [DF_logregistros_LogRegistroFechaCreacion]  DEFAULT (getdate()) FOR [UsuarioRegistroAccesoFechaCreacion]
GO
ALTER TABLE [dbo].[UsuariosRegistroCookie] ADD  CONSTRAINT [DF_UsuariosRegistroCookie_UsuariosRegistroCookieFechaRegistro]  DEFAULT (getdate()) FOR [UsuarioRegistroCookieFechaRegistro]
GO
ALTER TABLE [dbo].[Ventas] ADD  CONSTRAINT [DF_Ventas_VentaFechaRegistro]  DEFAULT (getdate()) FOR [VentaFechaRegistro]
GO
ALTER TABLE [dbo].[VentasAuditorias] ADD  CONSTRAINT [DF_VentasAuditorias_VentaAuditoriaFechaRegistro]  DEFAULT (getdate()) FOR [VentaAuditoriaFechaRegistro]
GO
ALTER TABLE [dbo].[VentasHistoricosRechazos] ADD  CONSTRAINT [DF_VentasHistoricosRechazos_VentaHistoricoRechazoFechaRegistro]  DEFAULT (getdate()) FOR [VentaHistoricoRechazoFechaRegistro]
GO
ALTER TABLE [dbo].[VentasPromociones] ADD  CONSTRAINT [DF_VentasPromociones_VentaPromocionFechaRegistro]  DEFAULT (getdate()) FOR [VentaPromocionFechaRegistro]
GO
ALTER TABLE [dbo].[VentasPromocionesDetalles] ADD  CONSTRAINT [DF__VentasPro__Venta__6166761E]  DEFAULT (NULL) FOR [VentaPromocionId]
GO
ALTER TABLE [dbo].[VentasPromocionesDetalles] ADD  CONSTRAINT [DF__VentasPro__Venta__625A9A57]  DEFAULT (NULL) FOR [VentaPromocionDetalleGMC]
GO
ALTER TABLE [dbo].[VentasPromocionesDetalles] ADD  CONSTRAINT [DF__VentasPro__Venta__634EBE90]  DEFAULT (NULL) FOR [VentaPromocionDetalleCodigo]
GO
ALTER TABLE [dbo].[VentasPromocionesDetalles] ADD  CONSTRAINT [DF__VentasPro__Venta__6442E2C9]  DEFAULT (NULL) FOR [VentaPromocionDetalleDescripcion]
GO
ALTER TABLE [dbo].[VentasPromocionesDetalles] ADD  CONSTRAINT [DF__VentasPro__Venta__65370702]  DEFAULT (NULL) FOR [VentaPromocionDetallePresentacion]
GO
ALTER TABLE [dbo].[VentasPromocionesDetalles] ADD  CONSTRAINT [DF_VentasPromocionesDetalles_VentasPromocionesDetallesFechaAlta]  DEFAULT (getdate()) FOR [VentaPromocionDetalleFechaAlta]
GO
ALTER TABLE [dbo].[VentasUsuariosPromociones] ADD  CONSTRAINT [DF_VentasUsuariosPromociones_VentaUsuarioPromocionFechaRegistro]  DEFAULT (getdate()) FOR [VentaUsuarioPromocionFechaRegistro]
GO
ALTER TABLE [dbo].[Cargas]  WITH CHECK ADD  CONSTRAINT [FK_Cargas_CargasTipos] FOREIGN KEY([CargaTipoId])
REFERENCES [dbo].[CargasTipos] ([CargaTipoId])
GO
ALTER TABLE [dbo].[Cargas] CHECK CONSTRAINT [FK_Cargas_CargasTipos]
GO
ALTER TABLE [dbo].[CargasMultimedias]  WITH CHECK ADD  CONSTRAINT [FK_CargasMultimedias_Modulos] FOREIGN KEY([CargaMultimediaModuloId])
REFERENCES [dbo].[CargasMultimediasModulos] ([CargaMultimediaModuloId])
GO
ALTER TABLE [dbo].[CargasMultimedias] CHECK CONSTRAINT [FK_CargasMultimedias_Modulos]
GO
ALTER TABLE [dbo].[CargasMultimedias]  WITH CHECK ADD  CONSTRAINT [FK_CargasMultimedias_VideosTipos] FOREIGN KEY([CargaMultimediaVideoTipoId])
REFERENCES [dbo].[CargasMultimediasVideosTipos] ([CargaMultimediaVideoTipoId])
GO
ALTER TABLE [dbo].[CargasMultimedias] CHECK CONSTRAINT [FK_CargasMultimedias_VideosTipos]
GO
ALTER TABLE [dbo].[CargasMultimediasPerfiles]  WITH CHECK ADD  CONSTRAINT [FK_CargasMultimediasPerfiles_Multimedias] FOREIGN KEY([CargaMultimediaId])
REFERENCES [dbo].[CargasMultimedias] ([CargaMultimediaId])
GO
ALTER TABLE [dbo].[CargasMultimediasPerfiles] CHECK CONSTRAINT [FK_CargasMultimediasPerfiles_Multimedias]
GO
ALTER TABLE [dbo].[CargasMultimediasPerfiles]  WITH CHECK ADD  CONSTRAINT [FK_CargasMultimediasPerfiles_Perfiles] FOREIGN KEY([PerfilId])
REFERENCES [dbo].[Perfiles] ([PerfilId])
GO
ALTER TABLE [dbo].[CargasMultimediasPerfiles] CHECK CONSTRAINT [FK_CargasMultimediasPerfiles_Perfiles]
GO
ALTER TABLE [dbo].[Cortes]  WITH CHECK ADD  CONSTRAINT [FK_Cortes_CortesTipos] FOREIGN KEY([CorteTipoId])
REFERENCES [dbo].[CortesTipos] ([CorteTipoId])
GO
ALTER TABLE [dbo].[Cortes] CHECK CONSTRAINT [FK_Cortes_CortesTipos]
GO
ALTER TABLE [dbo].[CortesBimestralesDistribuidores]  WITH CHECK ADD  CONSTRAINT [FK_CortesBimestralesDistribuidores_Cortes] FOREIGN KEY([CorteId])
REFERENCES [dbo].[Cortes] ([CorteId])
GO
ALTER TABLE [dbo].[CortesBimestralesDistribuidores] CHECK CONSTRAINT [FK_CortesBimestralesDistribuidores_Cortes]
GO
ALTER TABLE [dbo].[CortesBimestralesMaestrosPintores]  WITH CHECK ADD  CONSTRAINT [FK_CortesBimestralesMaestrosPintores_Cortes] FOREIGN KEY([CorteId])
REFERENCES [dbo].[Cortes] ([CorteId])
GO
ALTER TABLE [dbo].[CortesBimestralesMaestrosPintores] CHECK CONSTRAINT [FK_CortesBimestralesMaestrosPintores_Cortes]
GO
ALTER TABLE [dbo].[CortesBimestralesPerfiles]  WITH CHECK ADD  CONSTRAINT [FK_CortesBimestralesPerfiles_Cortes] FOREIGN KEY([CorteId])
REFERENCES [dbo].[Cortes] ([CorteId])
GO
ALTER TABLE [dbo].[CortesBimestralesPerfiles] CHECK CONSTRAINT [FK_CortesBimestralesPerfiles_Cortes]
GO
ALTER TABLE [dbo].[CortesBimestralesVentas]  WITH CHECK ADD  CONSTRAINT [FK_CortesBimestralesVentas_Cortes] FOREIGN KEY([CorteId])
REFERENCES [dbo].[Cortes] ([CorteId])
GO
ALTER TABLE [dbo].[CortesBimestralesVentas] CHECK CONSTRAINT [FK_CortesBimestralesVentas_Cortes]
GO
ALTER TABLE [dbo].[CortesGanadores]  WITH CHECK ADD  CONSTRAINT [FK_CortesGanadores_Cortes] FOREIGN KEY([CorteId])
REFERENCES [dbo].[Cortes] ([CorteId])
GO
ALTER TABLE [dbo].[CortesGanadores] CHECK CONSTRAINT [FK_CortesGanadores_Cortes]
GO
ALTER TABLE [dbo].[CortesGanadores]  WITH CHECK ADD  CONSTRAINT [FK_CortesGanadores_RecompensasTipos] FOREIGN KEY([RecompensaTipoId])
REFERENCES [dbo].[RecompensasTipos] ([RecompensaTipoId])
GO
ALTER TABLE [dbo].[CortesGanadores] CHECK CONSTRAINT [FK_CortesGanadores_RecompensasTipos]
GO
ALTER TABLE [dbo].[CortesGanadores]  WITH CHECK ADD  CONSTRAINT [FK_CortesGanadores_Tarjetas] FOREIGN KEY([TarjetaId])
REFERENCES [dbo].[Tarjetas] ([TarjetaId])
GO
ALTER TABLE [dbo].[CortesGanadores] CHECK CONSTRAINT [FK_CortesGanadores_Tarjetas]
GO
ALTER TABLE [dbo].[CortesGanadores]  WITH CHECK ADD  CONSTRAINT [FK_CortesGanadores_Usuarios] FOREIGN KEY([UsuarioId])
REFERENCES [dbo].[Usuarios] ([UsuarioId])
GO
ALTER TABLE [dbo].[CortesGanadores] CHECK CONSTRAINT [FK_CortesGanadores_Usuarios]
GO
ALTER TABLE [dbo].[DistribuidoresActivasRE]  WITH CHECK ADD  CONSTRAINT [FK_DistribuidoresActivasRE_Distribuidores] FOREIGN KEY([DistribuidorId])
REFERENCES [dbo].[Distribuidores] ([DistribuidorId])
GO
ALTER TABLE [dbo].[DistribuidoresActivasRE] CHECK CONSTRAINT [FK_DistribuidoresActivasRE_Distribuidores]
GO
ALTER TABLE [dbo].[LogRegistros]  WITH CHECK ADD  CONSTRAINT [FK_LogRegistros_PaginaAccesadas] FOREIGN KEY([PaginaAccesadaId])
REFERENCES [dbo].[PaginaAccesadas] ([PaginaAccesadaId])
GO
ALTER TABLE [dbo].[LogRegistros] CHECK CONSTRAINT [FK_LogRegistros_PaginaAccesadas]
GO
ALTER TABLE [dbo].[Recompensas]  WITH CHECK ADD  CONSTRAINT [FK_Recompensas_RecompensasTipos] FOREIGN KEY([RecompensaTipoId])
REFERENCES [dbo].[RecompensasTipos] ([RecompensaTipoId])
GO
ALTER TABLE [dbo].[Recompensas] CHECK CONSTRAINT [FK_Recompensas_RecompensasTipos]
GO
ALTER TABLE [dbo].[ReposicionesProductosFotos]  WITH CHECK ADD  CONSTRAINT [FK_ReposicionesProductosFotos_Distribuidores] FOREIGN KEY([DistribuidorId])
REFERENCES [dbo].[Distribuidores] ([DistribuidorId])
GO
ALTER TABLE [dbo].[ReposicionesProductosFotos] CHECK CONSTRAINT [FK_ReposicionesProductosFotos_Distribuidores]
GO
ALTER TABLE [dbo].[ReposicionesProductosFotos]  WITH CHECK ADD  CONSTRAINT [FK_ReposicionesProductosFotos_Tipos] FOREIGN KEY([ReposicionProductoFotoTipoId])
REFERENCES [dbo].[ReposicionesProductosFotosTipos] ([ReposicionProductoFotoTipoId])
GO
ALTER TABLE [dbo].[ReposicionesProductosFotos] CHECK CONSTRAINT [FK_ReposicionesProductosFotos_Tipos]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores]  WITH CHECK ADD  CONSTRAINT [FK_ReposicionesProductosGanadores_Distribuidores] FOREIGN KEY([DistribuidorId])
REFERENCES [dbo].[Distribuidores] ([DistribuidorId])
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] CHECK CONSTRAINT [FK_ReposicionesProductosGanadores_Distribuidores]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores]  WITH CHECK ADD  CONSTRAINT [FK_ReposicionesProductosGanadores_RecompensasTipos] FOREIGN KEY([RecompensaTipoId])
REFERENCES [dbo].[RecompensasTipos] ([RecompensaTipoId])
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] CHECK CONSTRAINT [FK_ReposicionesProductosGanadores_RecompensasTipos]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores]  WITH CHECK ADD  CONSTRAINT [FK_ReposicionesProductosGanadores_Tarjetas] FOREIGN KEY([TarjetaId])
REFERENCES [dbo].[Tarjetas] ([TarjetaId])
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] CHECK CONSTRAINT [FK_ReposicionesProductosGanadores_Tarjetas]
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores]  WITH CHECK ADD  CONSTRAINT [FK_ReposicionesProductosGanadores_Usuarios] FOREIGN KEY([UsuarioId])
REFERENCES [dbo].[Usuarios] ([UsuarioId])
GO
ALTER TABLE [dbo].[ReposicionesProductosGanadores] CHECK CONSTRAINT [FK_ReposicionesProductosGanadores_Usuarios]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremios]  WITH CHECK ADD  CONSTRAINT [FK_ReposicionesProductosPremios_ProductosDivisiones] FOREIGN KEY([ProductoDivisionId])
REFERENCES [dbo].[ProductosDivisiones] ([ProductoDivisionId])
GO
ALTER TABLE [dbo].[ReposicionesProductosPremios] CHECK CONSTRAINT [FK_ReposicionesProductosPremios_ProductosDivisiones]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductosRelaciones]  WITH CHECK ADD  CONSTRAINT [FK_RelPremProd_Premio] FOREIGN KEY([ReposicionProductoPremioId])
REFERENCES [dbo].[ReposicionesProductosPremios] ([ReposicionProductoPremioId])
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductosRelaciones] CHECK CONSTRAINT [FK_RelPremProd_Premio]
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductosRelaciones]  WITH CHECK ADD  CONSTRAINT [FK_RelPremProd_Producto] FOREIGN KEY([ReposicionProductoPremioProductoId])
REFERENCES [dbo].[ReposicionesProductosPremiosProductos] ([ReposicionProductoPremioProductoId])
GO
ALTER TABLE [dbo].[ReposicionesProductosPremiosProductosRelaciones] CHECK CONSTRAINT [FK_RelPremProd_Producto]
GO
ALTER TABLE [dbo].[Tarjetas]  WITH CHECK ADD  CONSTRAINT [FK_Tarjetas_Distribuidores] FOREIGN KEY([DistribuidorId])
REFERENCES [dbo].[Distribuidores] ([DistribuidorId])
GO
ALTER TABLE [dbo].[Tarjetas] CHECK CONSTRAINT [FK_Tarjetas_Distribuidores]
GO
ALTER TABLE [dbo].[Tarjetas]  WITH CHECK ADD  CONSTRAINT [FK_Tarjetas_TarjetasEstatus] FOREIGN KEY([TarjetaEstatusId])
REFERENCES [dbo].[TarjetasEstatus] ([TarjetaEstatusId])
GO
ALTER TABLE [dbo].[Tarjetas] CHECK CONSTRAINT [FK_Tarjetas_TarjetasEstatus]
GO
ALTER TABLE [dbo].[Tarjetas]  WITH CHECK ADD  CONSTRAINT [FK_Tarjetas_Usuarios] FOREIGN KEY([UsuarioId])
REFERENCES [dbo].[Usuarios] ([UsuarioId])
GO
ALTER TABLE [dbo].[Tarjetas] CHECK CONSTRAINT [FK_Tarjetas_Usuarios]
GO
ALTER TABLE [dbo].[TarjetasFolios]  WITH CHECK ADD  CONSTRAINT [FK_TarjetasFolios_Tarjetas] FOREIGN KEY([TarjetaId])
REFERENCES [dbo].[Tarjetas] ([TarjetaId])
GO
ALTER TABLE [dbo].[TarjetasFolios] CHECK CONSTRAINT [FK_TarjetasFolios_Tarjetas]
GO
ALTER TABLE [dbo].[Usuarios]  WITH CHECK ADD  CONSTRAINT [FK_Usuarios_Perfiles] FOREIGN KEY([PerfilId])
REFERENCES [dbo].[Perfiles] ([PerfilId])
GO
ALTER TABLE [dbo].[Usuarios] CHECK CONSTRAINT [FK_Usuarios_Perfiles]
GO
ALTER TABLE [dbo].[Usuarios]  WITH CHECK ADD  CONSTRAINT [FK_Usuarios_UsuariosTiposRegistro] FOREIGN KEY([UsuarioTipoRegistroId])
REFERENCES [dbo].[UsuariosTiposRegistro] ([UsuarioTipoRegistroId])
GO
ALTER TABLE [dbo].[Usuarios] CHECK CONSTRAINT [FK_Usuarios_UsuariosTiposRegistro]
GO
ALTER TABLE [dbo].[UsuariosDetalles]  WITH CHECK ADD  CONSTRAINT [FK_UsuariosDetalles_CompaniasCelulares] FOREIGN KEY([UsuarioDetalleCompaniaCelularId])
REFERENCES [dbo].[CompaniasCelulares] ([CompaniaCelularId])
GO
ALTER TABLE [dbo].[UsuariosDetalles] CHECK CONSTRAINT [FK_UsuariosDetalles_CompaniasCelulares]
GO
ALTER TABLE [dbo].[UsuariosDetalles]  WITH CHECK ADD  CONSTRAINT [FK_UsuariosDetalles_Usuarios] FOREIGN KEY([UsuarioId])
REFERENCES [dbo].[Usuarios] ([UsuarioId])
GO
ALTER TABLE [dbo].[UsuariosDetalles] CHECK CONSTRAINT [FK_UsuariosDetalles_Usuarios]
GO
ALTER TABLE [dbo].[UsuariosDistribuidores]  WITH CHECK ADD  CONSTRAINT [FK_UsuariosDistribuidores_Distribuidores] FOREIGN KEY([DistribuidorId])
REFERENCES [dbo].[Distribuidores] ([DistribuidorId])
GO
ALTER TABLE [dbo].[UsuariosDistribuidores] CHECK CONSTRAINT [FK_UsuariosDistribuidores_Distribuidores]
GO
ALTER TABLE [dbo].[UsuariosDistribuidores]  WITH CHECK ADD  CONSTRAINT [FK_UsuariosDistribuidores_Usuarios] FOREIGN KEY([UsuarioId])
REFERENCES [dbo].[Usuarios] ([UsuarioId])
GO
ALTER TABLE [dbo].[UsuariosDistribuidores] CHECK CONSTRAINT [FK_UsuariosDistribuidores_Usuarios]
GO
ALTER TABLE [dbo].[UsuariosRecuperacionClave]  WITH CHECK ADD  CONSTRAINT [FK_UsuariosRecuperacionClave_Usuarios] FOREIGN KEY([UsuarioId])
REFERENCES [dbo].[Usuarios] ([UsuarioId])
GO
ALTER TABLE [dbo].[UsuariosRecuperacionClave] CHECK CONSTRAINT [FK_UsuariosRecuperacionClave_Usuarios]
GO
ALTER TABLE [dbo].[UsuariosRegistroAccesos]  WITH CHECK ADD  CONSTRAINT [FK_UsuariosRegistroAccesos_Usuarios] FOREIGN KEY([UsuarioId])
REFERENCES [dbo].[Usuarios] ([UsuarioId])
GO
ALTER TABLE [dbo].[UsuariosRegistroAccesos] CHECK CONSTRAINT [FK_UsuariosRegistroAccesos_Usuarios]
GO
ALTER TABLE [dbo].[Ventas]  WITH CHECK ADD  CONSTRAINT [FK_Ventas_Distribuidores] FOREIGN KEY([DistribuidorId])
REFERENCES [dbo].[Distribuidores] ([DistribuidorId])
GO
ALTER TABLE [dbo].[Ventas] CHECK CONSTRAINT [FK_Ventas_Distribuidores]
GO
ALTER TABLE [dbo].[Ventas]  WITH CHECK ADD  CONSTRAINT [FK_Ventas_Tarjetas] FOREIGN KEY([TarjetaId])
REFERENCES [dbo].[Tarjetas] ([TarjetaId])
GO
ALTER TABLE [dbo].[Ventas] CHECK CONSTRAINT [FK_Ventas_Tarjetas]
GO
ALTER TABLE [dbo].[VentasAuditorias]  WITH CHECK ADD  CONSTRAINT [FK_VentasAuditorias_Cortes] FOREIGN KEY([CorteId])
REFERENCES [dbo].[Cortes] ([CorteId])
GO
ALTER TABLE [dbo].[VentasAuditorias] CHECK CONSTRAINT [FK_VentasAuditorias_Cortes]
GO
ALTER TABLE [dbo].[VentasAuditorias]  WITH CHECK ADD  CONSTRAINT [FK_VentasAuditorias_Estatus] FOREIGN KEY([VentaAuditoriaEstatusId])
REFERENCES [dbo].[VentasAuditoriasEstatus] ([VentaAuditoriaEstatusId])
GO
ALTER TABLE [dbo].[VentasAuditorias] CHECK CONSTRAINT [FK_VentasAuditorias_Estatus]
GO
ALTER TABLE [dbo].[VentasAuditorias]  WITH CHECK ADD  CONSTRAINT [FK_VentasAuditorias_EstatusOportunidades] FOREIGN KEY([VentaAuditoriaEstatusOportunidadId])
REFERENCES [dbo].[VentasAuditoriasEstatusOportunidades] ([VentaAuditoriaEstatusOportunidadId])
GO
ALTER TABLE [dbo].[VentasAuditorias] CHECK CONSTRAINT [FK_VentasAuditorias_EstatusOportunidades]
GO
ALTER TABLE [dbo].[VentasAuditorias]  WITH CHECK ADD  CONSTRAINT [FK_VentasAuditorias_Tipos] FOREIGN KEY([VentaAuditoriaTipoId])
REFERENCES [dbo].[VentasAuditoriasTipos] ([VentaAuditoriaTipoId])
GO
ALTER TABLE [dbo].[VentasAuditorias] CHECK CONSTRAINT [FK_VentasAuditorias_Tipos]
GO
ALTER TABLE [dbo].[VentasAuditorias]  WITH CHECK ADD  CONSTRAINT [FK_VentasAuditorias_Ventas] FOREIGN KEY([VentaId])
REFERENCES [dbo].[Ventas] ([VentaId])
GO
ALTER TABLE [dbo].[VentasAuditorias] CHECK CONSTRAINT [FK_VentasAuditorias_Ventas]
GO
ALTER TABLE [dbo].[VentasUsuariosPromociones]  WITH CHECK ADD  CONSTRAINT [FK_VentasUsuariosPromociones_VentasPromocionesDetalles] FOREIGN KEY([VentaPromocionDetalleId])
REFERENCES [dbo].[VentasPromocionesDetalles] ([VentaPromocionDetalleId])
GO
ALTER TABLE [dbo].[VentasUsuariosPromociones] CHECK CONSTRAINT [FK_VentasUsuariosPromociones_VentasPromocionesDetalles]
GO
/****** Object:  StoredProcedure [dbo].[sp_control_modulos]    Script Date: 18/03/2026 12:57:10 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[sp_control_modulos]
AS 
BEGIN
UPDATE ControlModulos SET ControlModuloEstatus=0 WHERE ControlModuloId=1;
END;
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ReposicionesProductosGanadores', @level2type=N'COLUMN',@level2name=N'ReposicionProductoGanadorFechaRegistro'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4[30] 2[40] 3) )"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2[43] 3) )"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 5
   End
   Begin DiagramPane = 
      PaneHidden = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "Usuarios"
            Begin Extent = 
               Top = 7
               Left = 48
               Bottom = 309
               Right = 480
            End
            DisplayFlags = 280
            TopColumn = 6
         End
         Begin Table = "UsuariosDetalles"
            Begin Extent = 
               Top = 7
               Left = 523
               Bottom = 315
               Right = 995
            End
            DisplayFlags = 280
            TopColumn = 25
         End
         Begin Table = "Perfiles"
            Begin Extent = 
               Top = 109
               Left = 1190
               Bottom = 228
               Right = 1434
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "UsuariosDistribuidores"
            Begin Extent = 
               Top = 22
               Left = 1496
               Bottom = 163
               Right = 1740
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "DistribuidoresDetalles"
            Begin Extent = 
               Top = 21
               Left = 1799
               Bottom = 310
               Right = 2200
            End
            DisplayFlags = 280
            TopColumn = 14
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 17
         Width = 284
         Width = 1200
         Width = 1200
         Width = 1200
         Width = 3048
         Width = 2016
         Width = 2724
         Width = 1200
         Width = 1200
         Width = 1200
         Width = 1200
         Width ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_usuarios_dis'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'= 1200
         Width = 1200
         Width = 1200
         Width = 1200
         Width = 1200
         Width = 1200
      End
   End
   Begin CriteriaPane = 
      PaneHidden = 
      Begin ColumnWidths = 11
         Column = 7032
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_usuarios_dis'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vw_usuarios_dis'
GO
USE [master]
GO
ALTER DATABASE [pruebas_clubdelpintoraxaltabrasil] SET  READ_WRITE 
GO
