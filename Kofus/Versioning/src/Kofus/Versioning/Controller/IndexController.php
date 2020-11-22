<?php
namespace Kofus\Versioning\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter\Boolean;



class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        
    }
    
    public function rebuildAction()
    {
        $versioning = $this->getServiceLocator()->get('KofusVersioningService');
        $commits = $this->nodes()->getRepository('VINGC')->findAll();
        foreach ($commits as $commit) {
            $version = explode('.', $versioning->calcNumber($commit));
            $commit->setX($version[0]);
            $commit->setY($version[1]);
            $commit->setZ($version[2]);
            $this->em()->persist($commit);
        }
        $this->em()->flush();
        return $this->redirect()->toRoute('kofus_versioning', array('controller' => 'index', 'action' => 'index'));
    }
    
    public function importAction()
    {
        // Import
        exec('git --no-pager log', $output);
        
        $commit = null;
        $msg = array();
        
        foreach ($output as $line) {
            // Hash
            if (preg_match('/^commit ([0-9a-z]+)$/i', $line, $matches)) {
                $hash = $matches[1];
                
                // Finalize last commit
                if ($commit) {
                    $commit->setMessage(implode("\n", $msg));
                    $this->em()->persist($commit);
                    $msg = array();
                }
                
                // Begin new commit
                $commit = $this->nodes()->getRepository('VERC')->findOneBy(array('hash' => $hash));
                if (! $commit) {
                    $commit = new \Kofus\Versioning\Entity\CommitEntity();
                    $commit->setHash($hash);
                }
                // Author
            } elseif (preg_match('/^Author: (.+)$/', $line, $matches)) {
                $commit->setAuthor($matches[1]);
                
                // Date
            } elseif (preg_match('/^Date: (.+)$/', $line, $matches)) {
                $dt = \DateTime::createFromFormat('D M j H:i:s Y O', trim($matches[1]));
                if (! $dt) throw new \Exception('Parsing error: date ' . trim($matches[1]));
                $commit->setTimestamp($dt);
                
                // Message
            } elseif (trim($line)) {
                $msg[] = trim($line);
            }
        }
        
        // Finalize last commit
        if ($commit) {
            $commit->setMessage(implode("\n", $msg));
            $this->em()->persist($commit);
            $msg = array();
        }
        $this->em()->flush();
        
        
        die();
    }
}
