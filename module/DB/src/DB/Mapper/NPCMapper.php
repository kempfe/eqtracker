<?php

namespace DB\Mapper;


class NPCMapper extends \DB\Mapper\AbstractMapper{
    
    protected $entityName = 'DB\Entity\NPC';
    
    public function getActiveNPCList(){
        $sql = $this->getEntityRepository()->createQueryBuilder("n");
        $sql->join("DB\Entity\Kill","k","WITH","k.npc = n.id");
        $sql->orderBy("k.spawnTime","DESC");
        return $sql->getQuery()->getResult();
    }
    
    
}