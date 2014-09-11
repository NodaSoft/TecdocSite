<h2>Аналоги и оригинальные замены</h2>
{if $data.analogs }
	<table class="TecDocTable">
		<thead>
		<tr>
			<th>Бренд</th>
			<th>Номер</th>
			<th>Описание</th>
		</tr>
		</thead>
		<tbody>
		{foreach from=$data.analogs item="analog"}
			<tr>
				<td>{$analog->brandName}</td>
				<td>{$analog->number}</td>
				<td>{$analog->description}</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
{else}
	Аналоги не найдены.
{/if}