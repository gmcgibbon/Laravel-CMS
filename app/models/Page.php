<?php

use Carbon\Carbon;
use LaravelBook\Ardent\Ardent;

/**
 * Page Ardent Model
 * 
 * Page table object model
 */
class Page extends Ardent 
{
	/**
	 * Ardent validation rules
	 */
	public static $rules =
	[
	    'title'     => 'required',
	    'content'   => 'required',
	    'permalink' => 'required|alpha_dash'
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

	/**
	 * Define accessible fileds
	 *
	 */
	protected $fillable = array('title', 'content', 'permalink');

	/**
	 * Get created at attribute date formatted
	 * 
	 * @param attr attribute value to format
	 * 
	 * @return formatted created at date string
	 */
	public function getCreatedAtAttribute($attr)
	{

		return Carbon::parse($attr)->format(Config::get('vars.date_format'));
	}

	/**
	 * Get updated at attribute date formatted
	 * 
	 * @param attr attribute value to format
	 * 
	 * @return formatted updated at date string
	 */
	public function getUpdatedAtAttribute($attr)
	{

		return Carbon::parse($attr)->format(Config::get('vars.date_format'));
	}

}
