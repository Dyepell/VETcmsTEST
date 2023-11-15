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
}
?>