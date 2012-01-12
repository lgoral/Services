<?php
/**
 * @package    KVD.Services.Agiv.Crab
 * @subpackage Tests
 * @copyright  2011 Koen Van Daele <koen_van_daele@telenet.be>
 * @author     Koen Van Daele <koen_van_daele@telenet.be>
 * @license    http://www.osor.eu/eupl The European Union Public Licence
 */

namespace KVD\Services\Agiv\Crab;

/**
 * Unit test voor de Crab gateway.
 *
 * Deze unit test is niet afhankelijk van een werkende soapclient en kan dus 
 * volledig offline draaien.
 *
 * @package    KVD.Services.Agiv.Crab
 * @subpackage Tests
 * @since      0.1.0
 * @copyright  2011 Koen Van Daele <koen_van_daele@telenet.be>
 * @author     Koen Van Daele <koen_van_daele@telenet.be>
 * @license    http://www.osor.eu/eupl The European Union Public Licence
 */
class CaPaKeyGatewayTest extends \PHPUnit_Framework_TestCase
{
    public function testListTalen( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListTalen') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $talen = array();
        $t = new \StdClass( );
        $t->Code = 'nl';
        $t->Naam = 'Nederlands';
        $t->Definitie = 'Nederlands.';
        $talen[] = $t;
        $res = new \StdClass( );
        $res->ListTalenResult = new \StdClass( );
        $res->ListTalenResult->CodeItem = $talen;
        $client->expects( $this->once( ) )
               ->method( 'ListTalen' )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->listTalen();
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 1, count( $resultaat ) );
        $first = $resultaat[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Taal', $first );
        $this->assertEquals( 'nl', $first->getCode( ) );
        $this->assertEquals( 'Nederlands', $first->getNaam( ) );
        $this->assertEquals( 'Nederlands.', $first->getDefinitie( ) );
    }

    public function testListBewerkingen( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListBewerkingen') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $bewerkingen = array();
        $b = new \StdClass( );
        $b->Code = 1;
        $b->Naam = 'invoer';
        $b->Definitie = 'Invoer in de databank.';
        $bewerkingen[] = $b;
        $res = new \StdClass( );
        $res->ListBewerkingenResult = new \StdClass( );
        $res->ListBewerkingenResult->CodeItem = $bewerkingen;
        $client->expects( $this->once( ) )
               ->method( 'ListBewerkingen' )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->listBewerkingen();
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 1, count( $resultaat ) );
        $first = $resultaat[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Bewerking', $first );
        $this->assertEquals( 1, $first->getCode( ) );
        $this->assertEquals( 'invoer', $first->getNaam( ) );
        $this->assertEquals( 'Invoer in de databank.', $first->getDefinitie( ) );
    }

    public function testListOrganisaties( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListOrganisaties') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $orgs = array();
        $o = new \StdClass( );
        $o->Code = 1;
        $o->Naam = 'gemeente';
        $o->Definitie = 'Gemeente.';
        $orgs[] = $o;
        $res = new \StdClass( );
        $res->ListOrganisatiesResult = new \StdClass( );
        $res->ListOrganisatiesResult->CodeItem = $orgs;
        $client->expects( $this->once( ) )
               ->method( 'ListOrganisaties' )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->listOrganisaties();
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 1, count( $resultaat ) );
        $first = $resultaat[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Organisatie', $first );
        $this->assertEquals( 1, $first->getCode( ) );
        $this->assertEquals( 'gemeente', $first->getNaam( ) );
        $this->assertEquals( 'Gemeente.', $first->getDefinitie( ) );
    }

    public function testListAardSubadressen( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListAardSubadressen') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $aarden = array();
        $a = new \StdClass( );
        $a->Code = 1;
        $a->Naam = 'appartement';
        $a->Definitie = 'Nummer van een appartement.';
        $aarden[] = $a;
        $res = new \StdClass( );
        $res->ListAardSubadressenResult = new \StdClass( );
        $res->ListAardSubadressenResult->CodeItem = $aarden;
        $client->expects( $this->once( ) )
               ->method( 'ListAardSubadressen' )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->listAardSubadressen();
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 1, count( $resultaat ) );
        $first = $resultaat[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\AardSubadres', $first );
        $this->assertEquals( 1, $first->getCode( ) );
        $this->assertEquals( 'appartement', $first->getNaam( ) );
        $this->assertEquals( 'Nummer van een appartement.', $first->getDefinitie( ) );
    }

    public function testListAardTerreinobjecten( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListAardTerreinobjecten') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $aarden = array();
        $a = new \StdClass( );
        $a->Code = 4;
        $a->Naam = 'grbAdmPerceel';
        $a->Definitie = 'Een perceel volgens het GRB.';
        $aarden[] = $a;
        $res = new \StdClass( );
        $res->ListAardTerreinobjectenResult = new \StdClass( );
        $res->ListAardTerreinobjectenResult->CodeItem = $aarden;
        $client->expects( $this->once( ) )
               ->method( 'ListAardTerreinobjecten' )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->listAardTerreinobjecten();
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 1, count( $resultaat ) );
        $first = $resultaat[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\AardTerreinobject', $first );
        $this->assertEquals( 4, $first->getCode( ) );
        $this->assertEquals( 'grbAdmPerceel', $first->getNaam( ) );
        $this->assertEquals( 'Een perceel volgens het GRB.', $first->getDefinitie( ) );
    }

    public function testListAardWegobjecten( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListAardWegobjecten') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $aarden = array();
        $a = new \StdClass( );
        $a->Code = 2;
        $a->Naam = 'grbWegverbinding';
        $a->Definitie = 'Een wegverbinding volgens het GRB.';
        $aarden[] = $a;
        $res = new \StdClass( );
        $res->ListAardWegobjectenResult = new \StdClass( );
        $res->ListAardWegobjectenResult->CodeItem = $aarden;
        $client->expects( $this->once( ) )
               ->method( 'ListAardWegobjecten' )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->listAardWegobjecten();
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 1, count( $resultaat ) );
        $first = $resultaat[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\AardWegobject', $first );
        $this->assertEquals( 2, $first->getCode( ) );
        $this->assertEquals( 'grbWegverbinding', $first->getNaam( ) );
        $this->assertEquals( 'Een wegverbinding volgens het GRB.', $first->getDefinitie( ) );
    }

    public function testListGemeentenByGewestId( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListGemeentenByGewestId') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $p = new \StdClass();
        $p->GewestId = 2;
        $p->SorteerVeld = 1;
        $pWrapper = new \SoapParam ( $p , "ListGemeentenByGewestId" );
        $gemeenten = array();
        $tg = new \StdClass( );
        $tg->GemeenteId = 666;
        $tg->NISGemeenteCode = 39999;
        $tg->GemeenteNaam = 'TestGemeente';
        $tg->TaalCodeGemeenteNaam = 'nl';
        $tg->TaalCode = 'nl';
        $gemeenten[] = $tg;
        $res = new \StdClass( );
        $res->ListGemeentenByGewestIdResult = new \StdClass( );
        $res->ListGemeentenByGewestIdResult->GemeenteItem = $gemeenten;
        $client->expects( $this->once( ) )
               ->method( 'ListGemeentenByGewestId' )
               ->with( $pWrapper )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->listGemeentenByGewestId(2, 1);
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 1, count( $resultaat ) );
        $first = $resultaat[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $first );
        $this->assertEquals( 666, $first->getId( ) );
        $this->assertEquals( 'nl', $first->getTaalCode( ) );
        $this->assertEquals( 'TestGemeente', $first->getNaam( ) );
    }

    public function testListGemeentenByGewestOnlyListsOfficialName( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListGemeentenByGewestId') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $p = new \StdClass();
        $p->GewestId = 2;
        $p->SorteerVeld = 1;
        $pWrapper = new \SoapParam ( $p , "ListGemeentenByGewestId" );
        $gemeenten = array();
        $tg = new \StdClass( );
        $tg->GemeenteId = 666;
        $tg->NISGemeenteCode = 39999;
        $tg->GemeenteNaam = 'TestGemeente';
        $tg->TaalCodeGemeenteNaam = 'nl';
        $tg->TaalCode = 'fr';
        $gemeenten[] = $tg;
        $res = new \StdClass( );
        $res->ListGemeentenByGewestIdResult = new \StdClass( );
        $res->ListGemeentenByGewestIdResult->GemeenteItem = $gemeenten;
        $client->expects( $this->once( ) )
               ->method( 'ListGemeentenByGewestId' )
               ->with( $pWrapper )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->listGemeentenByGewestId(2, 1);
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 0, count( $resultaat ) );
    }

    public function testGetGemeenteByNiscode( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'GetGemeenteByNISGemeenteCode') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $p = new \StdClass();
        $p->NISGemeenteCode = 39999; 
        $pWrapper = new \SoapParam ( $p , "GetGemeenteByNISGemeenteCode" );
        $gem = new \StdClass( );
        $gem->GemeenteId = 666;
        $gem->NisGemeenteCode = 39999;
        $gem->GemeenteNaam = 'TestGemeente';
        $gem->TaalCodeGemeenteNaam = 'nl';
        $gem->TaalCode = 'nl';
        $gem->CenterX = 10.0;
        $gem->CenterY = 10.0;
        $gem->MinimumX = 0.0;
        $gem->MinimumY = 0.0;
        $gem->MaximumX = 20.0;
        $gem->MaximumY = 20.0;
        $res = new \StdClass( );
        $res->GetGemeenteByNISGemeenteCodeResult = $gem;
        $client->expects( $this->once( ) )
               ->method( 'GetGemeenteByNISGemeenteCode' )
               ->with( $pWrapper )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->getGemeenteByNiscode( 39999 );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $resultaat );
        $this->assertEquals( 666, $resultaat->getId( ) );
        $this->assertEquals( 'TestGemeente', $resultaat->getNaam( ) );
    }

    public function testGetGemeenteById( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'GetGemeenteByGemeenteId') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $p = new \StdClass();
        $p->GemeenteId = 666; 
        $pWrapper = new \SoapParam ( $p , "GetGemeenteByGemeenteId" );
        $gem = new \StdClass( );
        $gem->GemeenteId = 666;
        $gem->NisGemeenteCode = 39999;
        $gem->GemeenteNaam = 'TestGemeente';
        $gem->TaalCodeGemeenteNaam = 'nl';
        $gem->TaalCode = 'nl';
        $gem->CenterX = 10.0;
        $gem->CenterY = 10.0;
        $gem->MinimumX = 0.0;
        $gem->MinimumY = 0.0;
        $gem->MaximumX = 20.0;
        $gem->MaximumY = 20.0;
        $res = new \StdClass( );
        $res->GetGemeenteByGemeenteIdResult = $gem;
        $client->expects( $this->once( ) )
               ->method( 'GetGemeenteByGemeenteId' )
               ->with( $pWrapper )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->getGemeenteById( 666 );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $resultaat );
        $this->assertEquals( 666, $resultaat->getId( ) );
        $this->assertEquals( 'TestGemeente', $resultaat->getNaam( ) );
    }

    public function testGetGemeenteByNaam( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'GetGemeenteByGemeenteNaam') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $p = new \StdClass();
        $p->GemeenteNaam = 'TestGemeente';
        $p->GewestId = 2; 
        $pWrapper = new \SoapParam ( $p , "GetGemeenteByGemeenteNaam" );
        $gem = new \StdClass( );
        $gem->GemeenteId = 666;
        $gem->NisGemeenteCode = 39999;
        $gem->GemeenteNaam = 'TestGemeente';
        $gem->TaalCodeGemeenteNaam = 'nl';
        $gem->TaalCode = 'nl';
        $gem->CenterX = 10.0;
        $gem->CenterY = 10.0;
        $gem->MinimumX = 0.0;
        $gem->MinimumY = 0.0;
        $gem->MaximumX = 20.0;
        $gem->MaximumY = 20.0;
        $res = new \StdClass( );
        $res->GetGemeenteByGemeenteNaamResult = $gem;
        $client->expects( $this->once( ) )
               ->method( 'GetGemeenteByGemeenteNaam' )
               ->with( $pWrapper )
               ->will( $this->returnValue( $res ) );
        $resultaat = $gateway->getGemeenteByNaam( 'TestGemeente' );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $resultaat );
        $this->assertEquals( 666, $resultaat->getId( ) );
        $this->assertEquals( 'TestGemeente', $resultaat->getNaam( ) );
    }

    public function testListStratenByGemeente( )
    {
        $client = $this->getMockBuilder('KVD\Services\Agiv\Crab\SoapClient')
                       ->disableOriginalConstructor( )
                       ->setMethods( array( 'ListStraatnamenByGemeenteId') )
                       ->getMock( );
        $gateway = new CrabGateway( $client );

        $p = new \StdClass();
        $p->GemeenteId = 666;
        $p->SorteerVeld = 6; 
        $pWrapper = new \SoapParam ( $p , "ListStraatnamenByGemeenteId" );
        $straten = array();
        $ts = new \StdClass( );
        $ts->StraatnaamId = 456;
        $ts->StraatnaamLabel = 'Teststraat';
        $ts->TaalCode = 'nl';
        $ts->Straatnaam = 'Teststraat';
        $ts->TaalCodeTweedeTaal = 'fr';
        $ts->StraatnaamTweedeTaal = 'Rue du Test';
        $straten[] = $ts;
        $ts = new \StdClass( );
        $ts->StraatnaamId = 4555;
        $ts->StraatnaamLabel = 'Avenue';
        $ts->TaalCode = 'nl';
        $ts->Straatnaam = 'Avenue';
        $ts->TaalCodeTweedeTaal = 'fr';
        $straten[] = $ts;
        $res = new \StdClass( );
        $res->ListStraatnamenByGemeenteIdResult = new \StdClass( );
        $res->ListStraatnamenByGemeenteIdResult->StraatnaamItem = $straten;
        $client->expects( $this->once( ) )
               ->method( 'ListStraatnamenByGemeenteId' )
               ->with( $pWrapper )
               ->will( $this->returnValue( $res ) );
        $gemeente = new Gemeente( 666, 39999, array( 'nl' => 'TestGemeente' ), 'nl' );
        $resultaat = $gateway->listStratenByGemeente( $gemeente );
        $this->assertInternalType( 'array', $resultaat );
        $this->assertEquals( 2, count( $resultaat ) );
        $first = $resultaat[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Straat', $first );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $first->getGemeente( ) );
        $this->assertEquals( 456, $first->getId( ) );
        $this->assertEquals( $gemeente->getId( ), $first->getGemeente( )->getId( ) );
        $this->assertEquals( $gemeente->getNaam( ), $first->getGemeente( )->getNaam( ) );
        $this->assertEquals( 'Teststraat', $first->getNaam( ) );
        $this->assertEquals( 'Rue du Test', $first->getNaam( 'fr' ) );
        $second = $resultaat[1];
        $this->assertEquals( $second->getNaam( 'nl' ), $second->getNaam( 'fr' ) );
    }
}
?>
