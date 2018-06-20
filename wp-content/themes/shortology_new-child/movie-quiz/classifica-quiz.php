<?php
include_once 'quiz-functions.php';

$quizFunctions = new QuizFunctionsNew ();

$classifica = $quizFunctions->getClassifica ();

$posizione = 1;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>MovieQuiz: Classifica</title>
		<link href="MQstyle.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			var refreshInSecondi = 10;
			setTimeout(function(){
				location.reload(true);
			}, (refreshInSecondi * 1000));
		</script>
	</head>
	<body>
		<h1 class="classifica">LA CLASSIFICA</h1>
		<table border="1" style="width: 100%;margin: auto;text-align: left;">
			<tr>
            	<th width="30%">&nbsp;</th>
				<th width="50">#</th>
				<th width="100">Punteggio</th>
				<th width="100">Tempo</th>
				<th>Nickname</th>
                <th width="10%">&nbsp;</th>
			</tr>
			<?php foreach ($classifica as $record){ ?>
				<tr class="<?php echo $posizione <= 3 ? 'rigaPrimiTre' : ($posizione % 2 == 0 ? 'rigaPari' :'rigaDispari' );?>">
                	<td>&nbsp;</td>
					<td><?php echo $posizione++;?></td>					
					<td><?php echo $record->PUNTEGGIO; ?></td>
					<td><?php echo $record->TEMPO; ?></td>
					<td><?php echo $record->NICKNAME;  ?></td>
                    <td>&nbsp;</td>
				</tr>
			<?php }?>
		</table>
	</body>
</html>