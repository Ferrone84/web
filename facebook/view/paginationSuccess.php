<div class="pagination-component">
    <span>  «  </span>
    <?php foreach($context->pagination as $page) : ?>
    		<a href="facebook.php?action=profil&amp;id=<?= htmlspecialchars($context->user->id) ?>&amp;page=<?= htmlspecialchars($page)?>">
    			<span class="index-pagination">  <?php echo($page);?>  </span>
    		</a>
    	<?php endforeach; ?>
    <span>  »  </span>
</div>