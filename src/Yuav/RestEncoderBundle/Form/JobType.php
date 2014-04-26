<?php

namespace Yuav\RestEncoderBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JobType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('state')->add('created_at');
	}

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array('data_class' => 'Yuav\RestEncoderBundle\Entity\Job'));
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return '';
// 		return 'job';
// 		return 'yuav_restencoderbundle_job';
	}
}
