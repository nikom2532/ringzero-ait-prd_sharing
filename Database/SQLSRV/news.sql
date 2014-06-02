USE [ringzero_ait_prd_sharing]
GO
/****** Object:  Table [dbo].[News]    Script Date: 06/02/2014 15:30:31 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[News](
	[News_ID] [int] IDENTITY(1,1) NOT NULL,
	[News_Title] [nvarchar](500) NULL,
	[News_Detail] [nvarchar](1000) NULL,
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
	[News_Cate] [nvarchar](30) NULL,
	[News_SubCate] [nvarchar](30) NULL,
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
) ON [PRIMARY]
GO
