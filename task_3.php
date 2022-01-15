<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
        </title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/statistics/chartist/chartist.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    </head>
    <body class="mod-bg-1 mod-nav-link ">
        <main id="js-page-content" role="main" class="page-content">
            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Задание
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <ol class="breadcrumb page-breadcrumb">

                                <?php
                                //формируем массив для хлебных крошек
                                $breadCrumbs = ['Главная', 'PHP', 'Функции'];

                                //вычисляем длину массива
                                $breadCrumbsLenghts = count($breadCrumbs);
                                // var_dump($breadCrumbsLenghts);

                                // уменьшаем номер последнего элемента в массиве на 1, т.к. счет элементов начинается с 0
                                $breadCrumbsLenghts = $breadCrumbsLenghts -1;

                                // сохраняем последний элемент массива в отдельную переменную
                                $breadCrumbsLastElement = $breadCrumbs[$breadCrumbsLenghts];
                                // var_dump($breadCrumbsLastElement);

                                // удаляем из массива последний элемент
                                array_pop($breadCrumbs);
                                // var_dump($breadCrumbs);

                                // выводим в цикле массив
                                foreach($breadCrumbs as $breadCrumb):
                                ?>

                                <li class="breadcrumb-item"><a href="#"><?php echo $breadCrumb?></a></li>

                                <?php
                                    endforeach;
                                // вставляем последний сохраненный элемент массива
                                ?>
                                <li class="breadcrumb-item active"><?php echo $breadCrumbsLastElement; ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        

        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script>
            // default list filter
            initApp.listFilter($('#js_default_list'), $('#js_default_list_filter'));
            // custom response message
            initApp.listFilter($('#js-list-msg'), $('#js-list-msg-filter'));
        </script>
    </body>
</html>
