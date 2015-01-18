<?php
namespace Yuav\RestEncoderBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManager;
use Yuav\RestEncoderBundle\Entity\Output;
use Yuav\RestEncoderBundle\Entity\MediaFile;
use Yuav\RestEncoderBundle\Entity\Input;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{

    private $em;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Then print response body
     */
    public function printResponseBody()
    {
        echo $this->getSession()->getPage()->getContent();
    }
    
    /**
     * @Given /There is no "([^"]*)" in database/
     */
    public function thereIsNoRecordInDatabase($entityName)
    {
        $entities = $this->getEntityManager()
            ->getRepository('YuavRestEncoderBundle:' . $entityName)
            ->findAll();
        foreach ($entities as $eachEntity) {
            $this->getEntityManager()->remove($eachEntity);
        }
        
        $this->getEntityManager()->flush();
    }

    /**
     * @Given /I have a job with input "([^"]*)"/
     */
    public function iHaveAJobWithInput($input)
    {
        $job = new \Yuav\RestEncoderBundle\Entity\Job();
        $inputEntity = new Input();
        $inputEntity->setUri($input);
        $job->setInput($inputEntity);
        
        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush();
    }

    /**
     * @Given /I have a job with progress "([^"]*)"/
     */
    public function iHaveAJobWithProgress($progress)
    {
        $job = new \Yuav\RestEncoderBundle\Entity\Job();
        $inputEntity = new Input();
        $inputEntity->setUri('dummyInput');
        $job->setInput($inputEntity);
        $job->setProgress($progress);
        $job->setState('encoding');        
        
        $input = new Input();
        $input->setUri('dummyUri');
        $job->setInput($input);
        
        $output1 = new Output();
        $output1->setCurrentEvent('Transcoding');
        $output1->setCurrentEventProgress(35.23532);
        $job->addOutput($output1);
       
        $output2 = new Output();
        $output2->setCurrentEvent('Uploading');
        $output2->setCurrentEventProgress(82.32);
        $job->addOutput($output2);
    
        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush();
    }
    
//     /**
//      * @Given /I have a product "([^"]*)"/
//      */
//     public function iHaveAProduct($name)
//     {
//         $product = new \Acme\DemoBundle\Entity\Product();
//         $product->setName($name);
        
//         $this->getEntityManager()->persist($product);
//         $this->getEntityManager()->flush();
//     }

//     /**
//      * @When /I add product "([^"]*)" to category "([^"]*)"/
//      */
//     public function iAddProductToCategory($productName, $categoryName)
//     {
//         $product = $this->getRepository('YuavRestEncoderBundle:Product')->findOneByName($productName);
//         $category = $this->getRepository('YuavRestEncoderBundle:Category')->findOneByName($categoryName);
        
//         $category->addProduct($product);
        
//         $this->getEntityManager()->persist($category);
//         $this->getEntityManager()->flush();
//     }

//     /**
//      * @Then /I should find product "([^"]*)" in category "([^"]*)"/
//      */
//     public function iShouldFindProductInCategory($productName, $categoryName)
//     {
//         $category = $this->getRepository('YuavRestEncoderBundle:Category')->findOneByName($categoryName);
        
//         $found = false;
//         foreach ($category->getProducts() as $product) {
//             if ($productName === $product->getName()) {
//                 $found = true;
//                 break;
//             }
//         }
        
//         assertTrue($found);
//     }

    /**
     * Returns the Doctrine entity manager.
     *
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->em;
    }

    /**
     * Returns the Doctrine repository manager for a given entity.
     *
     * @param string $entityName
     *            The name of the entity.
     *            
     * @return Doctrine\ORM\EntityRepository
     */
    protected function getRepository($entityName)
    {
        return $this->getEntityManager()->getRepository($entityName);
    }
}
