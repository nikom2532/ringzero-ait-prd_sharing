USE [ringzero_ait_prd_sharing]
GO
/****** Object:  Table [dbo].[SendInformation]    Script Date: 06/10/2014 17:16:52 ******/
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
/****** Object:  Default [DF_SendInformation_SendIn_view]    Script Date: 06/10/2014 17:16:52 ******/
ALTER TABLE [dbo].[SendInformation] ADD  CONSTRAINT [DF_SendInformation_SendIn_view]  DEFAULT ((0)) FOR [SendIn_view]
GO
/****** Object:  Default [DF_SendInformation_SendIn_Delete]    Script Date: 06/10/2014 17:16:52 ******/
ALTER TABLE [dbo].[SendInformation] ADD  CONSTRAINT [DF_SendInformation_SendIn_Delete]  DEFAULT ((0)) FOR [SendIn_Delete]
GO
