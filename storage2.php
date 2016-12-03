<?php

function formatSize2($bytes2) {
    $types2 = array('B', 'KB', 'MB', 'GB', 'TB');
    for ($f = 0; $bytes2 >= 1024 && $f < ( count($types2) - 1 ); $bytes2 /= 1024, $f++)
        ;
    return( round($bytes2, 2) . " " . $types2[$f] );
}


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
    $df2 = formatSize2($df2);
    $du2 = formatSize2($du2);
    $dt2 = formatSize2($dt2);
    echo "$storage_name2:  $du2 Used - $df2 Free - $dt2 Total"; 