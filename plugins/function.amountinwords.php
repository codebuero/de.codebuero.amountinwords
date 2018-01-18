<?php

function _parse_amount($input) {
  if (is_numeric($input)) {
    $out = 'Es ist 1 Zahl, sie heißt ' . $input;
    return $out;
  } 
  return '';
}

function smarty_function_amountinwords($params){
  if (!in_array('value', array_keys($params))) {
    trigger_error("assign: missing 'value' parameter");
    return;
  }

  if (empty($params['value'])) {
    trigger_error("assign: missing value for parameter 'value'");
    return;
  }
  
  $out = _parse_amount($params['value']);
  return $out;
}

?>
