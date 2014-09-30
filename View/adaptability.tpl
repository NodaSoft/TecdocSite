<h2>Применимость</h2>
{if $data.adaptability}
	<table class="TecDocTable">
		<tr>
			<th>Модель</th>
			<th>Год выпуска</th>
			<th>Код двигателя</th>
			<th>Кузов</th>
			<th>V см<sup>3</sup></th>
			<th>KW</th>
			<th>PS<</th>
			<th>Топливо</th>
		</tr>
		{foreach from=$data.adaptability item="adaptability"}
			<tr>
				<td>{$adaptability->name}</td>
				<td>{if $adaptability->yearFrom}{$adaptability->yearFrom->format('m/Y')}{/if} - {if $adaptability->yearTo}{$adaptability->yearTo->format('m/Y')}{/if}</td>
				<td>{$adaptability->motorCodes}</td>
				<td>{$adaptability->constructionType}</td>
				<td>{$adaptability->cylinderCapacityCcm}</td>
				<td>{$adaptability->powerKW}</td>
				<td>{$adaptability->powerHP}</td>
				<td>{$adaptability->fuelType}</td>
			</tr>
		{/foreach}
	</table>
{else}
	Применимость не найдена.
{/if}