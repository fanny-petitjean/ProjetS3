<?php


class Security
{
    private static $seed = 'ngfdgfdg56rbp1k38DOqKVnsAtwz';

    public static function hacher($texte_en_clair)
    {
        $texte_hache = hash('sha256', self::$seed . $texte_en_clair);
        return $texte_hache;
    }
}


?>