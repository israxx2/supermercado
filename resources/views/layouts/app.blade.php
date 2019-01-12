<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Default') | Panel de Administración</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	@php if(!isset($resourceLink)) $resourceLink = 'general'; @endphp
	@php if(!isset($resourceScript)) $resourceScript = 'general'; @endphp

	@include('layouts.resources.link', ['resourceLink' => $resourceLink])
</head>


@include('layouts.partials.navbar')
@include('layouts.partials.sidebar_l')

<body class="hold-transition skin-red sidebar-mini">

	<div class="wrapper">
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">


			@yield('content')


		</div>
		<!-- /.content-wrapper -->
		
	</div>
	@include('layouts.partials.footer')
	@include('layouts.partials.sidebar_r')




	@include('layouts.resources.script', ['resourceScript' => $resourceScript])	


</body>

</html>