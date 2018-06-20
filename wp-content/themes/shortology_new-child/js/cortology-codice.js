//$(document).ready(function(){
//	
//	$("#codBtn").click(function(event) {
//		event.preventDefault();
//		
//		$("#errorMessage").text("");
//		
//		if($.trim($("#codice").val()) === ''){
//			$("#errorMessage").text("Inserisci un codice");
//		}else{
//			event.run();
//		}
//		
//		$.ajax({
//			async: false,
//			method: 'POST',
//			url : '/wp-content/themes/shortology_new-child/cortology/check-codice-cortology.php&code=',
//			data: {'codice' : $.trim($("#codice").val())},
//			success: function(data){
//				console.info(data);				
//			}
//		});
//	});
//	
//	
//});