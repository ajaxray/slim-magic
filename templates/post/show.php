<h3><?= $post['title'] ?></h3>

<p class="meta">Published on <?= date('d M, Y', strtotime($post['created_at'])) ?></p>

<div class="post-content">
    <?= $post['content'] ?>
</div>