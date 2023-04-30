<?php
    const LOGIN_PAGE_PATH = '../../crud/';
    require_once '../../crud/auth.php';

    require_once '../../config/database.php';
    require_once '../../models/Competition.php';
    require_once '../../models/Category.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../crud/dist/bootstrap-5.2.3/css/bootstrap.min.css">
    <style>
        th, td {
            vertical-align: middle;
        },
        .bt {
            border-top: 2px solid #aaa !important;
        }
        .br {
            border-right: 2px solid #aaa !important;
        }
        .bb, table.result tbody tr:last-child td {
            border-bottom: 2px solid #aaa !important;
        }
        .bl {
            border-left: 2px solid #aaa !important;
        }
    </style>
    <title>Scoresheet</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-center">
                <h1 class="text-uppercase"><?= Competition::findById(1)->getTitle() ?></h1>
                <h3>S C O R E S H E E T</h3>
            </div>
            <div class="col-md-6 text-center">
                <h1>_____________________</h1>
                <h3>Judge #&nbsp;</h3>
            </div>
        </div>

        <hr class="mb-4"/>

        <div class="row">
        <!-- categories -->
        <?php foreach(Category::all() as $category) { ?>
            <div class="col-md-6">
                <h2 class="text-uppercase text-center m-0"><?= $category->getTitle() ?></h2>

                <!-- events -->
                <?php foreach($category->getAllEvents() as $event) { ?>
                    <div class="p-4">
                        <table class="table">
                            <thead>
                                <tr class="table-secondary">
                                    <!-- event title -->
                                    <th colspan="3" rowspan="2" class="text-center bl bt br">
                                        <h3 class="text-center text-uppercase m-0"><?= $event->getTitle() ?></h3>
                                    </th>

                                    <!-- criteria title headers -->
                                    <?php foreach($event->getAllCriteria() as $criterion) { ?>
                                        <th class="text-center br bt" style="width: 10%"><?= $criterion->getTitle() ?></th>
                                    <?php } ?>

                                    <!-- total header -->
                                    <th class="table-primary br" style="width: 11%">
                                        <h4 class="text-center text-uppercase m-0">TOTAL</h4>
                                    </th>

                                    <!-- rank header -->
                                    <th class="table-success br" style="width: 11%">
                                        <h4 class="text-center text-uppercase m-0">RANK</h4>
                                    </th>
                                </tr>
                                <tr class="table-secondary">
                                    <!-- criteria points headers -->
                                    <?php foreach($event->getAllCriteria() as $criterion) { ?>
                                        <th class="text-center br">
                                            <h5 class="m-0"><b><?= $criterion->getPercentage() ?></b> pts.</h5>
                                        </th>
                                    <?php } ?>

                                    <!-- total spacer -->
                                    <th class="table-primary bb br"></th>

                                    <!-- rank notes -->
                                    <th class="table-success text-center bb br"><small>1 = <i>highest</i></small></th>
                                </tr>
                            </thead>

                            <tbody>
                            <!-- event teams -->
                            <?php foreach($event->getAllTeams() as $team) { ?>
                                <tr>
                                    <!-- team number -->
                                    <td class="pe-3 fw-bold bl bb" align="right">
                                        <h3 class="m-0">
                                            <?= $team->getNumber() ?>
                                        </h3>
                                    </td>

                                    <!-- team avatar -->
                                    <td class="bb" style="width: 56px;">
                                        <img
                                            src="../../crud/uploads/<?= $team->getAvatar() ?>"
                                            alt="<?= $team->getNumber() ?>"
                                            style="width: 56px; border-radius: 100%"
                                        >
                                    </td>

                                    <!-- team name -->
                                    <td class="br bb">
                                        <h6 class="text-uppercase m-0"><?= $team->getName() ?></h6>
                                        <small class="m-0"><?= $team->getLocation() ?></small>
                                    </td>

                                    <!-- rating box -->
                                    <?php foreach($event->getAllCriteria() as $criterion) { ?>
                                        <td class="bb br"></td>
                                    <?php } ?>

                                    <!-- total box -->
                                    <td class="table-primary bb br"></td>

                                    <!-- rank box -->
                                    <td class="table-success bb br"></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        </div>
    </div>

    <script src="../../crud/dist/bootstrap-5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>