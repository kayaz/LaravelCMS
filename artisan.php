<?php

$output = shell_exec('php artisan storage:link');
echo "<pre>$output</pre>";
