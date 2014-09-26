<h2>Полная информация о детали</h2>
<table>
	<tr>
		<td>
			<table class="TecDocTable">
				<tr>
					<th>Производитель</th>
					<th>Номер</th>
					<th>Наименование</th>
				</tr>
				<tr>
					<td>{$data.articleInfo->brandName}</td>
					<td>{$data.articleInfo->number}</td>
					<td>{$data.articleInfo->description}</td>
				</tr>
			</table>
			<br/>
			<table class="TecDocTable">
				<tr>
					<th colspan="2">Характеристики</th>
				</tr>
				{foreach from=$data.articleInfo->attributes item="characteristic"}
					<tr>
						<td>{$characteristic->name}</td>
						<td>{$characteristic->value} {$characteristic->unit}</td>
					</tr>
				{/foreach}
			</table>
			<br/>
			<table class="TecDocTable">
				<tr>
					<th colspan="2">Оригинальные номера</th>
				</tr>
				{foreach from=$data.articleInfo->oenNumbers item="original"}
					<tr>
						<td>{$original->brandName}</td>
						<td>{$original->oeNumber}</td>
					</tr>
				{/foreach}
			</table>
			<br/>
		</td>
		<td>
			{if !empty($data.articleInfo->documents->data)}
				<img src="data:{$data.articleInfo->documents->fileType};base64,{$data.articleInfo->documents->data}"/>
			{/if}
		</td>
	</tr>
</table>