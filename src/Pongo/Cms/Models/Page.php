<?php namespace Pongo\Cms\Models;

use Eloquent;

class Page extends Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

	/**
	 * Timestamp needed
	 * 
	 * @var boolean
	 */
	public $timestamps = true;

	/**
	 * Guarded mass-assignment property
	 * 
	 * @var array
	 */
	protected $guarded = array('id');

	/**
	 * Elements relationship
	 * Each element has many and belongs to many pages
	 * 
	 * @return mixed
	 */
	public function elements()
	{
		return $this->belongsToMany('Pongo\Cms\Models\Element')
					->withPivot('order_id')
					->orderBy('order_id', 'asc');
	}

	/**
	 * Files relationship
	 * Each page has many and belongs to many files
	 * 
	 * @return mixed
	 */
	public function files()
	{
		return $this->belongsToMany('Pongo\Cms\Models\File');
	}

	/**
	 * Other page relationship
	 * Each page has many and belongs to many related pages
	 * 
	 * @return mixed
	 */
	public function rels()
	{
		return $this->belongsToMany('Pongo\Cms\Models\Page', 'page_page', 'page_id', 'rel_id');
	}

	/**
	 * Author relationship
	 * Each page has one author
	 * 
	 * @return mixed
	 */
	public function author()
	{
		return $this->hasOne('Pongo\Cms\Models\User', 'author_id');
	}

}