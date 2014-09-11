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
					<td>{$data.articleInfo->directArticle->brandName}</td>
					<td>{$data.articleInfo->directArticle->articleNo}</td>
					<td>{$data.articleInfo->directArticle->articleName}</td>
				</tr>
			</table>
			<br/>
			<table class="TecDocTable">
				<tr>
					<th colspan="2">Характеристики</th>
				</tr>
				{foreach from=$data.articleInfo->articleAttributes item="characteristic"}
					<tr>
						<td>{$characteristic->attrName}</td>
						<td>{$characteristic->attrValue} {$characteristic->attrUnit}</td>
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
			{foreach from=$data.articleInfo->documentData item=image}
			{if !empty($image->docData)}
				<img src="data:{$image->docFileType};base64,{$image->docData}"/>
			{/if}
			{/foreach}
		</td>
	</tr>
</table>