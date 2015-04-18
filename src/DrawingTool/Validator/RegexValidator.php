<?php

namespace DrawingTool\Validator;

class RegexValidator {

  function validateRegex($regex, $string) {
      //return preg_match("/^[A-Z0-9]{3}-[A-Z]{2}$/", $string);
      return preg_match($regex, $string);
  }

}
