/****** Script for SelectTopNRows command from SSMS  ******/
SELECT TOP 1000 [NT01_News].[NT01_NewsID],
[NT01_News].[NT01_NewsTitle]
      
  FROM [NNT_DataCenter_2].[dbo].[NT01_News]
  
  JOIN [NNT_DataCenter_2].[dbo].NT12_Voice
					ON NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID
   JOIN [NNT_DataCenter_2].[dbo].NT02_NewsType ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID 
  where [NT01_News].[NT08_PubTypeID] = '11'
AND NT02_NewsType.NT02_Status = 'Y' 
AND NT01_News.NT01_Status = 'Y' 
AND NT01_News.NT02_TypeID IN ('1','2','5','6','7','3','4','17','16','15','14','13','12','11','10','8','9')