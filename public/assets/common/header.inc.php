<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pageTitle; ?></title>
    <?php foreach ($cssFiles as $css): ?>
    <link rel="stylesheet" media="screen,projection" href="public/assets/css/<?php echo $css; ?>" />
    <?php endforeach; ?>
</head>
<body>