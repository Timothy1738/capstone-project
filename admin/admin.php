<?php
include('includes/header.php');
$createdToday = getUsersCreatedToday();
?>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-3 col-sm-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div class="icon-box icon-box-lg bg-success-light rounded-circle">
								<svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M22.9715 29.3168C15.7197 29.3168 9.52686 30.4132 9.52686 34.8043C9.52686 39.1953 15.6804 40.331 22.9715 40.331C30.2233 40.331 36.4144 39.2328 36.4144 34.8435C36.4144 30.4543 30.2626 29.3168 22.9715 29.3168Z" stroke="#3AC977" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M22.9714 23.0537C27.7304 23.0537 31.5875 19.1948 31.5875 14.4359C31.5875 9.67694 27.7304 5.81979 22.9714 5.81979C18.2125 5.81979 14.3536 9.67694 14.3536 14.4359C14.3375 19.1787 18.1696 23.0377 22.9107 23.0537H22.9714Z" stroke="#3AC977" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</div>
							<div class="total-projects ms-3">
								<h3 class="text-success count"><?= getNumberOfUsers() ?></h3>
								<span>Users</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div class="icon-box icon-box-lg bg-success-light rounded-circle">
								<svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M22.9715 29.3168C15.7197 29.3168 9.52686 30.4132 9.52686 34.8043C9.52686 39.1953 15.6804 40.331 22.9715 40.331C30.2233 40.331 36.4144 39.2328 36.4144 34.8435C36.4144 30.4543 30.2626 29.3168 22.9715 29.3168Z" stroke="#3AC977" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M22.9714 23.0537C27.7304 23.0537 31.5875 19.1948 31.5875 14.4359C31.5875 9.67694 27.7304 5.81979 22.9714 5.81979C18.2125 5.81979 14.3536 9.67694 14.3536 14.4359C14.3375 19.1787 18.1696 23.0377 22.9107 23.0537H22.9714Z" stroke="#3AC977" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</div>
							<div class="total-projects ms-3">
								<h3 class="text-success count"><?= getNumberOfPromoters() ?></h3>
								<span>Promoters</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div class="icon-box icon-box-lg bg-purple-light rounded-circle">
								<svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M22.9717 41.0539C22.9717 41.0539 37.3567 36.6983 37.3567 24.6908C37.3567 12.6814 37.878 11.7439 36.723 10.5889C35.5699 9.43391 24.858 5.69891 22.9717 5.69891C21.0855 5.69891 10.3736 9.43391 9.21863 10.5889C8.0655 11.7439 8.58675 12.6814 8.58675 24.6908C8.58675 36.6983 22.9717 41.0539 22.9717 41.0539Z" stroke="#BB6BD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M26.4945 26.4642L19.4482 19.4179" stroke="#BB6BD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M19.4487 26.4642L26.495 19.4179" stroke="#BB6BD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</div>
							<div class="total-projects ms-3">
								<h3 class="text-purple count"><?= getNumberofPendingVideos() ?></h3>
								<span>Pending Videos</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div class="icon-box icon-box-lg bg-danger-light rounded-circle">
								<span class="me-3 bgl-warning text-warning">
									<svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
										<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
										<polyline points="14 2 14 8 20 8"></polyline>
										<line x1="16" y1="13" x2="8" y2="13"></line>
										<line x1="16" y1="17" x2="8" y2="17"></line>
										<polyline points="10 9 9 9 8 9"></polyline>
									</svg>
								</span>
							</div>
							<div class="total-projects ms-3">
								<h3 class="text-danger count"><?= getNumberOfAllVideos() ?></h3>
								<span>Videos Posted</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-12">
				<div class="card">
					<div class="card-body p-0">
						<div class="table-responsive active-projects">
							<div class="tbl-caption">
								<h4 class="heading mb-0">New Users</h4>
							</div>
							<table id="projects-tbl" class="table">
								<thead>
									<tr>
										<th>S/N</th>
										<th>User</th>
										<th>Email</th>
										<th>Contact</th>
										<th>Username</th>
										<th>DOB</th>
										<th>View Profile</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($createdToday)) { ?>
										<tr>
											<td colspan="6" style="text-align: center;">No User signed up today</td>
										</tr>
										<?php } else {
											$num = 0;
										foreach ($createdToday as $user) : ?>
											<tr>
												<td><?= $num += 1 ?></td>
												<td>
													<div class="d-flex align-items-center">
														<img src="../dbimages/<?= $user['profile_picture'] ?>" class="avatar avatar-md rounded-circle" alt="">
														<p class="mb-0 ms-2"><?= $user['firstname'] . ' ' . $user['lastname'] ?></p>
													</div>
												</td>
												<td>
													<?= $user['email'] ?>
												</td>
												<td class="pe-0">
													<?= $user['contact'] ?>
												</td>
												<td class="pe-0">
													<?= $user['username'] ?>
												</td>
												<td>
													<?= $user['dob'] ?>
												</td>
												<td>
													<a href="view-more.php?id=<?= $user['user_id'] ?>"><span class="badge badge-primary light border-0">view More</span></a>
												</td>
											</tr>
									<?php endforeach;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--**********************************
            Content body end
        ***********************************-->
<?php
include('includes/footer.php');
?>