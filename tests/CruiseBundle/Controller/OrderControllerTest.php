<?

namespace Tests\CruiseBundle\OrderController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class OrderControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }


	public function testAddTourist()
	{
		$this->logIn();
		

		$crawler = $this->client->request('GET', '/cruise/order/add_tourist');
		$this->assertEquals(200, $this->client->getResponse()->getStatusCode());
		
	}
	
    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        // the firewall context defaults to the firewall name
        $firewallContext = 'main';

        $token = new UsernamePasswordToken('dkochetkov', null, $firewallContext, array('ROLE_SUPER_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }	
	
}