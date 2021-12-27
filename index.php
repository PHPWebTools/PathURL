<?php
class pathurl {
    public static function pathURL($file) {
        $file = str_replace($_SERVER['DOCUMENT_ROOT'], "", $file);
        $https = ($_SERVER['SERVER_PROTOCOL'] === 443);
        $host = ($https ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
        if ((substr($file, 0, 1) === ".") && (substr($file, 0, 2) !== "..")) {
            $file = $host.dirname($_SERVER['PHP_SELF']).substr_replace($file, "", 0, 1);
        }
        if (strpos($file, "..") === 0) {
            $file = $host . dirname($_SERVER['PHP_SELF'], 2) . substr_replace($file, "", 0, 2);
        }
        if ((substr($file, 0, 1) === "/") || (substr($file, 0, 1) === "\\")) {
            $file = substr_replace($file, $host . "/", 0, 1);
        }
        $file = str_replace("\\", "/", $file);
        if (strpos($file, $host . "//") !== false) {
            $file = str_replace($host . "//", $host . "/", $file);
        }
        if (!((substr($file, 0, 1) === "/") || (substr($file, 0, 1) === "\\") || (substr($file, 0, 1) === ".") || (strpos($file, $host) === 0))) {
            $file = $host . dirname($_SERVER['PHP_SELF']) . "/" . $file;
        }
        return $file;
    }
    public static function file_as_url2($file, $file2=null) {
        if ($file2 == null) {
            $file2 = $_SERVER['PHP_SELF'];
        }
        $file = self::pathURL($file);
        $file2 = self::pathURL($file2);
        return (strpos($file, $file2) !== false);
    }
}
$pathurl = new PathURL;
