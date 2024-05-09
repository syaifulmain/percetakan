<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>percetakan"</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .main-bg {
            background-color: #eeebe3;
        }

        body {
            font-family: 'Poppins';
            background-color: #eeebe3;
        }

        #alertDiv {
            transition: opacity 1s;
        }
        .hidden {
            display: none;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

</head>
<body>
<div class="container-fluid">
    <?php if (isset($model['error'])) { ?>
        <div id="alertDiv" class="alert alert-danger position-absolute ms-auto me-auto start-0 end-0 text-center"
             role="alert" style="width: 1440px;">
            <?= $model['error'] ?>
        </div>
    <?php } ?>
    <?php if (isset($model['alert'])) { ?>
        <div id="alertDiv" class="alert alert-warning position-absolute ms-auto me-auto start-0 end-0 text-center"
             role="alert"
             style="width: 1440px;">
            <?= $model['alert'] ?>
        </div>
    <?php } ?>
    <?php if (isset($model['success'])) { ?>
        <div id="alertDiv" class="alert alert-success position-absolute ms-auto me-auto start-0 end-0 text-center"
             role="alert"
             style="width: 1440px;">
            <?= $model['success'] ?>
        </div>
    <?php } ?>
</div>
