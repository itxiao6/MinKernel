document.documentElement.style.fontSize = innerWidth / 16 + 'px';

onresize = function() {
	document.documentElement.style.fontSize = innerWidth / 16 + 'px';
};

$.ajax({
	url: "site.json",
	type: "get",
	dataType: "JSON",
	success: function(data) {
		for(var i in data) {
			$(".box1").append('<option value="' + data[i].name + '">' + data[i].name + '</option>');
		}
	},
	error: function() {
		console.log("没有获取到");
	}
});
$(".box1").on("change", function() {
	$(".box2").html("");
	$.ajax({
		url: "site.json",
		type: "get",
		dataType: "JSON",
		success: function(data) {
			for(var i in data) {
				if(data[i].name == $(".box1").val()) {
					for(var j in data[i].city) {
						$(".box2").append('<option value="' + data[i].city[j].name + '">' + data[i].city[j].name + '</option>');
					}
					$(".box2").change();
				}
			}
		},
		error: function() {
			console.log("没有获取到");
		}
	});
});
$(".box2").on("change", function() {
	$(".box3").html("");
	$.ajax({
		url: "site.json",
		type: "get",
		dataType: "JSON",
		success: function(data) {
			for(var i in data) {
				if(data[i].name == $(".box1").val()) {
					for(var j in data[i].city) {
						if($(".box2").val() == data[i].city[j].name) {
							for(var x in data[i].city[j].area) {
								$(".box3").append('<option value=' + data[i].city[j].area[x] + '>' + data[i].city[j].area[x] + '</option>');
							}
						}
					}
				}
			}
		},
		error: function() {
			console.log("没有获取到");
		}
	});
});

$(".box1").change();