<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<h3>Create New Post</h3>
<form method="post" action="/posts">
    <div class="row">
        <div class="six columns">
            <label for="title">Post Title</label>
            <input class="u-full-width" type="text" placeholder="A Short title" id="title" name="title">
            <?= isset($errors['title']) ? '<div class="input error">'. $errors['title'] .'</div>' : '' ?>
        </div>
    </div>
    <label for="content">Post Content</label>
    <textarea class="u-full-width" placeholder="Hi Dave …" id="content" name="content" rows="10" style="height: 200px"></textarea>
    <?= isset($errors['content']) ? '<div class="input error">'. $errors['content'] .'</div>' : '' ?>
<!--    <label class="example-send-yourself-copy">-->
<!--        <input type="checkbox">-->
<!--        <span class="label-body">Send a copy to yourself</span>-->
<!--    </label>-->
    <input class="button-primary" type="submit" value="Submit">
</form>

<script>
    var simplemde = new SimpleMDE();
</script>