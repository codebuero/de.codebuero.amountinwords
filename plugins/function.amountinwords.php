<?php

define('NUMERAL_SIGN', 'minus');
define('NUMERAL_HUNDREDS_SUFFIX', 'hundert');
define('NUMERAL_INFIX', 'und');

function num2text($pNumber) {
  $lNumeral = array('null', 'ein', 'zwei', 'drei', 'vier',
                'fünf', 'sechs', 'sieben', 'acht', 'neun',
                'zehn', 'elf', 'zwölf', 'dreizehn', 'vierzehn',
                'fünfzehn', 'sechzehn', 'siebzehn', 'achtzehn', 'neunzehn');

  if ($pNumber == 0) {
    return $lNumeral[0]; // „null“
  } elseif ($pNumber < 0) {
    return NUMERAL_SIGN . ' ' . num2text_group(abs($pNumber));
  } else {
    return num2text_group($pNumber);
  }
}

/**
 *
 * @global array $lNumeral
 * @global array $lTenner
 * @global array $lGroupSuffix
 * @param int $pNumber Die Ganzzahl, die in ein Zahlwort umgewandelt werden soll.
 * @param int $pGroupLevel (optional) Das Gruppen-Level der aktuellen Zahl.
 * @return string Das Zahlwort.
 */
function num2text_group($pNumber, $pGroupLevel = 0) {
  $lNumeral = array('null', 'ein', 'zwei', 'drei', 'vier',
                  'fünf', 'sechs', 'sieben', 'acht', 'neun',
                  'zehn', 'elf', 'zwölf', 'dreizehn', 'vierzehn',
                  'fünfzehn', 'sechzehn', 'siebzehn', 'achtzehn', 'neunzehn');

  $lTenner = array('', '', 'zwanzig', 'dreißig', 'vierzig',
                 'fünfzig', 'sechzig', 'siebzig', 'achtzig', 'neunzig');

  $lGroupSuffix = array(array('s', ''),
                      array('tausend ', 'tausend '),
                      array('e Million ', ' Millionen '),
                      array('e Milliarde ', ' Milliarden '),
                      array('e Billion ', ' Billionen '),
                      array('e Billiarde ', ' Billiarden '),
                      array('e Trillion ', ' Trillionen '));

  if ($pNumber == 0) {
    return '';
  }

  $lGroupNumber = $pNumber % 1000;

  if ($lGroupNumber == 1) {
    $lResult = $lNumeral[1] . $lGroupSuffix[$pGroupLevel][0];
  } elseif ($lGroupNumber > 1) {
    $lResult = '';

    $lFirstDigit = floor($lGroupNumber / 100);

    if ($lFirstDigit > 0) {
      $lResult .= $lNumeral[$lFirstDigit] . NUMERAL_HUNDREDS_SUFFIX;
    }

    $lLastDigits = $lGroupNumber % 100;
    $lSecondDigit = floor($lLastDigits / 10);
    $lThirdDigit = $lLastDigits % 10;

    if ($lLastDigits == 1) {
      $lResult .= $lNumeral[1] . 's';
    } elseif ($lLastDigits > 1 && $lLastDigits < 20) {
      $lResult .= $lNumeral[$lLastDigits];
    } elseif ($lLastDigits >= 20) {
      if ($lThirdDigit > 0) {
        $lResult .= $lNumeral[$lThirdDigit] . NUMERAL_INFIX;
      }
      $lResult .= $lTenner[$lSecondDigit];
    }

    $lResult .= $lGroupSuffix[$pGroupLevel][1];
  }

  return num2text_group(floor($pNumber / 1000), $pGroupLevel + 1) . $lResult;
}

function _parse_amount($input) {
  if (is_numeric($input)) {
    $pre = num2text((int) $input);
    $post = num2text(($input - floor($input)) * 100);
    return ucfirst($pre) . ' Euro ' . ucfirst($post) . ' Cent';
  }
  return '';
}

function smarty_function_amountinwords($params){
  if (!in_array('value', array_keys($params))) {
    trigger_error("amountinwords: missing 'value' parameter");
    return;
  }

  if (empty($params['value'])) {
    trigger_error("amountinwords: missing value for parameter 'value'");
    return;
  }

  $out = _parse_amount($params['value']);
  return $out;
}

?>
