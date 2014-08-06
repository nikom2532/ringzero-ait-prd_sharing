USE [NNT_DataCenter_2]
GO
/****** Object:  View [dbo].[VW06_OtherFile]    Script Date: 06/17/2014 10:41:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VW06_OtherFile]
AS
SELECT     TOP (100) PERCENT NT01.NT01_NewsID AS 'NewsID', NT13.NT13_FileName AS 'FileName', NT13.NT13_FileSize AS 'FileSize', 
                      'http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=' + NT13.NT13_FilePath AS Url
FROM         dbo.NT13_OtherFile AS NT13 INNER JOIN
                      dbo.NT01_News AS NT01 ON NT13.NT01_NewsID = NT01.NT01_NewsID
ORDER BY 'NewsID'
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
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
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
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "NT13"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 125
               Right = 207
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT01"
            Begin Extent = 
               Top = 6
               Left = 245
               Bottom = 125
               Right = 467
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
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
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW06_OtherFile'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW06_OtherFile'
GO
/****** Object:  View [dbo].[VW05_Voice]    Script Date: 06/17/2014 10:41:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VW05_Voice]
AS
SELECT     TOP (100) PERCENT NT01.NT01_NewsID AS 'NewsID', NT12.NT12_VoiceName AS 'FileName', NT12.NT12_FileSize AS 'FileSize', 
                      'http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=' + NT12.NT12_VoicePath AS Url
FROM         dbo.NT12_Voice AS NT12 INNER JOIN
                      dbo.NT01_News AS NT01 ON NT12.NT01_NewsID = NT01.NT01_NewsID
ORDER BY 'NewsID'
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
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
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
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "NT12"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 125
               Right = 213
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT01"
            Begin Extent = 
               Top = 6
               Left = 251
               Bottom = 125
               Right = 473
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
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
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW05_Voice'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW05_Voice'
GO
/****** Object:  View [dbo].[VW04_Picture]    Script Date: 06/17/2014 10:41:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VW04_Picture]
AS
SELECT     TOP (100) PERCENT NT01.NT01_NewsID AS NewsID, NT11.NT11_PicName AS FileName, NT11.NT11_FileSize AS FileSize, 
                      'http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=' + NT11.NT11_PicPath AS Url
FROM         dbo.NT11_Picture AS NT11 INNER JOIN
                      dbo.NT01_News AS NT01 ON NT11.NT01_NewsID = NT01.NT01_NewsID
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[29] 4[32] 2[21] 3) )"
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
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
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
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "NT11"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 125
               Right = 213
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT01"
            Begin Extent = 
               Top = 6
               Left = 251
               Bottom = 125
               Right = 473
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1995
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 2175
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW04_Picture'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW04_Picture'
GO
/****** Object:  View [dbo].[VW03_Video]    Script Date: 06/17/2014 10:41:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VW03_Video]
AS
SELECT     TOP (100) PERCENT NT01.NT01_NewsID AS NewsID, NT10.NT10_VDOName AS FileName, NT10.NT10_FileSize AS FileSize, 
                      'http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=' + NT10.NT10_VDOPath AS Url
FROM         dbo.NT10_VDO AS NT10 INNER JOIN
                      dbo.NT01_News AS NT01 ON NT10.NT01_NewsID = NT01.NT01_NewsID
ORDER BY 'NewsID'
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
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
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
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "NT10"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 125
               Right = 213
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT01"
            Begin Extent = 
               Top = 6
               Left = 251
               Bottom = 125
               Right = 473
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
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
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW03_Video'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW03_Video'
GO
/****** Object:  View [dbo].[VW07_User]    Script Date: 06/17/2014 10:41:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VW07_User]
AS
SELECT     TOP (100) PERCENT SC03.SC03_UserId AS 'UserID', SC03.SC03_TName AS 'Title', SC03.SC03_FName AS 'FName', SC03.SC03_LName AS 'LName', 
                      SC03.SC03_Gender AS 'Gender', SC03.SC03_Email AS 'Email', SC03.SC03_UserName AS 'Username', SC03.SC03_Tel AS 'Tel', 
                      SC03.SC03_PhoneOffice AS 'Phone Office', SC03.SC03_Address AS 'Address', SC03.SC03_Career AS 'Career', SC03.SC03_PositionType AS 'PositionType', 
                      SC03.SC03_Position AS 'Position', SC03.SC03_IDCard AS 'IDCard', SC03.SC03_RegisterDate AS 'RegisterDate', SC03.SC03_ContactName AS 'ContactName', 
                      dbo.CM13_Country.CM13_CountryName AS 'Country', SC17.SC17_SystemName AS 'System', SC07.SC07_DepartmentName AS 'Department', 
                      CM05.CM05_RegionName AS 'Region', CM06.CM06_ProvinceName AS 'Province', CM07.CM07_AmpurName AS 'Ampur', 
                      CM08.CM08_TumbonName AS 'Tumbon'
FROM         dbo.SC03_User AS SC03 LEFT OUTER JOIN
                      dbo.CM13_Country ON SC03.CM13_CountryID = dbo.CM13_Country.CM13_CountryID LEFT OUTER JOIN
                      dbo.SC17_System AS SC17 ON SC03.SC17_SystemID = SC17.SC17_SystemID LEFT OUTER JOIN
                      dbo.CM05_Region AS CM05 ON SC03.CM05_RegionId = CM05.CM05_RegionID LEFT OUTER JOIN
                      dbo.SC07_Department AS SC07 ON SC03.SC07_DepartmentId = SC07.SC07_DepartmentId LEFT OUTER JOIN
                      dbo.CM07_Ampur AS CM07 ON SC03.CM07_AmpurId = CM07.CM07_AmpurID LEFT OUTER JOIN
                      dbo.CM06_Province AS CM06 ON SC03.CM06_ProvinceId = CM06.CM06_ProvinceID LEFT OUTER JOIN
                      dbo.CM08_Tumbon AS CM08 ON SC03.CM08_TumbonId = CM08.CM08_TumbonID
ORDER BY 'System', SC07.SC07_DepartmentSeq
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
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
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
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "SC03"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 125
               Right = 270
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "CM13_Country"
            Begin Extent = 
               Top = 6
               Left = 308
               Bottom = 125
               Right = 512
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SC17"
            Begin Extent = 
               Top = 6
               Left = 550
               Bottom = 125
               Right = 732
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "CM05"
            Begin Extent = 
               Top = 6
               Left = 770
               Bottom = 125
               Right = 964
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SC07"
            Begin Extent = 
               Top = 6
               Left = 1002
               Bottom = 125
               Right = 1221
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "CM07"
            Begin Extent = 
               Top = 126
               Left = 38
               Bottom = 245
               Right = 230
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "CM06"
            Begin Extent = 
               Top = 126
               Left = 268
               Bottom = 245
               Right = 470
            End
            DisplayFlags = 280
            Top' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW07_User'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'Column = 0
         End
         Begin Table = "CM08"
            Begin Extent = 
               Top = 126
               Left = 508
               Bottom = 245
               Right = 707
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
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
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW07_User'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW07_User'
GO
/****** Object:  View [dbo].[VW02_PublishNews]    Script Date: 06/17/2014 10:41:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VW02_PublishNews]
AS
SELECT     TOP (100) PERCENT NT01.NT01_NewsID AS NewsID, NT01.NT01_NewsTitle AS Title, NT01.NT01_NewsDesc AS Detail, NT01.NT01_NewsDate AS Date, 
                      NT02.NT02_TypeName AS Type, NT03.NT03_SubTypeName AS SubType, NT06.NT06_MoreTypeName AS MoreType, NT26.NT26_IssueTitle AS Issue, 
                      CM06.CM06_ProvinceName AS Province, SC07.SC07_DepartmentName AS Department, LTRIM(RTRIM(ISNULL(SC03_Reporter.SC03_TName, '') 
                      + ' ' + ISNULL(SC03_Reporter.SC03_FName, '') + ' ' + ISNULL(SC03_Reporter.SC03_LName, ''))) AS Reporter, LTRIM(RTRIM(ISNULL(SC03_Rewriter.SC03_TName, '') 
                      + ' ' + ISNULL(SC03_Rewriter.SC03_FName, '') + ' ' + ISNULL(SC03_Rewriter.SC03_LName, ''))) AS Rewriter, LTRIM(RTRIM(ISNULL(SC03_Editor.SC03_TName, '') 
                      + ' ' + ISNULL(SC03_Editor.SC03_FName, '') + ' ' + ISNULL(SC03_Editor.SC03_LName, ''))) AS Editor, 
                      CASE NT01.NT01_EngMode WHEN 'Y' THEN 'ภาษาอังกฤษ' ELSE 'ภาษาไทย' END AS Language, NT08.NT08_PubTypeName AS 'Publish', ISNULL(NT01.NT01_ViewCount, 0)
                       AS 'Views'
FROM         dbo.NT01_News AS NT01 INNER JOIN
                      dbo.NT08_PublicType AS NT08 ON NT01.NT08_PubTypeID = NT08.NT08_PubTypeID LEFT OUTER JOIN
                      dbo.SC03_User AS SC03_Editor ON NT01.NT01_EditorID = SC03_Editor.SC03_UserId LEFT OUTER JOIN
                      dbo.SC03_User AS SC03_Rewriter ON NT01.NT01_ReWriteID = SC03_Rewriter.SC03_UserId LEFT OUTER JOIN
                      dbo.SC03_User AS SC03_Reporter ON NT01.NT01_ReporterID = SC03_Reporter.SC03_UserId LEFT OUTER JOIN
                      dbo.NT06_MoreType AS NT06 ON NT01.NT06_MoreTypeID = NT06.NT06_MoreTypeID LEFT OUTER JOIN
                      dbo.CM06_Province AS CM06 ON NT01.CM06_ProvinceID = CM06.CM06_ProvinceID LEFT OUTER JOIN
                      dbo.NT26_IOCIssue AS NT26 ON NT01.NT26_IssueID = NT26.NT26_IssueID LEFT OUTER JOIN
                      dbo.SC07_Department AS SC07 ON NT01.SC07_DepartmentId = SC07.SC07_DepartmentId LEFT OUTER JOIN
                      dbo.NT03_NewsSubType AS NT03 ON NT01.NT03_SubTypeID = NT03.NT03_SubTypeID LEFT OUTER JOIN
                      dbo.NT02_NewsType AS NT02 ON NT01.NT02_TypeID = NT02.NT02_TypeID
WHERE     (NT01.NT08_PubTypeID IS NOT NULL) AND (NT01.NT08_PubTypeID <> 8)
ORDER BY 'Date' DESC
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[26] 4[28] 2[27] 3) )"
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
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
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
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = -192
         Left = 0
      End
      Begin Tables = 
         Begin Table = "NT01"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 125
               Right = 260
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SC03_Editor"
            Begin Extent = 
               Top = 6
               Left = 298
               Bottom = 125
               Right = 530
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SC03_Rewriter"
            Begin Extent = 
               Top = 6
               Left = 568
               Bottom = 125
               Right = 800
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SC03_Reporter"
            Begin Extent = 
               Top = 6
               Left = 838
               Bottom = 125
               Right = 1070
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT06"
            Begin Extent = 
               Top = 6
               Left = 1108
               Bottom = 125
               Right = 1315
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "CM06"
            Begin Extent = 
               Top = 126
               Left = 38
               Bottom = 245
               Right = 240
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT26"
            Begin Extent = 
               Top = 126
               Left = 278
               Bottom = 245
               Right = 471
            End
            DisplayFlags =' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW02_PublishNews'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N' 280
            TopColumn = 0
         End
         Begin Table = "SC07"
            Begin Extent = 
               Top = 126
               Left = 509
               Bottom = 245
               Right = 728
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT03"
            Begin Extent = 
               Top = 126
               Left = 766
               Bottom = 245
               Right = 967
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT02"
            Begin Extent = 
               Top = 126
               Left = 1005
               Bottom = 245
               Right = 1188
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT08"
            Begin Extent = 
               Top = 246
               Left = 38
               Bottom = 350
               Right = 227
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
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
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW02_PublishNews'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW02_PublishNews'
GO
/****** Object:  View [dbo].[VW01_RawNews]    Script Date: 06/17/2014 10:41:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VW01_RawNews]
AS
SELECT     TOP (100) PERCENT NT01.NT01_NewsID AS NewsID, NT01.NT01_NewsTitle AS Title, NT01.NT01_NewsDesc AS Detail, NT01.NT01_NewsDate AS Date, 
                      NT02.NT02_TypeName AS Type, NT03.NT03_SubTypeName AS SubType, NT06.NT06_MoreTypeName AS MoreType, NT26.NT26_IssueTitle AS Issue, 
                      CM06.CM06_ProvinceName AS Province, SC07.SC07_DepartmentName AS Department, LTRIM(RTRIM(ISNULL(SC03_Reporter.SC03_TName, '') 
                      + ' ' + ISNULL(SC03_Reporter.SC03_FName, '') + ' ' + ISNULL(SC03_Reporter.SC03_LName, ''))) AS Reporter, LTRIM(RTRIM(ISNULL(SC03_Rewriter.SC03_TName, '') 
                      + ' ' + ISNULL(SC03_Rewriter.SC03_FName, '') + ' ' + ISNULL(SC03_Rewriter.SC03_LName, ''))) AS Rewriter, LTRIM(RTRIM(ISNULL(SC03_Editor.SC03_TName, '') 
                      + ' ' + ISNULL(SC03_Editor.SC03_FName, '') + ' ' + ISNULL(SC03_Editor.SC03_LName, ''))) AS Editor, 
                      CASE NT01.NT01_EngMode WHEN 'Y' THEN 'ภาษาอังกฤษ' ELSE 'ภาษาไทย' END AS Language, ISNULL(NT01.NT01_ViewCount, 0) AS Views
FROM         dbo.NT01_News AS NT01 LEFT OUTER JOIN
                      dbo.SC03_User AS SC03_Editor ON NT01.NT01_EditorID = SC03_Editor.SC03_UserId LEFT OUTER JOIN
                      dbo.SC03_User AS SC03_Rewriter ON NT01.NT01_ReWriteID = SC03_Rewriter.SC03_UserId LEFT OUTER JOIN
                      dbo.SC03_User AS SC03_Reporter ON NT01.NT01_ReporterID = SC03_Reporter.SC03_UserId LEFT OUTER JOIN
                      dbo.NT06_MoreType AS NT06 ON NT01.NT06_MoreTypeID = NT06.NT06_MoreTypeID LEFT OUTER JOIN
                      dbo.CM06_Province AS CM06 ON NT01.CM06_ProvinceID = CM06.CM06_ProvinceID LEFT OUTER JOIN
                      dbo.NT26_IOCIssue AS NT26 ON NT01.NT26_IssueID = NT26.NT26_IssueID LEFT OUTER JOIN
                      dbo.SC07_Department AS SC07 ON NT01.SC07_DepartmentId = SC07.SC07_DepartmentId LEFT OUTER JOIN
                      dbo.NT03_NewsSubType AS NT03 ON NT01.NT03_SubTypeID = NT03.NT03_SubTypeID LEFT OUTER JOIN
                      dbo.NT02_NewsType AS NT02 ON NT01.NT02_TypeID = NT02.NT02_TypeID
WHERE     (NT01.NT08_PubTypeID IS NULL) OR
                      (NT01.NT08_PubTypeID = 8)
ORDER BY 'Date' DESC
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[39] 4[23] 2[20] 3) )"
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
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
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
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "NT01"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 125
               Right = 260
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SC03_Editor"
            Begin Extent = 
               Top = 6
               Left = 298
               Bottom = 125
               Right = 530
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SC03_Rewriter"
            Begin Extent = 
               Top = 6
               Left = 568
               Bottom = 125
               Right = 800
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "SC03_Reporter"
            Begin Extent = 
               Top = 6
               Left = 838
               Bottom = 125
               Right = 1070
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT06"
            Begin Extent = 
               Top = 6
               Left = 1108
               Bottom = 125
               Right = 1315
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "CM06"
            Begin Extent = 
               Top = 126
               Left = 38
               Bottom = 245
               Right = 240
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT26"
            Begin Extent = 
               Top = 126
               Left = 278
               Bottom = 245
               Right = 471
            End
            DisplayFlags = 28' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW01_RawNews'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'0
            TopColumn = 0
         End
         Begin Table = "SC07"
            Begin Extent = 
               Top = 126
               Left = 509
               Bottom = 245
               Right = 728
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT03"
            Begin Extent = 
               Top = 126
               Left = 766
               Bottom = 245
               Right = 967
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "NT02"
            Begin Extent = 
               Top = 126
               Left = 1005
               Bottom = 245
               Right = 1188
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 10
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 3045
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
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW01_RawNews'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'VW01_RawNews'
GO
