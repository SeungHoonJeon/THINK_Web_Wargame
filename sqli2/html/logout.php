<?php
    session_save_path("./cookie");
    session_start();

    session_destroy();
    echo "<script>location.href='./';</script>";
?>