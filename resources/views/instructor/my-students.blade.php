@extends('instructor.partials.layout')

@section('meta')

<title>Instructor Reviews | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="card mb-4">
		<!-- Card body -->
		<div class="p-4 d-flex justify-content-between align-items-center">
			<div>
				<h3 class="mb-0">Students</h3>
				<span>Meet people taking your course.</span>
			</div>
			<!-- Nav -->
				<div class="nav btn-group flex-nowrap" role="tablist">
					<button class="btn btn-outline-white active" data-bs-toggle="tab" data-bs-target="#tabPaneGrid" role="tab"
						aria-controls="tabPaneGrid" aria-selected="true">
						<span class="fe fe-grid"></span>
					</button>
					<button class="btn btn-outline-white" data-bs-toggle="tab" data-bs-target="#tabPaneList" role="tab"
						aria-controls="tabPaneList" aria-selected="false">
						<span class="fe fe-list"></span>
					</button>
				</div>
		</div>
	</div>
	<!-- Tab content -->
	<div class="tab-content">
		<div class="tab-pane fade show active pb-4" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-12 mb-3">
					<!-- Content -->
					<div class="row">
						<div class="col pe-0">
							<!-- Form -->
							<form>
								<input type="search" class="form-control" placeholder="Search by Name" />
							</form>
						</div>
						<!-- Button -->
						<div class="col-auto">
							<a href="#" class="btn btn-secondary">Export CSV</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card body -->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-3.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Wade Warren</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>United States
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark"> 3/12/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 0% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card body -->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-2.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Dianna Smiley</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>India
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark"> 3/11/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 12% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card Body -->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-1.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Esther Howard</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>UK
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark">4/10/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 14% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card body -->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-5.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Guy Hawkins</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>Brazil
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark">4/09/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 34% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card body -->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-10.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Jacob Jones</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>Chile
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark">3/12/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 23% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card body -->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-4.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Kristin Watson</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>Estonia
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark">8/12/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 45% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card body-->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-6.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Rivao Luke</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>Greece
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark">18/12/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 100% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card body -->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-8.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Nia Sikhone</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>Egypt
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark">2/12/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 67% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12 d-none d-lg-block">
					<!-- Card -->
					<div class="card mb-4">
						<!-- Card body -->
						<div class="card-body">
							<div class="text-center">
								<img src="../assets/images/avatar/avatar-9.jpg" class="rounded-circle avatar-xl mb-3" alt="" />
								<h4 class="mb-1">Xiaon Merry</h4>
								<p class="mb-0 fs-6">
									<i class="fe fe-map-pin me-1"></i>Denmark
								</p>
								<a href="#" class="btn btn-sm btn-outline-white mt-3">Message</a>
							</div>
							<div class="d-flex justify-content-between border-bottom py-2 mt-4 fs-6">
								<span>Enrolled</span>
								<span class="text-dark">7/12/2020</span>
							</div>
							<div class="d-flex justify-content-between pt-2 fs-6">
								<span>Progress</span>
								<span class="text-success"> 65% </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-12">
					<!-- Pagination -->
					<nav>
						<ul class="pagination justify-content-center mb-0">
							<li class="page-item disabled">
								<a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true"><i
										class="mdi mdi-chevron-left"></i></a>
							</li>
							<li class="page-item active">
								<a class="page-link mx-1 rounded" href="#">1</a>
							</li>
							<li class="page-item">
								<a class="page-link mx-1 rounded" href="#">2</a>
							</li>
							<li class="page-item">
								<a class="page-link mx-1 rounded" href="#">3</a>
							</li>
							<li class="page-item">
								<a class="page-link mx-1 rounded" href="#"><i class="mdi mdi-chevron-right"></i></a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!-- Tab pane -->
		<div class="tab-pane fade" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
			<div class="card">
				<div class="card-header border-bottom-0">
					<div class="row">
						<div class="col pe-0">
							<form>
								<input type="search" class="form-control" placeholder="Search by Name" />
							</form>
						</div>
						<div class="col-auto">
							<a href="#" class="btn btn-secondary">Export CSV</a>
						</div>
					</div>
				</div>
				<!-- Table -->
				<div class="table-responsive">
					<table class="table">
						<thead class="table-light">
							<tr>
								<th scope="col" class="border-0">Name</th>
								<th scope="col" class="border-0">Enrolled</th>
								<th scope="col" class="border-0">Progress</th>
								<th scope="col" class="border-0">Q/A</th>
								<th scope="col" class="border-0">Locations</th>
								<th scope="col" class="border-0">Message</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="align-middle border-top-0">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-3.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Guy Hawkins</h5>
									</div>
								</td>
								<td class="align-middle border-top-0">3/12/2020</td>
								<td class="align-middle border-top-0">0%</td>
								<td class="align-middle border-top-0">0</td>
								<td class="align-middle border-top-0">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Greece</span>
								</td>
								<td class="pe-0 align-middle border-top-0">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-2.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Dianna Smiley</h5>
									</div>
								</td>
								<td class="align-middle">3/11/2020</td>
								<td class="align-middle">12%</td>
								<td class="align-middle">2</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>India</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-5.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Guy Hawkins</h5>
									</div>
								</td>
								<td class="align-middle">3/11/2020</td>
								<td class="align-middle">34%</td>
								<td class="align-middle">4</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Brazil</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-10.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Jacob Jones</h5>
									</div>
								</td>
								<td class="align-middle">3/12/2020</td>
								<td class="align-middle">44%</td>
								<td class="align-middle">5</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Chile</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-8.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Kristin Watson</h5>
									</div>
								</td>
								<td class="align-middle">18/12/2020</td>
								<td class="align-middle">45%</td>
								<td class="align-middle">9</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Estonia</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-6.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Rivao Luke</h5>
									</div>
								</td>
								<td class="align-middle">8/12/2020</td>
								<td class="align-middle">100%</td>
								<td class="align-middle">5</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Greece</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-7.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Nia Sikhone</h5>
									</div>
								</td>
								<td class="align-middle">8/12/2020</td>
								<td class="align-middle">67%</td>
								<td class="align-middle">3</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Egypt</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
							<tr class="border-bottom">
								<td class="align-middle">
									<div class="d-flex align-items-center">
										<img src="../assets/images/avatar/avatar-9.jpg" alt="" class="rounded-circle avatar-md me-2" />
										<h5 class="mb-0">Xiaon Merry</h5>
									</div>
								</td>
								<td class="align-middle">7/12/2020</td>
								<td class="align-middle">65%</td>
								<td class="align-middle">4</td>
								<td class="align-middle">
									<span class="fs-6"><i class="fe fe-map-pin me-1"></i>Denmark</span>
								</td>
								<td class="pe-0 align-middle">
									<a href="#" class="btn btn-outline-white btn-sm">Message</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="pt-2 pb-4">
					<!-- Pagination -->
					<nav>
						<ul class="pagination justify-content-center mb-0">
							<li class="page-item disabled">
								<a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true"><i
										class="mdi mdi-chevron-left"></i></a>
							</li>
							<li class="page-item active">
								<a class="page-link mx-1 rounded" href="#">1</a>
							</li>
							<li class="page-item">
								<a class="page-link mx-1 rounded" href="#">2</a>
							</li>
							<li class="page-item">
								<a class="page-link mx-1 rounded" href="#">3</a>
							</li>
							<li class="page-item">
								<a class="page-link mx-1 rounded" href="#"><i class="mdi mdi-chevron-right"></i></a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection