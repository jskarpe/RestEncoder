<?php


use Codeception\Util\Stub;
class ExampleTest extends \Codeception\TestCase\Cest
{
    
    // test
    public function checkLogin(\AcceptanceTester $I)
    {
        $I->wantTo('log in to site');
        $I->amOnPage('/');
        $I->click('Login');
        $I->fillField('username', 'jon');
        $I->fillField('password','coltrane');
        $I->click('Enter');
        $I->see('Hello, Jon');
        $I->seeInCurrentUrl('/account');
    }
    
    
    
//     public function testExample()
//     {
        
        
        
        
//         $example = true;
//         $this->assertSame($example, true);
//     }
}


// $I = new ApiTester ($scenario);
// $I->wantTo('create a new user by API');
// $I->amHttpAuthenticated('davert','123456');
// $I->haveHttpHeader('Content-Type','application/x-www-form-urlencoded');
// $I->sendPOST('/users', array('name' => 'davert' ));
// $I->seeResponseCodeIs(200);
// $I->seeResponseIsJson();
// $I->seeResponseContainsJson(array('result' => 'ok'));