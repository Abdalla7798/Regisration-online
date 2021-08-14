<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    exit;
}
?>
<html >
    <head>
    <title>Object not found!</title>
    <link rev="made" href="mailto:admin@example.com">
    <style type="text/css">
        body { color: #000000; background-color: #FFFFFF; }
        a:link { color: #0000CC; }
        p {margin-left: 3em;}
        span {font-size: smaller;}
    </style>
    <link id="avast_os_ext_custom_font" href="chrome-extension://eofcbnmajmjmplflapaojjnihcjkigck/common/ui/fonts/fonts.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
    <h1>Object not found!</h1>
    <p>
      The requested URL was not found on this server.
    </p>
    <p>
    If you think this is a server error, please contact
    the <a href="mailto:admin@example.com">webmaster</a>.
    </p>
    
    <h2>Error 404!</h2>

    </body>
</html> 