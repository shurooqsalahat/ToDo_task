

<html>
	<head>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.4.2'></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    </head>

    <script>
        $( function() {
            $.ajax({
                type: "POST",
                url: "<?php echo  base_url();?>lists/update_list",
                data: {id:'32'},
                success: function() {
                    alert(' in success function');
                    window.location.href = "<?php echo base_url();?>lists/index";


                }
            });
        });
        </script>
</html>
<body>

"<?php echo  base_url();?>lists/update_list"
</body>