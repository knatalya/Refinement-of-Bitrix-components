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
$this->setFrameMode(true);
if($arResult['FILTER_HIDE']!='Y'){
	?>
	<div class="smart_filter">
		<form action="<?=$arResult['FORM_ACTION']?>" method="get">
			<div class="fields">
				<? foreach($arResult['ITEMS'] as $propID => $arItem)
				{
					if(isset($arResult['PRICES'][$propID])){ continue;}?>
					<?if(empty($arItem['VALUES'])){ continue;}?>
					<div class="field">
						<div class="name"><?=$arItem['NAME']?></div>
						<div class="drop_down <?=isset($arResult['PRICES'][$propID])?'price':''?>">

							<div class="search_container">
								<input type="text" class="search_filter" placeholder="Введите название" id="search_filter" />
								<div class="search_count">Выбрано:&nbsp;<span id="count_number"><?=count($arItem['VALUES'])?></span></div>
							</div>

							<? if($arItem['DISPLAY_TYPE'] == 'P'){ ?>
								<div class="checkboxes <?=count($arItem['VALUES']) > 48 ? 'scrollbar' : ''?>">
									<? foreach($arItem['VALUES'] as $arItemValue)
									{
										$disabled = ($arItemValue['DISABLED'] and !$arItemValue['CHECKED'])?true:false;?>
										<div class="value <?=$disabled?'disabled':''?>">
											<label class="<?=$arItemValue['CHECKED']?'active':''?>">
												<input
														type="checkbox"
														name="<?=$arItemValue['CONTROL_ID']?>"
														value="<?=$arItemValue['HTML_VALUE']?>"
														<?=$arItemValue['CHECKED']?'checked':''?>
														<?=$arItemValue['DISABLED']?'disabled':''?>
												>
												<span class="name"><?=$arItemValue['VALUE']?></span>
											</label>
										</div>
									<? } ?>
								</div>
							<? }if($arItem['DISPLAY_TYPE'] == 'F'){ ?>
								<div class="checkboxes <?=count($arItem['VALUES']) > 42 ? 'scrollbar' : ''?>">
									<? foreach($arItem['VALUES'] as $arItemValue)
									{?>
										<div class="value <?=$arItemValue['DISABLED']?'disabled':''?>">
											<label class="<?=$arItemValue['CHECKED']?'active':''?>">
												<input
														type="checkbox"
														name="<?=$arItemValue['CONTROL_ID']?>"
														value="<?=$arItemValue['HTML_VALUE']?>"
														<?=$arItemValue['CHECKED']?'checked':''?>
														<?=$arItemValue['DISABLED']?'disabled':''?>
												>
												<span class="name"><?=$arItemValue['VALUE']?></span>
											</label>
										</div>
									<? } ?>
								</div>
							<? }elseif($arItem['DISPLAY_TYPE'] == 'B'){ ?>
								<div class="slider">
									<input type="text" class="min" name="<?=$arItem['VALUES']['MIN']['CONTROL_ID']?>" value=""/>
									<input type="text" class="max" name="<?=$arItem['VALUES']['MAX']['CONTROL_ID']?>" value=""/>
									<div
											class="slider_range"
											data-min="<?=$arItem['VALUES']['MIN']['VALUE']?>"
											data-max="<?=$arItem['VALUES']['MAX']['VALUE']?>"
									></div>
								</div>
							<? }elseif(isset($arResult['PRICES'][$propID])){?>
								<div class="slider">
									<input
											type="text"
											class="min"
											name="<?=$arItem['VALUES']['MIN']['CONTROL_ID']?>"
											value=""
											title=""
											placeholder="от <?=$arItem['VALUES']['MIN']['VALUE']?>"
									/>
									<input
											type="text"
											class="max"
											name="<?=$arItem['VALUES']['MAX']['CONTROL_ID']?>"
											value=""
											title=""
											placeholder="до <?=$arItem['VALUES']['MAX']['VALUE']?>"
									/>
									<div
											class="slider_range"
											data-min="<?=$arItem['VALUES']['MIN']['VALUE']?>"
											data-max="<?=$arItem['VALUES']['MAX']['VALUE']?>"
									></div>
								</div>
							<? } ?>
						</div>
					</div>
				<? } ?>
				<div class="buttons">
					<input type="submit" name="set_filter" value="Применить">
					<a class="reset" href="<?=$arResult['FORM_ACTION']?>">Сбросить фильтр</a>
				</div>
			</div>
		</form>
	</div>
<?}