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
		$builder
			->add('apiKey')
			->add('asperaTransferPolicy', null, array('required' => false))
			->add('credentials', null, array('required' => false))
			->add('downloadConnections')
			->add('expectedMd5Checksum', null, array('required' => false))
			->add('grouping', null, array('required' => false))
			->add('input')
			->add('liveStream', null, array('required' => false))
			->add('mock', null, array('required' => false))
			->add('outputs', null, array('required' => false))
			->add('passThrough', null, array('required' => false))
			->add('private', null, array('required' => false))
			->add('region', null, array('required' => false))
			->add('test', null, array('required' => false))
			->add('transferMaximumRate', null, array('required' => false))
			->add('transferMinimumRate', null, array('required' => false));
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
