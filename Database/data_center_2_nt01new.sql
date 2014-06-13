WITH LIMIT AS

(

SELECT

MAX([NNT_DataCenter_2].[dbo].[NT01_News].[NT01_NewsID]) AS NT01_NewsID, 
MAX([NNT_DataCenter_2].[dbo].[NT01_News].[NT01_UpdDate]) AS NT01_UpdDate, 
MAX([NNT_DataCenter_2].[dbo].[NT01_News].[NT01_CreDate]) AS NT01_CreDate, 
MAX([NNT_DataCenter_2].[dbo].[NT01_News].[NT01_NewsTitle]) AS NT01_NewsTitle, 
MAX([NNT_DataCenter_2].[dbo].[NT01_News].[NT01_ViewCount]) AS NT01_ViewCount, 
MAX([NNT_DataCenter_2].[dbo].[NT01_News].[NT02_TypeID]) AS NT02_TypeID, 
MAX([NNT_DataCenter_2].[dbo].[SC03_User].[SC03_FName]) AS SC03_FName, 
MAX([NNT_DataCenter_2].[dbo].[NT10_VDO].[NT10_FileStatus]) AS NT10_FileStatus, 
MAX([NNT_DataCenter_2].[dbo].[NT11_Picture].[NT11_FileStatus]) AS NT11_FileStatus, 
MAX([NNT_DataCenter_2].[dbo].[NT12_Voice].[NT12_FileStatus]) AS NT12_FileStatus, 
MAX([NNT_DataCenter_2].[dbo].[NT13_OtherFile].[NT13_FileStatus]) AS NT13_FileStatus,
ROW_NUMBER() OVER (ORDER BY MAX([NNT_DataCenter_2].[dbo].[NT01_News].[NT01_NewsID]) DESC) AS 'RowNumber' 
 
 FROM [NNT_DataCenter_2].[dbo].[NT01_News]
 LEFT JOIN [NNT_DataCenter_2].[dbo].[NT02_NewsType] ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID 
 LEFT JOIN [NNT_DataCenter_2].[dbo].[SC03_User] ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
 LEFT JOIN [NNT_DataCenter_2].[dbo].[NT10_VDO] ON NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
 LEFT JOIN [NNT_DataCenter_2].[dbo].[NT11_Picture] ON NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
 LEFT JOIN [NNT_DataCenter_2].[dbo].[NT12_Voice] ON NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
 LEFT JOIN [NNT_DataCenter_2].[dbo].[NT13_OtherFile] ON NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID 
 
 WHERE [NNT_DataCenter_2].[dbo].[NT01_News].[NT08_PubTypeID] = '11' 
 AND [NNT_DataCenter_2].[dbo].[NT02_NewsType].[NT02_Status] = 'Y' 
 AND [NNT_DataCenter_2].[dbo].[NT01_News].[NT01_Status] = 'Y' 
 AND [NNT_DataCenter_2].[dbo].[NT01_News].[NT02_TypeID] IN ('1') group by NT01_News.NT01_NewsID 
)

 SELECT * from LIMIT WHERE RowNumber BETWEEN 0 AND 20