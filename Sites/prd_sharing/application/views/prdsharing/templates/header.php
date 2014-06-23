<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- IE Compatibility modes -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!--   -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRDSHARING</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../favicon.ico"> 
    
    <link href="<?php echo base_url(); ?>css/uploadfile.css" rel="stylesheet">
    
	
	<script src="<?php echo base_url(); ?>js/jqueryui/jquery-1.10.2.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/jqueryui/jquery-ui-1.10.4.custom.min.css">
	<script src="<?php echo base_url(); ?>js/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	
	<script src="<?php echo base_url(); ?>js/jquery.uploadfile.min.js"></script>
	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
	
    <link href="<?php echo base_url(); ?>css/reset.css" rel="stylesheet" charset="utf-8">
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" charset="utf-8">
    <script src="<?php echo base_url(); ?>js/ckeditor.js"></script>
    
    <!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	
	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    
    <!-- Jquery Choosen -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/chosen.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/chosen.jquery.js"></script>
    
<?php
    if($title == "Sent News"){
 	   ?><link rel="stylesheet" href="<?php echo base_url(); ?>css/sample.css"><?php
	}
?>
</head>
<body>
    <div class="container">
    <!-- HEADER -->
        <div class="wrapper">
            <div class="bg-header">
                <div id="header">
                    <div class="logo">
                        <img src="<?php echo base_url(); ?>images/prdsharing_Login.png" alt="Logo" style="width:auto;">
                    </div>
                </div>
            </div>
        </div>
    <!-- Content -->
        <div class="wrapper">
            <div class="content">
                <div class="welcome">
                    <p><b style=" color: #0808A7;font-weight: bold;">Welcome to: </b><span style="color: #0404F5;"><?php echo $session_Mem_Title." ".$session_Mem_Name." ".$session_Mem_LasName; ?></span> | <a href="<?php echo base_url().index_page(); ?>logout">logout</a></p>
                </div>
                <div class="menu">
                    <ul> 
                        <li class="menu-item <?php if($title == "Home"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="<?php echo base_url().index_page(); ?>homePRD">Home</a><?php
                        	/*
                        	if(!($title == "Home")){
                        		?><a href="<?php echo base_url().index_page(); ?>homePRD"><?php
                        	}
                        			?>Home<?php 
                        	if(!($title == "Home PRD")){
                        			?></a><?php
                        	}
							*/
							
                        ?></li>
                        <li class="menu-item <?php if($title == "Sent News"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="<?php echo base_url().index_page(); ?>sentNew">Send News</a><?php
							/*
                        	if(!($title == "Sent News")){
                        		?><a href="<?php echo base_url().index_page(); ?>sentNew"><?php
                        	}
                    				?>Send News<?php
                    		if(!($title == "Sent News")){
                        		?></a><?php
							}
							*/
                        ?></li>
                        <li class="menu-item <?php if($title == "RSS Feed"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="<?php echo base_url().index_page(); ?>rss">Rss Feed</a><?php
                        	/*
                        	if(!($title == "RSS Feed")){
                        		?><a href="<?php echo base_url().index_page(); ?>rss"><?php
							}
                        			?>Rss Feed<?php
                        	if(!($title == "RSS Feed")){
                        		?></a><?php
							}
							*/
                        ?></li>
                        <li class="menu-item <?php if($title == "Manage News"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="<?php echo base_url().index_page(); ?>manageNewPRD">Manage News</a><?php
                        	/*
							if(!($title == "Manage News")){
                        		?><a href="<?php echo base_url().index_page(); ?>manageNewPRD"><?php
							}
                        			?>Manage News<?php
                        	if(!($title == "Manage News")){
                        		?></a><?php
							}
							*/
                        ?></li>
                        <li class="menu-item <?php if($title == "Manage Users"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="<?php echo base_url().index_page(); ?>manageUserPRD">Manage User</a><?php
                        	/*
                        	if(!($title == "Manage Users")){
	                        	?><a href="<?php echo base_url().index_page(); ?>manageUser"><?php
							}
	                        		?>Manage User<?php
	                        if(!($title == "Manage Users")){
	                        	?></a><?php
							}
							*/
                        ?></li>
                        
                        <li class="menu-item <?php if($title == "Manage Info"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="<?php echo base_url().index_page(); ?>manageInfo_Category">Manage Info</a><?php
                        	/*
                        	if(!($title == "Manage Info")){
                        		?><a href="<?php echo base_url().index_page(); ?>manageInfo_Category"><?php
							}
                        			?>Manage Info<?php
                    		if(!($title == "Manage Info")){
                        		?></a><?php
							}
							*/
                        ?></li>
                        <li class="menu-item <?php if($title == "Report"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="<?php echo base_url().index_page(); ?>reportPRD">Report</a><?php
                        	/*
                        	if(!($title == "Report")){
                        		?><a href="<?php echo base_url().index_page(); ?>reportPRD"><?php
							}
                        		?>Report<?php
                    		if(!($title == "Report")){
                    			?></a><?php
							}
							*/
                    	?></li>
                    </ul>
                </div>
            </div>