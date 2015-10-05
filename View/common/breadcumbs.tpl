<a class="tecdocCrumb" href="/">Каталог</a>
{foreach from=$data.breadcrumbs item=oneItem}
	<img src="/images/breadcrumbs_arr.png">
	{if isset($oneItem.url)}
		<a class="tecdocCrumb" href="{$oneItem.url}">{$oneItem.name}</a>
	{else}
		<span class="tecdocCrumb">{$oneItem.name}</span>
	{/if}
{/foreach}