<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 15/09/2016
 * Time: 16:22
 */

namespace AppBundle\Manager;


use Doctrine\ORM\EntityManager;

class ContactManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ContactManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAll() {
        $repo = $this->em->getRepository('AppBundle:Contact');
        return $repo->findAll();
    }
}