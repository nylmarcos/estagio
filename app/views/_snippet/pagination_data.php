<div class="pagination">
<?php if($count > 1): ?>
	<ul>
		<?php if($p > 1): ?>
		<li><a href="~/<?= $url . ($p - 1) . $i .$f .$s  ?>">«</a></li>
		<?php endif ?>

		<?php for($r = 1; $r <= $count; $r++): ?>
			<?php if($r == $p): ?>
			<li class="active"><span><?= $r ?></span></li>
			<?php else: ?>
			<li><a href="~/<?= $url . $r . $i .$f .$s  ?>"><?= $r ?></a></li>
			<?php endif ?>
		<?php endfor ?>

		<?php if($p < $count): ?>
		<li><a href="~/<?= $url . ($p + 1) . $i .$f .$s ?>">»</a></li>
		<?php endif ?>
	</ul>
<?php else: ?>
	<p class="muted">Página 1 de 1</p>
<?php endif ?>
</div>