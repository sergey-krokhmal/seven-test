<h2><?=$title_h2?></h2>
<?if (isset($err_msg)):?>
	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Ошибка:</span>
		<?=$err_msg?>
	</div>
<?endif?>
<div class="list-group">
	<?for($i = 1; $i <= 6; $i++):?>
		<a href="/tasks/solved/<?=$i?>" class="list-group-item">Задание №<?=$i?></a>
	<?endfor?>
</div>