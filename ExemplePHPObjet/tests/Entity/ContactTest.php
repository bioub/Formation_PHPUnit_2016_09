<?php

namespace SmalsTest\Entity;

use PHPUnit\Framework\TestCase;
use Smals\Entity\Contact;

class ContactTest extends TestCase
{
    /**
     * @var Contact
     */
    protected $contact;

    protected function setUp()
    {
        $this->contact = new Contact();
    }

    public function testPrenom() {
        $this->assertNull($this->contact->getPrenom());
        $this->assertEquals($this->contact, $this->contact->setPrenom('Romain'));
        $this->assertEquals('Romain', $this->contact->getPrenom());
    }

    public function testNom() {
        $this->assertNull($this->contact->getNom());
        $this->assertEquals($this->contact, $this->contact->setNom('Bohdanowicz'));
        $this->assertEquals('Bohdanowicz', $this->contact->getNom());
    }
}