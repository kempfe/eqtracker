<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ParserController extends AbstractActionController
{
    
    public function indexAction() {
        if(isset($_FILES['logfile'])){
            $handle = fopen($_FILES['logfile']['tmp_name'], "r");
            if ($handle) {
                while (($buffer = fgets($handle, 4096)) !== false) {
                   preg_match("/\[(.*)\] <SYSTEMWIDE_MESSAGE>: (.*) has/",$buffer,$matches);
                   if($matches){
                       $date = date_create_from_format("D M d H:i:s Y", $matches[1]);
                       $npcName = $matches[2];
                       $npcMapper = $this->getServiceLocator()->get("DB\Mapper\NPC");
                       $killMapper = $this->getServiceLocator()->get("DB\Mapper\Kill");
                       $npc = $npcMapper->findByName($npcName);
                       if($npc){
                           $killMapper->cleanNPC($npc);
                           
                           $kill = new \DB\Entity\Kill;
                           
                           $kill->setCrDate($date);
                           
                           $spawnTime = clone $date;
                           $spawnTime->add(new \DateInterval("PT".$npc->getSpawnInterval()."M"));
                           $kill->setSpawnTime($spawnTime);
                           $kill->setNpc($npc);
                           $kill->setSpawnInterval($npc->getSpawnWindow());
                           $npc->setKill($kill);
                          $npcMapper->update($kill);
                       }
                   }
                }
                if (!feof($handle)) {
                    echo "Error\n";
                }
                fclose($handle);
            }
            exit();
        }
    }
    
}