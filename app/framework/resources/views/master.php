<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->escape($title); ?></title>
</head>
<body>
    <h1>Sistema de templates</h1>
    <?php echo $this->load(); ?>

    <hr>

    <span>footer</span>
</body>
</html>