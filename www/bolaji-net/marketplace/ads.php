<?php
		switch(strtolower($_REQUEST['cc']))
		{
			case 'travel' : 
						include(dirname(__FILE__)."/../includes/ads/travel/txtimg_468x60.php"); 
						break;

			case 'cars' : 
						include(dirname(__FILE__)."/../includes/ads/cars/txtimg_468x60.php"); 
						break;

			case 'health-and-beauty' : 
						include(dirname(__FILE__)."/../includes/ads/health-beauty/txtimg_468x60.php"); 
						break;

			case 'electronics'	:
			case 'computers' : 
						include(dirname(__FILE__)."/../includes/ads/computers/txtimg_468x60.php"); 
						break;

			case 'fashion' : 
						include(dirname(__FILE__)."/../includes/ads/fashion/txtimg_468x60.php"); 
						break;

			case 'finance' : 
						include(dirname(__FILE__)."/../includes/ads/finance/txtimg_468x60.php"); 
						break;

			case 'jobs' : 
						include(dirname(__FILE__)."/../includes/ads/jobs/txtimg_468x60.php"); 
						break;


			case 'misc' : 
						include(dirname(__FILE__)."/../includes/ads/misc/txtimg_468x60.php"); 
						break;


			case 'real-estate' : 
						include(dirname(__FILE__)."/../includes/ads/real-estate/txtimg_468x60.php"); 
						break;

			default	: 
						include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php");
					 	break;
		}
?>