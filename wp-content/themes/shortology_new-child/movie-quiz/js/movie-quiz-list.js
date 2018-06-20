$(document).ready(function(){

	$("a[data-quiz-id]").click(function(event){
		event.preventDefault();
		$("#formQuizList input[name='quiz-selected']").val($(this).attr("data-quiz-id"));
		$("#formQuizList").submit();
	});

});