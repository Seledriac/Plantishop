<?php
    session_start();
    echo json_encode($_SESSION , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();