<?php

namespace DB\Entity;

/**
 * KillLog
 */
class KillLog
{
    /**
     * @var \DateTime
     */
    private $crDate;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DB\Entity\NPC
     */
    private $npc;


    /**
     * Set crDate
     *
     * @param \DateTime $crDate
     *
     * @return KillLog
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
     * @return KillLog
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
}
