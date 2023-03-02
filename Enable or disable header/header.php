<!--- Шапка -->
<?if($APPLICATION->GetCurPage() !== '/'):?>
        <div class="breadcrumbs">
            <div class="container">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "main",
                    Array(),
                    false
                );?>
            </div>
        </div>
        <?if($APPLICATION->GetCurPage() !== '/company/'):
            $APPLICATION->AddBufferContent(['\\UW\\Helper', 'showH1']);
        endif;?>
    <div class="content-block">
<?endif;