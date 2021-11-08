
<div class="u-cf"></div>
<h1>Hello from home</h1>

<?php foreach($posts as $post): ?>
    <h3><a href="/posts/<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
<?php endforeach; ?>