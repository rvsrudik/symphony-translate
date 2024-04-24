<?php

namespace App;

class Translator {
  public static function translate($text, $from = 'en', $to = 'en') {
    return strtoupper($text);
  }
}