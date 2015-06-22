<?php

echo exec("php index.php orm:generate:entities d:\Projekte\RosenSpawn\module\DB\src");
echo "<br>";
echo exec("php index.php orm:schema-tool:update --force");