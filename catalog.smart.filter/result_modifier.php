<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$arResult = \UW\CatalogSmartFilter::DisableTemplateItems($arResult);
$arResult['FILTER_HIDE'] = 'Y';
foreach($arResult['ITEMS'] as $propID => &$arItem)
{
	if(!empty($arItem['VALUES']) and count($arItem['VALUES']))
	{
		if(isset($arResult['PRICES'][$propID]))
			continue;
		$arResult['FILTER_HIDE'] = 'N';
		//break;
	}
	uasort($arItem['VALUES'], function($a, $b){
		return strnatcasecmp($a['VALUE'],$b['VALUE']);
	});
}