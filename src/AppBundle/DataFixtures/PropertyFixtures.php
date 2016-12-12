<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Property;

class PropertyFixtures extends AbstractFixture 
{
    public function load(ObjectManager $manager)
    {
        $color = 'white';
        $dateBuilt = null;
        $hasHoaLien = false;
        $isOccupied = true;
        $status = 'Owner';
        $bm = 'Brandy Mill Drive';
        $sf = 'Spring Flower Way';
        $sb = 'Spring Brook Court';
        $lH = 'Lavender Hill Drive';
        $cl = 'Cosmos Lane';
        $type = 'Residential';
        
//Brandy Mill:        
        
        $lot = new Property();
        $lot->setColor($color);
        $lot->setDateBuilt($dateBuilt);
        $lot->setHasHoaLien($hasHoaLien);
        $lot->setHouseNumber('100');
        $lot->setIsOccupied($isOccupied);
        $lot->setLotNumber('1');
        $lot->setStatus($status);
        $lot->setStreet($bm);
        $lot->setType($type);
        $manager->persist($lot);
        
        $lot2 = new Property();
        $lot2->setColor($color);
        $lot2->setDateBuilt($dateBuilt);
        $lot2->setHasHoaLien($hasHoaLien);
        $lot2->setHouseNumber('104');
        $lot2->setIsOccupied($isOccupied);
        $lot2->setLotNumber('2');
        $lot2->setStatus($status);
        $lot2->setStreet($bm);
        $lot2->setType($type);
        $manager->persist($lot2);
        
        $lot3 = new Property();
        $lot3->setColor($color);
        $lot3->setDateBuilt($dateBuilt);
        $lot3->setHasHoaLien($hasHoaLien);
        $lot3->setHouseNumber('108');
        $lot3->setIsOccupied($isOccupied);
        $lot3->setLotNumber('3');
        $lot3->setStatus($status);
        $lot3->setStreet($bm);
        $lot3->setType($type);
        $manager->persist($lot3);
        
        $lot4 = new Property();
        $lot4->setColor($color);
        $lot4->setDateBuilt($dateBuilt);
        $lot4->setHasHoaLien($hasHoaLien);
        $lot4->setHouseNumber('109');
        $lot4->setIsOccupied($isOccupied);
        $lot4->setLotNumber('4');
        $lot4->setStatus($status);
        $lot4->setStreet($bm);
        $lot4->setType($type);
        $manager->persist($lot4);
        
        $lot5 = new Property();
        $lot5->setColor($color);
        $lot5->setDateBuilt($dateBuilt);
        $lot5->setHasHoaLien($hasHoaLien);
        $lot5->setHouseNumber('112');
        $lot5->setIsOccupied($isOccupied);
        $lot5->setLotNumber('5');
        $lot5->setStatus($status);
        $lot5->setStreet($bm);
        $lot5->setType($type);
        $manager->persist($lot5);
        
        $lot6 = new Property();
        $lot6->setColor($color);
        $lot6->setDateBuilt($dateBuilt);
        $lot6->setHasHoaLien($hasHoaLien);
        $lot6->setHouseNumber('120');
        $lot6->setIsOccupied($isOccupied);
        $lot6->setLotNumber('6');
        $lot6->setStatus($status);
        $lot6->setStreet($bm);
        $lot6->setType($type);
        $manager->persist($lot6);
        
        $lot7 = new Property();
        $lot7->setColor($color);
        $lot7->setDateBuilt($dateBuilt);
        $lot7->setHasHoaLien($hasHoaLien);
        $lot7->setHouseNumber('124');
        $lot7->setIsOccupied($isOccupied);
        $lot7->setLotNumber('7');
        $lot7->setStatus($status);
        $lot7->setStreet($bm);
        $lot7->setType($type);
        $manager->persist($lot7);
        
        $lot8 = new Property();
        $lot8->setColor($color);
        $lot8->setDateBuilt($dateBuilt);
        $lot8->setHasHoaLien($hasHoaLien);
        $lot8->setHouseNumber('125');
        $lot8->setIsOccupied($isOccupied);
        $lot8->setLotNumber('8');
        $lot8->setStatus($status);
        $lot8->setStreet($bm);
        $lot8->setType($type);
        $manager->persist($lot8);
        
        $lot9 = new Property();
        $lot9->setColor($color);
        $lot9->setDateBuilt($dateBuilt);
        $lot9->setHasHoaLien($hasHoaLien);
        $lot9->setHouseNumber('128');
        $lot9->setIsOccupied($isOccupied);
        $lot9->setLotNumber('9');
        $lot9->setStatus($status);
        $lot9->setStreet($bm);
        $lot9->setType($type);
        $manager->persist($lot9);
        
        $lot10 = new Property();
        $lot10->setColor($color);
        $lot10->setDateBuilt($dateBuilt);
        $lot10->setHasHoaLien($hasHoaLien);
        $lot10->setHouseNumber('132');
        $lot10->setIsOccupied($isOccupied);
        $lot10->setLotNumber('10');
        $lot10->setStatus($status);
        $lot10->setStreet($bm);
        $lot10->setType($type);
        $manager->persist($lot10);
        
        $lot11 = new Property();
        $lot11->setColor($color);
        $lot11->setDateBuilt($dateBuilt);
        $lot11->setHasHoaLien($hasHoaLien);
        $lot11->setHouseNumber('135');
        $lot11->setIsOccupied($isOccupied);
        $lot11->setLotNumber('11');
        $lot11->setStatus($status);
        $lot11->setStreet($bm);
        $lot11->setType($type);
        $manager->persist($lot11);
        
        $lot12 = new Property();
        $lot12->setColor($color);
        $lot12->setDateBuilt($dateBuilt);
        $lot12->setHasHoaLien($hasHoaLien);
        $lot12->setHouseNumber('136');
        $lot12->setIsOccupied($isOccupied);
        $lot12->setLotNumber('12');
        $lot12->setStatus($status);
        $lot12->setStreet($bm);
        $lot12->setType($type);
        $manager->persist($lot12);
        
        $lot13 = new Property();
        $lot13->setColor($color);
        $lot13->setDateBuilt($dateBuilt);
        $lot13->setHasHoaLien($hasHoaLien);
        $lot13->setHouseNumber('139');
        $lot13->setIsOccupied($isOccupied);
        $lot13->setLotNumber('13');
        $lot13->setStatus($status);
        $lot13->setStreet($bm);
        $lot13->setType($type);
        $manager->persist($lot13);
        
        $lot14 = new Property();
        $lot14->setColor($color);
        $lot14->setDateBuilt($dateBuilt);
        $lot14->setHasHoaLien($hasHoaLien);
        $lot14->setHouseNumber('140');
        $lot14->setIsOccupied($isOccupied);
        $lot14->setLotNumber('14');
        $lot14->setStatus($status);
        $lot14->setStreet($bm);
        $lot14->setType($type);
        $manager->persist($lot14);
        
        $lot15 = new Property();
        $lot15->setColor($color);
        $lot15->setDateBuilt($dateBuilt);
        $lot15->setHasHoaLien($hasHoaLien);
        $lot15->setHouseNumber('143');
        $lot15->setIsOccupied($isOccupied);
        $lot15->setLotNumber('15');
        $lot15->setStatus($status);
        $lot15->setStreet($bm);
        $lot15->setType($type);
        $manager->persist($lot15);
        
        $lot16 = new Property();
        $lot16->setColor($color);
        $lot16->setDateBuilt($dateBuilt);
        $lot16->setHasHoaLien($hasHoaLien);
        $lot16->setHouseNumber('144');
        $lot16->setIsOccupied($isOccupied);
        $lot16->setLotNumber('16');
        $lot16->setStatus($status);
        $lot16->setStreet($bm);
        $lot16->setType($type);
        $manager->persist($lot16);
        
        $lot17 = new Property();
        $lot17->setColor($color);
        $lot17->setDateBuilt($dateBuilt);
        $lot17->setHasHoaLien($hasHoaLien);
        $lot17->setHouseNumber('147');
        $lot17->setIsOccupied($isOccupied);
        $lot17->setLotNumber('17');
        $lot17->setStatus($status);
        $lot17->setStreet($bm);
        $lot17->setType($type);
        $manager->persist($lot17);
        
        $lot18 = new Property();
        $lot18->setColor($color);
        $lot18->setDateBuilt($dateBuilt);
        $lot18->setHasHoaLien($hasHoaLien);
        $lot18->setHouseNumber('152');
        $lot18->setIsOccupied($isOccupied);
        $lot18->setLotNumber('18');
        $lot18->setStatus($status);
        $lot18->setStreet($bm);
        $lot18->setType($type);
        $manager->persist($lot18);
        
        $lot19 = new Property();
        $lot19->setColor($color);
        $lot19->setDateBuilt($dateBuilt);
        $lot19->setHasHoaLien($hasHoaLien);
        $lot19->setHouseNumber('155');
        $lot19->setIsOccupied($isOccupied);
        $lot19->setLotNumber('19');
        $lot19->setStatus($status);
        $lot19->setStreet($bm);
        $lot19->setType($type);
        $manager->persist($lot19);
        
        $lot20 = new Property();
        $lot20->setColor($color);
        $lot20->setDateBuilt($dateBuilt);
        $lot20->setHasHoaLien($hasHoaLien);
        $lot20->setHouseNumber('159');
        $lot20->setIsOccupied($isOccupied);
        $lot20->setLotNumber('20');
        $lot20->setStatus($status);
        $lot20->setStreet($bm);
        $lot20->setType($type);
        $manager->persist($lot20);
        
        $lot21 = new Property();
        $lot21->setColor($color);
        $lot21->setDateBuilt($dateBuilt);
        $lot21->setHasHoaLien($hasHoaLien);
        $lot21->setHouseNumber('163');
        $lot21->setIsOccupied($isOccupied);
        $lot21->setLotNumber('21');
        $lot21->setStatus($status);
        $lot21->setStreet($bm);
        $lot21->setType($type);
        $manager->persist($lot21);
        
        $lot22 = new Property();
        $lot22->setColor($color);
        $lot22->setDateBuilt($dateBuilt);
        $lot22->setHasHoaLien($hasHoaLien);
        $lot22->setHouseNumber('170');
        $lot22->setIsOccupied($isOccupied);
        $lot22->setLotNumber('22');
        $lot22->setStatus($status);
        $lot22->setStreet($bm);
        $lot22->setType($type);
        $manager->persist($lot22);
        
        $lot23 = new Property();
        $lot23->setColor($color);
        $lot23->setDateBuilt($dateBuilt);
        $lot23->setHasHoaLien($hasHoaLien);
        $lot23->setHouseNumber('179');
        $lot23->setIsOccupied($isOccupied);
        $lot23->setLotNumber('23');
        $lot23->setStatus($status);
        $lot23->setStreet($bm);
        $lot23->setType($type);
        $manager->persist($lot23);
        
        $lot24 = new Property();
        $lot24->setColor($color);
        $lot24->setDateBuilt($dateBuilt);
        $lot24->setHasHoaLien($hasHoaLien);
        $lot24->setHouseNumber('183');
        $lot24->setIsOccupied($isOccupied);
        $lot24->setLotNumber('24');
        $lot24->setStatus($status);
        $lot24->setStreet($bm);
        $lot24->setType($type);
        $manager->persist($lot24);
        
        $lot25 = new Property();
        $lot25->setColor($color);
        $lot25->setDateBuilt($dateBuilt);
        $lot25->setHasHoaLien($hasHoaLien);
        $lot25->setHouseNumber('187');
        $lot25->setIsOccupied($isOccupied);
        $lot25->setLotNumber('25');
        $lot25->setStatus($status);
        $lot25->setStreet($bm);
        $lot25->setType($type);
        $manager->persist($lot25);
        
        $lot26 = new Property();
        $lot26->setColor($color);
        $lot26->setDateBuilt($dateBuilt);
        $lot26->setHasHoaLien($hasHoaLien);
        $lot26->setHouseNumber('191');
        $lot26->setIsOccupied($isOccupied);
        $lot26->setLotNumber('26');
        $lot26->setStatus($status);
        $lot26->setStreet($bm);
        $lot26->setType($type);
        $manager->persist($lot26);
        
        
        
        $manager->flush();
        
    }
    
}