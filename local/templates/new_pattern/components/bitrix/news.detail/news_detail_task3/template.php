<div class="article-card">
    <div class="article-card__title"><?=$arResult["NAME"]?></div>
    <div class="article-card__date"><?=DateTime::createFromFormat('d.m.Y H:i:s', $arResult["TIMESTAMP_X"])->format('d.m.Y')?></div>
    <div class="article-card__content">
        <div class="article-card__image sticky">
			<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
		 	alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?> data-object-fit="cover"/>
        </div>
        <div class="article-card__text">
            <div class="block-content" data-anim="anim-3"><p><?=$arResult["DETAIL_TEXT"]?></p></div>
            <a class="article-card__button" href="<?=$arResult["LIST_PAGE_URL"]?>">Назад к новостям</a></div>
		</div>
</div>