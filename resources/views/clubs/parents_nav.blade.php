<?php
    $school_name=config('app.schools');              
    $database = config('app.database');              
    $school_code = str_replace('sms','',$database[$_SERVER['HTTP_HOST']]);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand " href="#">彰化縣{{ $school_name[$school_code] }}</a>  
    </div>                    
</nav>