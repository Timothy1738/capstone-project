<?php
session_start();
if (!isset($_SESSION['promoter_id'])) {
	header("location: logout.php");
}
include "../backend/functions.php";

$promoter = get_promoter($_SESSION['promoter_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Yeshadmin:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:title" content="Yeshadmin:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:description" content="Yeshadmin:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:image" content="https://yeshadmin.dexignzone.com/">
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>Talent Management System</title>
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="./assets/images/favicon.png">

	<link href="./assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="./assets/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
	<link href="./assets/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="./../cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
	<link href="./assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="./../cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="./assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link href="./assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

	<style>
		/*video styling - actual video*/
		.video {
			/* background-color: rgb(63, 63, 155); */
			border-radius: 10px;
			width: 100%;
			padding-bottom: 56.25%;
			position: relative;
			background-color: #030C11;
		}

		video {
			width: 100%;
			height: 100%;
			object-fit: contain;
			/* Ensure video covers the container */
			border-radius: 10px;
			position: absolute;
			top: 0;
			left: 0;
		}

		.error {
			color: #d8000c;
			background-color: #ffbaba;
			display: block;
			/* Show the message div */
			margin-top: 10px;
			padding: 10px;
			border-radius: 5px;
			font-weight: bold;
			text-align: center;
		}

		.success {
			color: #4f8a10;
			background-color: #dff2bf;
			display: block;
			/* Show the message div */
			margin-top: 10px;
			padding: 10px;
			border-radius: 5px;
			font-weight: bold;
			text-align: center;
		}
	</style>

	<!-- tagify-css -->
	<link href="./assets/vendor/tagify/dist/tagify.css" rel="stylesheet">

	<!-- Style css -->
	<link href="./assets/css/style.css" rel="stylesheet">

</head>

<body>

	<!-- *******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div>
			<img src="./assets/images/pre.gif" alt="">
		</div>
	</div>
	<!--*******************
        Preloader end
    ******************** -->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">
		<!--**********************************
            Nav header start
        ***********************************-->
		<div class="nav-header">
			<a href="home.php" class="brand-logo">
				<svg class="logo-abbr" width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M31.3287 2.96046L26.3411 0.0805375C26.1549 -0.0268458 25.9256 -0.0268458 25.7394 0.0805375C19.754 3.53731 12.3785 3.53785 6.39259 0.0816161L6.39043 0.0805375C6.20426 -0.0268458 5.97493 -0.0268458 5.78876 0.0805375L0.801104 2.95992C0.614937 3.0673 0.5 3.26588 0.5 3.48119V9.24049C0.5 9.4558 0.614937 9.65438 0.801104 9.76176C6.78759 13.2169 10.4753 19.6038 10.4753 26.5162V26.5184C10.4753 26.7332 10.5903 26.9323 10.7764 27.0397L15.7641 29.9196C15.8574 29.9736 15.961 30 16.0652 30C16.1693 30 16.2729 29.973 16.3663 29.9196L21.3539 27.0397C21.5401 26.9323 21.655 26.7337 21.655 26.5184C21.6545 19.6059 25.3422 13.2185 31.3287 9.7623L31.3298 9.76176C31.516 9.65438 31.6309 9.4558 31.6309 9.24049V3.48173C31.6293 3.26642 31.5149 3.06784 31.3287 2.96046ZM30.4259 8.89352L15.7635 17.359C15.5774 17.4664 15.4624 17.665 15.4624 17.8803V22.4168C14.9876 22.651 14.6692 23.1534 14.7043 23.7259C14.7458 24.3993 15.2854 24.9471 15.9589 24.9978C16.7591 25.0582 17.4272 24.4263 17.4272 23.639C17.4272 23.1026 17.1169 22.6386 16.6663 22.4163C16.6663 19.824 18.0493 17.4286 20.2941 16.1324L20.4496 16.0429L20.4501 26.1714L16.0641 28.7038L11.6781 26.1714V9.24103C11.6781 9.02627 11.5632 8.82715 11.377 8.71976L7.44754 6.45123C7.4497 6.42155 7.45078 6.39187 7.45078 6.36165C7.45078 5.59162 6.81187 4.97052 6.03537 5.0002C5.32901 5.02718 4.75378 5.60241 4.7268 6.30877C4.69712 7.08527 5.31822 7.72471 6.08825 7.72471C6.36885 7.72471 6.62948 7.63999 6.84587 7.49484C9.09066 8.79099 10.4737 11.1863 10.4737 13.7786V13.9573L1.70172 8.89406V3.82978L6.08771 1.29737L20.7501 9.76284C20.9363 9.87022 21.1656 9.87022 21.3518 9.76284L25.2807 7.4943C25.4993 7.64108 25.7631 7.72579 26.0464 7.72417C26.7895 7.71986 27.3998 7.10686 27.4009 6.36381C27.4019 5.60997 26.7916 4.99912 26.0383 4.99912C25.2856 4.99912 24.6758 5.60943 24.6758 6.36165C24.6758 6.39187 24.6769 6.42155 24.6791 6.45123C22.4337 7.74738 19.6676 7.74738 17.4223 6.45123L17.268 6.36219L26.0383 1.29737L30.4243 3.82978V8.89352H30.4259Z" fill="white" />
				</svg>
				<svg class="brand-title" width="111" height="24" viewBox="0 0 111 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect class="yesh" width="49" height="22" transform="translate(0 1)" fill="white" />
					<path class="admin1" d="M14.296 7.172L10.894 13.752V17H8.5V13.752L5.098 7.172H7.814L9.718 11.288L11.608 7.172H14.296ZM21.3786 15.264H17.7106L17.1226 17H14.6166L18.1726 7.172H20.9446L24.5006 17H21.9666L21.3786 15.264ZM20.7626 13.416L19.5446 9.818L18.3406 13.416H20.7626ZM29.1388 17.098C28.4202 17.098 27.7762 16.9813 27.2068 16.748C26.6375 16.5147 26.1802 16.1693 25.8348 15.712C25.4988 15.2547 25.3215 14.704 25.3028 14.06H27.8508C27.8882 14.424 28.0142 14.704 28.2288 14.9C28.4435 15.0867 28.7235 15.18 29.0688 15.18C29.4235 15.18 29.7035 15.1007 29.9088 14.942C30.1142 14.774 30.2168 14.5453 30.2168 14.256C30.2168 14.0133 30.1328 13.8127 29.9648 13.654C29.8062 13.4953 29.6055 13.3647 29.3628 13.262C29.1295 13.1593 28.7935 13.0427 28.3548 12.912C27.7202 12.716 27.2022 12.52 26.8008 12.324C26.3995 12.128 26.0542 11.8387 25.7648 11.456C25.4755 11.0733 25.3308 10.574 25.3308 9.958C25.3308 9.04333 25.6622 8.32933 26.3248 7.816C26.9875 7.29333 27.8508 7.032 28.9148 7.032C29.9975 7.032 30.8702 7.29333 31.5328 7.816C32.1955 8.32933 32.5502 9.048 32.5968 9.972H30.0068C29.9882 9.65467 29.8715 9.40733 29.6568 9.23C29.4422 9.04333 29.1668 8.95 28.8308 8.95C28.5415 8.95 28.3082 9.02933 28.1308 9.188C27.9535 9.33733 27.8648 9.55667 27.8648 9.846C27.8648 10.1633 28.0142 10.4107 28.3128 10.588C28.6115 10.7653 29.0782 10.9567 29.7128 11.162C30.3475 11.3767 30.8608 11.582 31.2528 11.778C31.6542 11.974 31.9995 12.2587 32.2888 12.632C32.5782 13.0053 32.7228 13.486 32.7228 14.074C32.7228 14.634 32.5782 15.1427 32.2888 15.6C32.0088 16.0573 31.5982 16.4213 31.0568 16.692C30.5155 16.9627 29.8762 17.098 29.1388 17.098ZM42.7081 7.172V17H40.3141V12.954H36.5901V17H34.1961V7.172H36.5901V11.022H40.3141V7.172H42.7081Z" fill="#222B40" />
					<path class="admin2" d="M63.484 16.016H59.292L58.62 18H55.756L59.82 6.768H62.988L67.052 18H64.156L63.484 16.016ZM62.78 13.904L61.388 9.792L60.012 13.904H62.78ZM72.4969 6.768C73.6809 6.768 74.7155 7.00267 75.6009 7.472C76.4862 7.94133 77.1689 8.60267 77.6489 9.456C78.1395 10.2987 78.3849 11.2747 78.3849 12.384C78.3849 13.4827 78.1395 14.4587 77.6489 15.312C77.1689 16.1653 76.4809 16.8267 75.5849 17.296C74.6995 17.7653 73.6702 18 72.4969 18H68.2889V6.768H72.4969ZM72.3209 15.632C73.3555 15.632 74.1609 15.3493 74.7369 14.784C75.3129 14.2187 75.6009 13.4187 75.6009 12.384C75.6009 11.3493 75.3129 10.544 74.7369 9.968C74.1609 9.392 73.3555 9.104 72.3209 9.104H71.0249V15.632H72.3209ZM92.6339 6.768V18H89.8979V11.264L87.3859 18H85.1779L82.6499 11.248V18H79.9139V6.768H83.1459L86.2979 14.544L89.4179 6.768H92.6339ZM97.3374 6.768V18H94.6014V6.768H97.3374ZM109.368 18H106.632L102.056 11.072V18H99.3201V6.768H102.056L106.632 13.728V6.768H109.368V18Z" fill="white" />
				</svg>
			</a>
			<div class="nav-control">
				<div class="hamburger">
					<span class="line">
						<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.7468 5.58925C11.0722 5.26381 11.0722 4.73617 10.7468 4.41073C10.4213 4.0853 9.89369 4.0853 9.56826 4.41073L4.56826 9.41073C4.25277 9.72622 4.24174 10.2342 4.54322 10.5631L9.12655 15.5631C9.43754 15.9024 9.96468 15.9253 10.3039 15.6143C10.6432 15.3033 10.6661 14.7762 10.3551 14.4369L6.31096 10.0251L10.7468 5.58925Z" fill="#452B90" />
							<path opacity="0.3" d="M16.5801 5.58924C16.9056 5.26381 16.9056 4.73617 16.5801 4.41073C16.2547 4.0853 15.727 4.0853 15.4016 4.41073L10.4016 9.41073C10.0861 9.72622 10.0751 10.2342 10.3766 10.5631L14.9599 15.5631C15.2709 15.9024 15.798 15.9253 16.1373 15.6143C16.4766 15.3033 16.4995 14.7762 16.1885 14.4369L12.1443 10.0251L16.5801 5.58924Z" fill="#452B90" />
						</svg>
					</span>
				</div>
			</div>
		</div>
		<!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Chat box start
        ***********************************-->
		<div class="chatbox">
			<div class="chatbox-close"></div>
			<div class="custom-tab-1">

				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#notes">Notes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#alerts">Alerts</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#chat">Chat</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active show" id="chat">
						<div class="card mb-sm-3 mb-md-0 contacts_card dz-chat-user-box">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
											<rect fill="#000000" opacity="1.0" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Chat List</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<circle fill="#000000" cx="5" cy="12" r="2" />
											<circle fill="#000000" cx="12" cy="12" r="2" />
											<circle fill="#000000" cx="19" cy="12" r="2" />
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dz-scroll  " id="DZ_W_Contacts_Body">
								<ul class="contacts">
									<li class="name-first-letter">A</li>
									<li class="active dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Archie Parker</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets//avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Alfie Mason</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>AharlieKane</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">B</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Bashid Samim</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz- -user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Breddie Ronan</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Ceorge Carson</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">D</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Darry Parker</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Denry Hunter</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">J</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Jack Ronan</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Jacob Tucker</span>
												<p>Kalid is online</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/2.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>James Logan</span>
												<p>Taherah left 7 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/3.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Joshua Weston</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">O</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/4.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Oliver Acker</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
									<li class="dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="./assets/images/avatar/5.jpg" class="rounded-circle user_img" alt="">
												<span class="online_icon offline"></span>
											</div>
											<div class="user_info">
												<span>Oscar Weston</span>
												<p>Rashid left 50 mins ago</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="card chat dz-chat-history-box d-none">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);" class="dz-chat-history-back">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) " x="14" y="7" width="2" height="10" rx="1" />
											<path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) " />
										</g>
									</svg>
								</a>
								<div>
									<h6 class="mb-1">Chat with Khelesh</h6>
									<p class="mb-0 text-success">Online</p>
								</div>
								<div class="dropdown">
									<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<circle fill="#000000" cx="5" cy="12" r="2" />
												<circle fill="#000000" cx="12" cy="12" r="2" />
												<circle fill="#000000" cx="19" cy="12" r="2" />
											</g>
										</svg></a>
									<ul class="dropdown-menu dropdown-menu-end">
										<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> View profile</li>
										<li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to btn-close friends</li>
										<li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to group</li>
										<li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
									</ul>
								</div>
							</div>
							<div class="card-body msg_card_body dz-scroll" id="DZ_W_Contacts_Body3">
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Hi, how are you samim?
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Hi Khalid i am good tnx how about you?
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am good too, thank you for your chat template
										<span class="msg_time">9:00 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										You are welcome
										<span class="msg_time_send">9:05 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am looking for your next templates
										<span class="msg_time">9:07 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Ok, thank you have a good day
										<span class="msg_time_send">9:10 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Bye, see you
										<span class="msg_time">9:12 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Hi, how are you samim?
										<span class="msg_time">8:40 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Hi Khalid i am good tnx how about you?
										<span class="msg_time_send">8:55 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am good too, thank you for your chat template
										<span class="msg_time">9:00 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										You are welcome
										<span class="msg_time_send">9:05 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										I am looking for your next templates
										<span class="msg_time">9:07 AM, Today</span>
									</div>
								</div>
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										Ok, thank you have a good day
										<span class="msg_time_send">9:10 AM, Today</span>
									</div>
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
								</div>
								<div class="d-flex justify-content-start mb-4">
									<div class="img_cont_msg">
										<img src="./assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
									</div>
									<div class="msg_cotainer">
										Bye, see you
										<span class="msg_time">9:12 AM, Today</span>
									</div>
								</div>
							</div>
							<div class="card-footer type_msg">
								<div class="input-group">
									<textarea class="form-control" placeholder="Type your message..."></textarea>
									<div class="input-group-append">
										<button type="button" class="btn btn-primary"><i class="fa fa-location-arrow"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="alerts">
						<div class="card mb-sm-3 mb-md-0 contacts_card">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<circle fill="#000000" cx="5" cy="12" r="2" />
											<circle fill="#000000" cx="12" cy="12" r="2" />
											<circle fill="#000000" cx="19" cy="12" r="2" />
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Notications</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="1" />
											<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dz-scroll" id="DZ_W_Contacts_Body1">
								<ul class="contacts">
									<li class="name-first-letter">SEVER STATUS</li>
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="img_cont primary">KK</div>
											<div class="user_info">
												<span>David Nester Birthday</span>
												<p class="text-primary">Today</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">SOCIAL</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont success">RU</div>
											<div class="user_info">
												<span>Perfection Simplified</span>
												<p>Jame Smith commented on your status</p>
											</div>
										</div>
									</li>
									<li class="name-first-letter">SEVER STATUS</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont primary">AU</div>
											<div class="user_info">
												<span>AharlieKane</span>
												<p>Sami is online</p>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="img_cont info">MO</div>
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>Nargis left 30 mins ago</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="card-footer"></div>
						</div>
					</div>
					<div class="tab-pane fade" id="notes">
						<div class="card mb-sm-3 mb-md-0 note_card">
							<div class="card-header chat-list-header text-center">
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
											<rect fill="#000000" opacity="1.0" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
										</g>
									</svg></a>
								<div>
									<h6 class="mb-1">Notes</h6>
									<p class="mb-0">Add New Nots</p>
								</div>
								<a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="1" />
											<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
										</g>
									</svg></a>
							</div>
							<div class="card-body contacts_body p-0 dz-scroll" id="DZ_W_Contacts_Body2">
								<ul class="contacts">
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>New order placed..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>Youtube, a video-sharing website..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>john just buy your product..</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex bd-highlight">
											<div class="user_info">
												<span>Athan Jacoby</span>
												<p>10 Aug 2020</p>
											</div>
											<div class="ms-auto">
												<a href="javascript:void(0);" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
												<a href="javascript:void(0);" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--**********************************
            Chat box End
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
		<div class="header">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">
							<div class="dashboard_bar">
								My Dashboard
							</div>
						</div>
						<div class="header-right d-flex align-items-center">
							<ul class="navbar-nav">
								<li class="nav-item dropdown notification_dropdown">
									<a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
										<svg id="icon-light" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" fill-rule="nonzero" />
												<path d="M19.5,10.5 L21,10.5 C21.8284271,10.5 22.5,11.1715729 22.5,12 C22.5,12.8284271 21.8284271,13.5 21,13.5 L19.5,13.5 C18.6715729,13.5 18,12.8284271 18,12 C18,11.1715729 18.6715729,10.5 19.5,10.5 Z M16.0606602,5.87132034 L17.1213203,4.81066017 C17.7071068,4.22487373 18.6568542,4.22487373 19.2426407,4.81066017 C19.8284271,5.39644661 19.8284271,6.34619408 19.2426407,6.93198052 L18.1819805,7.99264069 C17.5961941,8.57842712 16.6464466,8.57842712 16.0606602,7.99264069 C15.4748737,7.40685425 15.4748737,6.45710678 16.0606602,5.87132034 Z M16.0606602,18.1819805 C15.4748737,17.5961941 15.4748737,16.6464466 16.0606602,16.0606602 C16.6464466,15.4748737 17.5961941,15.4748737 18.1819805,16.0606602 L19.2426407,17.1213203 C19.8284271,17.7071068 19.8284271,18.6568542 19.2426407,19.2426407 C18.6568542,19.8284271 17.7071068,19.8284271 17.1213203,19.2426407 L16.0606602,18.1819805 Z M3,10.5 L4.5,10.5 C5.32842712,10.5 6,11.1715729 6,12 C6,12.8284271 5.32842712,13.5 4.5,13.5 L3,13.5 C2.17157288,13.5 1.5,12.8284271 1.5,12 C1.5,11.1715729 2.17157288,10.5 3,10.5 Z M12,1.5 C12.8284271,1.5 13.5,2.17157288 13.5,3 L13.5,4.5 C13.5,5.32842712 12.8284271,6 12,6 C11.1715729,6 10.5,5.32842712 10.5,4.5 L10.5,3 C10.5,2.17157288 11.1715729,1.5 12,1.5 Z M12,18 C12.8284271,18 13.5,18.6715729 13.5,19.5 L13.5,21 C13.5,21.8284271 12.8284271,22.5 12,22.5 C11.1715729,22.5 10.5,21.8284271 10.5,21 L10.5,19.5 C10.5,18.6715729 11.1715729,18 12,18 Z M4.81066017,4.81066017 C5.39644661,4.22487373 6.34619408,4.22487373 6.93198052,4.81066017 L7.99264069,5.87132034 C8.57842712,6.45710678 8.57842712,7.40685425 7.99264069,7.99264069 C7.40685425,8.57842712 6.45710678,8.57842712 5.87132034,7.99264069 L4.81066017,6.93198052 C4.22487373,6.34619408 4.22487373,5.39644661 4.81066017,4.81066017 Z M4.81066017,19.2426407 C4.22487373,18.6568542 4.22487373,17.7071068 4.81066017,17.1213203 L5.87132034,16.0606602 C6.45710678,15.4748737 7.40685425,15.4748737 7.99264069,16.0606602 C8.57842712,16.6464466 8.57842712,17.5961941 7.99264069,18.1819805 L6.93198052,19.2426407 C6.34619408,19.8284271 5.39644661,19.8284271 4.81066017,19.2426407 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
											</g>
										</svg>
										<svg id="icon-dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z" fill="#000000" />
											</g>
										</svg>
									</a>
								</li>
								<li class="nav-item dropdown notification_dropdown">
									<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
										<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 12H19C19.8284 12 20.5 12.6716 20.5 13.5C20.5 14.3284 19.8284 15 19 15H6C5.17157 15 4.5 14.3284 4.5 13.5C4.5 12.6716 5.17157 12 6 12H7.5L8.05827 6.97553C8.30975 4.71226 10.2228 3 12.5 3C14.7772 3 16.6903 4.71226 16.9417 6.97553L17.5 12Z" fill="#222B40" />
											<path opacity="0.3" d="M14.5 18C14.5 16.8954 13.6046 16 12.5 16C11.3954 16 10.5 16.8954 10.5 18C10.5 19.1046 11.3954 20 12.5 20C13.6046 20 14.5 19.1046 14.5 18Z" fill="#222B40" />
										</svg>
									</a>
									<div class="dropdown-menu dropdown-menu-end">
										<div id="DZ_W_Notification1" class="widget-media dz-scroll p-2" style="height:380px;">
											<ul class="timeline">
												<li>
													<div class="timeline-panel">
														<div class="media me-2">
															<img alt="image" width="50" src="./assets/images/avatar/1.jpg">
														</div>
														<div class="media-body">
															<h6 class="mb-1">Dr sultads Send you Photo</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-info">
															KG
														</div>
														<div class="media-body">
															<h6 class="mb-1">Resport created successfully</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-success">
															<i class="fa fa-home"></i>
														</div>
														<div class="media-body">
															<h6 class="mb-1">Reminder : Treatment Time!</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2">
															<img alt="image" width="50" src="./assets/images/avatar/1.jpg">
														</div>
														<div class="media-body">
															<h6 class="mb-1">Dr sultads Send you Photo</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-danger">
															KG
														</div>
														<div class="media-body">
															<h6 class="mb-1">Resport created successfully</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-primary">
															<i class="fa fa-home"></i>
														</div>
														<div class="media-body">
															<h6 class="mb-1">Reminder : Treatment Time!</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2">
															<img alt="image" width="50" src="./assets/images/avatar/1.jpg">
														</div>
														<div class="media-body">
															<h6 class="mb-1">Dr sultads Send you Photo</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-info">
															KG
														</div>
														<div class="media-body">
															<h6 class="mb-1">Resport created successfully</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-success">
															<i class="fa fa-home"></i>
														</div>
														<div class="media-body">
															<h6 class="mb-1">Reminder : Treatment Time!</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2">
															<img alt="image" width="50" src="./assets/images/avatar/1.jpg">
														</div>
														<div class="media-body">
															<h6 class="mb-1">Dr sultads Send you Photo</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-danger">
															KG
														</div>
														<div class="media-body">
															<h6 class="mb-1">Resport created successfully</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
												<li>
													<div class="timeline-panel">
														<div class="media me-2 media-primary">
															<i class="fa fa-home"></i>
														</div>
														<div class="media-body">
															<h6 class="mb-1">Reminder : Treatment Time!</h6>
															<small class="d-block">29 July 2020 - 02:26 PM</small>
														</div>
													</div>
												</li>
											</ul>
										</div>
										<a class="all-notification" href="javascript:void(0);">See all notifications <i class="ti-arrow-end"></i></a>
									</div>
								</li>
								<li class="nav-item dropdown notification_dropdown">
									<a class="nav-link bell-link" href="javascript:void(0);">
										<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g clip-path="url(#clip0_1_463)">
												<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M6.5 2H18.5C19.0523 2 19.5 2.44772 19.5 3V13C19.5 13.5523 19.0523 14 18.5 14H6.5C5.94772 14 5.5 13.5523 5.5 13V3C5.5 2.44772 5.94772 2 6.5 2ZM14.3 4C13.6562 4 12.9033 4.72985 12.5 5.2C12.0967 4.72985 11.3438 4 10.7 4C9.5604 4 8.9 4.88887 8.9 6.02016C8.9 7.27339 10.1 8.6 12.5 10C14.9 8.6 16.1 7.3 16.1 6.1C16.1 4.96871 15.4396 4 14.3 4Z" fill="#222B40" />
												<path fill-rule="evenodd" clip-rule="evenodd" d="M4.29275 6.57254L12.5 12.5L20.7073 6.57254C20.9311 6.41086 21.2437 6.46127 21.4053 6.68514C21.4669 6.77034 21.5 6.87278 21.5 6.97788V17C21.5 18.1046 20.6046 19 19.5 19H5.5C4.39543 19 3.5 18.1046 3.5 17V6.97788C3.5 6.70174 3.72386 6.47788 4 6.47788C4.10511 6.47788 4.20754 6.511 4.29275 6.57254Z" fill="#222B40" />
											</g>
											<defs>
												<clipPath id="clip0_1_463">
													<rect width="24" height="24" fill="white" transform="translate(0.5)" />
												</clipPath>
											</defs>
										</svg>
									</a>
								</li>

								<li class="nav-item ps-3">
									<div class="dropdown header-profile2">
										<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<div class="header-info2 d-flex align-items-center">
												<div class="header-media">
													<img src="../dbimages/<?= $promoter['profile_picture'] ?>" alt="">
												</div>
											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<div class="card border-0 mb-0">
												<div class="card-header py-2">
													<div class="products">
														<img src="../dbimages/<?= $promoter['profile_picture'] ?>" class="avatar avatar-md" alt="">
														<div>
															<h6><?= $promoter['brand_name'] ?></h6>
														</div>
													</div>
												</div>
												<div class="card-body px-0 py-2">
													<a href="profile.php" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9848 15.3462C8.11714 15.3462 4.81429 15.931 4.81429 18.2729C4.81429 20.6148 8.09619 21.2205 11.9848 21.2205C15.8524 21.2205 19.1543 20.6348 19.1543 18.2938C19.1543 15.9529 15.8733 15.3462 11.9848 15.3462Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
															<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9848 12.0059C14.5229 12.0059 16.58 9.94779 16.58 7.40969C16.58 4.8716 14.5229 2.81445 11.9848 2.81445C9.44667 2.81445 7.38857 4.8716 7.38857 7.40969C7.38 9.93922 9.42381 11.9973 11.9524 12.0059H11.9848Z" stroke="var(--primary)" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														<span class="ms-2">Profile</span>
													</a>
													<a href="javascript:void(0);" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M17.9026 8.85114L13.4593 12.4642C12.6198 13.1302 11.4387 13.1302 10.5992 12.4642L6.11844 8.85114" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
															<path fill-rule="evenodd" clip-rule="evenodd" d="M16.9089 21C19.9502 21.0084 22 18.5095 22 15.4384V8.57001C22 5.49883 19.9502 3 16.9089 3H7.09114C4.04979 3 2 5.49883 2 8.57001V15.4384C2 18.5095 4.04979 21.0084 7.09114 21H16.9089Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														<span class="ms-2">Message </span>
													</a>
													<a href="email-inbox.html" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 17.8476C17.6392 17.8476 20.2481 17.1242 20.5 14.2205C20.5 11.3188 18.6812 11.5054 18.6812 7.94511C18.6812 5.16414 16.0452 2 12 2C7.95477 2 5.31885 5.16414 5.31885 7.94511C5.31885 11.5054 3.5 11.3188 3.5 14.2205C3.75295 17.1352 6.36177 17.8476 12 17.8476Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
															<path d="M14.3888 20.8572C13.0247 22.372 10.8967 22.3899 9.51947 20.8572" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														<span class="ms-2">Notification </span>
													</a>
												</div>
												<div class="card-footer px-0 py-2">
													<a href="logout.php" class="dropdown-item ai-icon">
														<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
															<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
															<polyline points="16 17 21 12 16 7"></polyline>
															<line x1="21" y1="12" x2="9" y2="12"></line>
														</svg>
														<span class="ms-2">Logout </span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<div class="deznav">
			<div class="deznav-scroll">
				<ul class="metismenu" id="menu">
					<li class="menu-title">Talent Exhibition & Promotion System</li>
					<li><a class="has-arrow " href="home.php" aria-expanded="false">
							<div class="menu-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.756 22 16.0829 22H18.0438C18.9596 22.0024 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z" fill="#90959F" />
								</svg>
							</div>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
					<li class="menu-title">OUR FEATURES</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<div class="menu-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g opacity="0.5">
										<path d="M9.34933 14.8577C5.38553 14.8577 2 15.47 2 17.9174C2 20.3666 5.364 21 9.34933 21C13.3131 21 16.6987 20.3877 16.6987 17.9404C16.6987 15.4911 13.3347 14.8577 9.34933 14.8577Z" fill="white" />
										<path opacity="0.4" d="M9.34935 12.5248C12.049 12.5248 14.2124 10.4062 14.2124 7.76241C14.2124 5.11865 12.049 3 9.34935 3C6.65072 3 4.48633 5.11865 4.48633 7.76241C4.48633 10.4062 6.65072 12.5248 9.34935 12.5248Z" fill="white" />
										<path opacity="0.4" d="M16.1734 7.84876C16.1734 9.19508 15.7605 10.4513 15.0364 11.4948C14.9611 11.6022 15.0276 11.7468 15.1587 11.7698C15.3407 11.7996 15.5276 11.8178 15.7184 11.8216C17.6167 11.8705 19.3202 10.6736 19.7908 8.87119C20.4885 6.19677 18.4415 3.79544 15.8339 3.79544C15.5511 3.79544 15.2801 3.82419 15.0159 3.87689C14.9797 3.88456 14.9405 3.9018 14.921 3.93247C14.8955 3.97176 14.9141 4.02254 14.9395 4.05608C15.7233 5.13217 16.1734 6.44208 16.1734 7.84876Z" fill="white" />
										<path d="M21.7791 15.1693C21.4318 14.444 20.5932 13.9466 19.3173 13.7023C18.7155 13.5586 17.0854 13.3545 15.5697 13.3832C15.5472 13.3861 15.5345 13.4014 15.5325 13.411C15.5296 13.4263 15.5365 13.4493 15.5658 13.4656C16.2664 13.8048 18.9738 15.2805 18.6333 18.3928C18.6187 18.5289 18.7292 18.6439 18.8672 18.6247C19.5335 18.5318 21.2478 18.1705 21.7791 17.0475C22.0737 16.4534 22.0737 15.7634 21.7791 15.1693Z" fill="white" />
									</g>
								</svg>

							</div>
							<span class="nav-text">Talents</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="users.php">View Talents</a></li>
						</ul>
					</li>
					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<div class="menu-icon">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g opacity="0.5">
										<path d="M9.34933 14.8577C5.38553 14.8577 2 15.47 2 17.9174C2 20.3666 5.364 21 9.34933 21C13.3131 21 16.6987 20.3877 16.6987 17.9404C16.6987 15.4911 13.3347 14.8577 9.34933 14.8577Z" fill="white" />
										<path opacity="0.4" d="M9.34935 12.5248C12.049 12.5248 14.2124 10.4062 14.2124 7.76241C14.2124 5.11865 12.049 3 9.34935 3C6.65072 3 4.48633 5.11865 4.48633 7.76241C4.48633 10.4062 6.65072 12.5248 9.34935 12.5248Z" fill="white" />
										<path opacity="0.4" d="M16.1734 7.84876C16.1734 9.19508 15.7605 10.4513 15.0364 11.4948C14.9611 11.6022 15.0276 11.7468 15.1587 11.7698C15.3407 11.7996 15.5276 11.8178 15.7184 11.8216C17.6167 11.8705 19.3202 10.6736 19.7908 8.87119C20.4885 6.19677 18.4415 3.79544 15.8339 3.79544C15.5511 3.79544 15.2801 3.82419 15.0159 3.87689C14.9797 3.88456 14.9405 3.9018 14.921 3.93247C14.8955 3.97176 14.9141 4.02254 14.9395 4.05608C15.7233 5.13217 16.1734 6.44208 16.1734 7.84876Z" fill="white" />
										<path d="M21.7791 15.1693C21.4318 14.444 20.5932 13.9466 19.3173 13.7023C18.7155 13.5586 17.0854 13.3545 15.5697 13.3832C15.5472 13.3861 15.5345 13.4014 15.5325 13.411C15.5296 13.4263 15.5365 13.4493 15.5658 13.4656C16.2664 13.8048 18.9738 15.2805 18.6333 18.3928C18.6187 18.5289 18.7292 18.6439 18.8672 18.6247C19.5335 18.5318 21.2478 18.1705 21.7791 17.0475C22.0737 16.4534 22.0737 15.7634 21.7791 15.1693Z" fill="white" />
									</g>
								</svg>
							</div>
							<span class="nav-text">Promoters</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="promoters.php">View Promoters</a></li>

						</ul>
					</li>
				</ul>
			</div>
		</div>

		<!--**********************************
Sidebar end
***********************************-->