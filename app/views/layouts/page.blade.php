<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
            @yield('title', PageHelper::getTitle())
        </title>
        <meta charset="UTF-8">
        {{-- 
            Favicon image: https://raw.githubusercontent.com/laravel/art/master/sign-laravel.png
            Favicon font:  http://www.fontsquirrel.com/fonts/bevan
         --}}
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        {{ stylesheet_link_tag()    }}
        {{ javascript_include_tag() }}
        @yield('head')
	</head>
    <body>
        <div id="container">
            @include('layouts.status')
        	@include('layouts.header')
            
        	<div class="content">
            	@yield('content')
            </div>

            @include('layouts.footer')
        </div>
    </body>
</html>