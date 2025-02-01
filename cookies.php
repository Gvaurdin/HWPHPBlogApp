<?php
//cookies

// 4 параметр задает доступ хука ( / - хука доступна везде)
setcookie("username", "admin", time() + 36000, '/');

print_r($_COOKIE);