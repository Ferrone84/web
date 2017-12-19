<div class="pagination-component">
    <?php if ($context->page > 1 && $context->page <= $context->max_pagination) : ?>
		<a href="facebook.php?action=profil&amp;id=<?= htmlspecialchars($context->user->id) ?>&amp;page=<?=htmlspecialchars($context->page-1)?>">
	    	<span class="index-pagination">  «  </span>
	    </a>
	<?php endif; ?>
    <?php foreach($context->pagination as $page) : ?>
            <a href="facebook.php?action=profil&amp;id=<?= htmlspecialchars($context->user->id) ?>&amp;page=<?= htmlspecialchars($page)?>">
                <span class="index-pagination">  <?php echo($page);?>  </span>
            </a>
    <?php endforeach; ?>
    <?php if ($context->page < $context->max_pagination) : ?>
	    <a href="facebook.php?action=profil&amp;id=<?=htmlspecialchars($context->user->id) ?>&amp;page=<?=htmlspecialchars($context->page+1)?>">
	    	<span class="index-pagination"> »  </span>
		</a>
	<?php endif; ?>
</div>