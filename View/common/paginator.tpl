<div class="paginator">
	{if $data.options->showGoFirstAndLast && ($data.currentPage != 1) && ($data.pagesCount > 0)}
		<span class="first"><a href="{if $data.url}{$data.url}&{$data.argName}=0{else}?{$data.argName}=0{/if}">{if $data.options->shortLinks}&laquo;{else}Первая{/if}</a></span>
	{/if}
	{foreach from=$data.displayedPages key=number item=page}
		<a href="{if $data.url}{$data.url}&{$data.argName}={$page}{else}?{$data.argName}={$page}{/if}" {if $data.currentPage == $number}class="act"{/if}>
			{$number}
		</a>
	{/foreach}
	{if $data.options->showGoFirstAndLast && ($data.currentPage != $data.pagesCount)}
		{math equation="(pagesCount - 1) * recordsPageCount" pagesCount=$data.pagesCount recordsPageCount=$data.options->recordsPageCount assign="argValue"}
		<span class="last"><a href="{if $data.url}{$data.url}&{$data.argName}={$argValue}{else}?{$data.argName}={$argValue}{/if}">{if $data.options->shortLinks}&raquo;{else}Последняя{/if}</a></span>
	{/if}
</div>