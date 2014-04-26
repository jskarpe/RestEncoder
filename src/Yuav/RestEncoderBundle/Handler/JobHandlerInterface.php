<?php
namespace Yuav\RestEncoderBundle\Handler;
use Yuav\RestEncoderBundle\Model\JobInterface;

interface JobHandlerInterface
{
	/**
	 * Get a Job given the identifier
	 *
	 * @api
	 *
	 * @param mixed $id
	 *
	 * @return JobInterface
	 */
	public function get($id);

}
