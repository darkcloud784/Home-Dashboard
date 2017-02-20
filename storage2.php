<?php

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

function formatSize2($bytes2) {
    $types2 = array('B', 'KB', 'MB', 'GB', 'TB');
    for ($i = 0; $bytes2 >= 1024 && $i < ( count($types2) - 1 ); $bytes2 /= 1024, $i++)
        ;
    return( round($bytes2, 2) . " " . $types2[$i] );
}

echo "$storage_name2:  $du2 Used - $df2 Free - $dt2 Total";      