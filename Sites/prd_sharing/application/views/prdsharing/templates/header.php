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
    
    <link href="css/uploadfile.css" rel="stylesheet">
    
	<script src="js/jqueryui/jquery-1.10.2.js"></script>
	<link rel="stylesheet" href="css/jqueryui/jquery-ui-1.10.4.custom.min.css">
	<script src="js/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	
	<script src="js/jquery.uploadfile.min.js"></script>
	
    <link href="css/reset.css" rel="stylesheet" charset="utf-8">
    <link href="css/style.css" rel="stylesheet" charset="utf-8">
    <script src="js/ckeditor.js"></script>
<?php
    if($title == "Sent News"){
 	   ?><link rel="stylesheet" href="css/sample.css"><?php
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
                        <img src="images/NNT_logo.png" alt="Logo" style="width:110px;">
                        <h1>
                            <label class="th">ระบบช่องทางเผยแพร่ ข้อมูลข่าวสาร</br>
                            <span class="bold">หน่วยงานภาครัฐ กรมประชาสัมพันธ์</span></label>
                        </h1>
                        <img src="images/sh_logo_header.png" alt="Logo" style="width:100%">
                    </div>
                </div>
            </div>
        </div>
    <!-- Content -->
        <div class="wrapper">
            <div class="content">
                <div class="welcome">
                    <p><b style=" color: #0808A7;font-weight: bold;">Welcome to: </b><span style="color: #0404F5;">admin</span> | <a href="index">logout</a></p>
                </div>
                <div class="menu">
                    <ul> 
                        <li class="menu-item <?php if($title == "Home"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="homePRD">Home</a><?php
                        	/*
                        	if(!($title == "Home")){
                        		?><a href="homePRD"><?php
                        	}
                        			?>Home<?php 
                        	if(!($title == "Home PRD")){
                        			?></a><?php
                        	}
							*/
							
                        ?></li>
                        <li class="menu-item <?php if($title == "Sent News"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="sentNew">Send News</a><?php
							/*
                        	if(!($title == "Sent News")){
                        		?><a href="sentNew"><?php
                        	}
                    				?>Send News<?php
                    		if(!($title == "Sent News")){
                        		?></a><?php
							}
							*/
                        ?></li>
                        <li class="menu-item <?php if($title == "RSS Feed"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="rss">Rss Feed</a><?php
                        	/*
                        	if(!($title == "RSS Feed")){
                        		?><a href="rss"><?php
							}
                        			?>Rss Feed<?php
                        	if(!($title == "RSS Feed")){
                        		?></a><?php
							}
							*/
                        ?></li>
                        <li class="menu-item <?php if($title == "Manage News"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="manageNewPRD">Manage News</a><?php
							if(!($title == "Manage News")){
                        		?><a href="manageNewPRD"><?php
							}
                        			?>Manage News<?php
                        	if(!($title == "Manage News")){
                        		?></a><?php
							}
                        ?></li>
                        <li class="menu-item <?php if($title == "Manage Users"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="manageUser">Manage User</a><?php
                        	if(!($title == "Manage Users")){
	                        	?><a href="manageUser"><?php
							}
	                        		?>Manage User<?php
	                        if(!($title == "Manage Users")){
	                        	?></a><?php
							}
                        ?></li>
                        
                        <li class="menu-item <?php if($title == "Manage Info"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="manageInfo_Category">Manage Info</a><?php
                        	if(!($title == "Manage Info")){
                        		?><a href="manageInfo_Category"><?php
							}
                        			?>Manage Info<?php
                    		if(!($title == "Manage Info")){
                        		?></a><?php
							}
                        ?></li>
                        <li class="menu-item <?php if($title == "Report"){ ?>onClick<?php } else{ ?>click<?php } ?>"><a href="reportPRD">Report</a><?php
                        	if(!($title == "Report")){
                        		?><a href="reportPRD"><?php
							}
                        		?>Report<?php
                    		if(!($title == "Report")){
                    			?></a><?php
							}
                    	?></li>
                    </ul>
                </div>
            </div>