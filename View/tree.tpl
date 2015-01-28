<h2>Группы деталей</h2>
{$data.breadcrumbs}
<div class="tecdocTop">
	<input name="searchTecdoc" id="searchTecdoc" value="" placeholder="Начните вводить слово..."
	       class="jqueryPlaceholder"/>
</div>
<table class="TecDocTable">
	<tr>
		<td style="vertical-align: top;">
			<div class='dtree'>
				<p><a href="javascript: tree.openAll();">Открыть все</a> | <a href="javascript: tree.closeAll();">Закрыть
						все</a></p>
				<script>
					tree = new dTree('tree', '/images/');
					tree.add(1, -1, 'Группы деталей', '', false, false, false, false, false, false, false, true);
					{foreach from=$data.tree item=row}
					tree.add({$row->id}, {if is_null($row->parentId)}1{else}{$row->parentId}{/if}, '{$row->name}', '{if !$row->hasChilds}{$data.url}{$row->id}{/if}', false, false, false, false, false, false, false, {if $row->hasChilds}true{else}false{/if});
					{/foreach}
					document.write(tree);
				</script>
			</div>
		</td>
		<td class="tecdocCt">
			<span>Популярные категории</span>
			<a href="{$data.url}100597">Интервал регулировки</a><br>
			<a href="{$data.url}100121">Амортизатор</a><br>
			<a href="{$data.url}100042">Батарея</a><br>
			<a href="{$data.url}102450">Вакуумный насос</a><br>
			<a href="{$data.url}100337">Вентилятор</a><br>
			<a href="{$data.url}100088">Водяной насос / прокладка</a><br>
			<a href="{$data.url}100103">Водяной радиатор</a><br>
			<a href="{$data.url}100260">Воздушный фильтр</a><br>
			<a href="{$data.url}100350">Генератор</a><br>
			<a href="{$data.url}100743">Детали кузова/крыло/буфер</a><br>
			<a href="{$data.url}100566">Зеркала</a><br>
			<a href="{$data.url}100356">Испаритель</a><br>
			<a href="{$data.url}101994">Масла</a><br>
			<a href="{$data.url}100150">Катушка зажигания</a><br>
			<a href="{$data.url}100048">Лямбда-зонд</a><br>
			<a href="{$data.url}100470">Масляный фильтр</a><br>
			<a href="{$data.url}100431">Поликлиновый ремень</a><br>
			<a href="{$data.url}100104">Радиатор печки</a><br>
			<a href="{$data.url}100601">Рулевая тяга</a><br>
			<a href="{$data.url}100151">Свеча зажигания</a><br>
			<a href="{$data.url}100359">Стартер</a><br>
			<a href="{$data.url}100206">Ступица колеса</a><br>
			<a href="{$data.url}100095">Термостат</a><br>
			<a href="{$data.url}100717">Топливный насос</a><br>
			<a href="{$data.url}100261">Топливный фильтр</a><br>
			<a href="{$data.url}102208">Тормозная жидкость</a><br>
			<a href="{$data.url}100032">Тормозной диск</a><br>
			<a href="{$data.url}100030">Тормозные колодки</a><br>
			<a href="{$data.url}100035">тормозные шланги</a><br>
			<a href="{$data.url}100263">Фильтр салона</a><br>
			<a href="{$data.url}100754">Электроника двигателя</a><br>
		</td>
	</tr>
</table>
<script>
	$('#searchTecdoc').keyup(function () {
		$('.dTreeNode').hide();
		var searchText = $(this).val();
		if (searchText) {
			tree.openAll();
		} else {
			tree.closeAll();
		}
		$('.dTreeNode').each(function(){
			$c = $(this).find('a:NotContainsCaseInsensitive("' + searchText + '")');
			if (!$c.length) {
				tree.showTo($(this));
			}
		});
	});
</script>