<?php

namespace Yuav\RestEncoderBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MediaType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('input')->add('test');
	}

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array('data_class' => 'Yuav\RestEncoderBundle\Entity\MediaFile'));
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
