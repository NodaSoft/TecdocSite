<h2>Детали</h2>
{$data.breadcrumbs}
<br>
<div class="goodsGroupResultRow" id="result">
	<div class="wGoodsGroup wGoodsGroupTile">
		<div class="goodsGroupHead">
			<div class="showingTypes">
				<a href="?{$data.baseUrl}{if $data.start}&start={$data.start}{/if}{if $data.itemsPerPage}&itemsPerPage={$data.itemsPerPage}{/if}&viewMode=tile"
				   title="Плиткой"
				   class="showing-tile{if $data.viewMode != 'list'} showing-act{/if}">
					<span class="fr-icon-layout"></span>
				</a>
				<a href="?{$data.baseUrl}{if $data.start}&start={$data.start}{/if}{if $data.itemsPerPage}&itemsPerPage={$data.itemsPerPage}{/if}&viewMode=list"
				   title="Списком"
				   class="showing-list{if $data.viewMode == 'list'} showing-act{/if}">
					<span class="fr-icon-list"></span>
				</a>
			</div>
			<div class="showOnPage">
				На странице:<br>
				{foreach from=$data.itemsPerPareValues item=oneItemPerPage}
					{if $oneItemPerPage == $data.selectedItemsPerPage}
						<b>{$oneItemPerPage}</b>
					{else}
						<a title="На странице: {$oneItemPerPage}"
						   href="?{$data.baseUrl}&itemsPerPage={$oneItemPerPage}{if $data.viewMode}&viewMode={$data.viewMode}{/if}{if $data.start}&start={$data.start}{/if}">
							{$oneItemPerPage}
						</a>
					{/if}
				{/foreach}
			</div>
		</div>
		<div class="goodsBody">
		{$data.paginator}
			{if $data.viewMode != 'list'}
				<ul class="item_ul">
					{foreach from=$data.articles item=oneArticle }
						<li class="item">
							<div class="topBlock">
								<div class="articlePic">
									<div class="articleImages">
										<div class="article-image">
											{if !empty($oneArticle->documents->data)}
												<img src="data:{$oneArticle->documents->fileType};base64,{$oneArticle->documents->data}"/>
											{else}
												<img src="/images/common/no_image.jpg"/>
											{/if}
										</div>
									</div>
								</div>
								<div class="articleDesc">
									<h3>{$oneArticle->brandName}</h3>
									<a target="_blank" href="/?articleInfo&articleId={$oneArticle->id}" >
										{$oneArticle->number}
										<br>
										{$oneArticle->description}
									</a>
								</div>
							</div>
							<div class="order">
								<div class="priceButton">
									<a target="_blank" href="//4mycar.ru/parts/{$oneArticle->brandName|escape:'url'}/{$oneArticle->number|escape:'url'}">Посмотреть цены</a>
								</div>
							</div>
						</li>
					{/foreach}
				</ul>
			{else}
				<table class="globalResult">
					<thead>
					<tr>
						<th></th>
						<th>Фирма</th>
						<th>Код детали</th>
						<th>Модель</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					{foreach from=$data.articles item=oneArticle }
						<tr class="white item">
							{*Картинка*}
							<td>
								<div class="articlePicList">
									<div class="articleImages">
										{if !empty($oneArticle->documents->data)}
											<a href="data:{$oneArticle->documents->fileType};base64,{$oneArticle->documents->data}">
												<img src="data:{$oneArticle->documents->fileType};base64,{$oneArticle->documents->data}"/>
											</a>
										{else}
											<img src="/images/common/no_image.jpg"/>
										{/if}
									</div>
								</div>
							</td>
							{*Фирма*}
							<td>
								{$oneArticle->brandName}
							</td>
							{*Код детали*}
							<td>
								{$oneArticle->number}
							</td>
							{*Модель*}
							<td class="description">
								<a target="_blank" href="/?articleInfo&articleId={$oneArticle->id}">{$oneArticle->description}</a>
							</td>
							{*Посмотреть цены*}
							<td class="order orderW">
								<a target="_blank" href="//4mycar.ru/parts/{$oneArticle->brandName|escape:'url'}/{$oneArticle->number|escape:'url'}">Посмотреть цены</a>
							</td>
						</tr>
					{/foreach}
					</tbody>
				</table>
			{/if}
			{$data.paginator}
		</div>
	</div>
	<div id="dialogConfirm"></div>
</div>