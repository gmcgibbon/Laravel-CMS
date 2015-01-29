@extends('layouts.page')

@section('content')
	
	<h2>{{ PageHelper::getName() }}</h2>

	<h3>Pages</h3>
	@if (! $pages->isEmpty())
		<table>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Permalink</th>
				<th>Created At</th>
				<th>Updated At</th>
				<th></th>
				<th></th>
			</tr>
			@foreach ($pages as $page)
				<tr>
					<td>{{ $page->id }}</td>
					<td>{{ $page->title }}</td>
					<td>{{ $page->permalink }}</td>
					<td>{{ $page->created_at }}</td>
					<td>{{ $page->updated_at }}</td>
					<td>{{ link_to_route('page.edit', 'Edit', $page->id) }}</td>
					<td>{{ link_to_post_route('page.delete', 'Delete', 'delete', true, ['id' => $page->id]) }}</td>
				</tr>
			@endforeach
		</table>
	@else
		<p>There are currently no pages</p>
	@endif

	<h4>Create</h4>
	<p>{{ link_to_route('page.create', 'Add New Page') }}</p>

	<h4>Homepage</h4>
	{{ Form::open(['route' => 'page.index.set', 'class' => 'mini']) }}
    	{{ Form::select('index', $selectPages, $selectIndex) }}
    	{{ Form::submit('Change') }}
	{{ Form::close() }}

@stop