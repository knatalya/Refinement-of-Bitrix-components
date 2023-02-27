<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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
$this->setFrameMode(true);

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID)<=0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID)<=0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"){?>
	<div id="<? echo $CONTAINER_ID ?>" class="search">
		<form action="<? echo $arResult["FORM_ACTION"] ?>">
			<input id="<? echo $INPUT_ID ?>" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" placeholder="Поиск по сайту"/><!--
			--><input name="s" type="submit" value=""/>
		</form>
	</div>
<? } ?>
<script>
	window.searchSuggestTimeoutId = 0;
	$('#<?=$INPUT_ID?>').on('input', function() {
		if(window.searchSuggestTimeoutId) {
			clearTimeout(window.searchSuggestTimeoutId);
			window.searchSuggestTimeoutId = 0;
		}
		window.searchSuggestTimeoutId = setTimeout(getSuggest, 200);
    });
	$('#<?=$CONTAINER_ID?>').mouseout(function(){
		$('.title-search-result').css('display', 'none');
	});
	$('#<?=$CONTAINER_ID?>').mouseover(function(){
		$('.title-search-result').css('display', 'block');
	});
	function getSuggest() {
		$.ajax({
			type: "POST",
			url: "/local/templates/1-ask/components/bitrix/search.title/.default/ajax.php",
			data: {input: $('#<?=$INPUT_ID?>').val()},
			success: function(data) {
				$('.title-search-result').remove();
				$('.search').append(data);
			}
		});
	}
</script>