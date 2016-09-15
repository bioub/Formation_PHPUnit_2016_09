<?php

namespace SmalsTest\Entity;

require_once __DIR__ . '/../../src/Entity/Contact.php';

use PHPUnit\Framework\TestCase;
use Smals\Entity\Contact;

class ContactTest extends TestCase
{
    public function testPrenom() {
        $contact = new Contact();

        $this->assertNull($contact->getPrenom());
        $this->assertEquals($contact, $contact->setPrenom('Romain'));
        $this->assertEquals('Romain', $contact->getPrenom());
    }
}