<?php

// database

// 데이터 베이스 접속
$db = new mysqli("127.0.0.1", "root", "", "web001");
$db->set_charset("utf8");


function mq ($sql){
	global $db;
	return $db->query($sql);
}

function mfa ($sql){
	$rs = mq($sql);
	return $rs->fetch_array();
}

function row ($sql){
	$rs = mq($sql);
	return $rs->fetch_row();
}



// session
session_start();
$ids = isset($_SESSION["ID"]) ? $_SESSION["ID"] : "";


// alertmove
function alertmove ($msg, $url){
	echo "<script>";
	echo $msg ? "alert('{$msg}');" : "";
	echo $url ? "location.replace('{$url}');" : "history.back();";
	echo "</script>";
}


// INJECTION
function filter ($str){
	$str = htmlspecialchars($str);
	$str = strip_tags($str);
	$str = addslashes($str);
	return $str;
}


// SEARCH
function getSplitString ($str){
	$piece = [];
	for ($i = 0; $i < mb_strlen($str, "UTF-8"); $i++){
		$piece[] = mb_substr($str, $i, 1);
	};

	return $piece;
}

function getSearchSql ($keyword){
	$regs = [];
	$where = "";
	if ($keyword){
		$arr = explode("+", $keyword);
		foreach ($arr as $rs){
			$temp = "";
			$reg = "";
			$spt = getSplitString($rs);
			foreach ($spt as $str){
				if ($str == "ㄱ"){			$temp = "([가-깋])";
				}else if ($str == "ㄲ"){		$temp = "([까-낗])";
				}else if ($str == "ㄴ"){		$temp = "([나-닣])";
				}else if ($str == "ㄷ"){		$temp = "([다-딯])";
				}else if ($str == "ㄸ"){		$temp = "([따-띻])";
				}else if ($str == "ㄹ"){		$temp = "([라-맇])";
				}else if ($str == "ㅁ"){		$temp = "([마-밓])";
				}else if ($str == "ㅂ"){		$temp = "([바-빟])";
				}else if ($str == "ㅃ"){		$temp = "([빠-삫])";
				}else if ($str == "ㅅ"){		$temp = "([사-싷])";
				}else if ($str == "ㅆ"){		$temp = "([싸-앃])";
				}else if ($str == "ㅇ"){		$temp = "([아-잏])";
				}else if ($str == "ㅈ"){		$temp = "([자-짛])";
				}else if ($str == "ㅉ"){		$temp = "([짜-찧])";
				}else if ($str == "ㅊ"){		$temp = "([차-칳])";
				}else if ($str == "ㅋ"){		$temp = "([카-킿])";
				}else if ($str == "ㅌ"){		$temp = "([타-팋])";
				}else if ($str == "ㅍ"){		$temp = "([파-핗])";
				}else if ($str == "ㅎ"){		$temp = "([하-힣])";
				}else {						$temp = "{$str}"; };
				$reg .= $temp;
			};
			$where .= "(name REGEXP '{$reg}') OR";
			$regs[] = $reg;
		};

		if ($where){
			$where = mb_substr($where, 0, -3);
			$where = "where (" . ($where) . ")";
		};
	};

	$sql = "select * from doctors
	{$where}
	order by popular desc, name asc";

	return [$sql, $regs];
}


// get major
function getMajor ($value){
	$content = file_get_contents("{$_SERVER["DOCUMENT_ROOT"]}/files/doctor.xml");
	$content = simplexml_load_string($content);
	$content = $content->type;
	foreach ($content as $rs){
		$type = $rs["name"];
		$name = "";
		foreach ($rs->doctor as $rs2){
			$name = $rs2["name"];
			if ($value == $name){
				return $type;
			};
		};
	};
}



// files
/*
$content = file_get_contents("files/doctor.xml");
$content = simplexml_load_string($content);
$content = $content->type;
foreach ($content as $rs){
	$type = $rs["name"];
	$name = $manner = $popular = $popular_text = $x = $y = $image = "";
	foreach ($rs->doctor as $rs2){
		$name = $rs2["name"];
		$manner = $rs2["manner"];
		$popular = $rs2["popular"];
		$popular_text = $rs2["popular_text"];
		$x = $rs2->x;
		$y = $rs2->y;
		$image = $rs2->image;

		// insert
		// mq("insert into doctors(type, name, manner, popular, popular_text, x, y, image) values('{$type}', '{$name}', '{$manner}', '{$popular}', '{$popular_text}', '{$x}', '{$y}', '{$image}')");
	};
};
*/


/*
$content = file_get_contents("files/member.xml");
$content = simplexml_load_string($content);
$content = $content->vvip;
foreach ($content as $rs){
	foreach ($rs->user as $rs2){
		$id = $rs2["id"];
		$pw = $rs2["password"];
		// mq("insert into member(id, pw) values('{$id}', '{$pw}')");
	};
};
*/


/*
$content = file_get_contents("files/major.json");
$content = json_decode($content);
foreach ($content as $rs){
	// mq("insert into major(type) values('{$rs}')");
};
*/


// 예약 제거
$today = date("Y-m-d");
foreach (mq("select * from reserve") as $rs){
	if (date("Y-m-d", strtotime($rs["rdate"])) < $today){
		mq("delete from reserve where idx = {$rs["idx"]}");
	};
};