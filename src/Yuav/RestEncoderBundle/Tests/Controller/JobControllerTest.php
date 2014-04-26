<?php

namespace Yuav\RestEncoderBundle\Tests\Controller;
use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;
use Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData;

class JobControllerTest extends WebTestCase
{
	private $auth;
	private $client;
	
	public function setUp()
	{
		$this->auth = array('PHP_AUTH_USER' => 'user', 'PHP_AUTH_PW' => 'userpass',);

		$this->client = static::createClient(array(), $this->auth);
	}

	public function testJsonGetJobAction()
	{
		$fixtures = array('Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData');
		$this->loadFixtures($fixtures);
		$jobs = LoadJobData::$jobs;

		$job = array_pop($jobs);

		$route = $this->getUrl('api_1_get_job', array('id' => $job->getId(), '_format' => 'json'));

		$this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
		$response = $this->client->getResponse();
		$this->assertJsonResponse($response, 200);
		$content = $response->getContent();

		$decoded = json_decode($content, true);
		$this->assertTrue(isset($decoded['id']));
	}

	public function testJsonPostJobAction()
	{
		$this->client
				->request('POST', '/api/v1/jobs.json', array(), array(), array('CONTENT_TYPE' => 'application/json'),
						'{"state":"finished"}');

		$this->assertJsonResponse($this->client->getResponse(), 201, false);
	}

	public function testJsonPostJobActionShouldReturn400WithBadParameters()
	{
		$this->client
				->request('POST', '/api/v1/jobs.json', array(), array(), array('CONTENT_TYPE' => 'application/json'),
						'{"state":"new","invalid":"field"}');

		$this->assertJsonResponse($this->client->getResponse(), 400, false);
	}

	public function testJsonPutJobActionShouldCreate()
	{
		$id = 0;
		$this->client->request('GET', sprintf('/api/v1/jobs/%d.json', $id), array('ACCEPT' => 'application/json'));

		$this
				->assertEquals(404, $this->client->getResponse()->getStatusCode(),
						$this->client->getResponse()->getContent());

		$this->client
				->request('PUT', sprintf('/api/v1/jobs/%d.json', $id), array(), array(),
						array('CONTENT_TYPE' => 'application/json'), '{"state":"finished"}');

		$this->assertJsonResponse($this->client->getResponse(), 201, false);
	}

	public function testJsonPatchJobAction()
	{
		$fixtures = array('Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData');
		$this->loadFixtures($fixtures);
		$jobs = LoadJobData::$jobs;
		$job = array_pop($jobs);

		$this->client
				->request('PATCH', sprintf('/api/v1/jobs/%d.json', $job->getId()), array(), array(),
						array('CONTENT_TYPE' => 'application/json'), '{"state":"new"}');

		$this->assertJsonResponse($this->client->getResponse(), 204, false);
		$this
				->assertTrue(
						$this->client->getResponse()->headers
								->contains('Location', sprintf('http://localhost/api/v1/jobs/%d.json', $job->getId())),
						$this->client->getResponse()->headers);
	}

	protected function assertJsonResponse($response, $statusCode = 200, $checkValidJson = true,
			$contentType = 'application/json')
	{
		$this->assertEquals($statusCode, $response->getStatusCode(), $response->getContent());
		$this->assertTrue($response->headers->contains('Content-Type', $contentType), $response->headers);

		if ($checkValidJson) {
			$decode = json_decode($response->getContent());
			$this
					->assertTrue(($decode != null && $decode != false),
							'is response valid json: [' . $response->getContent() . ']');
		}
	}

}
