<?php
namespace Yuav\RestEncoderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Yuav\RestEncoderBundle\Entity\Output;

class JobType extends AbstractType
{

    /**
     *
     * @param FormBuilderInterface $builder            
     * @param array $options            
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('api_key')
            ->add('asperaTransferPolicy', null, array(
            'required' => false
        ))
            ->add('credentials', null, array(
            'required' => false
        ))
            ->add('downloadConnections')
            ->add('expectedMd5Checksum', null, array(
            'required' => false
        ))
            ->add('grouping', null, array(
            'required' => false
        ))
            ->add('input', null, array(
            'required' => true
        ))
            ->add('liveStream', null, array(
            'required' => false
        ))
            ->add('mock', null, array(
            'required' => false
        ))
            ->add('outputs', 'collection', array(
            'type' => new \Yuav\RestEncoderBundle\Form\OutputType(),
            'allow_add' => true,
            'required' => false,
            'by_reference' => false
        ))
            ->add('passThrough', null, array(
            'required' => false
        ))
            ->add('private', null, array(
            'required' => false
        ))
            ->add('region', null, array(
            'required' => false
        ))
            ->add('thumbnails', 'collection', array(
            'type' => new \Yuav\RestEncoderBundle\Form\ThumbnailType(),
            'allow_add' => true,
            'required' => false,
            'by_reference' => false
        ))
            ->add('test', null, array(
            'required' => false
        ))
            ->add('transferMaximumRate', null, array(
            'required' => false
        ))
            ->add('transferMinimumRate', null, array(
            'required' => false
        ));
        
        // Add listeners
        // $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPostSetData'));
    }

    /**
     *
     * @param OptionsResolverInterface $resolver            
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Yuav\RestEncoderBundle\Entity\Job',
            'csrf_protection' => false
        ));
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return '';
        // return 'job';
        // return 'yuav_restencoderbundle_job';
    }

    public function onPostSetData(FormEvent $event)
    {
        $job = $event->getData();
        $form = $event->getForm();
        
        // check if the Job object is "new"
        // If no data is passed to the form, the data is "null".
        // This should be considered a new "Job"
        if (! $job || null === $job->getId()) {
            if (0 == count($job->getOutputs())) {
                $job->addOutput(new Output());
            }
            $form->setData($job);
        }
    }
}
