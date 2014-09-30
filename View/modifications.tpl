<h2>Список модификаций</h2>
<table class="TecDocTable">
	<tr>
		<th>Модель</th>
		<th>Год выпуска</th>
		<th>Код двигателя</th>
		<th>Кузов</th>
		<th>Двигатель</th>
		<th>Мощность</th>
		<th>Топливо</th>
	</tr>
	{foreach from=$data.modifications item="modification"}
		<tr>
			<td>
				<a href="/?man={$smarty.get.man}&model={$smarty.get.model}&modelVariant={$modification->id}">{$modification->name}</a>
			</td>
			<td>{if $modification->yearFrom}{$modification->yearFrom->format('m/Y')}{/if}
				- {if $modification->yearTo}{$modification->yearTo->format('m/Y')}{/if}</td>
			<td>{$modification->motorCodes}</td>
			<td>{$modification->constructionType}</td>
			<td>{$modification->cylinderCapacityLiter} л.</td>
			<td>{$modification->powerHP} л.с.</td>
			<td>{$modification->fuelType}</td>
		</tr>
	{/foreach}
</table>