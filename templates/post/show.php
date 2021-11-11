<h3><?= $post['title'] ?></h3>

<p class="meta">
    Published on <?= date('d M, Y', strtotime($post['created_at'])) ?>
    <?php if (isset($_SESSION['user'])): ?>
        &nbsp; <a href="/not-implemented">Edit</a>
    <?php endif ?>
</p>

<div class="post-content">
    <?= $post['content'] ?>
</div>