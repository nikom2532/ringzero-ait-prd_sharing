INSERT INTO [NNT_PRD_Sharing].[dbo].[Member]
           ([Mem_Name]
           ,[Mem_LasName]
           ,[Mem_EngName]
           ,[Mem_EngLasName]
          
           ,[Mem_Username]
           ,[Mem_Password]
           ,[Mem_Status]
           ,[Group_ID]
           )
     VALUES
           (
           'ผู้ดูแล',
           'ระบบ',
           'super',
           'admin',
           
           'admin1',
           'ad1min',
           1,
           2
           )
GO