<?php

namespace Yuav\RestEncoderBundle\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Yuav\RestEncoderBundle\Exception\InvalidFormException;
use Yuav\RestEncoderBundle\Form\JobType;
use Yuav\RestEncoderBundle\Model\JobInterface;

class JobController extends FOSRestController
{

	/**
	 * List all jobs.
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   statusCodes = {
	 *     200 = "Returned when successful"
	 *   }
	 * )
	 *
	 * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing pages.")
	 * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many pages to return.")
	 *
	 * @Annotations\View(
	 *  templateVar="jobs"
	 * )
	 *
	 * @param Request               $request      the request object
	 * @param ParamFetcherInterface $paramFetcher param fetcher service
	 *
	 * @return array
	 */
	public function getJobsAction(Request $request, ParamFetcherInterface $paramFetcher)
	{
		$offset = $paramFetcher->get('offset');
		$offset = null == $offset ? 0 : $offset;
		$limit = $paramFetcher->get('limit');
		return $this->container->get('yuav_rest_encoder.job.handler')->all($limit, $offset);
	}

	/**
	 * Get single Job,
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   description = "Gets a Job for a given id",
	 *   output = "Yuav\RestEncoderBundle\Entity\Job",
	 *   statusCodes = {
	 *     200 = "Returned when successful",
	 *     404 = "Returned when the page is not found"
	 *   }
	 * )
	 *
	 * @Annotations\View(templateVar="job")
	 *
	 * @param Request $request the request object
	 * @param int     $id      the job id
	 *
	 * @return array
	 *
	 * @throws NotFoundHttpException when job doesn't exist
	 */
	public function getJobAction(Request $request, $id)
	{
		$job = $this->getOr404($id);
		return $job;
	}

	/**
	 * Presents the form to use to create a new job.
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   statusCodes = {
	 *     200 = "Returned when successful"
	 *   }
	 * )
	 *
	 * @Annotations\View(
	 *  templateVar = "form"
	 * )
	 *
	 * @return FormTypeInterface
	 */
	public function newJobAction()
	{
		return $this->createForm(new JobType());
	}

	/**
	 * Create a Job from the submitted data.
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   description = "Creates a new job from the submitted data.",
	 *   input = "Yuav\RestEncoderBundle\Form\JobType",
	 *   statusCodes = {
	 *     200 = "Returned when successful",
	 *     400 = "Returned when the form has errors"
	 *   }
	 * )
	 *
	 * @Annotations\View(
	 *  template = "YuavRestEncoderBundle:Job:newJob.html.twig",
	 *  statusCode = Codes::HTTP_BAD_REQUEST,
	 *  templateVar = "form"
	 * )
	 *
	 * @param Request $request the request object
	 *
	 * @return FormTypeInterface|View
	 */
	public function postJobAction(Request $request)
	{
		try {
			$newJob = $this->container->get('yuav_rest_encoder.job.handler')
					->post($request->request->all());
			
			// Publish job to RabbitMQ
			$msg = array('job_id' => $newJob->getId());
			$producer = $this->get('old_sound_rabbit_mq.job_queue_producer');
			$producer->publish(json_encode($msg));
			
			// Add location header to newly created job
			$routeOptions = array('id' => $newJob->getId(), '_format' => $request->get('_format'));
			return $this->routeRedirectView('api_1_get_job', $routeOptions, Codes::HTTP_CREATED);
			
			// Zencoder format
// 			return array('id' => $newJob->getId(), 'test' => $newJob->getTest(), 'outputs' => $newJob->getOutputs());
		} catch (InvalidFormException $exception) {
			return $exception->getForm();
		}
		
		
	}

	/**
	 * Update existing job from the submitted data or create a new job at a specific location.
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   input = "Yuav\RestEncoderBundle\Form\JobType",
	 *   statusCodes = {
	 *     201 = "Returned when the Job is created",
	 *     204 = "Returned when successful",
	 *     400 = "Returned when the form has errors"
	 *   }
	 * )
	 *
	 * @Annotations\View(
	 *  template = "YuavRestEncoderBundle:Job:editJob.html.twig",
	 *  templateVar = "form"
	 * )
	 *
	 * @param Request $request the request object
	 * @param int     $id      the page id
	 *
	 * @return FormTypeInterface|View
	 *
	 * @throws NotFoundHttpException when page not exist
	 */
	public function putJobAction(Request $request, $id)
	{
		try {
			if (!($job = $this->container->get('yuav_rest_encoder.job.handler')->get($id))) {
				$statusCode = Codes::HTTP_CREATED;
				$job = $this->container->get('yuav_rest_encoder.job.handler')
						->post($request->request->all());
			} else {
				$statusCode = Codes::HTTP_NO_CONTENT;
				$job = $this->container->get('yuav_rest_encoder.job.handler')
						->put($job, $request->request->all());
			}

			$routeOptions = array('id' => $job->getId(), '_format' => $request->get('_format'));

			return $this->routeRedirectView('api_1_get_job', $routeOptions, $statusCode);

		} catch (InvalidFormException $exception) {

			return $exception->getForm();
		}
	}

	/**
	 * Update existing job from the submitted data or create a new job at a specific location.
	 *
	 * @ApiDoc(
	 *   resource = true,
	 *   input = "Yuav\RestEncoderBundle\Form\JobType",
	 *   statusCodes = {
	 *     204 = "Returned when successful",
	 *     400 = "Returned when the form has errors"
	 *   }
	 * )
	 *
	 * @Annotations\View(
	 *  template = "YuavRestEncoderBundle:Job:editJob.html.twig",
	 *  templateVar = "form"
	 * )
	 *
	 * @param Request $request the request object
	 * @param int     $id      the job id
	 *
	 * @return FormTypeInterface|View
	 *
	 * @throws NotFoundHttpException when job not exist
	 */
	public function patchJobAction(Request $request, $id)
	{
		try {
			$job = $this->container->get('yuav_rest_encoder.job.handler')
					->patch($this->getOr404($id), $request->request->all());

			$routeOptions = array('id' => $job->getId(), '_format' => $request->get('_format'));

			return $this->routeRedirectView('api_1_get_job', $routeOptions, Codes::HTTP_NO_CONTENT);

		} catch (InvalidFormException $exception) {

			return $exception->getForm();
		}
	}

	/**
	 * Fetch a Page or throw an 404 Exception.
	 *
	 * @param mixed $id
	 *
	 * @return JobInterface
	 *
	 * @throws NotFoundHttpException
	 */
	protected function getOr404($id)
	{
		if (!($job = $this->container->get('yuav_rest_encoder.job.handler')->get($id))) {
			throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
		}

		return $job;
	}
}

