<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escape($title); ?></title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <h1>From master page</h1>

    <div class="container">
        <?php echo $this->load(); ?>
    </div>

    <div id="footer">
        <span>footer</span>
    </div>

</body>
</html>