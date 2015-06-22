<?php

namespace DB\Mapper;


class KillMapper extends \DB\Mapper\AbstractMapper{
    
    protected $entityName = 'DB\Entity\Kill';
    
    public function getActiveNPCList(){
        $sql = $this->getEntityRepository()->createQueryBuilder("k");
        $sql->join("DB\Entity\NPC","n","WITH","k.npc = n.id");
        $sql->orderBy("k.spawnTime","ASC");
        return $sql->getQuery()->getResult();
    }
    
    public function cleanNPC(\DB\Entity\NPC $npc){
        $sql = $this->getEntityRepository()->createQueryBuilder("k");
        $sql->delete();
        $sql->andWhere("k.npc = :npc");
        $sql->setParameter("npc", $npc);
        $sql->getQuery()->execute();
    }
}