<h2>Список модификаций</h2>
{$data.breadcrumbs}
<div class="tecdocTop">
	<input name="searchTecdoc" id="searchTecdoc" value="" placeholder="Начните вводить слово..."
	       class="jqueryPlaceholder"/>
</div>
<table class="TecDocTable">
	<tr>
		<th class="tecdocInfo">&nbsp;</th>
		<th>Модель</th>
		<th>Год выпуска</th>
		<th>Код двигателя</th>
		<th>Кузов</th>
		<th>Двигатель</th>
		<th>Мощность</th>
		<th>Топливо</th>
	</tr>
	{foreach from=$data.modifications item="modification"}
		<tr class="forSearch">
			<td>
				<a target="_blank" href="/?fullInfoModelVariant&modelVariant={$modification->id}" class="tecdocInfo-box">
					<img src="/images/common/info_icon.png"/>
				</a>
			</td>
			{*Модель*}
			<td>
				<a href="/?man={$smarty.get.man}&model={$smarty.get.model}&modelVariant={$modification->id}">{$modification->name}</a>
			</td>
			{*Год выпуска*}
			<td>{if $modification->yearFrom}{$modification->yearFrom->format('m/Y')}{/if}
				- {if $modification->yearTo}{$modification->yearTo->format('m/Y')}{/if}</td>
			{*Код двигателя*}
			<td>{$modification->motorCodes}</td>
			{*Кузов*}
			<td>{$modification->constructionType}</td>
			{*Двигатель*}
			<td>{($modification->cylinderCapacityCcm/1000)|round:1} л.</td>
			{*Мощность*}
			<td>{$modification->powerHP} л.с.</td>
			{*Топливо*}
			<td>{$modification->fuelType}</td>
		</tr>
	{/foreach}
</table>
<script>
	$('#searchTecdoc').keyup(function () {
		$('.forSearch').show();
		var searchText = $(this).val();
		$('.forSearch:NotContainsCaseInsensitive("' + searchText + '")').hide();
	});
</script>