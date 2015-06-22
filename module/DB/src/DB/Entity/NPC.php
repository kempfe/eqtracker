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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $kills;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add kill
     *
     * @param \DB\Entity\Kill $kill
     *
     * @return NPC
     */
    public function addKill(\DB\Entity\Kill $kill)
    {
        $this->kills[] = $kill;

        return $this;
    }

    /**
     * Remove kill
     *
     * @param \DB\Entity\Kill $kill
     */
    public function removeKill(\DB\Entity\Kill $kill)
    {
        $this->kills->removeElement($kill);
    }

    /**
     * Get kills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKills()
    {
        return $this->kills;
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
}
