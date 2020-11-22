<?php 
namespace Kofus\Versioning\Service;
use Kofus\System\Service\AbstractService;
use Kofus\Versioning\Entity\CommitEntity;

class VersioningService extends AbstractService
{
    public function calcNumber(CommitEntity $entity)
    {
        $product = 0;
        $x = 0;
        $y = 0;
        $z = 0;
        
        $results = $this->nodes()->createQueryBuilder('VINGC')
            ->where('n.timestamp <= :timestamp')
            ->setParameter('timestamp', $entity->getTimestamp())
            ->orderBy('n.timestamp', 'ASC')
            ->getQuery()->getResult();
        
        
        $x = 'dev';
        $y = null;
        $z = null;
        
        $keys = array(
            'x' => array('dev'),
            'y' => array(),
            'z' => array()
        );
        
        foreach ($results as $result) {
            if ($result->getKeyX()) {
                $x = $result->getKeyX();
                if (! in_array($x, $keys['x'])) {
                    $keys['x'][] = $x;
                }
                if (! isset($keys['y'][$x])) $keys['y'][$x] = array();
            }
            if ($result->getKeyY()) {
                $y = $result->getKeyY();
                if (! isset($keys['y'][$x])) $keys['y'][$x] = array();
                if (! in_array($y, $keys['y'][$x])) {
                    $keys['y'][$x][] = $y;
                }
            }
            if ($y) {
                if (isset($keys['z'][$x][$y])) {
                    $keys['z'][$x][$y] = $keys['z'][$x][$y] + 1;
                } else {
                    $keys['z'][$x][$y] = 0;
                }
            }
        }
        
        $indexY = array_search($keys['y'], $keys['y'][$x]);
        $indexX =(int) array_search($x, $keys['x']);
        
        return ($indexX)  . '.' . ($indexY + 1) . '.' . $keys['z'][$x][$y];
    }
    
    
}
