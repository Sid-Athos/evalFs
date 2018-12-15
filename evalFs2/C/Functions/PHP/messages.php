<?php
/* Petits messages d'alerte */
    function alert($string) {
        return $string = '<div class="alert alert-danger ml-auto" role="alert" style="text-align:center;width:500px;display:inline-block;margin:auto;z-index:4;position:fixed;top:15%;left:30%">
        <div class="container">
        <div class="alert-icon">
        </div>'.$string.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">
          <i class="now-ui-icons ui-1_simple-remove"></i>
          </span>
        </button>
      </div>
    </div>';
    }
    function success($string) {
        return $string = '<div class="alert alert-warning ml-auto" role="alert" style="width:500px;display:inline-block;margin:auto;z-index:4;
        position:fixed;top:15%;left:30%;text-align:center">
        <div class="container">
          <div class="alert-icon">
          </div>'.$string.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </span>
        </button>
      </div>
    </div>';
    }
?>