<?php
$temp = file_get_contents(dirname(__DIR__, 1) . '/src/index.json');
$temp = str_replace(['  ', "\n", "\r"], '', $temp);
file_put_contents(dirname(__DIR__, 1) . '/src/index-min.json', $temp);

$temp = file_get_contents(dirname(__DIR__, 1) . '/src/especiais.json');
$temp = str_replace(['  ', "\n", "\r"], '', $temp);
file_put_contents(dirname(__DIR__, 1) . '/src/especiais-min.json', $temp);