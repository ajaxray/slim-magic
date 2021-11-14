<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<h3>Update Post</h3>
<form method="post">
    <div class="row">
        <div class="six columns">
            <label for="title">Post Title</label>
            <input class="u-full-width" type="text" placeholder="A Short title" id="title" name="title" value="<?= $post['title'] ?>">
            <?= isset($errors['title']) ? '<div class="input error">'. $errors['title'] .'</div>' : '' ?>
        </div>
    </div>
    <label for="content">Post Content</label>
    <textarea class="u-full-width" placeholder="The details …" id="content" name="content" rows="10" style="height: 200px"><?= $post['content'] ?></textarea>
    <?= isset($errors['content']) ? '<div class="input error">'. $errors['content'] .'</div>' : '' ?>

    <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
    <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">

    <input class="button-primary" type="submit" value="Update">
</form>

<script>
    var simplemde = new SimpleMDE();
</script>