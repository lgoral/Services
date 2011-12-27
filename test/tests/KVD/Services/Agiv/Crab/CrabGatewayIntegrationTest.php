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
 * Unit test voor de CrabGateway die effectief connecteert met de webservice..
 *
 * @package    KVD.Services.Agiv.Crab
 * @subpakcage Tests
 * @version    0.1.0
 * @copyright  2011 Koen Van Daele <koen_van_daele@telenet.be>
 * @author     Koen Van Daele <koen_van_daele@telenet.be>
 * @license    http://www.osor.eu/eupl The European Union Public Licence
 */
class CrabGatewayIntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function setUp( )
    {
        if ( CRAB_RUN_INTEGRATION_TESTS === false  ) {
            $this->markTestSkipped( );
        }
        $wsdl = 'http://ws.agiv.be/crabws/nodataset.asmx?WSDL';
        $this->client = new SoapClient( $wsdl,
                                        array( 'trace' => 1,
                                               'exceptions' => 1,
                                               'features' => SOAP_SINGLE_ELEMENT_ARRAYS ) );
        $this->client->setAuthentication( CRAB_USER, CRAB_PASSWORD );
        $this->gateway = new CrabGateway( $this->client );
    }

    public function tearDown( )
    {
        $this->client = null;
        $this->gateway = null;
    }

    public function testListTalen( )
    {
        $talen = $this->gateway->listTalen( );
        $this->assertInternalType( 'array', $talen );
    }

    public function testListBewerkingen( )
    {
        $bewerkingen = $this->gateway->listBewerkingen( );
        $this->assertInternalType( 'array', $bewerkingen );
    }

    public function testListOrganisaties( )
    {
        $organisaties = $this->gateway->listOrganisaties( );
        $this->assertInternalType( 'array', $organisaties );
    }

    public function testListAardSubadressen( )
    {
        $aarden = $this->gateway->listAardSubadressen( );
        $this->assertInternalType( 'array', $aarden );
    }

    public function testListAardWegobjecten( )
    {
        $aarden = $this->gateway->listAardWegobjecten( );
        $this->assertInternalType( 'array', $aarden );
    }

    public function testListAardTerreinobjecten( )
    {
        $aarden = $this->gateway->listAardTerreinobjecten( );
        $this->assertInternalType( 'array', $aarden );
    }

    public function testListGemeentenByGewestId(  )
    {
        $gemeenten = $this->gateway->listGemeentenByGewestId(2,1);
        $this->assertInternalType( 'array', $gemeenten );
        $this->assertEquals( 308, count( $gemeenten ) );
        $first = $gemeenten[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $first );
    }

    public function testGetGemeenteByNisCode( )
    {
        $gemeente = $this->gateway->getGemeenteByNisCode( 44021 );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $gemeente );
        $this->assertEquals( 44021, $gemeente->getNisCode( ) );
        $this->assertEquals( 278, $gemeente->getId( ) );
        $this->assertEquals( 'Gent', $gemeente->getNaam( ) );
        $this->assertEquals( 'nl', $gemeente->getTaalCode( ) );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Centroid', $gemeente->getCentroid( ) );
        $this->assertInstanceOf( 'KVD\Services\Agiv\BoundingBox', $gemeente->getBoundingBox( ) );
    }

    public function testGetGemeenteById( )
    {
        $gemeente = $this->gateway->getGemeenteById( 278 );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $gemeente );
        $this->assertEquals( 44021, $gemeente->getNisCode( ) );
        $this->assertEquals( 278, $gemeente->getId( ) );
        $this->assertEquals( 'Gent', $gemeente->getNaam( ) );
        $this->assertEquals( 'nl', $gemeente->getTaalCode( ) );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Centroid', $gemeente->getCentroid( ) );
        $this->assertInstanceOf( 'KVD\Services\Agiv\BoundingBox', $gemeente->getBoundingBox( ) );
    }

    public function testGetGemeenteByNaam( )
    {
        $gemeente = $this->gateway->getGemeenteByNaam( 'Gent' );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Gemeente', $gemeente );
        $this->assertEquals( 44021, $gemeente->getNisCode( ) );
        $this->assertEquals( 278, $gemeente->getId( ) );
        $this->assertEquals( 'Gent', $gemeente->getNaam( ) );
        $this->assertEquals( 'nl', $gemeente->getTaalCode( ) );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Centroid', $gemeente->getCentroid( ) );
        $this->assertInstanceOf( 'KVD\Services\Agiv\BoundingBox', $gemeente->getBoundingBox( ) );
    }

    public function testListStratenByGemeente( )
    {
        $gemeente = $this->gateway->getGemeenteByNaam( 'Linkebeek' );
        $straten = $this->gateway->listStratenByGemeente( $gemeente );
        $this->assertInternalType( 'array', $straten );
        $this->assertGreaterThan( 50, count( $straten ) );
    }

    public function testGetStraatById( )
    {
        $straat = $this->gateway->getStraatById( 48086 );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Straat', $straat );
        $this->assertEquals( 'Nieuwstraat', $straat->getNaam( ) );
        $this->assertEquals( 'Nieuwstraat', $straat->getLabel( ) );
        $this->assertEquals( 'Knokke-Heist', $straat->getGemeente( )->getNaam( ) );
    }

    public function testListWegobjectenByStraat( )
    {
        $straat = $this->gateway->getStraatById( 48086 );
        $wegobjecten = $this->gateway->listWegobjectenByStraat( $straat );
        $this->assertInternalType( 'array', $wegobjecten );
        $first = $wegobjecten[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Wegobject', $first );
    }

    public function testGetWegobjectById( )
    {
        $straat = $this->gateway->getStraatById( 48086 );
        $wegobjecten = $this->gateway->listWegobjectenByStraat( $straat );
        $first = $wegobjecten[0];
        $wegobject = $this->gateway->getWegobjectById( $straat, $first->getId( ) );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Wegobject', $wegobject );
        $this->assertInstanceOf( 'KVD\Services\Agiv\BoundingBox', $wegobject->getBoundingBox( ) );
        $this->assertInstanceOf( 'KVD\Services\Agiv\Centroid', $wegobject->getCentroid( ) );
    }

    public function testListHuisnummersByStraat( )
    {
        $straat = $this->gateway->getStraatById( 48086 );
        $huisnummers = $this->gateway->listHuisnummersByStraat( $straat );
        $this->assertInternalType( 'array', $huisnummers );
        $first = $huisnummers[0];
        $this->assertInstanceOf( 'KVD\Services\Agiv\Crab\Huisnummer', $first );
    }

}
?>
