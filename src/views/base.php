<!--
    base.php
    Base view for project 230-TP04_Php_Poo_Critique_photo
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title><?= isset($sectionTitle) ? "$sectionTitle | " : '' ?>Critique photo</title>
</head>

<body class='bg-light min-vh-100 d-flex flex-column'>

    <?php include 'components/_header.php' ?>

    <div class="container mb-2">
        <div class="row mt-5 mb-3">
            <div class="col">
                <h2>
                    <?php
                    if (isset($title) && $title)
                        echo $title;
                    ?>
                </h2>
            </div>
            <div class="col-5 d-flex justify-content-end align-items-center">
                <?php include 'photo/components/_owner_options.php' ?>
            </div>
        </div>
    </div>
    <div class='container'>
        <?php
        include $view;
        ?>
    </div>


    <?php include 'components/_footer.php' ?>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <?php
    if (isset($js) && $js) {
        foreach ($js as $_js) {
            echo "<script src='static/js/$_js'></script>";
        }
    }
    ?>

</body>

</html>