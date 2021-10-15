@extends('courses.partials.layout')

@section('meta')

<title>Course Completed | {{config('app.name')}}</title>

@endsection

@section('main_content')

<div class="container mt-13">
	<div class="col-md-8 offset-md-2 bg-white thanksContainer text-center">
		<img src="assets/images/vectors/hooray.png" class="img-fluid hooray" alt="Hooray" />
		<h3 class="title">Course Completed</h3>
		<p>
			You have successfully completed this course. You will receive your course completion certificate in your mailbox.
		</p>
		<a href="/student">
			<button class="btn btn-info btn-sm">Go to Dashbaord</button>
		</a>
	</div>
</div>

@endsection