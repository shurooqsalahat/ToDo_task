

<html>
	<head>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.4.2'></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    </head>

    <script>

        </script>
</html>
<body>

<?php $password="12345";
$password_hash = password_hash($password, PASSWORD_BCRYPT);
echo $password_hash.'</br>';

$res = password_verify( $password, $password_hash );
echo $res; ?>

</body>