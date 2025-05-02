<div id="barba-wrapper">
<div class="article-list">
        <? foreach( $arResult['ITEMS'] as $asItem): ?>
                <a class="article-item article-list__item" href="<?=$asItem["DETAIL_PAGE_URL"]?>" data-anim="anim-3">
                    <div class="article-item__background"><img src="<?=$asItem['PREVIEW_PICTURE']['SRC']?>"
                                                            data-src="xxxHTMLLINKxxx0.39186223192351520.41491856731872767xxx"
                                                            alt=""/></div>
                    <div class="article-item__wrapper">
                        <div class="article-item__title"><?=$asItem['NAME']?></div>
                        <div class="article-item__content"><?=$asItem['DETAIL_TEXT']?>
                        </div>
                    </div>
                </a>
		<? endforeach ?>
        
</div>
</div>



