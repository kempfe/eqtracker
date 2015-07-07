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
use Zend\View\Model\JsonModel;

class ParserController extends AbstractActionController
{
    
    public function indexAction() {
        if(isset($_FILES['logfile'])){
            $handle = fopen($_FILES['logfile']['tmp_name'], "r");
            if ($handle) {
                while (($buffer = fgets($handle, 4096)) !== false) {
                   preg_match("/\[(.*)\] <SYSTEMWIDE_MESSAGE>: (.*) has/",$buffer,$matches);
                   preg_match("/\[(.*)\].*<<KILL-LOG>> (.*)/",$buffer,$matches2);
                   if($matches || $matches2){
                       if($matches2){
                           $matches = $matches2;
                       }
                       $date = date_create_from_format("D M d H:i:s Y", $matches[1]);
                       $npcName = rtrim($matches[2],"'\r");
                       
                       $npcMapper = $this->getServiceLocator()->get("DB\Mapper\NPC");
                       $killMapper = $this->getServiceLocator()->get("DB\Mapper\Kill");
                       $npc = $npcMapper->findByName($npcName);
                       if($npc){
                           
                           if($npc->getKill() && $npc->getKill()->getCrDate() > $date) continue;
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
                       }else{
                           $return[] = sprintf("( %s ) - Kill registered but NPC could not be found ",$npcName);
                       }
                   }
                }
                if (!feof($handle)) {
                    echo "Error\n";
                }
                fclose($handle);
            }
            echo json_encode($return);
            exit();
        }
    }
    
    public function addkillAction(){
        $npc = $this->params()->fromPost('npc');
        $killtime = $this->params()->fromPost("killtime");
        
        if( $npc && $killtime){
            $date = date_create_from_format("D M d H:i:s Y", $killtime);
            $npcName = rtrim($npc,"'\r");
            $npcMapper = $this->getServiceLocator()->get("DB\Mapper\NPC");
            $killMapper = $this->getServiceLocator()->get("DB\Mapper\Kill");
            $npc = $npcMapper->findByName($npcName);
            if($npc){
                if($npc->getKill() && $npc->getKill()->getCrDate() >= $date) return new JsonModel(['statusMessage' => sprintf("Old Kill from NPC '%s'",$npcName),'statusCode' => 1]);
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
               
               // Add to Kill Log
               $killLog = new \DB\Entity\KillLog();
               $killLog->setCrDate($date);
               $killLog->setNpc($npc);
               $npcMapper->insert($killLog);
               
               return new JsonModel(['statusMessage' => sprintf("Kill of '%s' successful added",$npcName),'statusCode' => 0]);
            }
            return new JsonModel(['statusMessage' => sprintf("NPC with name '%s' not found",$npcName),'statusCode' => 2]);
        }
        return new JsonModel(['statusMessage' => 'Error','statusCode' => 3]);
    }
}