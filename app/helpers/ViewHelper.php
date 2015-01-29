<?php

/**
 * View Helper
 * 
 * Helper methods for views
 */
class ViewHelper
{
	/**
	 * Get current action name
	 * 
	 * @return string action name
	 */
	public static function getActionName()
	{
		$action = Route::currentRouteAction();

		return substr($action, strpos($action, '@') +1);
	}
}

	