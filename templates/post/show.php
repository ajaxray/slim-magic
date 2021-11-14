<h3><?= $post['title'] ?></h3>

<p class="meta">
    Published on <?= date('d M, Y', strtotime($post['created_at'])) ?>
    <?php if (isset($_SESSION['user'])): ?>
        &nbsp; <a href="/posts/edit/<?= $post['id'] ?>">Edit</a>
    <?php endif ?>
</p>

<div class="post-content">
    <?= $post['content'] ?>
</div>