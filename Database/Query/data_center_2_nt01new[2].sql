WITH LIMIT AS( 

SELECT NT01_News.NT01_NewsID, 
MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
MAX(NT01_News.NT01_ViewCount) AS NT01_ViewCount, 
MAX(NT01_News.NT02_TypeID) AS NT02_TypeID, 
MAX(SC03_User.SC03_FName) AS SC03_FName, 
MAX(NT10_VDO.NT10_FileStatus) AS NT10_FileStatus, 
MAX(NT11_Picture.NT11_FileStatus) AS NT11_FileStatus, 
MAX(NT12_Voice.NT12_FileStatus) AS NT12_FileStatus, 
MAX(NT13_OtherFile.NT13_FileStatus) AS NT13_FileStatus, ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber' 

FROM [NNT_DataCenter_2].[dbo].[NT01_News]  

INNER JOIN [NNT_DataCenter_2].[dbo].NT02_NewsType ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID 
INNER JOIN [NNT_DataCenter_2].[dbo].SC03_User ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
INNER JOIN [NNT_DataCenter_2].[dbo].NT10_VDO ON NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
INNER JOIN [NNT_DataCenter_2].[dbo].NT11_Picture ON NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
INNER JOIN [NNT_DataCenter_2].[dbo].NT12_Voice ON NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
INNER JOIN [NNT_DataCenter_2].[dbo].NT13_OtherFile ON NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID 

WHERE NT08_PubTypeID = '11' AND NT02_NewsType.NT02_Status = 'Y' AND NT01_News.NT01_Status = 'Y' AND NT01_News.NT02_TypeID IN ('1','2','5','6','7','3','4','17','16','15','14','13','12','11','10','8','9') group by NT01_News.NT01_NewsID ) SELECT * from LIMIT WHERE RowNumber BETWEEN 0 AND 20