<?php
require "php/db.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Seoul Health</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
		<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<meta name="viewport" content="width=device-width, user-scalable=no">
	</head>
	<body>
		<!-- 로그인 -->
		<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="/php/php.php/login" method="POST">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title">로그인</h4>
						</div>
						<div class="modal-body">
							<fieldset class="form-group">
								<label for="login_id">아이디</label>
								<input type="text" name="id" id="login_id" class="form-control" placeholder="아이디">
							</fieldset>
							<fieldset class="form-group">
								<label for="login_pw">비밀번호</label>
								<input type="password" name="pw" id="login_pw" class="form-control" placeholder="비밀번호">
							</fieldset>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
							<button type="submit" class="btn btn-primary">로그인</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- 예약 보기 -->
		<div class="modal fade" id="reserve_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">예약 조회</h4>
					</div>
					<div class="modal-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>예약번호</th>
									<th>담당의사</th>
									<th>예약일자</th>
									<th>진료일자</th>
								</tr>
							</thead>
							<tbody>
								<?php if($ids):
									foreach (mq("select * from reserve where r_name = '{$ids}' order by code asc") as $rs):
									?>
									<tr>
										<td><?= $rs["code"] ?></td>
										<td><?= $rs["doctor"] ?></td>
										<td><?= $rs["rdate"] ?></td>
										<td><?= $rs["ndate"] ?></td>
									</tr>
									<?php
									endforeach;
								endif; ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
					</div>
				</div>
			</div>
		</div>
		<!-- 의사 프로필 -->
		<div class="modal fade" id="doctor_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">의사 프로필</h4>
					</div>
					<div class="modal-body">
						<div id="doctor_bg" style="background-image: url('img/profile_bg.jpg')"></div>
						<div class="fl-row">
							<div id="doctor_profile">
								<div id="doctor_photo">
									<img src="img/doc_1.jpg" alt="Amy Kelley" title="Amy Kelley">
								</div>
								<div id="doctor_btn">
									<button><img src="img/message.png" alt="CHAT" title="CHAT"> CHAT</button>
									<button><img src="img/register.png" alt="RESERVE" title="RESERVE"> BOOK</button>
								</div>
								<div id="doctor_time">
									<h5>OFFICE HOURS</h5>
									<ul>
										<li>
											<span>Mon-Thurs</span>
											<span>9:00am - 7:00pm</span>
										</li>
										<li>
											<span>Fri</span>
											<span>8:00am - 5:00pm</span>
										</li>
										<li>
											<span>Sat-Sun</span>
											<span>9:00am - 2:00pm</span>
										</li>
									</ul>
								</div>
								<div id="doctor_review">
									<h5>REVIEWS</h5>
									<h4>MANNER</h4>
									<p>Excllent</p>
									<h4>POPULAR</h4>
									<p>Very Much</p>
								</div>
							</div>
							<div id="doctor_info" class="fl">
								<div class="fl-row">
									<div class="fl">
										<h1>Amy Kelley</h1>
										<p>진단검사의학과</p>
									</div>
									<div>
										<form action="#" method="POST">
											<button>MAKE RESERVE</button>
											<input type="text" name="date" placeholder="진료일자">
										</form>
									</div>
								</div>
								<div id="doctor_text" class="fl-row">
									<div class="fl">
										<h5>EDUCATION &amp; TRAINING:</h5>
										<h4>MEDICAL EDUCATION</h4>
										<p>Baylor College of Medicine</p>
										<h4>INTERSHIP</h4>
										<p>Baylor Medical Center</p>
										<h4>RESIDENCY</h4>
										<p>Stanford Hospital and Clinics</p>
										<h4>FELLOWSHIPS</h4>
										<p>Endocrinology - Parkland</p>
									</div>
									<div class="fl">
										<h5>HOSPITAL AFFILIANTIONS</h5>
										<h4></h4>
										<p>San Francisco General</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="wrap" class="fl-row">
			<!-- 사이드 영역 -->
			<div id="side" class="fl-col">
				<div id="side_logo" class="fl-row fl-x-center fl-y-center">
					<img src="img/logo.png" alt="Seoul Health" title="Seoul Health">
				</div>
				<div id="side_nav" class="fl">
					<ul class="fl-col">
						<li class="fl-col">
							<div class="side-menu-main">
								<img src="img/user.png" alt="Doctors" title="Doctors">
								<a href="#" onclick="return false">Doctors</a>
								<span></span>
							</div>
							<div class="side-menu-sub" class="fl">
								<!-- <ul>
									<li>
										<div class="side-doc-image">
											<img src="img/doc_1.jpg" alt="Amy Kelley" title="Amy Kelley">
										</div>
										<div class="side-doc-text">
											<h1>Amy Kelley</h1>
											<p>Dietician</p>
										</div>
										<div class="side-doc-more">
											<img src="img/more.png" alt="더 보기" title="더 보기">
										</div>
									</li>
								</ul> -->
								<ul>
								<?php
								$sql = "select * from doctors order by popular desc, name asc";
								foreach (mq($sql) as $rs):
								?>
								<li>
									<div class="side-doc-image">
										<img src="img/<?= $rs["image"] ?>" alt="Amy Kelley" title="Amy Kelley">
									</div>
									<div class="side-doc-text">
										<h1><?= $rs["name"] ?></h1>
										<p>-</p>
									</div>
									<div class="side-doc-more">
										<img src="img/more.png" alt="더 보기" title="더 보기" onClick="readMore(<?= $rs["idx"] ?>);">
									</div>
								</li>
								<?php endforeach; ?>
								</ul>
							</div>
						</li>
						<li>
							<div class="side-menu-main" onclick="modal('show', 'reserve_modal')">
								<img src="img/user.png" alt="Doctors" title="Doctors">
								<a href="#">My Reservation</a>
							</div>
						</li>
					</ul>
				</div>
				<div id="side_btn" class="fl-row">
					<div class="fl fl-row fl-x-center fl-y-center">
						<button onclick="window.close()"><img src="img/exit.png" alt="Exit" title="Exit"> Exit</button>
					</div>
					<div class="fl fl-row fl-x-center fl-y-center">
						<button><img src="img/set.png" alt="Setting" title="Setting"> Setting</button>
					</div>
				</div>
			</div>
			<!-- 컨텐츠 영역 -->
			<div id="content" class="fl fl-col">
				<!-- 상단 타이틀바 -->
				<div id="header" class="fl-row fl-y-center">
					<div id="header_title" class="fl fl-row">
						<h1>Home Page</h1>
						<span>Welcome to Seoul Health</span>
					</div>
					<div id="header_info">
						<?php
						$status = "move('/php/php.php/logout');";
						if (!$ids) $status = "modal('show', 'login_modal');";
						?>
						<span class="header-info" onClick="<?= $status ?>";><img src="img/user_dark.png" alt="로그인" title="로그인"></span>
						<span class="header-info"><img src="img/alert.png" alt="알림" title="알림"><span class="header-info-count">2</span></span>
						<span class="header-info"><img src="img/message.png" alt="메시지" title="메시지"></span>
					</div>
				</div>
				<!-- 검색 영역 -->
				<div id="search">
					<form class="fl-row fl-y-center">
						<img src="img/search.png" alt="검색" title="검색">
						<input type="text" name="search" placeholder="Search" class="fl">
						<button>SEARCH DOCTORS</button>
					</form>
				</div>
				<!-- 의사 전공 선택 영역 -->
				<div id="nav" class="fl-row fl-y-center">
					<label>
						<select>
							<option disabled selected>의사 전공</option>
							<option value="">전체</option>
							<?php foreach (mq("select * from major") as $rs): ?>
							<option value="<?= $rs["type"] ?>"><?= $rs["type"] ?></option>
							<?php endforeach; ?>
						</select>
						<span>▼</span>
					</label>
					<span class="fl">SORT BY : <strong>PROFESSIONALISM</strong></span>
					<div id="nav_toggle" class="fl-row">
						<label class="fl"><input type="radio" name="show" value="0" checked><span>MAP</span></label>
						<label class="fl"><input type="radio" name="show" value="1"><span>LIST</span></label>
					</div>
				</div>
				<div id="view" class="fl">
					<!-- 맵 영역 -->
					<div id="view_map">
						<img src="img/map.png">
						<!-- <div class="view-node fl-row fl-y-center">
							<div class="view-image">
								<img src="img/doc_1.jpg" alt="Amy Kelley" title="Amy Kelley">
							</div>
							<button><img src="img/search_mini.png" alt="더 보기" title="더 보기"></button>
							<div class="view-text">
								<h1>Amy Kelley</h1>
								<p>진단검사의학과</p>
							</div>
						</div> -->
						<?php foreach (mq($sql) as $rs):
						$type = getMajor($rs["name"]);
						?>
						<div class="view-node fl-row fl-y-center data" style="position: absolute; left: <?= $rs["x"] ?>px; top: <?= $rs["y"] ?>px;">
							<div class="view-image">
								<img src="img/<?= $rs["image"] ?>" alt="Amy Kelley" title="Amy Kelley">
							</div>
							<button onClick="readMore(<?= $rs["idx"] ?>);"><img src="img/search_mini.png" alt="더 보기" title="더 보기"></button>
							<div class="view-text">
								<h1><?= $rs["name"] ?></h1>
								<p><?= $type ?></p>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<!-- 리스트 영역 -->
					<div id="view_list">
						<?php foreach (mq($sql) as $rs):
						$type = getMajor($rs["name"]);
						?>
						<div class="view-figure data">
							<div class="view-figure-image">
								<img src="img/<?= $rs["image"] ?>" alt="<?= $rs["name"] ?>" title="<?= $rs["name"] ?>">
							</div>
							<button onClick="readMore(<?= $rs["idx"] ?>);"><img src="img/search_mini.png" alt="더 보기" title="더 보기"></button>
							<div class="view-figure-text">
								<h1><?= $rs["name"] ?></h1>
								<p><?= $type ?></p>
								<span>Lorem ipsum dolor sit amet<br>consectetur adipiscing elit.</span>
							</div>
						</div>
						<?php endforeach; ?>
						<!-- <div class="view-figure">
							<div class="view-figure-image">
								<img src="img/doc_1.jpg" alt="Amy Kelley" title="Amy Kelley">
							</div>
							<button><img src="img/search_mini.png" alt="더 보기" title="더 보기"></button>
							<div class="view-figure-text">
								<h1>Amy Kelley</h1>
								<p>진단검사의학과</p>
								<span>Lorem ipsum dolor sit amet<br>consectetur adipiscing elit.</span>
							</div>
						</div>
						<div class="view-figure">
							<div class="view-figure-image">
								<img src="img/doc_1.jpg" alt="Amy Kelley" title="Amy Kelley">
							</div>
							<button><img src="img/search_mini.png" alt="더 보기" title="더 보기"></button>
							<div class="view-figure-text">
								<h1>Amy Kelley</h1>
								<p>진단검사의학과</p>
								<span>Lorem ipsum dolor sit amet<br>consectetur adipiscing elit.</span>
							</div>
						</div>
						<div class="view-figure">
							<div class="view-figure-image">
								<img src="img/doc_1.jpg" alt="Amy Kelley" title="Amy Kelley">
							</div>
							<button><img src="img/search_mini.png" alt="더 보기" title="더 보기"></button>
							<div class="view-figure-text">
								<h1>Amy Kelley</h1>
								<p>진단검사의학과</p>
								<span>Lorem ipsum dolor sit amet<br>consectetur adipiscing elit.</span>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</body>
</html>