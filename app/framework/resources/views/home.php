<?php $this->extends('master', ['title' => 'Home']); ?>

<h1 id="home">Olá <?php echo $name; ?></h1>

<?php echo $this->lower('ALEXANDRE'); ?>

<!-- In master template you must create a section with $this->section('menu') -->
<?php $this->start('menu'); ?>
    <?php require 'partials/menu.php'; ?>
<?php $this->end(); ?>

<!-- In master template you must create a section with $this->section('css') -->
<?php $this->start('css'); ?>
    <style>
        h1#home{
            color:red;
        }
    </style>
<?php $this->end(); ?>

<ul>
    <?php foreach ($users as $user): ?>
        <li><?php echo $user->firstName; ?></li>
    <?php endforeach; ?>
</ul>