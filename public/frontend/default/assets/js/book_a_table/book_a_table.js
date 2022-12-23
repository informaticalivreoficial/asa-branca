	$.book = function() {
		
	};

	$('#book_table .title_book').click(function(){

		if ($('#book_table').css('right') == "-178px")
		{
			$right = "0px";
			$.book('displayoptions', "0");
		} else {
			$right = "-178px";
			$.book('displayoptions', "1");
		}

		$('#book_table').animate({
			right: $right
		},{
			duration: 500,
			easing: "easeInOutExpo"
		});


	});

	$(function(){
		$('#book_table').fadeIn();

		if ($.book('displayoptions') == "1")
		{
			$('#book_table').css('right','-178px');
		} else if ($.book('displayoptions') == "0") {
			$('#book_table').css('right','0');
		} else {
			$('#book_table').delay(800).animate({
				right: "-178px"
			},{
				duration: 500,
				easing: "easeInOutExpo"
			});

			$.book('displayoptions', "1");
		}


	});