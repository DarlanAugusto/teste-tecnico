CREATE DATABASE [softline]
GO

USE [softline]
GO
/****** Object:  Table [dbo].[clientes]    Script Date: 12/03/2024 22:33:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[clientes](
	[idclientes] [int] IDENTITY(1,1) NOT NULL,
	[cli_razao_social] [varchar](255) NOT NULL,
	[cli_nome_fantasia] [varchar](255) NOT NULL,
	[cli_documento] [varchar](20) NOT NULL,
	[cli_endereco] [varchar](max) NOT NULL,
 CONSTRAINT [PK_clientes] PRIMARY KEY CLUSTERED 
(
	[idclientes] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[produtos]    Script Date: 12/03/2024 22:33:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[produtos](
	[idprodutos] [int] IDENTITY(1,1) NOT NULL,
	[prod_descricao] [varchar](max) NOT NULL,
	[prod_cod_barras] [varchar](255) NOT NULL,
	[prod_preco_venda] [decimal](10, 2) NOT NULL,
	[prod_peso_bruto] [decimal](10, 2) NOT NULL,
	[prod_peso_liquido] [decimal](10, 2) NOT NULL,
 CONSTRAINT [PK_produtos] PRIMARY KEY CLUSTERED 
(
	[idprodutos] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[usuarios]    Script Date: 12/03/2024 22:33:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuarios](
	[idusuarios] [int] IDENTITY(1,1) NOT NULL,
	[user_login] [varchar](50) NOT NULL,
	[user_senha] [varchar](255) NOT NULL,
	[user_nome] [varchar](255) NOT NULL,
 CONSTRAINT [PK_usuarios] PRIMARY KEY CLUSTERED 
(
	[idusuarios] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[produtos] ADD  DEFAULT ((0.00)) FOR [prod_preco_venda]
GO
ALTER TABLE [dbo].[produtos] ADD  DEFAULT ((0.00)) FOR [prod_peso_bruto]
GO
ALTER TABLE [dbo].[produtos] ADD  DEFAULT ((0.00)) FOR [prod_peso_liquido]
GO
