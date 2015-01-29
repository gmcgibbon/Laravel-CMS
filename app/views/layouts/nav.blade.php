<nav>
	<ul>
		@foreach (PageHelper::getNavigationPages() as $page)
			<li>{{ link_to_route('page.show', $page->title, [ $page->id, $page->permalink]) }}</li>
		@endforeach

		@if (Auth::check())
			<li>{{ link_to_route('page.admin', 'Admin') }}</li>
			<li>{{ link_to_post_route('auth.logout', 'Logout', 'delete') }}</li>
		@else
			<li>{{ link_to_route('auth.login', 'Login') }}</li>
		@endif
	</ul>
</nav>