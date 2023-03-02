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
$this->setFrameMode(true); ?>


<div class="swiper mainSwiper">
	<div class="swiper-wrapper swiper-wrapper-main">
		<? $i = 0; ?>
		<? foreach($arResult['ITEMS'] as $i=>$arItem): ?>
			<div class="swiper-slide swiper-slide-main" data-number="<?=$i++?>" data-min="<?=$arItem['MIN_PHOTO']?>" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<img src="<?=CFile::GetPath($arItem["PREVIEW_PICTURE"]["ID"])?>" class="main-overflow-img">
					<div class="main-info-items">
						<div class="main-name">
							<?=$arItem['NAME']?>
						</div>
						<div class="main-prop-item">
							<div class="main-prop-name">Назначение</div>
							<div class="main-prop-val">
								<? foreach($arItem['PROPERTIES']['ROOM']['VALUE'] as $room): ?>
									<?
									if($room == end($arItem['PROPERTIES']['ROOM']['VALUE']))
									{
										echo $room;
									}
									else
									{
										echo $room.' /';
									}
									?>
								<? endforeach; ?>
							</div>
						</div>
						<div class="main-prop-item">
							<div class="main-prop-name">Площадь</div>
							<div class="main-prop-val"><?=$arItem['PROPERTIES']['AREA']['VALUE']?> кв.м</div>
						</div>
						<div class="main-prop-item">
							<div class="main-prop-name">Метро</div>
							<div class="main-prop-val"><?=$arItem['PROPERTIES']['METRO']['VALUE']?></div>
						</div>
						<? if($item['PROPERTIES']['SALE']['VALUE'] !== 'Да'): ?>
							<div class="main-prop-item">
								<div class="main-prop-name">Цена</div>
								<div class="main-prop-val">
									<?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], 0, '.', ' ');?>
									<?=(in_array(25, $arItem['PROPERTIES']['ARENDA']['VALUE_ENUM_ID']))?"руб./мес.":'руб.'?>
								</div>
							</div>
						<? endif; ?>
					</div>
				</a>
			</div>
		<? endforeach; ?>
	</div>
	<div class="swiper-button-next">
		<svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14">
			<defs>
				<style>
				.cls-1 {
					fill: #fff;
					fill-rule: evenodd;
				}
				</style>
			</defs>
			<path id="Прямоугольник_2_копия_2" data-name="Прямоугольник 2 копия 2" class="cls-1" d="M0,8H14.6l-3.647,3.69L12.377,13.1,17.413,8H18V6H17.413L12.377,0.9,10.954,2.31,14.6,6H0V8Z"/>
		</svg>
	</div>
    <div class="swiper-button-prev">
		<svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14">
			<defs>
				<style>
				.cls-1 {
					fill: #fff;
					fill-rule: evenodd;
				}
				</style>
			</defs>
			<path id="Прямоугольник_2_копия" data-name="Прямоугольник 2 копия" class="cls-1" d="M18,8H3.4l3.647,3.69L5.623,13.1,0.587,8H0V6H0.587L5.623,0.9,7.046,2.31,3.4,6H18V8Z"/>
		</svg>
	</div>
    <div class="swiper-pagination"></div>
</div>

