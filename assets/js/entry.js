var countries = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // url points to a json file that contains an array of country names, see
  // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
  prefetch: '/entry/suggestdesc'
});

// passing in `null` for the `options` arguments will result in the default
// options being used
$('#description').typeahead(null, {
  name: 'countries',
  source: countries
});

$('#date').datetimepicker({
	format:'Y-m-d H:i',
	step:30
});