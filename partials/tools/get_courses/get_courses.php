<?php
require_once '.././datos/datos.php';
require "query.php";

$courses_record = datos::queryExecutor($query, true);
