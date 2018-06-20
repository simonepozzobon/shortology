$(document).ajaxStart(function() {
	$("#layerLoading").show();
});

$(document).ajaxStop(function() {
	$("#layerLoading").hide();
});

$(document).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
	$("#layerLoading").hide();
	alert("Attenzione: Si e' verificato un errore di rete");
	location.reload(true);
});


$(document).ready(function(){

	$("*[data-hide='true']").hide();
	$("*[data-hide='false']").show();

	var interval = null;

	var quizId = $("input[data-quiz-id]").attr("data-quiz-id");
	
	var idQuizCheRegistaSei = 4;
	var urlQuizFunction = '/wp-content/themes/shortology_new-child/movie-quiz/quiz-functions.php';
	

	var tempoRisposta = 0;
	var tempoTotale = $("#tempoTotaleCountDown").val();
	var value = 0;
	
	function countDown(){
		if(value < 100){
			tempoRisposta++;
			value = value + (100 / tempoTotale);
		}else{
			stopCountDown();
			inviaRisposta(-1);
		}
	}
	
	
	function createIntervalCountDown(){
		return setInterval(function(){
			countDown();
		}, 1000);
	}
	
	function startCountDown(){
		value = 0;
		tempoRisposta = 0;
		$("#progressBar").width("0%");
		$(".container-progress").show();
		$("#progressBar").width("100%");
		countDown();
		if(interval != null){
			clearInterval(interval);
		}
		interval = createIntervalCountDown();
	}
	
	function stopCountDown() {
		$(".container-progress").hide();
		if(interval != null){
			clearInterval(interval);
		}
	}

	function showNextSlide(){
		var parentDiv = $(".MQwrapper:visible");
		var nextSlide = $(parentDiv).next();
		$(parentDiv).hide();
		$(nextSlide).show();
		$("#layerCover").hide();
		if($(nextSlide).attr("data-domanda") != null && quizId != idQuizCheRegistaSei){
			startCountDown();
		}else{
			stopCountDown();
		}
	}

	function inviaRisposta(risposta){
		$.ajax({
			type : "POST",
			timeout : 60000,
			url  : urlQuizFunction,
			data : {'insert-risposta' : 'true', 'risposta' : risposta, 'tempo' : tempoRisposta, 'quiz-id' : quizId },
			beforeSend: function(){
				stopCountDown();
				$("#layerCover").show();
			},
			success : function(data){
				showNextSlide();
			}
		});
	}
	
	function calcolaPunteggioQuiz(idQuiz){
		$.ajax({
			type : "POST",
			url  : urlQuizFunction,
			data : {'calcola-punteggio-quiz' : 'true', 'quiz-id' : quizId },
			beforeSend : function(){
				$("#layerCover").show();
			},
			success : function(data){
				$("#layerCover").hide();
				if(idQuiz != 4){
					showNextSlide();
					$("div[data-esito-quiz-loading]").hide();
					$("div[data-esito-quiz]").show();
					$("span[data-punteggio-quiz]").text(data);
				}else{
					/*
					 * che regista sei
					 */
					$(".MQwrapper:visible").hide();
					if(data <= 3){
						$("div[data-end-quiz-regista='1']").show();
					}else if(data >= 4 && data <= 7){
						$("div[data-end-quiz-regista='2']").show();
					}else if(data >= 8 && data <= 11){
						$("div[data-end-quiz-regista='3']").show();
					}else if(data >= 12 && data <= 15){
						$("div[data-end-quiz-regista='4']").show();
					}else if(data >= 16 && data <= 19){
						$("div[data-end-quiz-regista='5']").show();
					}else if(data >= 20 && data <= 23){
						$("div[data-end-quiz-regista='6']").show();
					}else if(data >= 24 && data <= 27){
						$("div[data-end-quiz-regista='7']").show();
					}else if(data >= 28 && data <= 30){
						$("div[data-end-quiz-regista='8']").show();
					}
//					data-end-quiz-regista="1"><!-- 0-3 -->			
//					data-end-quiz-regista="2"><!-- 4-7 -->
//					data-end-quiz-regista="3"><!-- 8-11 -->
//					data-end-quiz-regista="4"><!-- 12-15 -->
//					data-end-quiz-regista="5"><!-- 16-19 -->
//					data-end-quiz-regista="6"><!-- 20-23 -->
//					data-end-quiz-regista="7"><!-- 24-27 -->
//					data-end-quiz-regista="8"><!-- 28-30 -->
				}
			}
		});
	}

	$("a[data-start-quiz]").click(function(event){
		event.preventDefault();
		showNextSlide();
	});
	
	$("a[data-risposta]").click(function(event){
		event.preventDefault();
		stopCountDown();
		inviaRisposta($(this).attr("data-risposta"));
	});
	
	$("a[data-end]").click(function(event){
		event.preventDefault();
		calcolaPunteggioQuiz($(this).attr("data-end"));
	});

});