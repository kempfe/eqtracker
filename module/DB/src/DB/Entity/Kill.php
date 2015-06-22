<?php

namespace DB\Entity;

/**
 * Kill
 */
class Kill
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DB\Entity\NPC
     */
    private $npc;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set npc
     *
     * @param \DB\Entity\NPC $npc
     *
     * @return Kill
     */
    public function setNpc(\DB\Entity\NPC $npc = null)
    {
        $this->npc = $npc;

        return $this;
    }

    /**
     * Get npc
     *
     * @return \DB\Entity\NPC
     */
    public function getNpc()
    {
        return $this->npc;
    }
    /**
     * @var \DateTime
     */
    private $crDate;

    /**
     * @var \DateTime
     */
    private $spawnTime;

    /**
     * @var integer
     */
    private $spawnInterval;


    /**
     * Set crDate
     *
     * @param \DateTime $crDate
     *
     * @return Kill
     */
    public function setCrDate($crDate)
    {
        $this->crDate = $crDate;

        return $this;
    }

    /**
     * Get crDate
     *
     * @return \DateTime
     */
    public function getCrDate()
    {
        return $this->crDate;
    }

    /**
     * Set spawnTime
     *
     * @param \DateTime $spawnTime
     *
     * @return Kill
     */
    public function setSpawnTime($spawnTime)
    {
        $this->spawnTime = $spawnTime;

        return $this;
    }

    /**
     * Get spawnTime
     *
     * @return \DateTime
     */
    public function getSpawnTime()
    {
        return $this->spawnTime;
    }

    /**
     * Set spawnInterval
     *
     * @param integer $spawnInterval
     *
     * @return Kill
     */
    public function setSpawnInterval($spawnInterval)
    {
        $this->spawnInterval = $spawnInterval;

        return $this;
    }

    /**
     * Get spawnInterval
     *
     * @return integer
     */
    public function getSpawnInterval()
    {
        return $this->spawnInterval;
    }
}
