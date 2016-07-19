<div class="searchResultInfo">
	<table class='tecdocTable'>
		<tr>
			<th colspan="2">Подробная информация</th>
		</tr>
		<tr>
			<td>Модель</td>
			<td>{$data.modification->name}</td>
		</tr>
		<tr>
			<td>Год выпуска</td>
			<td>{if $data.modification->yearFrom}{$data.modification->yearFrom->format('Y')}{/if}
				- {if $data.modification->yearTo}{$data.modification->yearTo->format('Y')}{/if}</td>
		</tr>
		<tr>
			<td>Мощность</td>
			<td>{$data.modification->powerHP} л.с. / {$data.modification->powerKW}
				кВт.
			</td>
		</tr>
		<tr>
			<td>Рабочий обьем</td>
			<td>{$data.modification->cylinderCapacityCcm} см3
				/ {$data.modification->cylinderCapacityLiter/100} л.
			</td>
		</tr>
		<tr>
			<td>Цилиндров</td>
			<td>{$data.modification->cylinder}</td>
		</tr>
		<tr>
			<td>Клапанов на цилиндр</td>
			<td>{$data.modification->valves}</td>
		</tr>
		<tr>
			<td>Форма кузова</td>
			<td>{$data.modification->constructionType}</td>
		</tr>
		<tr>
			<td>Тип привода</td>
			<td>{$data.modification->impulsionType}</td>
		</tr>
		<tr>
			<td>Код двигателя</td>
			<td>{$data.modification->motorCodes}</td>
		</tr>
		<tr>
			<td>Вид двигателя</td>
			<td>{$data.modification->motorType}</td>
		</tr>
		<tr>
			<td>Вид топлива</td>
			<td>{$data.modification->fuelType}</td>
		</tr>
		<tr>
			<td>Подготовка топлива</td>
			<td>{$data.modification->fuelTypeProcess}</td>
		</tr>
	</table>
</div>