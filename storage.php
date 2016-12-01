<?php

$storage_path = ($cfg_array['storage_path']);
$storage_name = ($cfg_array['storage_name']);

/* get disk space free (in bytes) */
$df = disk_free_space($storage_path);
/* and get disk space total (in bytes)  */
$dt = disk_total_space($storage_path);
/* now we calculate the disk space used (in bytes) */
$du = $dt - $df;
/* percentage of disk used - this will be used to also set the width % of the progress bar */
$dp = sprintf('%.2f', ($du / $dt) * 100);
/* and we format the size from bytes to MB, GB, etc. */
$df = formatSize($df);
$du = formatSize($du);
$dt = formatSize($dt);

function formatSize($bytes) {
    $types = array('B', 'KB', 'MB', 'GB', 'TB');
    for ($i = 0; $bytes >= 1024 && $i < ( count($types) - 1 ); $bytes /= 1024, $i++)
        ;
    return( round($bytes, 2) . " " . $types[$i] );
}
echo "$storage_name:  $du Used - $df Free - $dt Total";

// Second Storage

if ($cfg_array['enable_second_storage'] == 'true') {
    $storage_path2 = ($cfg_array['storage_path2']);
    $storage_name2 = ($cfg_array['storage_name2']);

    /* get disk space free (in bytes) */
    $df2 = disk_free_space($storage_path2);
    /* and get disk space total (in bytes)  */
    $dt2 = disk_total_space($storage_path2);
    /* now we calculate the disk space used (in bytes) */
    $du2 = $dt2 - $df2;
    /* percentage of disk used - this will be used to also set the width % of the progress bar */
    $dp2 = sprintf('%.2f', ($du2 / $dt2) * 100);
    /* and we format the size from bytes to MB, GB, etc. */
    $df2 = formatSize($df2);
    $du2 = formatSize($du2);
    $dt2 = formatSize($dt2);
    echo "$storage_name2:  $du2 Used - $df2 Free - $dt2 Total";
}
?>         