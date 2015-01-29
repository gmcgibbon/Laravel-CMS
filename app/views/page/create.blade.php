@extends('layouts.page')

@section('head')
	<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>
	<script type="text/javascript">
		//<![CDATA[ 
		$(function(){ $("form textarea[name='content']").ckeditor() });
		//]]>
	</script>
@stop

@section('content')

	<h2>New Page</h2>

	{{ Form::model($page, ['route' => 'page.add']) }}

		@if ($errors->any())
			<div class="errors">
				<h3>Error</h3>
				<ul>
				@foreach ($errors->toArray() as $error)
					<li>{{ $error[0] }}</li>
				@endforeach
				</ul>
			</div>
		@endif

		{{ Form::token() }}
		<br>
		{{ Form::label('title', 'Title:') }}
		{{ Form::text ('title') }}
		<br>
		{{ Form::label('content', 'Content:') }}
		{{ Form::textarea ('content') }}
		<br>
		{{ Form::label('permalink', 'Permalink:') }}
		{{ Form::text ('permalink') }}
		<br>
		{{ Form::submit ('Create') }}

	{{ Form::close() }}
@stop