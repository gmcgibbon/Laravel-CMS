<?php

/**
 * Page Helper
 * 
 * Helper methods for views
 */
class PageHelper
{
	/**
	 * Get current page name
	 * 
	 * @return string page name
	 */
	public static function getName()
	{
			$actionName = ucfirst(ViewHelper::getActionName());

			// special cases
			switch ($actionName)
			{
				case '':
					$actionName = 'Error';
					break;
				case 'Index':
					$actionName = 'Home';
					break;
			}

			return $actionName;
	}
	
	/**
	 * Get current page title
	 * 
	 * @return string page title
	 */
	public static function getTitle()
	{
		return self::getName() 
			. ' | ' . Config::get('vars.app_name');
	}

	/**
	 * Get custom page title
	 * 
	 * @param string custom title
	 * 
	 * @return string page title
	 */
	public static function getCustomTitle($title)
	{
		return $title 
			. ' | ' . Config::get('vars.app_name');
	}

	/**
	 * Get nav menu pages
	 * 
	 * @return Eloquent pages ordered by title and index setting
	 */
	public static function getNavigationPages()
	{
		$index = Cache::get('index', 0);

		$pages = Page::where('id', '<>', $index)->orderBy('title')->get();

		$home = Page::find($index);

		if (! is_null($home))
		{
			$pages->prepend($home);
		}

		return $pages;
	}
}