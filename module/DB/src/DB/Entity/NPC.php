<?php

namespace DB\Entity;

/**
 * NPC
 */
class NPC
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $spawnType;

    /**
     * @var integer
     */
    private $spawnInterval;

    /**
     * @var integer
     */
    private $spawnWindow;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return NPC
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set spawnType
     *
     * @param string $spawnType
     *
     * @return NPC
     */
    public function setSpawnType($spawnType)
    {
        $this->spawnType = $spawnType;

        return $this;
    }

    /**
     * Get spawnType
     *
     * @return string
     */
    public function getSpawnType()
    {
        return $this->spawnType;
    }

    /**
     * Set spawnInterval
     *
     * @param integer $spawnInterval
     *
     * @return NPC
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

    /**
     * Set spawnWindow
     *
     * @param integer $spawnWindow
     *
     * @return NPC
     */
    public function setSpawnWindow($spawnWindow)
    {
        $this->spawnWindow = $spawnWindow;

        return $this;
    }

    /**
     * Get spawnWindow
     *
     * @return integer
     */
    public function getSpawnWindow()
    {
        return $this->spawnWindow;
    }

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
     * Constructor
     */
    public function __construct()
    {
        $this->kills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var \DB\Entity\Zone
     */
    private $zone;


    /**
     * Set zone
     *
     * @param \DB\Entity\Zone $zone
     *
     * @return NPC
     */
    public function setZone(\DB\Entity\Zone $zone = null)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \DB\Entity\Zone
     */
    public function getZone()
    {
        return $this->zone;
    }
    
    
    public function getLastKill(){
        $kills = $this->getKills();
        return $kills->current();
    }


    /**
     * @var \DB\Entity\Kill
     */
    private $kill;


    /**
     * Set kill
     *
     * @param \DB\Entity\Kill $kill
     *
     * @return NPC
     */
    public function setKill(\DB\Entity\Kill $kill = null)
    {
        $this->kill = $kill;

        return $this;
    }

    /**
     * Get kill
     *
     * @return \DB\Entity\Kill
     */
    public function getKill()
    {
        return $this->kill;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $killLog;


    /**
     * Add killLog
     *
     * @param \DB\Entity\KillLog $killLog
     *
     * @return NPC
     */
    public function addKillLog(\DB\Entity\KillLog $killLog)
    {
        $this->killLog[] = $killLog;

        return $this;
    }

    /**
     * Remove killLog
     *
     * @param \DB\Entity\KillLog $killLog
     */
    public function removeKillLog(\DB\Entity\KillLog $killLog)
    {
        $this->killLog->removeElement($killLog);
    }

    /**
     * Get killLog
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKillLog()
    {
        return $this->killLog;
    }
}
