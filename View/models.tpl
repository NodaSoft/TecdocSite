<h2>Список моделей</h2>
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
			{section name="model" loop=$data.models step=3}
				{$i=$smarty.section.model.index}
				{for $k=0 to 2}
					{if isset($data.models[$i+$k])}
						<li class="couple">
							<div class="TecDocModel">
								<a href="/?man={$data.man}&model={$data.models[$i+$k]->id}">{$data.models[$i+$k]->name}</a>
							</div>
							<div class="TecDocYear">
								{$data.models[$i+$k]->yearFrom|substr:4}/{$data.models[$i+$k]->yearFrom|substr:0:4}
								- {if $data.models[$i+$k]->yearTo}{$data.models[$i+$k]->yearTo|substr:4}/{$data.models[$i+$k]->yearTo|substr:0:4}{/if}
							</div>
						</li>
					{/if}
				{/for}
			{/section}
		</ul>
	</div>
</div>