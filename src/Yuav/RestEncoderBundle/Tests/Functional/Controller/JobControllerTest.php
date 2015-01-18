<?php
namespace Yuav\RestEncoderBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;
use Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData;
use Doctrine\ORM\Tools\SchemaTool;

class JobControllerTest extends WebTestCase
{

    private $auth;

    private $client;

    public function setUp()
    {
        $this->auth = array(
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'userpass'
        );
        $client = static::createClient(array(), $this->auth);
        $this->client = $client;
        
        // $container = $client->getContainer();
        // $doctrine = $container->get('doctrine');
        // $em = $doctrine->getManager();
        
        // $tool = new SchemaTool($em);
        // $tool->dropDatabase();
        // $em->getConnection()->connect();
        // $tool->createSchema($em->getMetadataFactory()
        // ->getAllMetadata());
        
        // $schemaTool = new SchemaTool($em);
        // $mdf = $em->getMetadataFactory();
        // $classes = $mdf->getAllMetadata();
        
        // $schemaTool->dropDatabase();
        // $schemaTool->createSchema($classes);
    }

    /**
     * Workaround for MakeGood integration
     */
    protected static function createKernel(array $options = array())
    {
        require_once realpath(dirname(__file__) . '/../../../../../../') . '/app/AppKernel.php';
        
        return new \AppKernel(isset($options['environment']) ? $options['environment'] : 'test', isset($options['debug']) ? $options['debug'] : true);
    }

    public function testJsonGetJobAction()
    {
        $fixtures = array(
            'Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData'
        );
        $this->loadFixtures($fixtures);
        $jobs = LoadJobData::$jobs;
        
        $job = array_pop($jobs);
        
        $route = $this->getUrl('api_1_get_job', array(
            'id' => $job->getId(),
            '_format' => 'json'
        ));
        
        $this->client->request('GET', $route, array(
            'ACCEPT' => 'application/json'
        ));
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200);
        $content = $response->getContent();
        
        $decoded = json_decode($content, true);
        
        $this->assertTrue(isset($decoded['id']));
    }

    public function testJsonGetJobProgressAction()
    {
        $fixtures = array(
            'Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData'
        );
        $this->loadFixtures($fixtures);
        $jobs = LoadJobData::$jobs;
        
        $job = array_pop($jobs);
        
        $route = $this->getUrl('api_1_get_job_progress', array(
            'id' => $job->getId(),
            '_format' => 'json'
        ));
        
        $this->client->request('GET', $route, array(
            'ACCEPT' => 'application/json'
        ));
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200);
        $content = $response->getContent();
        
        $decoded = json_decode($content, true);
        
        $this->assertArrayHasKey('state', $decoded, "No state found in json: $content");
        $this->assertArrayHasKey('progress', $decoded, "No progress found in json: $content");
        $this->assertArrayHasKey('input', $decoded, "No input found in json: $content");
        $this->assertInternalType('array', $decoded['input']);
        $array = $decoded['input'];
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('current_event', $array);
        $this->assertArrayHasKey('current_event_progress', $array);
        $this->assertArrayHasKey('progress', $array);
        $this->assertInternalType('array', $decoded['outputs']);
        foreach ($decoded['outputs'] as $array) {
            $this->assertInternalType('array', $array);
            $this->assertArrayHasKey('id', $array);
            $this->assertArrayHasKey('current_event', $array);
            $this->assertArrayHasKey('current_event_progress', $array);
            $this->assertArrayHasKey('progress', $array);
        }
    }

    public function testJsonPostJobAction()
    {
        $this->client->request('POST', '/api/v1/jobs.json', array(), array(), array(
            'CONTENT_TYPE' => 'application/json',
            'ACCEPT' => 'application/json'
        ), '{"input":"finished","api_key":"asdf"}');
        
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 201, false);
    }

    public function testJsonPostJobActionShouldReturn400WithBadParameters()
    {
        // Too short input
        $this->client->request('POST', '/api/v1/jobs.json', array(), array(), array(
            'CONTENT_TYPE' => 'application/json'
        ), '{"state":"new","invalid":"field","input":"h"}');
        $this->assertJsonResponse($this->client->getResponse(), 400, false);
        
        // Blank input
        $this->client->request('POST', '/api/v1/jobs.json', array(), array(), array(
            'CONTENT_TYPE' => 'application/json'
        ), '{"state":"new","invalid":"field","input":""}');
        $this->assertJsonResponse($this->client->getResponse(), 400, false);
        
        // Missing input
        // $this->markTestSkipped('Not null validator from config not working since symfony upgrade');
        // $this->client->request ( 'POST', '/api/v1/jobs.json', array (), array (), array (
        // 'CONTENT_TYPE' => 'application/json'
        // ), '{"state":"new","invalid":"field"}' );
        // $this->assertJsonResponse ( $this->client->getResponse (), 400, false );
    }

    public function testJsonPutJobAction()
    {
        $fixtures = array(
            'Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData'
        );
        $this->loadFixtures($fixtures);
        $jobs = LoadJobData::$jobs;
        $job = array_pop($jobs);
    
        $this->client->request('PUT', sprintf('/api/v1/jobs/%d', $job->getId()), array(), array(), array(
            'CONTENT_TYPE' => 'application/json'
        ), '{"input":"finished", "api_key":"fdsa"}');
        $response = $this->client->getResponse();
    
        $this->assertJsonResponse($response, 405, false);
    }
    
    public function testJsonCreateBasic()
    {
        // Init database
        $fixtures = array(
            'Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData'
        );
        $this->loadFixtures($fixtures);
        
        // Create new job
        $job = array(
            'input' => 'http://testing/test.mov',
            'api_key' => 'asdffdsa'
        );
        $this->client->request('POST', '/api/v1/jobs.json', array(), array(), array(
            'CONTENT_TYPE' => 'application/json'
        ), json_encode($job));
        
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 201, false);
        $this->assertEmpty($response->getContent(), 'Expected Content-Length: 0');
        $location = $response->headers->get('location', false);
        $this->assertTrue((false !== $location), 'Location header not found in response');
        
        $path = parse_url($location, PHP_URL_PATH);
        $this->client->request('GET', $path, array(
            'ACCEPT' => 'application/json'
        ));
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200, true);
        
        $r = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $r);
        $this->assertArrayHasKey('id', $r);
        $this->assertInternalType('numeric', $r['id']);
        $this->assertArrayHasKey('input', $r);
        $this->assertInternalType('array', $r['input']);
        $this->assertArrayHasKey('uri', $r['input']);
        $this->assertEquals($job['input'], $r['input']['uri']);
        
        $this->assertArrayHasKey('api_key', $r);
        $this->assertEquals($job['api_key'], $r['api_key']);
        $this->assertArrayHasKey('outputs', $r);
        $this->assertInternalType('array', $r['outputs']);
        $this->assertEquals(1, count($r['outputs']), 'Expected 1 output in job');
        $output = array_shift($r['outputs']);
        $this->assertArrayHasKey('id', $output);
        // $this->assertArrayHasKey('url', $output);
        // $this->assertArrayHasKey('label', $output);
    }

    public function testJsonCreateMultipleOutputs()
    {
        // Init database
        $fixtures = array(
            'Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData'
        );
        $this->loadFixtures($fixtures);
        
        $job = array(
            'test' => true,
            'input' => 'http://testing/test.mov',
            'outputs' => array(
                array(
                    'label' => 'mp4 high',
                    'url' => 'http://output/out-high.mp4',
                    'h264_profile' => 'high'
                ),
                array(
                    'label' => 'mp4 low',
                    'url' => 'http://output/out-low.mp4',
                    'h264_profile' => 'low',
                    'size' => '640x480'
                ),
                array(
                    'label' => 'webm',
                    'url' => 'http://output/out.webm',
                    'format' => 'webm'
                ),
                array(
                    'label' => 'ogg',
                    'url' => 'http://output/out.ogg',
                    'format' => 'ogg'
                )
            )
        );
        
        // Create new job
        $this->client->request('POST', '/api/v1/jobs.json', array(), array(), array(
            'CONTENT_TYPE' => 'application/json'
        ), json_encode($job));
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 201, false);
        $this->assertEmpty($response->getContent(), 'Expected Content-Length: 0');
        $location = $response->headers->get('location', false);
        $this->assertTrue((false !== $location), 'Location header not found in response');
        
        // Get newly created job
        $path = parse_url($location, PHP_URL_PATH);
        $this->client->request('GET', $path, array(
            'ACCEPT' => 'application/json'
        ));
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200, true);
        
        $r = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $r);
        $this->assertArrayHasKey('test', $r);
        $this->assertTrue($r['test']);
        $this->assertInternalType('array', $r['outputs']);
        $o = $r['outputs'];
        $this->assertEquals(4, count($o), 'Unexpected amount of outputs');
        $foundOgg = false;
        $foundMp4High = false;
        $foundMp4Low = false;
        $foundWebm = false;
        foreach ($o as $output) {
            $this->assertArrayHasKey('id', $output);
            $this->assertArrayHasKey('label', $output);
            $this->assertArrayHasKey('url', $output);
            if ($output['label'] == 'ogg') {
                $foundOgg = true;
            }
            if ($output['label'] == 'webm') {
                $foundWebm = true;
            }
            if ($output['label'] == 'mp4 high') {
                $foundMp4High = true;
            }
            if ($output['label'] == 'mp4 low') {
                $foundMp4Low = true;
            }
        }
        $this->assertTrue($foundOgg, 'Did not find outout labeled \'ogg\'');
        $this->assertTrue($foundWebm, 'Did not find outout labeled \'webm\'');
        $this->assertTrue($foundMp4High, 'Did not find outout labeled \'mp4 high\'');
        $this->assertTrue($foundMp4Low, 'Did not find outout labeled \'mp4 low\'');
    }

    protected function assertJsonResponse($response, $statusCode = 200, $checkValidJson = true, $contentType = 'application/json')
    {
        $this->assertEquals($statusCode, $response->getStatusCode(), $response->getContent());
        if ($checkValidJson) {
            $this->assertTrue($response->headers->contains('Content-Type', $contentType), "Header 'Content-Type' not found in: \n" . $response->headers);
            $decode = json_decode($response->getContent());
            $this->assertTrue(($decode != null && $decode != false), 'is response valid json: [' . $response->getContent() . ']');
        }
    }
}
