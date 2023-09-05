<?php
namespace HideButtons;

use Omeka\Module\AbstractModule;
use Zend\Mvc\MvcEvent;

class Module extends AbstractModule
{
    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $eventManager->attach("render", [$this, "HideButtons"]);
    }

    public function HideButtons(MvcEvent $event)
    {
        //$viewModel = $event->getViewModel();
        $services = $event->getApplication()->getServiceManager();
        $auth = $services->get("Omeka\AuthenticationService");

        $user = $auth->getIdentity();

        if (!is_null($user)) {
            $myusername = $user->getName();

            $myRole = $user->getRole(); //eg global_admin, global_admin, site_admin, reviewer

            if ($myRole == "global_admin") {
                
                echo "
				
				<script>
							alert('HideButtons is active');
				  
							document.addEventListener('DOMContentLoaded', function() {
							  var buttons = document.querySelectorAll('a.button');
							  buttons.forEach(function(button) {
								if (button.textContent.trim() === 'Add new site') {
								  button.style.display = 'none';
								}
							  });
							});

							document.addEventListener('DOMContentLoaded', function() {
							  var buttons = document.querySelectorAll('button.option');
							  buttons.forEach(function(button) {
								if (button.value === 'd3Graph') {
								  button.style.display = 'none';
								}
								
								if (button.value === 'division') {
								  button.style.display = 'none';
								}
								
								if (button.value === 'externalContent') {
								  button.style.display = 'none';
								}
								
								if (button.value === 'buttons') {
								  button.style.display = 'none';
								}
								
								if (button.value === 'itemSetShowcase') {
								  button.style.display = 'none';
								}
								
								if (button.value === 'itemSetsTree') {
								  button.style.display = 'none';
								}
								
								if (button.value === 'jumbotron-search') {
								  button.style.display = 'none';
								}
								
								if (button.value === 'links') {
								  button.style.display = 'none';
								}
									
							  });
							});
				</script>";
            }
        }
    }
} 