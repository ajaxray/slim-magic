
<div class="u-cf"></div>
<h3>Recent Posts</h3>

<?php foreach($posts as $post): ?>
    <h4><a href="/posts/<?= $post['id'] ?>"><?= $post['title'] ?></a></h4>
<?php endforeach; ?>