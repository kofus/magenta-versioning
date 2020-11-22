<?php

namespace Kofus\Versioning\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class VersioningHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected $sm;
    
    public function __invoke()
    {
        return $this->getServiceLocator()->get('KofusVersioningService');
    }
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
    	$this->sm = $serviceLocator;
    }
    
    public function getServiceLocator()
    {
    	return $this->sm->getServiceLocator();
    }
    
}


