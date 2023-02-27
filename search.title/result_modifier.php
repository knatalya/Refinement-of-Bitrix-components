<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$arResult['USER_PROPERTY'] = array(
	"UF_DEPARTMENT",
);

$iblockItemIDs = [];
foreach($arResult["CATEGORIES"] as $category_id => $arCategory)
{
	array_pop($arResult["CATEGORIES"][$category_id]['ITEMS']);//удаляем "Остальные"
	foreach($arCategory['ITEMS'] as $arItem)
		if($arItem['MODULE_ID']=='iblock')
			$iblockItemIDs[] = $arItem['ITEM_ID'];
}

if(count($iblockItemIDs))
{
	$elementPictures = [];
	$obElements = CIBlockElement::GetList([], ['ID' => $iblockItemIDs], false, false, ['PREVIEW_PICTURE', 'DETAIL_PICTURE', 'ID']);
	while($arElement = $obElements -> Fetch())
	{
		$elementPictures[$arElement['ID']] = false;
		if($arElement['PREVIEW_PICTURE'])
			$elementPictures[$arElement['ID']] = $arElement['PREVIEW_PICTURE'];
		elseif($arElement['DETAIL_PICTURE'])
			$elementPictures[$arElement['ID']] = $arElement['DETAIL_PICTURE'];
		if($elementPictures[$arElement['ID']])
		{
			$arSize                          = ['width' => 46, 'height' => 46];
			$arThumb = CFile::ResizeImageGet($elementPictures[$arElement['ID']], $arSize, 1, 1);
			$elementPictures[$arElement['ID']] = [
				'SRC'=>$arThumb['src'],
				'HEIGHT'=>$arThumb['height'],
				'WIDTH'=>$arThumb['width']
			];
		}
		else{
			$elementPictures[$arElement['ID']] = [
				'SRC'=>$this->GetFolder().'/images/no_photo.png',
				'HEIGHT'=>46,
				'WIDTH'=>46
			];
		}
	}
	foreach($arResult["CATEGORIES"] as $category_id => &$arCategory)
	{
		foreach($arCategory['ITEMS'] as &$arItem)
			if($arItem['MODULE_ID']=='iblock')
				$arItem['PICTURE'] = $elementPictures[$arItem['ITEM_ID']];
	}
}