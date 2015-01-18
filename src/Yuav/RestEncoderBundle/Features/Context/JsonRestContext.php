<?php
namespace Yuav\RestEncoderBundle\Features\Context;

use Sanpi\Behatch\Context\BaseContext;
use Behat\Gherkin\Node\PyStringNode;
use Coduo\PHPMatcher\Factory\SimpleFactory;

class JsonRestContext extends BaseContext
{

    /**
     * @When I send a :method request to :url with JSON body:
     */
    public function iSendARequestToWithBody($method, $url, PyStringNode $body)
    {
        $client = $this->getSession()
            ->getDriver()
            ->getClient();
        
        // Set $_SERVER values
        $server = array(
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json'
        );
        
        // intercept redirection
        $client->followRedirects(false);
        
        $client->request($method, $this->locatePath($url), array(), array(), $server, $body->getRaw());
        $client->followRedirects(true);
        
        return $this->getSession()->getPage();
    }

    /**
     * @Then the JSON response should contain:
     */
    public function theJsonResponseShouldContain(PyStringNode $json)
    {
        $responseBody = $this->getSession()
            ->getPage()
            ->getContent();
        $responseJson = json_decode($responseBody, true);
        if (null === $responseJson) {
            $this->assertFalse(null === $responseJson, 'Invalid JSON: ' . $responseBody);
        }
        
        $matchJson = json_decode($json->getRaw(), true);
        $this->assertNestedArray($matchJson, $responseJson);
    }
    
    private function assertNestedArray($expectedArray, $actualArray)
    {
        foreach ($expectedArray as $key => $value) {
            $this->assertArrayHasKey($key, $actualArray);
            if (is_array($value)) {
                $this->assertNestedArray($value, $actualArray[$key]);
                continue;
            }
            $this->assertEquals($value, $actualArray[$key]);
        }
    }
}