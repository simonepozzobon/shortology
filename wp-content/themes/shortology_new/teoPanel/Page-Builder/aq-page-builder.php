<?php
 /**
 * Copyright (c) 2013 Syamil MJ. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

//definitions
if(!defined('AQPB_VERSION')) define( 'AQPB_VERSION', '1.1.2' );
if(!defined('AQPB_PATH')) define( 'AQPB_PATH', get_template_directory() . '/teoPanel/Page-Builder/' );
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', get_template_directory_uri() . '/teoPanel/Page-Builder/' );

//required functions & classes
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'functions/aqpb_blocks.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');
//require_once(AQPB_PATH . 'classes/class-aq-plugin-updater.php');
require_once(AQPB_PATH . 'functions/aqpb_functions.php');

//some default blocks
require_once(AQPB_PATH . 'blocks/aq-text-block.php');
require_once(AQPB_PATH . 'blocks/aq-column-block.php');
require_once(AQPB_PATH . 'blocks/aq-clear-block.php');
require_once(AQPB_PATH . 'blocks/aq-widgets-block.php');
require_once(AQPB_PATH . 'blocks/aq-alert-block.php');
require_once(AQPB_PATH . 'blocks/aq-tabs-block.php');
require_once(AQPB_PATH . 'blocks/aq-skills-block.php');
require_once(AQPB_PATH . 'blocks/aq-quoteslider-block.php');
require_once(AQPB_PATH . 'blocks/aq-slider-block.php');
require_once(AQPB_PATH . 'blocks/aq-filterableportfolio-block.php');
require_once(AQPB_PATH . 'blocks/aq-portfolio-block.php');
require_once(AQPB_PATH . 'blocks/aq-button-block.php');
require_once(AQPB_PATH . 'blocks/aq-testimonial-block.php');
require_once(AQPB_PATH . 'blocks/aq-pricingtable-block.php');
require_once(AQPB_PATH . 'blocks/aq-team-block.php');
require_once(AQPB_PATH . 'blocks/aq-service-block.php');
//require_once(AQPB_PATH . 'blocks/aq-richtext-block.php'); //buggy

//register default blocks
aq_register_block('AQ_Text_Block');
//aq_register_block('AQ_Richtext_Block'); //buggy
aq_register_block('AQ_Column_Block');
aq_register_block('AQ_Clear_Block');
aq_register_block('AQ_Widgets_Block');
aq_register_block('AQ_Alert_Block');
aq_register_block('AQ_Tabs_Block');
aq_register_block('AQ_Skills_Block');
aq_register_block('AQ_QuoteSlider_Block');
aq_register_block('AQ_Slider_Block');
aq_register_block('AQ_FilterablePortfolio_Block');
aq_register_block('AQ_Portfolio_Block');
aq_register_block('AQ_Button_Block');
aq_register_block('AQ_Testimonial_Block');
aq_register_block('AQ_PricingTable_Block');
aq_register_block('AQ_Team_Block');
aq_register_block('AQ_Service_Block');

//fire up page builder
$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);
if(!is_network_admin()) $aq_page_builder->init();
