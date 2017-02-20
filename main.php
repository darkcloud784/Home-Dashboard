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
        <script src="https://www.google.com/uds/api?file=uds.js&v=1.0&key=AIzaSyBKuDQfjGRFrBETrff_O2b17I-1dNePYow" type="text/javascript"></script>
    </head>
    <body>
        <?php
        //Include Main Configuration
        include 'config.php';
        global $errors;
        // Include Transmission 
        include 'functions.php';
        if ($cfg_array['Show_Torrents'] == 'true') {
            $client = strtolower($cfg_array['Torrent_Client']);
            if ($client == "qbittorrent") {
                $torrents = getRequest("/query/torrents?filter=all&sort=name");
                $global_info = getRequest("/query/transferInfo");
            } elseif ($client == "transmission") {
                $torrents = transmissionTorrents();
                $global_info = transmissionAll();
            }
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
                <div class="row"
                     <div class="col-md-6">
                        <div class="info-box dark-heading-bg">
                            <div>
                                <i class="icon_drive"></i>
                                <?php
                                include 'storage.php';
                                ?>
                            </div>
                            <br>
                            <div>
                                <?php
                                if ($cfg_array['enable_second_storage'] == 'true') {
                                    include 'storage2.php';
                                }
                                ?>
                            </div>
                            <br>
                            <div class="w3-left">
                                <span class="search-box">                            
                                    <form method="get" action="https://www.google.com/search">
                                        <input style="color:#000000"
                                               type="text"
                                               name="q"
                                               size="31"
                                               color=""
                                               value="Google Search"
                                               placeholder="Google Search"
                                               onfocus="if (this.value == 'Google Search') {
                                                           this.value = '';
                                                           this.style.color = '#000';
                                                       }"
                                               >
                                    </form>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row"
                         <div class="col-md-6">
                            <div class="info-box twitter-bg">
                                <?php
                                if ($cfg_array['enable_grafana'] == 'true') {
                                    include 'dashlets.php';
                                    foreach ($dl as $element) {
                                        $url = $element["url"];
                                        $height = $element["height"];
                                        $width = $element["width"];
                                        echo "<iframe src=\"{$url}\" height=\"{$height}\" width=\"{$width}\" frameborder=\"0\"></iframe>\n";
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div id="reddit">
                            <?php
                            if ($cfg_array['enable_reddit'] == 'true') {
                                include 'reddit.php';
                            }
                            ?>
                        </div>
                        <!--Downloading and Seeding Section-->
                        <div>
                            <?php
                            if (!$cfg_array['Torrent_Client'] == "") {
                                if (['Show_Torrents'] == "true") {
                                    include 'torrent.php';
                                }
                            }
                            ?>
                        </div>
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