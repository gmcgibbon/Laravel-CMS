@extends('layouts.page')

@section('title')
	{{ PageHelper::getCustomTitle($page->title) }}
@stop

@section('content')
	<section>
		<h2>
			{{ $page->title }}
		</h2>
		@if (Auth::check())
			<p>{{ link_to_route('page.edit', 'Edit', $page->id) }}</p>
		@endif
		
		<br>
		{{ $page->content }}
		<br>
	</section>
@stop