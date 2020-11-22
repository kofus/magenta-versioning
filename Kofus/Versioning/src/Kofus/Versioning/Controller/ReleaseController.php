<?php
namespace Kofus\Versioning\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter\Boolean;



class ReleaseController extends AbstractActionController
{
    public function listAction()
    {
        $this->autoCreateReleases();
        
        $entities = $this->nodes()->createQueryBuilder('VINGR')->getQuery()->getResult();
        return new ViewModel(array(
            'entities' => $entities
        ));
    }
    
    public function editAjaxAction()
    {
        $entity = $this->nodes()->getNode($this->params('id'), 'VINGR');
        $filterBoolean = new Boolean(array('type' => array(
            Boolean::TYPE_FALSE_STRING
        )));
        $value = $this->getRequest()->getPost('value');
        $boolValue = $filterBoolean->filter($value);
        switch ($this->getRequest()->getPost('name')) {
            case 'title':
                $entity->setTitle($value);
                break;
        }
        $this->em()->persist($entity);
        $this->em()->flush();
        exit();
    }
    
    
    protected function autoCreateReleases()
    {
        $commits = $this->nodes()->createQueryBuilder('VINGC')->where('n.keyY IS NOT NULL')->getQuery()->getResult();
        foreach ($commits as $commit) {
            $release = $this->nodes()->getRepository('VINGR')->findOneBy(array('releaseType' => 'Y', 'token' => $commit->getKeyY()));
            if (! $release) {
                $release = new \Kofus\Versioning\Entity\ReleaseEntity();
                $release->setToken($commit->getKeyY());
                $release->setReleaseType('Y');
                $this->em()->persist($release);
                $this->em()->flush();
            }
        }
    }
    
    
  
}
