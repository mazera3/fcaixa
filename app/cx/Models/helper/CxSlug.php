<?php

namespace App\cx\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CxSlug
 *
 * @copyright (c) year, Édio Mazera
 */
class CxSlug {

    private $Nome;
    private $Formato;

    public function nomeSlug($Nome) {
        $this->Nome = (string) $Nome;
        $this->Formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->Formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';

        $this->Nome = strtr(utf8_decode($this->Nome), utf8_decode($this->Formato['a']), $this->Formato['b']);
        $this->Nome = strip_tags($this->Nome);

        $this->Nome = str_replace(' ', '_', $this->Nome);

        $this->Nome = str_replace(array('-----', '----', '---', '--'), '-', $this->Nome);

        $this->Nome = strtolower($this->Nome);

        return $this->Nome;
    }

}
