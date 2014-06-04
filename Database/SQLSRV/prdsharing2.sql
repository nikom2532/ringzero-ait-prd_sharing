USE [ringzero_ait_prd_sharing]
GO
/****** Object:  Table [dbo].[UserLog]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserLog](
	[Log_ID] [int] IDENTITY(1,1) NOT NULL,
	[Log_Date] [datetime] NULL,
	[Log_IP] [nvarchar](15) NULL,
	[Log_StartLogin] [nvarchar](15) NULL,
	[Log_EndLogin] [nvarchar](15) NULL,
	[Mem_ID] [int] NULL,
 CONSTRAINT [PK_UserLog] PRIMARY KEY CLUSTERED 
(
	[Log_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Tompon]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Tompon](
	[Tombon_ID] [int] IDENTITY(1,1) NOT NULL,
	[Tompon_Name] [nvarchar](20) NULL,
	[Tompon_Status] [int] NULL,
	[Ampur_ID] [int] NULL,
 CONSTRAINT [PK_Tompon] PRIMARY KEY CLUSTERED 
(
	[Tombon_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[test]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[test](
	[field1] [int] NULL,
	[field2] [varchar](1) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TargetGroup]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TargetGroup](
	[Tar_ID] [int] IDENTITY(1,1) NOT NULL,
	[Tar_Name] [nvarchar](200) NULL,
	[Tar_status] [int] NULL,
 CONSTRAINT [PK_TargetGroup] PRIMARY KEY CLUSTERED 
(
	[Tar_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[TargetGroup] ON
INSERT [dbo].[TargetGroup] ([Tar_ID], [Tar_Name], [Tar_status]) VALUES (3, N'สมาชิกระบบทั้งหมด', NULL)
INSERT [dbo].[TargetGroup] ([Tar_ID], [Tar_Name], [Tar_status]) VALUES (4, N'เฉพาะสำนักข่าวกรมประชาสัมพันธ์', NULL)
SET IDENTITY_INSERT [dbo].[TargetGroup] OFF
/****** Object:  Table [dbo].[SendInformation]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SendInformation](
	[SendIn_ID] [int] IDENTITY(1,1) NOT NULL,
	[SendIn_CreateDate] [datetime] NULL,
	[SendIn_UpdateDate] [datetime] NULL,
	[SendIn_Plan] [nvarchar](30) NULL,
	[SendIn_Issue] [nvarchar](30) NULL,
	[SendIn_Detail] [nvarchar](30) NULL,
	[SendIn_Status] [int] NULL,
	[SendIn_view] [int] NULL,
	[Dep_ID] [int] NULL,
	[Policy_ID] [int] NULL,
	[Agency_ID] [int] NULL,
	[Ministry_ID] [int] NULL,
	[Tar_ID] [int] NULL,
	[Mem_ID] [int] NULL,
	[SendIn_Delete] [int] NULL,
	[SendIn_PoliceID] [int] NULL,
	[PRD_Active] [int] NULL,
	[PRD_Status] [int] NULL,
	[GOVE_Active] [int] NULL,
	[GOVE_Status] [int] NULL,
 CONSTRAINT [PK_SendInformation] PRIMARY KEY CLUSTERED 
(
	[SendIn_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Province]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Province](
	[Prov_ID] [int] IDENTITY(1,1) NOT NULL,
	[Prov_Name] [nvarchar](20) NULL,
	[Prov_Status] [int] NULL,
 CONSTRAINT [PK_Province] PRIMARY KEY CLUSTERED 
(
	[Prov_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Policy]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Policy](
	[Poli_ID] [int] IDENTITY(1,1) NOT NULL,
	[Poli_Name] [nvarchar](20) NULL,
	[Poli_Status] [int] NULL,
 CONSTRAINT [PK_Policy] PRIMARY KEY CLUSTERED 
(
	[Poli_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[News]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[News](
	[News_ID] [int] IDENTITY(1,1) NOT NULL,
	[News_Title] [nvarchar](500) NULL,
	[News_Detail] [text] NULL,
	[News_Date] [datetime] NULL,
	[News_UpdateDate] [datetime] NULL,
	[News_StatusPublic] [int] NULL,
	[News_View] [int] NULL,
	[News_StatusPhoto] [int] NULL,
	[News_StatusVDO] [int] NULL,
	[News_StatusVoice] [int] NULL,
	[News_StatusOtherFile] [int] NULL,
	[News_Tag] [nvarchar](200) NULL,
	[News_Resource] [nvarchar](500) NULL,
	[News_Reference] [nvarchar](500) NULL,
	[News_OldCateID] [nvarchar](30) NULL,
	[News_OldSubCateID] [nvarchar](30) NULL,
	[News_MoreCate] [nvarchar](30) NULL,
	[News_UpdateID] [int] NULL,
	[News_OldID] [nvarchar](30) NULL,
	[News_Active] [int] NULL,
	[MemUpdate_ID] [int] NULL,
	[Cate_ID] [int] NULL,
	[News_Delete] [int] NULL,
 CONSTRAINT [PK_News] PRIMARY KEY CLUSTERED 
(
	[News_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Ministry]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Ministry](
	[Minis_ID] [int] IDENTITY(1,1) NOT NULL,
	[Minis_Name] [nvarchar](20) NULL,
	[Minis_Status] [int] NULL,
	[Minis_Desc] [nvarchar](500) NULL,
 CONSTRAINT [PK_Ministry] PRIMARY KEY CLUSTERED 
(
	[Minis_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Member]    Script Date: 06/04/2014 17:12:33 ******/
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
	[Mem_CardID] [int] NULL,
	[Mem_Ministry] [nvarchar](20) NULL,
	[Mem_Department] [nvarchar](20) NULL,
	[Mem_Position] [nvarchar](20) NULL,
	[Mem_Moblie] [int] NULL,
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
 CONSTRAINT [PK__Member__816CC0F708EA5793] PRIMARY KEY CLUSTERED 
(
	[Mem_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[GroupMember]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[GroupMember](
	[Group_ID] [int] IDENTITY(1,1) NOT NULL,
	[Group_Name] [nvarchar](50) NULL,
	[Group_Desc] [nvarchar](50) NULL,
	[Group_CreateDate] [datetime] NULL,
	[Group_Status] [int] NULL,
 CONSTRAINT [PK_GroupMember2] PRIMARY KEY CLUSTERED 
(
	[Group_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[GroupMember] ON
INSERT [dbo].[GroupMember] ([Group_ID], [Group_Name], [Group_Desc], [Group_CreateDate], [Group_Status]) VALUES (1, N'GROV', N'Goverment Sharing', CAST(0x0000A34000000000 AS DateTime), 1)
INSERT [dbo].[GroupMember] ([Group_ID], [Group_Name], [Group_Desc], [Group_CreateDate], [Group_Status]) VALUES (2, N'Admin', N'Admin', CAST(0x0000A34000000000 AS DateTime), 1)
INSERT [dbo].[GroupMember] ([Group_ID], [Group_Name], [Group_Desc], [Group_CreateDate], [Group_Status]) VALUES (3, N'PRD', N'PRD Sharing', CAST(0x0000A34000000000 AS DateTime), 1)
SET IDENTITY_INSERT [dbo].[GroupMember] OFF
/****** Object:  Table [dbo].[FileAttach]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[FileAttach](
	[File_ID] [int] IDENTITY(1,1) NOT NULL,
	[File_Name] [nvarchar](20) NULL,
	[File_Path] [nvarchar](30) NULL,
	[File_Extension] [nvarchar](10) NULL,
	[File_FileSize] [nvarchar](20) NULL,
	[File_Status] [int] NULL,
	[File_Type] [nvarchar](10) NULL,
	[SendIn_ID] [int] NULL,
 CONSTRAINT [PK_FileAttach] PRIMARY KEY CLUSTERED 
(
	[File_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Department]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Department](
	[Dep_ID] [int] IDENTITY(1,1) NOT NULL,
	[Dep_Name] [nvarchar](200) NULL,
	[Dep_Status] [int] NULL,
	[Ministry_ID] [int] NULL,
	[Dep_Desc] [text] NULL,
 CONSTRAINT [PK_Department] PRIMARY KEY CLUSTERED 
(
	[Dep_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Category]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Category](
	[Cate_ID] [int] IDENTITY(1,1) NOT NULL,
	[Cate_OldID] [int] NULL,
	[CateName] [nvarchar](30) NULL,
	[Cate_Status] [int] NULL,
	[Cate_UpdateDate] [datetime] NULL,
	[MemUpdate_ID] [int] NOT NULL,
 CONSTRAINT [PK_Category] PRIMARY KEY CLUSTERED 
(
	[Cate_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Approve]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Approve](
	[Approve_ID] [int] IDENTITY(1,1) NOT NULL,
	[Approve_Date] [nchar](10) NULL,
	[Approve_Status] [int] NULL,
	[Mem_ID] [int] NULL,
	[SendIn_ID] [int] NULL,
 CONSTRAINT [PK_Approve] PRIMARY KEY CLUSTERED 
(
	[Approve_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Ampur]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Ampur](
	[Ampur_ID] [int] IDENTITY(1,1) NOT NULL,
	[Ampur_Name] [nvarchar](50) NULL,
	[Ampur_Status] [int] NULL,
	[Prov_ID] [int] NULL,
 CONSTRAINT [PK_Ampur] PRIMARY KEY CLUSTERED 
(
	[Ampur_ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Agency]    Script Date: 06/04/2014 17:12:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Agency](
	[Agen_ID] [int] NULL,
	[Agen_Name] [nvarchar](20) NULL,
	[Agen_Status] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Default [DF_SendInformation_SendIn_Delete]    Script Date: 06/04/2014 17:12:33 ******/
ALTER TABLE [dbo].[SendInformation] ADD  CONSTRAINT [DF_SendInformation_SendIn_Delete]  DEFAULT ((0)) FOR [SendIn_Delete]
GO
