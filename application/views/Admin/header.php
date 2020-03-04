<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Water Plant</title>
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/font-awesome/4.5.0/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/jquery-ui.custom.min.css" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/chosen.min.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/bootstrap-datepicker3.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/jquery.gritter.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/fonts.googleapis.com.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/ace.min.css" type="text/css" class="ace-main-stylesheet" id="main-ace-style"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/jquery.dataTables.min.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/ace-skins.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/ace-rtl.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assests/css/grid.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assests/css/select2.min.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assests/js/ace-extra.min.js"></script>
		<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script> -->
        <script type="text/javascript" src="<?php echo base_url();?>assests/js/jquery-typeahead.js"></script> 
		<style>
			.center
			{
				text-align: center;
			}
			.center [class*="col-"]
			{
				margin-top: 2px;
				margin-bottom: 2px;
				position: relative;
				text-overflow: ellipsis;
			}
			.center [class*="col-"]  div
			{
			  position: relative;
			  z-index: 2;
			  padding-top: 4px;
			  padding-bottom: 4px;
			  display: block;
			  overflow: hidden;
			  text-overflow: ellipsis;
			  white-space: nowrap;
			  width: 100%;
			}
			.center [class*="col-"]  div span
			{
			  position: relative;
			  z-index: 2;
			}
			.center [class*="col-"] div:before
			{
				display: block;
				content: "";
				position: absolute;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
				z-index: 1;
				border: 1px solid #DDD;
			}
			.center [class*="col-"] div:hover:before
			{
				background-color: #FCE6A6;
				border-color: #EFD27A;
			}
			.pagination a
			{
		     background-color: #f0f0e9;
		     border: medium none;
		     color: #444;
			}
			.pagination a
			{
			     cursor: default;
			     float: left;
			     line-height: 1.42857;
			     margin-right: 5px;
			     padding: 6px 12px;
			     position: relative;
			     text-decoration: none;
			     z-index: 2;
			}
			.pagination strong,.pagination a:hover
			{
			     background-color: #0f90fe;
			     border-color: #fe980f;
			     color: #ffffff;
			     cursor: default;
			     float: left;
			     line-height: 1.42857;
			     margin-right: 5px;
			     padding: 6px 12px;
			     position: relative;
			     text-decoration: none;
			     z-index: 2;
			}
			.pag
			{
			     display: table;
			     margin: 0 auto;
			}
			@media print{
			 .noPrint {
					display: none;
				}
			}
			.mandatory{
				color: red;
			}
			.checkColor{
				background-color: red;
			}
            select[disabled]{
              background-color:#eee !important;
            }
            textarea[disabled]{
              background-color:#eee !important;
            }
		</style>
    </head>
    <body class="no-skin">	
        <div id="navbar" class="navbar navbar-default ace-save-state noPrint">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header pull-left">
                    <a href="<?php echo base_url();?>Admin" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            Water Plant
                        </small>
                    </a>
                </div>
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span class="user-info">
                                    <small>Welcome, Uvip</small>
                                </span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="#">
                                        <a href="<?php echo base_url(); ?>Admin/logout"><i class="ace-icon fa fa-power-off"></i>Logout</a>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-container ace-save-state" id="main-container">