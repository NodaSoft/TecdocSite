<h2>Каталог TecDoc</h2>
{$data.breadcrumbs}
<div class="tecdocTop">
	<input name="searchTecdoc" id="searchTecdoc" value="" placeholder="Начните вводить слово..."
	       class="jqueryPlaceholder"/>
</div>
<div>
	<ul class="tabs_table clearfix">
		<li {if empty($data.carType) && empty($data.selectedLetter)}class="active"{/if}><a href="/">Все</a></li>
		<li {if $data.carType == 1}class="active"{/if}><a href="/?carType=1">Легковые</a></li>
		<li {if $data.carType == 2}class="active"{/if}><a href="/?carType=2">Грузовые</a></li>
		<li {if $data.carType == 3}class="active"{/if}><a href="/?carType=3">Малотоннажные грузовые</a></li>
		{foreach item="item" from=$data.manufacturers key="letter"}
			<li{if $data.selectedLetter == $letter} class="active"{/if}><a href="/?letter={$letter}">{$letter}</a></li>
		{/foreach}
	</ul>
</div>
<div class="TecDocCont">
	{foreach item="manufacturer" key="letter" from=$data.manufacturers}
		{if empty($data.selectedLetter) || $data.selectedLetter == $letter}
			<div class="listLine">
				<div class="wordBold">{$letter}</div>
				<div class="brandsList">
					<ul>
						{foreach from=$manufacturer item=man}
							<li class="liSearch">
								<a href="/?man={$man->id}" class="forSearch">{$man->name}</a>
							</li>
						{/foreach}
					</ul>
				</div>
			</div>
		{/if}
	{/foreach}
</div>
<script>
	$('#searchTecdoc').keyup(function () {
		$('.brandsList li, .listLine').show();
		var searchText = $(this).val();
		$('.listLine:NotContainsCaseInsensitive("' + searchText + '")').hide();
		$('.brandsList .forSearch:NotContainsCaseInsensitive("' + searchText + '")').closest('li').hide();
	});
</script>