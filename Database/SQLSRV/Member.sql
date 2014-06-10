USE [ringzero_ait_prd_sharing]
GO
/****** Object:  Table [dbo].[Member]    Script Date: 06/10/2014 14:39:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Member](
	[Mem_ID] [int] IDENTITY(1,1) NOT NULL,
	[Mem_Name] [nvarchar](20) NULL,
	[Mem_LasName] [nvarchar](20) NULL,
	[Mem_EngName] [nvarchar](20) NULL,
	[Mem_EngLasName] [nvarchar](20) NULL,
	[Mem_Sex] [nvarchar](10) NULL,
	[Mem_Title] [nvarchar](20) NULL,
	[Mem_CardID] [nvarchar](20) NULL,
	[Mem_Ministry] [nvarchar](20) NULL,
	[Mem_Department] [nvarchar](20) NULL,
	[Mem_Position] [nvarchar](20) NULL,
	[Mem_Password] [nvarchar](20) NULL,
	[Mem_Username] [nvarchar](20) NULL,
	[Mem_Status] [int] NULL,
	[Mem_Address] [nvarchar](30) NULL,
	[Mem_Email] [nvarchar](20) NULL,
	[Mem_Postcode] [int] NULL,
	[Mem_NickName] [nvarchar](20) NULL,
	[Mem_Tel] [int] NULL,
	[Mem_Mobile] [int] NULL,
	[Ampur_ID] [int] NULL,
	[Group_ID] [int] NULL,
	[Tumbon_ID] [int] NULL,
	[Prov_ID] [int] NULL,
	[Mem_OldID] [int] NULL,
	[Mem_CreateDate] [datetime] NULL,
	[Mem_UpdateDate] [datetime] NULL,
 CONSTRAINT [PK__Member__816CC0F708EA5793] PRIMARY KEY CLUSTERED 
(
	[Mem_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
