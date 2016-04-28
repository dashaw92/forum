<?php
  class Config {
    private $results = false;

    function __construct($file) {
      global $results;
      $results = parse_ini_file($file, true);
      if($results == false) {
        return false;
      }
    }

    function read_field($section, $property) {
      global $results;
      if(isset($results[$section])) {
        if(isset($results[$section][$property])) {
          return $results[$section][$property];
        } else {
          return NULL;
        }
      } else {
        return NULL;
      }
    }
  }
?>
