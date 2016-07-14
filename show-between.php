<?

kirbytext::$pre[] = function($kirbytext, $text) {

  c::set('show-between.timezone', 'Europe/Zurich');
  $timeZone = c::get('show-between.timezone', date_default_timezone_get());
  $fromKeyword = c::get('show-between.from', 'from');
  $untilKeyword = c::get('show-between.until', 'until');
  $fromOrUntil = '('.$fromKeyword.'|'.$untilKeyword.')';

  $dateRegex = '(\d{4}-\d{2}-\d{2})';
  $regex = '!\('.$fromOrUntil.': ?'.$dateRegex.'( '.$fromOrUntil.': ?'.$dateRegex.')? (…|\.{3})\)(.*?)\((…|\.{3}) ?'.$fromOrUntil.'\)!is';

  $text = preg_replace_callback($regex, function($matches) use($kirbytext, $timeZone, $fromKeyword, $untilKeyword) {

    $fromSet  = false;
    $untilSet = false;

    $fromMatch = 2;
    $untilMatch = 5;

    if($matches[1] === $fromKeyword) {
      $fromSet = true;
    }

    if($matches[1] === $untilKeyword) {
      $untilSet = true;
      $untilMatch = 2;
    }

    if($matches[4] === $untilKeyword) {
      $untilSet = true;
    }

    if($matches[4] === $fromKeyword) {
      $fromSet = true;
      $fromMatch = 5;
    }

    $now       = new DateTime('now', new DateTimeZone($timeZone));
    $dateFrom  = new DateTime($matches[$fromMatch].' 00:00:00', new DateTimeZone($timeZone));
    $diffFrom  = $now->diff($dateFrom);

    $untilBeforeFrom = false;
    $diffUntil       = false;

    if($untilSet === true) {
      $dateUntil = new DateTime($matches[$untilMatch].' 00:00:00', new DateTimeZone($timeZone));
      $dateUntil->add(new DateInterval('P1D'));
      $dateUntil->sub(new DateInterval('PT1S'));
      $diffUntil = $dateUntil->diff($now);
      $untilBeforeFrom = ($dateFrom->diff($dateUntil)->invert === 1);
    }

    $fromCase = ($fromSet && $diffFrom->invert);
    $untilCase = ($untilSet && $diffUntil->invert);

    if($fromCase && $untilCase || (!$untilSet && $fromCase) || (!$fromSet && $untilCase) || ($untilBeforeFrom && ($fromCase || $untilCase))) {
      return $matches[7];
    } else {
      return '';
    }
  }, $text);

  return $text;

};

