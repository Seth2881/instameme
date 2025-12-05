<?php
session_start();
session_unset();    // supprime les variables
session_destroy();  // détruit la session
?>