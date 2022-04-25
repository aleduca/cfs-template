<?php $this->extends('master', ['title' => 'Home']); ?>

<h2>Olá <?php echo $name; ?></h2>

<ul>
    <?php foreach ($users as $user): ?>
        <li><?php echo $user->firstName; ?></li>
    <?php endforeach; ?>
</ul>