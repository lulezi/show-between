<?

return;

$yesterday = '2016-07-13';
$today     = '2016-07-14';
$tomorrow  = '2016-07-15';

var_dump(kirbytext('(from: '.$yesterday.' …)yes(…from)') === '<p>yes</p>');
var_dump(kirbytext('(from: '.$today.' …)yes(…from)') === '<p>yes</p>');
var_dump(kirbytext('(from: '.$tomorrow.' …)no(…from)') === '');

var_dump(kirbytext('(until: '.$yesterday.' …)no(…from)') === '');
var_dump(kirbytext('(until: '.$today.' …)yes(…from)') === '<p>yes</p>');
var_dump(kirbytext('(until: '.$tomorrow.' …)yes(…from)') === '<p>yes</p>');

var_dump(kirbytext('(from: '.$yesterday.' until: '.$yesterday.' …)no(…from)') === '');
var_dump(kirbytext('(from: '.$today.' until: '.$yesterday.' …)yes(…from)') === '<p>yes</p>');
var_dump(kirbytext('(from: '.$tomorrow.' until: '.$yesterday.' …)no(…from)') === '');

var_dump(kirbytext('(from: '.$yesterday.' until: '.$today.' …)yes(…from)') === '<p>yes</p>');
var_dump(kirbytext('(from: '.$today.' until: '.$today.' …)yes(…from)') === '<p>yes</p>');
var_dump(kirbytext('(from: '.$tomorrow.' until: '.$today.' …)yes(…from)') === '<p>yes</p>');

var_dump(kirbytext('(from: '.$yesterday.' until: '.$tomorrow.' …)yes(…from)') === '<p>yes</p>');
var_dump(kirbytext('(from: '.$today.' until: '.$tomorrow.' …)yes(…from)') === '<p>yes</p>');
var_dump(kirbytext('(from: '.$tomorrow.' until: '.$tomorrow.' …)no(…from)') === '');

