$(document).ready(function() {

	$("#openSendCodeModal").magnificPopup({
		type : 'inline',
		midClick : true
	});

	$("#openPopupEsempio").magnificPopup({
		type : 'inline',
		midClick : true
	});

	$("#textareaStory").keyup(function(){
		var maxLength = 1000;
		var caratteriRimanenti = maxLength - $(this).val().length;
		if(caratteriRimanenti <= 0){
			if(caratteriRimanenti < 0){
				$(this).val($(this).val().substring(0, maxLength));
				$this.text($(this).val());
			}else{
				$("#countTextareaStory").text(0);
			}
		}else{
			$("#countTextareaStory").text(caratteriRimanenti);
		}
	});


	$("#sendCodeByEmail").click(function(event){
		event.preventDefault();
		var data = {};
		data["sendCodeByEmail"] = true;
		data["email"] = $("#emailForCode").val();
		data["codice"] = $("#codiceForm").val();
		$.ajax({
			type: "POST",
			url : '/wp-content/themes/shortology_new-child/cortology/cortology-functions.php',
			data: data,
			beforeSend: function(){
				$("#messageSendCodeByEmail").text("Attendere prego...");
			},
			success: function(data){
				$("#messageSendCodeByEmail").text(data);
			}
		});
	});


	setTimeout(function() {
//		audio.pause();
//		audio.currentTime = 0;
	}, 10000);

	var code;
	var enableSlot = true;

	function onComplete($el, active) {
		switch ($el[0].id) {
			case 'machine1':
				break;
			case 'machine2':
				break;
			case 'machine3':
				break;
			case 'machine4':
				$("#codice").text(code);
				$("#cortInsertStory form input[name='code']").val(code);
				$("#codiceForm").val(code);
				$("#slotResult").slideDown("slow");
				enableSlot = true;
				break;
		}
	}

	var machine1 = $("#machine1").slotMachine({
		active : 0,
		delay : 500
	});

	var machine2 = $("#machine2").slotMachine({
		active : 1,
		delay : 500
	});

	var machine3 = $("#machine3").slotMachine({
		active : 2,
		delay : 500
	});

	var machine4 = $("#machine4").slotMachine({
		active : 3,
		delay : 500
	});

	$("#btnSlot").click(function() {
		if(enableSlot){


			$(this).attr("src", $(this).attr("src").substring(0, $(this).attr("src").lastIndexOf("/")) + "/slotBar.gif");
			$(this).attr("src", $(this).attr("src").substring(0, $(this).attr("src").lastIndexOf("/")) + "/slotBar_anim.gif?removeCache=" + new Date());

			try{
//				var audio = new Audio("");
//				audio.play();
			}catch(e){}



			enableSlot = false;
			this.src=this.src
			$("#codice").text("");
			$("#slotResult").slideUp("slow");

			$.ajax({
				url : '/wp-content/themes/shortology_new-child/cortology/immagini-random-json.php',
				success : function(data) {
					var jsonResult = $.parseJSON(data);
					console.log(jsonResult);
					if (jsonResult["images"] && jsonResult["images"].length == 4) {

						code = jsonResult["code"];

						var images = jsonResult["images"];

						machine1.setRandomize(images[0] - 1);
						machine2.setRandomize(images[1] - 1);
						machine3.setRandomize(images[2] - 1);
						machine4.setRandomize(images[3] - 1);

						machine1.shuffle(3, onComplete);

						setTimeout(function() {
							machine2.shuffle(3, onComplete);
						}, 500);

						setTimeout(function() {
							machine3.shuffle(3, onComplete);
						}, 1000);

						setTimeout(function() {
							machine4.shuffle(3, onComplete);
						}, 1500);

					} else {
						alert("errore: " + data);
					}
				}
			});
		}
	});

	$("#linkStoria").click(function(event){
		event.preventDefault();
		$("#formCreateStory").submit();
	});

});
