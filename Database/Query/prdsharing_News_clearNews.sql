UPDATE [ringzero_ait_prd_sharing].[dbo].[News]
   SET
     News_Title = '',
     News_Detail = '',
     News_Date = '',
     News_UpdateID = 0
 WHERE
	News_UpdateID > 0
GO
