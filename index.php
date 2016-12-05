<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.ico" type='image/x-icon'/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/elegant-icons-style.css" rel="stylesheet" />
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/custom.css" rel="stylesheet">
    </head>

    <body>

        <?php
        $today = date("F j, Y, g:i a");
        $cfg_array = include('config.php');
        // Add Weather
        include('weather.php');
        $api_key = $cfg_array['weather_key'];
        $latitude = $cfg_array['latitude'];
        $longitude = $cfg_array['longitude'];
        $lang = $cfg_array['lang'];
        $units = $cfg_array['units'];
        $forecast = new ForecastIO($api_key, $units, $lang);
        $weather = weather();
        //Add bookmarks
        include ('bookmarks.php');
        ?>

        <!-- Start sidebar -->

        <nav class="w3-sidenav w3-white w3-card-2 w3-border" style="display:none" id="sidenav">
            <a href="javascript:void(0)"
               onclick="w3_close()"
               class="w3-closenav w3-medium">Close &times;</a>
            <a href="main.php" class="w3-border-bottom" target="search_iframe"><i class="icon_desktop"></i> Dashboard</a></i>
        <?php
        $bms = spawnBookmarks();
        foreach ($bms as $bm) {
            if ($bm->iframe)
                echo "<a href=\"" . $bm->url . "\" . target=\"search_iframe\" . class=\"w3-border\">";
            else
                echo "<a href=\"" . $bm->url . "\" target=\"_blank\" . class=\"w3-border\">";
            echo "<i class=\"" . $bm->icon . "\"></i>";
            echo "     ";
            echo $bm->name;
            echo "</a>";
        }
        ?>
    </nav>


    <!-- Start Top Navbar -->

    <div id="main">
        <header class="w3-container w3-green">
            <span class="w3-opennav w3-medium" onclick="w3_open()" id="openNav">&#9776;</span>
            <!-- Weather -->
            <span style="padding-left: 20px;">
                <h3 class="nav-mid">
                    <?php echo '<a href="https://darksky.net/forecast/' . $cfg_array['latitude'] . $cfg_array['longitude'] . '"' . " " . "target=search_iframe" . '>' .
                    "<b>" . round($weather[2]) . "</b>, " . $weather[0] . ",  Feels like <b>" . round($weather[3]) . '' . "</a>" . "</b>";
                    ?></h3>
                <span class="iweather">
                    <canvas id="weather-canvas" width="32" height="32"></canvas></span>
                <script src="js/skycons.js"></script>
                <script>
                var icons = new Skycons();
                icons.set("weather-canvas", "<?php echo $weather[1]; ?>");
                icons.play();
                </script>    
            </span>

            <!-- Title -->
            <span class="header1"><h3 class="header1"><?php echo $cfg_array['Title']; ?></h3></span>
            <!-- Date -->
            <span class="w3-right"><h3 class="w3-right-align"><?php echo $today ?></h3></span>    
        </header>
    </div>
    <!-- Start iframe content -->          
    <div class="frame" id="iframe">
        <iframe style="height: calc(100% - 50px); width: 100%; position: absolute; border: none;" name="search_iframe" src="main.php" allowfullscreen="" ></iframe>
    </div>
    <!-- JavaScript-->
    <script>
        function w3_open() {
            document.getElementById("main").style.marginLeft = "10%";
            document.getElementById("sidenav").style.width = "10%";
            document.getElementById("iframe").style.marginLeft = "10%";
            document.getElementById("sidenav").style.display = "block";
            document.getElementById("openNav").style.display = 'none';

        }
        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("iframe").style.marginLeft = "0%";
            document.getElementById("sidenav").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";

        }
    </script>

</body>
</html>