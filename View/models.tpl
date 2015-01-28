<h2>Список моделей</h2>
{$data.breadcrumbs}
<div class="tecdocTop">
	<input name="searchTecdoc" id="searchTecdoc" value="" placeholder="Начните вводить слово..."
	       class="jqueryPlaceholder"/>
</div>
<div class="clearfix catalogTabs">
	<ul class="tabs_table clearfix">
		<li {if $data.selectedYear == 'all'}class="active"{/if}>
			<a href="?man={$data.man}&yearFilter=all">Все</a>
		</li>
		{foreach from=$data.yearsFilter item=onePeriod }
			{if $onePeriod.isVisible}
				<li {if $data.selectedYear == $onePeriod.end}class="active"{/if} >
					<a href="?man={$data.man}&yearFilter={$onePeriod.end}">{if $onePeriod.begin}{$onePeriod.begin}{/if}
						- {$onePeriod.end}</a>
				</li>
			{/if}
		{/foreach}
	</ul>
</div>
<div class='TecDocTable'>
	<div>
		<ul class="TecDocModelTitle">
			<li class="couple">
				<div class="TecDocModel">Название</div>
				<div class="TecDocYear">Год выпуска</div>
			</li>
			<li class="couple">
				<div class="TecDocModel">Название</div>
				<div class="TecDocYear">Год выпуска</div>
			</li>
			<li class="couple">
				<div class="TecDocModel">Название</div>
				<div class="TecDocYear">Год выпуска</div>
			</li>
		</ul>
	</div>
	<div>
		<ul class="ulTecDocModels">
			{foreach from=$data.models item=oneModel}
				<li class="couple forSearch">
					<div class="TecDocModel">
						<a href="/?man={$data.man}&model={$oneModel->id}">{$oneModel->name}</a>
					</div>
					<div class="TecDocYear">
						{if $oneModel->yearFrom}{$oneModel->yearFrom->format('m/Y')}{/if}
						- {if $oneModel->yearTo}{$oneModel->yearTo->format('m/Y')}{/if}
					</div>
				</li>
			{/foreach}
		</ul>
	</div>
</div>
<script>
	$('#searchTecdoc').keyup(function () {
		$('.forSearch').show();
		var searchText = $(this).val();
		$('.forSearch:NotContainsCaseInsensitive("' + searchText + '")').closest('li').hide();
	});
</script>