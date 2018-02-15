<!DOCTYPE html>

<html lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<head>
    <title>Login V6
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/todo.css">

</head>
<body>
<div class="container">
    <p>
        <label for="new-task">Add Item </label>
    <div>
        <label for="data">Task Data</label>
        <input id="new-task" name="task_name" type="text">
    </div>
    <div>
        <label for="data"> Start Date </label>
        <input type="date" name="start" ;>
    </div>
    <div>
        <label for="data"> End Date </label>
        <input style"width:200px;" type="date" name="end">
    </div>
    </p>
    <button id="add"> add</button>
    <h3>Todo
    </h3>
    <ul id="incomplete-tasks">
        <?php if ($this->session->userdata('lists')) {
            $list_data = $this->session->userdata('lists');
            for ($i = 0; $i < count($list_data); $i++) {
                if ($list_data[$i]['is_completed'] == 0) {
                    echo '<li><input type="checkbox" name="status" onchange="update(this);"  value="' . $list_data[$i]['event_id'] . '" ><label>' . $list_data[$i]['event_name'] . '</label><label> start  ' . $list_data[$i]['event_start'] . '</label><label> end  ' . $list_data[$i]['event_end'] . '</label> <input type="text"><button class="delete" onclick="delete_list(this);" " value="' . $list_data[$i]['event_id'] . '" >Delete</button></li> ';
                }
            }
            echo '</ul>';
            echo '<h3>Completed</h3> <ul id="completed-tasks">';
            for ($i = 0; $i < count($list_data); $i++) {
                if ($list_data[$i]['is_completed'] == 1) {
                    echo '<li><input type="checkbox" id="chk" checked onchange="update(this);" value="' . $list_data[$i]['event_id'] . '"><label>' . $list_data[$i]['event_name'] . '</label><label> start  ' . $list_data[$i]['event_start'] . '</label><label> end  ' . $list_data[$i]['event_end'] . '</label> <input type="text"><button class="delete" onclick="delete_list(this); "  value="' . $list_data[$i]['event_id'] . '"$>Delete</button></li> ';
                }
            }
            echo '</ul>';
        }
        ?>
        <div>
            <button onclick="logout();"> logout
            </button>
        </div>
</div>
<div id="dialog" style="display: none" align="center">
    Are you sure you want to delete ?
    <div id="delete" style="float:left; margin-top:55px;">
        <button style>Delete
        </button>
    </div>
    <div id="cancle" style=" float:right; margin-top:55px;">
        <button style>cancel
        </button>
    </div>
</div>
<script>
    $("#add").click(function () {
            var name = $('input[name="task_name"]').val();
            var start = $('input[name="start"]').val();
            var end = $('input[name="end"]').val();
            var todayDate = new Date();
            if (!name || !start || !end) {
                alert('empty, You must fill all fields');
                return;
            } else if (Date.parse(start) < Date.parse(todayDate)) {
                alert('Past date ! Be carefull');
                return;
            } else if ((new Date(start).getTime() > new Date(end).getTime())) {
                alert('Start date must be less than end date');
                return;
            } else {
                $(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>lists/addList",
                        data: {t_name: name, t_start: start, t_end: end},
                        success: function () {
                            window.location.href = "<?php echo base_url();?>lists/index";


                        }
                    });
                });
            }
        }
    );
</script>
<script type="text/javascript">
    function delete_list(item) {
        var x = item.value;
        $("#dialog").dialog({
                title: "jQuery Dialog",
                width: 450,
                height: 150,
            }
        );
        $("#delete").click(function () {
                $(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>lists/deleteList",
                        data: {id: x},
                        success: function () {
                            window.location.href = "<?php echo base_url();?>lists/index";
                        }
                    });
                });

            }
        );
        $("#cancle").click(function () {
                $('#dialog').dialog('close');
            }
        );
    }
</script>
<script>
    function update(item) {
        var x = item.value;
        if ($('#chk').is(':checked')) {
            $(function () {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>lists/updateList",
                    data: {id: x},
                    success: function () {
                        window.location.href = "<?php echo base_url();?>lists/index";
                    }
                });
            });
        }
        else {
            $(function () {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>lists/updateList",
                    data: {id: x},
                    success: function () {
                        window.location.href = "<?php echo base_url();?>lists/index";
                    }
                });
            });
        }
    }
</script>
<script>
    function logout() {
        window.location.href = "<?php echo base_url();?>user/logout";
    }
</script>
</body>
</html>
​