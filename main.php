<html>
    <head>
        <meta charset="UTF-8">
        <title>Main</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/elegant-icons-style.css" rel="stylesheet" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />    
        <link href="css/widgets.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        //Include Main Configuration
        include 'config.php';
        global $errors;
        // Include Transmission 
        include 'functions.php';
        $client = strtolower($cfg_array['Torrent_Client']);
        if ($client == "qbittorrent") {
            $torrents = getRequest("/query/torrents?filter=all&sort=name");
            $global_info = getRequest("/query/transferInfo");
        } elseif ($client == "transmission") {
            $torrents = transmissionTorrents();
            $global_info = transmissionAll();
        }
        ?>


        <!--main content start-->
        <section id="main-content">
            <!--overview start-->
            <section class="wrapper-frame">
                <!--Dashboard section-->
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</i></h3>
                    </div>
                </div>
                <!--Breadcrumb Section-->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="main.php">Home</a></li>
                            <li><i class="fa fa-laptop"></i>Dashboard</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-3 col-sm-12 col-xs-12">
                        
                        <h5 class="info-box dark-heading-bg">
                            <i class="icon_drive"></i>
                        <?php
                        include 'storage.php';
                        ?>
                        </h5>
                    </div>
                    </div>

                <!--Downloading and Seeding Section-->
                <?php
                if (!$cfg_array['Torrent_Client'] == "") {
                    include 'torrent.php';
                }
                ?>
                <!--Error display-->
                <?php
                if (count($errors) > 0) {
                    echo "<div class=\"row\">";
                    echo "<div class=\"col-lg-12 col-md-3 col-sm-12 col-xs-12\">";
                    echo "<div class=\"info-box red-bg\">";
                    echo "<h3><span style=\"color: black; font-weight: bold;\">Errors</span></h3>";
                    foreach ($errors as $err) {
                        echo "<span style=\"color: black; font-weight: bold;\">" . $err . "</span><br>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </section>
            <!--overview end-->
        </section>
        <!--main content end-->

        <!-- container section start -->
        <!-- javascripts -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui-1.10.4.min.js"></script>
        <script src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <!-- bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!-- nice scroll -->
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <!-- custom select -->
        <script src="js/jquery.customSelect.min.js" ></script>
        <!--custome script for all page-->
        <script src="js/scripts.js"></script>
        <!-- custom script for this page-->
        <script src="js/jquery.autosize.min.js"></script>
        <script src="js/jquery.placeholder.min.js"></script>
        <script src="js/jquery.slimscroll.min.js"></script>
    </body>
</html>

</body>
</html>