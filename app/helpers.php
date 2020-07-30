<?php

/**
 * Utility Class to be consumed by the Livewire Controller || Controller.
 */

 if ( ! function_exists( 'generate_branch_code' ) ) {
     /**
      * This will generate branch code => branch ID
      */
      function generate_branch_code()
      {
        return 'FAF-' . strtotime(now());
      }
 }