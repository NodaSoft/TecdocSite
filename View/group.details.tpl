<h2>Детали</h2>
<table class="TecDocTable">
	<tr>
		<th class="TecDocInfo">&nbsp;</th>
		<th class="TecDocImg">&nbsp;</th>
		<th>Фирма</th>
		<th>Код детали</th>
		<th>Описание</th>
		<th colspan="2"></th>
	</tr>
	{foreach from=$data.articles item="article"}
		<tr>
			<td>
				<a href="/?articleInfo&articleId={$article->id}">
					<img src="/images/info_icon.png"/>
				</a>
			</td>
			<td class="TecDocImg">
				{if !empty($article->documents->data)}
					<img src="data:{$article->documents->fileType};base64,{$article->documents->data}"/>
				{/if}
			</td>
			<td>{$article->brandName}</td>
			<td>{$article->number}</td>
			<td>{$article->description}</td>
			<td>
				<a href="/?adaptability&articleId={$article->id}">Применимость</a>
			</td>
			<td>
				<a href="/?analogs&number={$article->number|urlencode}">Аналоги</a>
			</td>
		</tr>
	{/foreach}
</table>