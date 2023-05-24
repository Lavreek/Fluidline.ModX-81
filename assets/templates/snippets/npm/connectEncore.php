<?php
$files = array_diff(scandir(MODX_ENCORE_PATH), ['.', '..']);

if (!is_dir(MODX_ENCORE_PATH)) {
    throw new Exception("Encore folder is does not exist.");
}

if (count($files) < 1) {
    throw new Exception("Encore folder is empty.");
}

foreach ($files as $file) {
    if (preg_match('#.+(\.\w+)#', $file, $match)) {
        if (isset($match[1])) {
            $filepath = MODX_ENCORE_URL . $file;

            switch ($match[1]) {
                case '.js' : {
                    echo "<script type='text/javascript' src='$filepath' defer></script>" . "\t";
                    break;
                }
                case '.css' : {
                    echo "<link rel='stylesheet' href='$filepath'>" . "\t";
                    break;
                }
            }
        }
    }
}

return null;