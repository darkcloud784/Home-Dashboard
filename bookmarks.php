<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!file_exists("bookmarks.dat")) {
    echo "<span class=\"error-center\">Failed to load bookmarks.dat</span>";
    Exit(1);
}

$bookmarks = array_map('trim', file("bookmarks.dat"));

class Bookmark {

    var $name;
    var $url;
    var $icon;
    var $iframe;

}

// Parse bookmarks file
function spawnBookmarks() {
    $bookmark_array = [];
    global $bookmarks;
    for ($i = 0; $i < count($bookmarks); $i++) {
        $bm = $bookmarks[$i];
        if (startsWith($bm, "[") && endsWith($bm, "]")) {
            $new = new Bookmark();
            $name = substr($bm, 1, strlen($bm) - 2);
            $new->name = trim($name);
            do {
                $i++;
                if ($i >= count($bookmarks)) {
                    break;
                }
                if (startsWith($bookmarks[$i], "url=")) {
                    $new->url = substr($bookmarks[$i], 4, strlen($bookmarks[$i]) - 4);
                }
                if (startsWith($bookmarks[$i], "icon=")) {
                    $new->icon = substr($bookmarks[$i], 5, strlen($bookmarks[$i]) - 5);
                }
                if (startsWith($bookmarks[$i], "iframe=")) {
                    $new->iframe = substr($bookmarks[$i], 7, strlen($bookmarks[$i]) - 7);
                    if ($new->iframe === "true") {
                        $new->iframe = true;
                    } else
                        $new->iframe = false;
                }
            } while (trim($bookmarks[$i]) !== "");
            array_push($bookmark_array, $new);
        }
    }
    return $bookmark_array;
}
function startsWith($haystack, $needle)
        {
            $length = strlen($needle);
            return (substr($haystack, 0, $length) === $needle);
        }
        function endsWith($haystack, $needle)
        {
            $length = strlen($needle);
            if ($length == 0) {
                return true;
            }
            return (substr($haystack, -$length) === $needle);
        }      
      ?>