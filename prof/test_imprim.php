<?php
echo "coucou";
$handle = printer_open();
printer_write($handle, "Texte � imprimer");
printer_close($handle);
?>
