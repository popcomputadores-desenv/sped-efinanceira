<?php

namespace NFePHP\eFinanc\Common;

/**
 * Class XsdSeeker find XSD files for validations
 *
 * @category  API
 * @package   NFePHP\eFinanc
 * @copyright Copyright (c) 2018
 * @license   http://www.gnu.org/licenses/lesser.html LGPL v3
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-efinanceira for the canonical source repository
 */
class XsdSeeker
{
    public static $list = [
        'EnvioLoteEventos' => ['version' => '', 'name' => ''],
        'RetornoEvento' => ['version' => '', 'name' => ''],
        'RetornoLoteEventos' => ['version' => '', 'name' => ''],
        'RetornoTotalizadorContribuinte' => ['version' => '', 'name' => ''],
        'RetornoProcessamentoLote' => ['version' => '', 'name' => '']
    ];
    
    public static function seek($path)
    {
        $arr = scandir($path);
        foreach ($arr as $filename) {
            if ($filename == '.' || $filename == '..') {
                continue;
            }
            foreach (self::$list as $key => $content) {
                $len = strlen($key);
                $chave = substr($filename, 0, $len);
                $version = self::getVersion($filename);
                if (strtolower($chave) == strtolower($key)) {
                    self::$list[$key] = ['version' => $version, 'name' => $filename];
                    break;
                }
            }
        }
        return self::$list;
    }
    
    public static function getVersion($filename)
    {
        $p = explode('-', $filename);
        $v = explode('.', $p[1]);
        return $v[0];
    }
}
