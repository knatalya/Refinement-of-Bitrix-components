<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arResult */
foreach($arResult['ITEMS'] as $key => $item){
    $arFileTmp = CFile::ResizeImageGet(
        $item["PREVIEW_PICTURE"],
        array("width" => 280, "height" => 165),
        BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
        true
    );
    $arResult['ITEMS'][$key]['MIN_PHOTO'] = $arFileTmp['src'];
}