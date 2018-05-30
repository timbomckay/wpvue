<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Base
 */

 function display_array($array) {
   echo '<pre style="font-size: 13px;
     max-width: 960px;
     margin: 3rem auto;
     background-color: whitesmoke;
     border: 1px solid lightgray;
     padding: 10px;
     color: #333;
     text-align: left;
     font-weight: normal;
     border-radius: 3px;
     overflow: scroll">';

   ob_start();
   print_r($array);
   $contents = ob_get_contents();
   ob_end_clean();
   print htmlentities($contents);

   echo "</pre>";
 }
