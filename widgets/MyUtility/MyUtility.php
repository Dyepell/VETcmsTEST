<?php
namespace MyUtility;

class MyUtility
{
    public static function Dump($arr): void {
        echo '<pre>'.print_r($arr, true).'</pre>';
    }


    public static function UniqidReal($lenght = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }


    public static function CsvExplode($filePath, $delimiter): array {
        $data = [];
        $fh = fopen($filePath, "r");

        while (($row = fgetcsv($fh, 0, $delimiter)) !== false) {
            array_push($data, $row);
        }

        return $data;
    }

    public static function cleanDir($dir) {
        $files = glob($dir."/*");
        $c = count($files);
        if (count($files) > 0) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }

    public function get_absolute_path($path) {
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = array();
        foreach ($parts as $part) {
            if ('.' == $part) continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        return implode(DIRECTORY_SEPARATOR, $absolutes);
    }

    public function getVersion() {
        return json_decode(file_get_contents(\Yii::$app->basePath . '/version.json'), true);
    }


}
?>