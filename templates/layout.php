<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Slim-Magic Blog</title>
    <meta name="description" content="A minimalist blog">
    <meta name="author" content="Anis Uddin Ahmad <anis.programmer@gmail.com>">

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/skeleton.css">
    <link rel="stylesheet" href="/css/custom.css">

    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="/images/favicon.png">

</head>
<body>

<!-- Primary Page Layout
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="container">
    <div class="row">
        <div class="seven columns" style="min-height: 150px">
            <h4>Slim-Magic Blog</h4>
            <p>Testing if <a href="https://github.com/ajaxray/magic">Magic</a> Dependency Injection Container works with
                <a href="https://www.slimframework.com">Slim Framework</a>.</p>

            <div class="u-cf"></div>
        </div>
        <div class="five columns">
            <nav class="u-pull-right">
                <a href="/">Home</a>
                <?php if (isset($_SESSION['user'])): ?>
                    | <a href="/posts/new">Create New Post</a>
                    | <?= $_SESSION['user'] ?> (<a href="/logout">logout</a>)
                <?php else: ?>
                    | <a href="/login">login</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
    <div class="row">
        <?php if (isset($sidebar)): ?>
        <div class="three columns">
            <?= $sidebar ?>
        </div>
        <?php endif; ?>

        <div class="<?= isset($sidebar)? 'nine' : 'twelve' ?> columns">
            <?php if(isset($flash_type)): ?>
                <div class="alert <?= $flash_type ?>"><?= $flash_message ?></div>
            <?php endif; ?>

            <?= $content ?>
        </div>
    </div>
</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
