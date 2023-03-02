<?php


namespace UW;


class Helper
{
    static public function showH1(){
        global $APPLICATION;
        return ($APPLICATION->GetPageProperty('HIDE_H1')!='Y')?'<div class="container"><div class="title-page"><h1>' . $APPLICATION->GetTitle(false) . '</h1><div class="title-separotor"><img src="/local/templates/main/img/liner.svg" alt=""></div></div></div>':'';
    }
}