jQuery.expr[":"].ContainsCaseInsensitive = jQuery.expr.createPseudo(function (arg) {
	return function (elem) {
		return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
	};
});
jQuery.expr[":"].NotContainsCaseInsensitive = jQuery.expr.createPseudo(function (arg) {
	return function (elem) {
		return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) < 0;
	};
});
