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

        .table-wrapper {
            max-height: 440px;
            overflow: auto;
            display: inline-block;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
          integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous"/>
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
