<?php

namespace ChrisScientistUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser ;

/**
 * Utilisateur
 *
 * @ORM\Entity
 */
class Utilisateur extends BaseUser
{

	public function __construct()
	{
	    $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
	    $this->enabled = false;
	    $this->locked = false;
	    $this->expired = false;
	    $this->roles = array();
	    $this->credentialsExpired = false;
	}

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}
