<?php

require "db.php";

$arr = explode("/", $_SERVER["REQUEST_URI"]);
switch ($arr[3]){
	case "login":
		$id = filter($_POST["id"]);
		$pw = filter($_POST["pw"]);

		$sql = "select * from member where
		id = '{$id}'
		AND
		pw = '{$pw}'";
		$chk = mfa($sql);
		if ($chk){
			$_SESSION["ID"] = $chk["id"];
			alertmove("로그인되었습니다.", "/");
		};

		alertmove("아이디 혹은 비밀번혹 틀렸습니다.", "");
		break;
	case "logout":
		session_destroy();
		alertmove("로그아웃되었습니다.", "/");
		break;
	case "search":
		$keyword = filter(isset($_POST["keyword"])) ? filter($_POST["keyword"]) : "";

		$get = getSearchSql($keyword);
		foreach (mq($get[0]) as $rs):
			$type = getMajor($rs["name"]);
			$temp = $rs["name"];
			foreach ($get[1] as $str){
				preg_match_all("/{$str}/ui", $rs["name"], $matchs);
				$match = "";
				foreach ($matchs as $rs3){
					$match .= implode("", $rs3);
				};

				@$data = getSplitString($match);
				foreach ($data as $rs3){
					$temp = str_replace($rs3, "<mark>{$rs3}</mark>", $temp);
				};
			};
			?>
			<div class="view-node fl-row fl-y-center data" style="position: absolute; left: <?= $rs["x"] ?>px; top: <?= $rs["y"] ?>px;">
				<div class="view-image">
					<img src="img/<?= $rs["image"] ?>" alt="<?= $rs["name"] ?>" title="<?= $rs["name"] ?>">
				</div>
				<button onClick="readMore(<?= $rs["idx"] ?>);"><img src="img/search_mini.png" alt="더 보기" title="더 보기"></button>
				<div class="view-text">
					<h1><?= $temp ?></h1>
					<p><?= $type ?></p>
				</div>
			</div>
		<?php endforeach;
		break;
	case "search_list":
		$keyword = filter(isset($_POST["keyword"])) ? filter($_POST["keyword"]) : "";

		$get = getSearchSql($keyword);
		foreach (mq($get[0]) as $rs):
			$type = getMajor($rs["name"]);
			$temp = $rs["name"];
			foreach ($get[1] as $str){
				preg_match_all("/{$str}/ui", $rs["name"], $matchs);
				$match = "";
				foreach ($matchs as $rs3){
					$match .= implode("", $rs3);
				};

				@$data = getSplitString($match);
				foreach ($data as $rs3){
					$temp = str_replace($rs3, "<mark>{$rs3}</mark>", $temp);
				};
			};
			?>
			<div class="view-figure data">
				<div class="view-figure-image">
					<img src="img/<?= $rs["image"] ?>" alt="<?= $rs["name"] ?>" title="<?= $rs["name"] ?>">
				</div>
				<button onClick="readMore(<?= $rs["idx"] ?>);"><img src="img/search_mini.png" alt="더 보기" title="더 보기"></button>
				<div class="view-figure-text">
					<h1><?= $temp ?></h1>
					<p><?= $type ?></p>
					<span>Lorem ipsum dolor sit amet<br>consectetur adipiscing elit.</span>
				</div>
			</div>
		<?php endforeach;
		break;
	case "readMore":
		$index = $_POST["index"];
		$find = mfa("select * from doctors where idx = $index");
		
		$str = "";
		foreach (mq("select * from reserve where type = '{$find["type"]}' AND doctor = '{$find["name"]}'") as $rs){
			$str .= $rs["rdate"] . ",";
		};

		$str = substr($str, 0, -1);
		?>
		<input type="hidden" value="<?= $str ?>" class="reserveDates">

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
								<img src="img/<?= $find["image"] ?>" alt="<?= $find["name"] ?>" title="<?= $find["name"] ?>">
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
								<p><?= $find["manner"] ?></p>
								<h4>POPULAR</h4>
								<p><?= $find["popular_text"] ?></p>
							</div>
						</div>
						<div id="doctor_info" class="fl">
							<div class="fl-row">
								<div class="fl">
									<h1><?= $find["name"] ?></h1>
									<p><?= $find["type"] ?></p>
								</div>
								<div>
									<form action="/php/php.php/reserve" method="POST">
										<button>MAKE RESERVE</button>
										<input type="hidden" name="doctor" value="<?= $find["name"] ?>">
										<input type="hidden" name="type" value="<?= $find["type"] ?>">
										<input type="text" class="date" name="date" placeholder="진료일자" readonly="readonly" required="required">
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
		<script>
		
		var reserveDates = $(".reserveDates").val();
		reserveDates = reserveDates.split(",");

		$(".date").datepicker({
			minDate: "1",
			dateFormat: "yy-mm-dd",
			beforeShowDay: disabledReserveDate
		});

		function disabledReserveDate (date){
			var y = date.getFullYear(), m = date.getMonth() + 1, d = date.getDate();

			m = m < 10 ? "0" + m : m;
			d = d < 10 ? "0" + d : d;

			if ($.inArray(y + "-" + m + "-" + d, reserveDates) != -1){
				return [false, "highlight"];
			};

			return [true];
		}
		</script>
		<?php
		break;
	case "reserve":
		// create code
		$pattern = "0QWERTYUIOPASDFGHJKLZXCVBNM";
		$code = substr(str_shuffle($pattern), 0, 3);

		// code chk
		while (true){
			$chk = mfa("select * from reserve where code = '{$code}'");
			$code = substr(str_shuffle($pattern), 0, 3);
			if (!$chk) break;
		};

		$doctor = $_POST["doctor"];
		$type = $_POST["type"];
		$rdate = $_POST["date"];
		$sql = "insert into reserve(type, doctor, rdate, ndate, r_name, code) 
		values(
		'{$type}',
		'{$doctor}',
		'{$rdate}',
		now(),
		'{$ids}',
		'{$code}'
		)
		";

		mq($sql);

		alertmove("예약되었습니다.", "");
		break;
};