		<title>
			<?php
				$pagetitle = $this->getPageTitle();
				//TODO: $default = $AppContext->PageTemplates->GetDefaultPageTitle()
				$default = "JANATEC | Web-based Solutions, Internet Strategy, E-Government, Product Engineering, Enterprise Integration, ICT Consulting - Janatec.com";
				$pagetitle = ForceString($pagetitle, $default);

				echo $pagetitle;
			?>
		</title>