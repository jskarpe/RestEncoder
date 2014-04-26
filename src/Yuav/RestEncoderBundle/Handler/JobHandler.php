<?php
namespace Yuav\RestEncoderBundle\Handler;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Yuav\RestEncoderBundle\Model\JobInterface;
use Yuav\RestEncoderBundle\Form\JobType;
use Yuav\RestEncoderBundle\Exception\InvalidFormException;

class JobHandler implements JobHandlerInterface
{
	private $om;
	private $entityClass;
	private $repository;
	private $formFactory;

	public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
	{
		$this->om = $om;
		$this->entityClass = $entityClass;
		$this->repository = $this->om->getRepository($this->entityClass);
		$this->formFactory = $formFactory;
	}

	/**
	 * Get a list of Jobs.
	 *
	 * @param int $limit  the limit of the result
	 * @param int $offset starting from the offset
	 *
	 * @return array
	 */
	public function all($limit = 5, $offset = 0)
	{
		return $this->repository->findBy(array(), null, $limit, $offset);
	}

	/**
	 * Get a Job.
	 *
	 * @param mixed $id
	 *
	 * @return JobInterface
	 */
	public function get($id)
	{
		return $this->repository->find($id);
	}

	/**
	 * Create a new Job.
	 *
	 * @param array $parameters
	 *
	 * @return JobInterface
	 */
	public function post(array $parameters)
	{
		$job = $this->createJob();

		return $this->processForm($job, $parameters, 'POST');
	}

	/**
	 * Edit a Job.
	 *
	 * @param JobInterface  $job
	 * @param array         $parameters
	 *
	 * @return PageInterface
	 */
	public function put(JobInterface $job, array $parameters)
	{
		return $this->processForm($job, $parameters, 'PUT');
	}

	/**
	 * Partially update a Job.
	 *
	 * @param JonInterface  $job
	 * @param array         $parameters
	 *
	 * @return JobInterface
	 */
	public function patch(JobInterface $job, array $parameters)
	{
		return $this->processForm($job, $parameters, 'PATCH');
	}

	/**
	 * Processes the form.
	 *
	 * @param JobInterface  $job
	 * @param array         $parameters
	 * @param String        $method
	 *
	 * @return JobInterface
	 *
	 * @throws \Yuav\RestEncoderBundle\Exception\InvalidFormException
	 */
	private function processForm(JobInterface $job, array $parameters, $method = "PUT")
	{
		$form = $this->formFactory->create(new JobType(), $job, array('method' => $method));
		$form->submit($parameters, 'PATCH' !== $method);
		if ($form->isValid()) {

			$page = $form->getData();
			$this->om->persist($job);
			$this->om->flush($job);

			return $job;
		}

		throw new InvalidFormException('Invalid submitted data', $form);
	}

	private function createJob()
	{
		return new $this->entityClass();
	}

}