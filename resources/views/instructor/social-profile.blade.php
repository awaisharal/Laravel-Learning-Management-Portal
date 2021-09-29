@extends('instructor.partials.layout')

@section('meta')

<title>Instructor Social Profile | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="card">
		<!-- Card header -->
		<div class="card-header">
			<h3 class="mb-0">Social Profiles</h3>
			<p class="mb-0">
				Add your social profile links in below social accounts.
			</p>
			@if(count($errors->all()) > 0)
				@if($errors->first() == 'success')
					<div class="alert alert-success mt-5 mb-3">
						Social updated successfully.
					</div>
				@endif
			@endif
		</div>
		<!-- Card body -->
		<div class="card-body">
			<form action="{{ route('instructor.socialUpdate') }}" method="POST">
				@csrf
				<div class="row mb-5">
					<div class="col-lg-3 col-md-4 col-12">
						<h5>Twitter</h5>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<input type="text" class="form-control mb-1" placeholder="Twitter Profile URL" value="{{ $user->twitter_link }}" name="twitter_link" />
						<small class="text-muted">Add your Twitter username (e.g. johnsmith).</small>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-lg-3 col-md-4 col-12">
						<h5>Facebook</h5>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<input type="text" class="form-control mb-1" placeholder="Facebook Profile URL"  value="{{ $user->fb_link }}" name="fb_link" />
						<small class="text-muted">Add your Facebook username (e.g. johnsmith).</small>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-lg-3 col-md-4 col-12">
						<h5>Github</h5>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<input type="text" class="form-control mb-1" placeholder="Github Profile URL" value="{{ $user->github_link }}" name="github_link" />
						<small class="text-muted">Add your github username (e.g. johnsmith).</small>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-lg-3 col-md-4 col-12">
						<h5>LinkedIn Profile URL</h5>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<input type="text" class="form-control mb-1" placeholder="LinkedIn Profile URL " value="{{ $user->linkedin_link }}" name="linkedin_link" />
						<small class="text-muted">Add your linkedin profile URL. (
							https://www.linkedin.com/in/example-a678vdsa)</small>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-lg-3 col-md-4 col-12">
						<h5>YouTube</h5>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<input type="text" class="form-control mb-1" placeholder="YouTube URL" value="{{ $user->youtube_link }}" name="youtube_link" />
						<small class="text-muted">Add your Youtube profile URL.
						</small>
					</div>
				</div>
				<div class="row">
					<div class="offset-lg-3 col-lg-6 col-12">
						<button type="submit" class="btn btn-primary">Save Social Profile</button>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>
@endsection