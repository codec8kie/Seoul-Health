
$(document).ready(function() {$("#side_nav ul li:first-child .side-menu-main").on("click", function() {$(this).parent().toggleClass("toggle"); }); $("#nav_toggle input").on("change", function() {var arr = [$("#view_map"), $("#view_list")], v = $("#nav_toggle input:checked").val(); arr[v]['show'](); arr[!parseInt(v) ? 1 : 0]['hide'](); $("#nav")[(parseInt(v) ? "remove" : "add")+"Class"]("map"); }).trigger("change"); }); 'use strict';

// 이 위에 코드는 변경하지 마시오


/*
 * Modal Controller
 *
 * @string action - 'show' or 'hide'
 * @string id - 'login_modal', 'reserve_modal', 'doctor_modal'
 *
 * @return null
 */

function modal(action, id) {
	$("#"+id).modal(action);
}

// 의사 자세히 보기
function readMore (index){
	$.post("/php/php.php/readMore", {index: index}, function (data){
		$("#doctor_modal").html(data);
		modal("show", "doctor_modal");
	});
}

// GET XML
// function getXml (){
// 	$.ajax({
// 		type: "GET",
// 		dataType: "xml",
// 		url: "/files/doctor.xml",
// 		success: function (data){
// 			console.log(data);
// 		},
// 	});
// }

// 이동
function move (url){ location.href = url; }

// on 최소화
function on (e, n, f){
	return $(document).on(e, n ,f);
}

$(function (){
	// submit
	on("submit", "#search form", function (e){
		var keyword = $(this).find("input[type=text]").val();
		var select = $("#nav select").val();

		// MAP
		$.post("/php/php.php/search", {keyword: keyword}, function (data){
			console.log(data);

			// 초기화
			$("#view_map > div").remove();
			$("#view_map").append(data);

			if (!select){
				$(".data").show();
			}else {
				$(".data").each(function (i, self){
					var dataSelect = $(self).find("p").text();
					if (dataSelect != select){
						$(self).hide();
					};
				});
			};
		});

		// LIST
		$.post("/php/php.php/search_list", {keyword: keyword}, function (data){
			// 초기화
			$("#view_list > div").remove();
			$("#view_list").append(data);

			if (!select){
				$(".data").show();
			}else {
				$(".data").each(function (i, self){
					var dataSelect = $(self).find("p").text();
					if (dataSelect != select){
						$(self).hide();
					};
				});
			};
		});

		return false;
	});
});