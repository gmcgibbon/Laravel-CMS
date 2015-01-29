<?php

/**
 * Page Controller
 * 
 * @author Gannon McGibbon
 * 
 * Page actions
 */
class PageController extends BaseController
{
	/**
	 * Page show
	 * 
	 * @param id   Page id
	 * @param link Page permalink or null
	 * 
	 * @return show view or index if not found
	 */
	public function show($id, $link = null)
	{
		$page = Page::find($id);

		if (! is_null($page))
		{
			$view = View::make('page.show')
				->with(['page' => $page]);
		}
		else
		{
			$this->putError("Page {$id} could not be found!");

			$view = Redirect::route('page.index');
		}

		return $view;
	}

	/**
	 * Page create
	 * 
	 * @return create view
	 */
	public function create()
	{
		return View::make('page.create')
			->with(['page' => new Page]);
	}

	/**
	 * Page add
	 * 
	 * @return index view or back to create on error
	 */
	public function add()
	{
		$page = new Page(Input::all());

		if ($page->save())
		{
			$this->putSuccess("Page {$page->id} created successfully!");

			$view = Redirect::route('page.admin');
		}
		else
		{
			$this->putError('There was a problem adding your page!');

			$view = Redirect::back()
				->withInput()
				->withErrors($page->errors()->all());
		}

		return $view;
	}

	/**
	 * Page edit
	 * 
	 * @param id Page id to edit
	 * 
	 * @return edit view or index if not found
	 */
	public function edit($id)
	{
		$page = Page::find($id);

		if (! is_null($page))
		{
			$view = View::make('page.edit')
				->with(['page' => $page]);
		}
		else
		{
			$this->putError("Page {$id} could not be found!");

			$view = Redirect::route('page.index');
		}
		
		return $view;
	}

	/**
	 * Page update
	 * 
	 * @param id Page id to update
	 * 
	 * @return index view or back to update on error
	 */
	public function update($id)
	{
		$page = Page::find($id);
		$page->title     = Input::get('title');
		$page->content   = Input::get('content');
		$page->permalink = Input::get('permalink');

		if ($page->save())
		{
			$this->putSuccess("Page {$id} has been updated!");

			$view = Redirect::route('page.admin');
		}
		else
		{
			$this->putError("There was a problem updaing page {$id}!");

			$view = Redirect::back()
				->withInput()
				->withErrors($page->errors()->all());
		}

		return $view;
	}

	/**
	 * Page delete
	 * 
	 * @param id Page id to delete
	 * 
	 * @return index view
	 */
	public function delete($id)
	{
		$page = Page::find($id);

		if ($page->delete())
		{
			$this->putSuccess("Page {$id} has been deleted!");

			$view = Redirect::route('page.admin');
		}
		else
		{
			$this->putError('Page {$id} could not be deleted!');

			$view = Redirect::route('page.index');
		}

		return $view;
	}

	/**
	 * Set index/home page
	 * 
	 * @return Admin page or index view on error
	 */
	public function setIndex()
	{
		$index = Input::get('index', '');
		$page  = Page::find($index);

		if (! is_null($page) || $index == 0)
		{
			$title = $index == 0 ?
				'Default' : $page->title;

			Cache::forever('index', $index);

			$this->putSuccess("Your home page is now {$title}!");

			$view = Redirect::route('page.admin');
		}
		else
		{
			$this->putError('Page {$index} could not be set as your home page!');

			$view = Redirect::route('page.index');
		}
		

		return $view;
	}

	/**
	 * Index/home page
	 * 
	 * @return index/root view
	 */
	public function index()
	{
		$page = Page::find(Cache::get('index', 0));

		if (! is_null($page))
		{
			$view = View::make('page.show')
				->with(['page' => $page]);
		}
		else
		{
			$view = View::make('page.default');
		}

		return $view;
	}

	/**
	 * Login page
	 * 
	 * @return login view
	 */
	public function login()
	{
		return View::make('page.login');
	}

	/**
	 * Admin page
	 * 
	 * @return admin view
	 */
	public function admin()
	{
		$pages       = Page::all();
		$selectPages = ['0' => 'Default'] + $pages->lists('title', 'id');
		$selectIndex = Cache::get('index', 0);

		return View::make('page.admin')
			->with(['pages'       => $pages, 
					'selectPages' => $selectPages, 
					'selectIndex' => $selectIndex]);
	}
}
