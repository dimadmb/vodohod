<?

namespace Tests\CruiseBundle\OrderController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{
	public function getFormTourist()
	{
		$client = static::createClient();
		$client->request('GET', '/cruise/cruise/order/add_tourist');
		$this->assertEquals(200, $client->getResponse()->getStatusCode());
	}
}