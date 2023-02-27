<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
$arResult = CIBlockElement::GetList([], ["IBLOCK_ID"=>20, "ACTIVE"=>"Y"]);
$return   = '<div class="title-search-result"><div class="title-search-result-wrap">';
$i = 0;
while($ob = $arResult->GetNextElement())
{
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	$gost     = mb_strtolower($arProps["ANALOG_GOST"]['VALUE']);
	$iso      = mb_strtolower($arProps["ANALOG_ISO"]['VALUE']);
	$nf       = mb_strtolower($arProps["ANALOG_NF_E"]['VALUE']);
	$input    = mb_strtolower($_POST['input']);
	if (
		(
			stripos(mb_strtolower($arFields['NAME']), $input) !== false
			|| stripos($gost, $input) !== false
			|| stripos($iso, $input) !== false
			|| stripos($nf, $input) !== false
		) 
		&& $i < 5
	) {
		if($arFields["PREVIEW_PICTURE"]) {
			$src = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
		} else {
			$src = "/local/templates/1-ask/components/bitrix/search.title/.default/images/no_photo.png?1";
		}
		$i++;
		$return .= '<div class="title-search-item">
			<a href="' . $arFields["DETAIL_PAGE_URL"] . '">
				<img src="' . $src . '"> ' .
				$arFields["NAME"] . '
			</a>
		</div>';
	} else if ($i >= 5) {
		break;
	}
}
$return .= '</div><div class="title-search-fader"></div></div>';

// Очистка памяти
unset($gost);
unset($iso);
unset($nf);
unset($input);

echo $return;