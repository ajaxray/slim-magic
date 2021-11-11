<h5 style="text-align: center">Login</h5>
<?php if (isset($failed)): ?>
    <p class="error" style="text-align: center">Wrong username-password combination provided!</p>
<?php endif; ?>
<form method="post">
    <div class="row">
        <div class="four columns"><label for="username">Username</label></div>
        <div class="eight columns"><input class="u-full-width" type="text" name="username"></div>
    </div>
    <div class="row">
        <div class="four columns"><label for="username">Password</label></div>
        <div class="eight columns"><input class="u-full-width" type="password" name="password"></div>
    </div>
    <div class="row">
        <div class="eight columns offset-by-four">
            <input type="hidden" name="<?= $nameKey ?>" value="<?= $name ?>">
            <input type="hidden" name="<?= $valueKey ?>" value="<?= $value ?>">

            <input class="button-primary" type="submit" value="Login">
        </div>
    </div>
</form>

