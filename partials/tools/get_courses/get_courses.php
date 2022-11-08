<?php
require_once 'C:xampp/htdocs/LoanBooks/datos/datos.php';
require "C:/xampp/htdocs/LoanBooks/partials/tools/get_courses/query.php";

$courses_record = datos::queryExecutor($query, true);
