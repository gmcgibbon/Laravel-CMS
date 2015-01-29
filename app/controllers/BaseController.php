<?php

/**
 * Base Controller
 *
 * @author Gannon McGibbon
 * 
 * Inherit common code
 */
class BaseController extends Controller
{
	/**
	 * Session error helper
	 * 
	 * @return void
	 */
	protected function putError($message)
	{
		Session::put('error', $message);
	}

	/**
	 * Session info helper
	 * 
	 * @return void
	 */
	protected function putInfo($message)
	{
		Session::put('info', $message);
	}

	/**
	 * Session success helper
	 * 
	 * @return void
	 */
	protected function putSuccess($message)
	{
		Session::put('success', $message);
	}

	/**
	 * Setup the layout used by the controller
	 * 
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
}
