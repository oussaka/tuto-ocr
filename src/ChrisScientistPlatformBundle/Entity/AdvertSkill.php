<?php

namespace ChrisScientistPlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdvertSkill
 *
 * @ORM\Table(name="advert_skill")
 * @ORM\Entity(repositoryClass="ChrisScientistPlatformBundle\Repository\AdvertSkillRepository")
 */
class AdvertSkill
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

    /**
     *
     * @var type ChrisScientistPlatformBundle\Entity\Advert
     * 
     * @ORM\ManyToOne(targetEntity="ChrisScientistPlatformBundle\Entity\Advert")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advert ;
    
    /**
     *
     * @var type ChrisScientistPlatformBundle\Entity\Skill
     * 
     * @ORM\ManyToOne(targetEntity="ChrisScientistPlatformBundle\Entity\Skill")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill ;

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
     * Set level
     *
     * @param string $level
     * @return AdvertSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set advert
     *
     * @param \ChrisScientistPlatformBundle\Entity\Advert $advert
     * @return AdvertSkill
     */
    public function setAdvert(\ChrisScientistPlatformBundle\Entity\Advert $advert)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \ChrisScientistPlatformBundle\Entity\Advert 
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Set skill
     *
     * @param \ChrisScientistPlatformBundle\Entity\Skill $skill
     * @return AdvertSkill
     */
    public function setSkill(\ChrisScientistPlatformBundle\Entity\Skill $skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \ChrisScientistPlatformBundle\Entity\Skill 
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
