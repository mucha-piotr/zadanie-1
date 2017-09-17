<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 17.09.2017
 * Time: 10:44
 */

namespace tests\AppBundle\Serivce;

use AppBundle\Service\Dates;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DatesTest extends WebTestCase
{
    /** @var Dates */
    private $daty;
    
    public function setUp()
    {
        $this->daty = new Dates();
        
    }
    
    public function testInit()
    {
        $daty = $this->daty;

        $daty->init("2017",5,"d-m-Y",true);

        $this->assertAttributeNotEmpty("year",$daty,"Błąd ustawienia roku");
        $this->assertAttributeNotEmpty("day_of_the_week",$daty,"Błąd ustawienia dnia tygodnia");
        $this->assertAttributeNotEmpty("date_format",$daty,"Błąd ustawienia formatu");
        $this->assertAttributeNotEmpty("mode",$daty,"Błąd ustawienia trybu");
        
        $this->daty = $daty;
    }
    
    /**
     * @depends testInit
     */
    public function testGetResults()
    {
        $daty = $this->daty;

        $daty->init("2017",5,"d-m-Y",true);
        $daty->getDaysFromYear();

        $this->assertNotEmpty($daty->getResults(),"Metoda nie zwraca żadnych wyników");
    }

    /**
     * @depends testGetResults
     */
    public function testGetDaysFromYearOdd()
    {
        $daty = $this->daty;

        $daty->init("2017",5,"d-m-Y",false);
        $daty->getDaysFromYear();

        $this->assertAttributeNotEmpty("odd",$daty,"Metoda niepoprawnie generuje daty dla dat nieparzystych");

        foreach ($daty->getResults() as $result){
            $odd = substr($result,0,2);
            $check = $odd % 2;
            $this->assertNotEquals(0,$check,"Data {$result} jest datą parzystą");
        }
    }

    /**
     * @depends testGetResults
     */
    public function testGetDaysFromYearEven()
    {
        $daty = $this->daty;

        $daty->init("2017",5,"d-m-Y",true);
        $daty->getDaysFromYear();

        $this->assertAttributeNotEmpty("even",$daty,"Metoda niepoprawnie generuje daty dla dat parzystych");

        foreach ($daty->getResults() as $result){
            $even = substr($result,0,2);
            $check = $even % 2;
            $this->assertEquals(0,$check,"Data {$result} jest datą nieparzystą");
        }
    }
    



    
    
    
}