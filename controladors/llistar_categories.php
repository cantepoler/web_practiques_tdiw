<?php
include_once __DIR__."/../models/connectaBD.php";
include_once __DIR__."/../models/categories.php";

$conn = connectaBD();
$categories = getCategories($conn);

pg_close($conn);

include __DIR__."/../vistes/vista_categories.php";

?>