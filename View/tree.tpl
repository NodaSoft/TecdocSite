<h2>Группы деталей</h2>
<table class="TecDocTable">
	<tr>
		<td>
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
	</tr>
</table>