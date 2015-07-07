<?php

namespace DB\Mapper;


class KillLogMapper extends \DB\Mapper\AbstractMapper{
    
    protected $entityName = 'DB\Entity\KillLog';
    
    public function getLog($options = []){
        $defaults = [
            'limit' => 50,
            'page' => 1
        ];
        $settings = array_merge($defaults,$options);
        
        $sql = $this->getEntityRepository()->createQueryBuilder("k");
        $sql->orderBy("k.crDate","DESC");
        if($settings['npcFilter']){
            $sql->andWhere("IDENTITY(k.npc) = :npc");
            $sql->setParameter('npc',$settings['npcFilter']);
        }
        $sql->select("COUNT(k.id) as ctn");
        $count = $sql->getQuery()->getSingleScalarResult();
        
        $sql->select("k");
        $sql->setMaxResults($settings['limit']);
        $sql->setFirstResult(($settings['page'] - 1) * $settings['limit']);

        return ['result' => $sql->getQuery()->getResult(), 'count' => (int)$count];
    }
}