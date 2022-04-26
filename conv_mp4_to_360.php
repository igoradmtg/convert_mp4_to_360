<?php
require_once(__DIR__ . '/inc/str.php');
$dir_mp4 = 'z:/upl1'; // Directory of mp4 files
$dir_out = 'z:/upl2'; // Directory of mp4 files 360
$str_ffmpeg = '-vf scale=-1:540'; // String for ffmpeg 360

if (make_dir_if_not_exists($dir_out)==false) {
    echo "Error make dir $dir_out" . PHP_EOL;
    exit;
}
$ar_files = dir_to_array_nr($dir_mp4,true);
if ($ar_files == false) {
    echo "Dir empty $dir_our" . PHP_EOL;
    exit;
}

foreach($ar_files as $fname) {
    $bname = basename($fname);
    $new_file = $dir_out . '/' . $bname;
    $str_exec = 'ffmpeg -y -i "'.$fname.'" ' . $str_ffmpeg. ' -c:v libx264 -crf 18 -preset veryslow -c:a copy ' . $new_file;
    echo "Exec $str_exec" . PHP_EOL;
    system($str_exec);
}