<?php
$handle=opendir('.');
echo "Pointeur de dossier: $handle\n";
echo "Fichiers:\n";
while ($file = readdir($handle)) {
print("<a href='$file' target=_BLANK>".$file."</a><br>");
}
closedir($handle);
?>