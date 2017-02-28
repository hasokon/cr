$(function(){

	var starOn = "<i class='fa fa-star fa-lg' style='color:gold'></i>";
	var starOff = "<i class='fa fa-star-o fa-lg'></i>";

	$(".datepicker").datetimepicker({
		language : 'ja',
		format : "YYYY/MM/DD",
		autoclose : true,
	});

	$(".star").on("click", function() {
		$(this).html(starOn);
		$(this).prevAll().html(starOn);
		$(this).nextAll().html(starOff);

		var input = $(this).parent().prev("input");
		var id = input.attr("id");
		var index = $(".star").index(this);

		switch(id) {
			case "level" :
				input.val(index+1);
				break;
			case "evaluation" :
				input.val(index-4);
				break;
		}
	});

	$("#add").on("click",function(){
		var isAllOk = true;
		$("input").each(function() {
			if($(this).val() == "") {
				alert("Please fill in all forms!");
				isAllOk = false;
				return false;
			}
		});
		if(isAllOk) $("#cr-form").submit();
	});
});
