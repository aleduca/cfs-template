<?php $this->extends('master', ['title' => 'Login']); ?>

<h2>Login <?php echo $name; ?></h2>

<?php $this->start('menu'); ?>
    <?php require 'partials/menu.php'; ?>
<?php $this->end(); ?>

<form action="/login" method="post">
    <input type="text" placeholder="Email">
    <input type="password" placeholder="Senha">

    <button type="submit">Login</button>
</form>