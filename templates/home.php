
<div class="u-cf"></div>
<h3>Recent Posts</h3>

<?php foreach($list->items as $post): ?>
    <h4><a href="/posts/<?= $post['id'] ?>"><?= $post['title'] ?></a></h4>
<?php endforeach; ?>
<p>
    <?php if ($list->hasPrevious): ?> <a href="/?page=<?= $currentPage - 1 ?>">&laquo; Newer Posts</a> <?php endif; ?>
    <?php if ($list->hasNext): ?> <a href="/?page=<?= $currentPage + 1 ?>">Older Posts &raquo;</a> <?php endif; ?>
</p>

