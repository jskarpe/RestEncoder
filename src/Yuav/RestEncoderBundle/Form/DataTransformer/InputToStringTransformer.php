<?php
namespace Yuav\RestEncoderBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Yuav\RestEncoderBundle\Entity\Input;

class InputToStringTransformer implements DataTransformerInterface
{

//     /**
//      *
//      * @var ObjectManager
//      */
//     private $om;

//     /**
//      *
//      * @param ObjectManager $om            
//      */
//     public function __construct(ObjectManager $om)
//     {
//         $this->om = $om;
//     }

    /**
     * Transforms an object (input) to a string (uri).
     *
     * @param Input|null $issue            
     * @return string
     */
    public function transform($input)
    {
        if (null === $input) {
            return "";
        }
        
        if (! $input instanceof Input) {
            throw new \InvalidArgumentException('Expected Input object as argument, got: ' . get_type($input));
        }
        
        return $input->getUri();
    }

    /**
     * Transforms a string (uri) to an object (input).
     *
     * @param string $uri            
     *
     * @return Issue|null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($uri)
    {
        if (! $uri) {
            return null;
        }

        $input = new Input();
        $input->setUri($uri);
        return $input;
    }
}