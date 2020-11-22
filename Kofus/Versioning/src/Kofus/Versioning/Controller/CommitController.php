<?php
namespace Kofus\Versioning\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter\Boolean;



class CommitController extends AbstractActionController
{
    public function listAction()
    {
        $vercs = $this->nodes()->createQueryBuilder('VINGC')
            ->orderBy("n.timestamp", "DESC")
            ->getQuery()->getResult();
        return new ViewModel(array(
            'entities' => $vercs
        ));
    }
    
    public function editAjaxAction()
    {
        $entity = $this->nodes()->getNode($this->params('id'), 'VINGC');
        $filterBoolean = new Boolean(array('type' => array(
            Boolean::TYPE_FALSE_STRING
        )));
        $value = $this->getRequest()->getPost('value');
        $boolValue = $filterBoolean->filter($value);
        switch ($this->getRequest()->getPost('name')) {
            case 'key-x':
                $entity->setKeyX($value);
                break;
            case 'key-y':
                $entity->setKeyY($value);
                break;
            case 'product':
                $entity->setProductId($value);
                break;
        }
        $this->em()->persist($entity);
        $this->em()->flush();
        exit();
    }
    
    
   
}
