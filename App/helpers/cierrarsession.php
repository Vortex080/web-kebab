<?php

LogIn::cierraSession();

if (LogIn::statusLogIn()) {
    echo 'La Sessión';
} else {
    echo 'cerro';
}



echo '<script>window.location="?menu=inicio"</script>';
