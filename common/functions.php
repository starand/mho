<?

#---------------------------------------------------------------------------------------------------
## show error
function show_error($msg, $target = 'main_error') {
    //echo $msg;
    $msg = addslashes("<span class='error-msg'>$msg</span>");
    echo "<script>parent.document.getElementById('$target').innerHTML = '$msg'</script>";
    die();
}

#---------------------------------------------------------------------------------------------------
## clear error
function clear_error($target = 'main_error') {
    echo "<script>parent.document.getElementById('$target').innerHTML = ' &nbsp; '</script>";
}

#---------------------------------------------------------------------------------------------------
## show message
function show_message($msg, $target = 'main_error') {
    $msg = addslashes("<span class='green-msg'>$msg</span>");
    echo "<script>parent.document.getElementById('$target').innerHTML = '$msg'</script>";
    //echo $msg;
}

#---------------------------------------------------------------------------------------------------
## load page
function load_page($page, $target='main') {
    echo "<script>parent.load_page('$page', '$target');</script>";
}


#---------------------------------------------------------------------------------------------------
## GOODS
#---------------------------------------------------------------------------------------------------
# show goods tale
function show_goods($goods, $cols) {
    $counter = 0;
    echo "<TABLE  id='goods' cellpadding='5'><tr>";
    
    foreach($goods as $good) {
        $class = "good-item";
        switch($good['g_state']) {
            case GOOD_STATE_SOLD: $class = "good-item-sold"; break;
            case GOOD_STATE_WAIT: $class = "good-item-wait"; break;
        }
        echo "<td class='$class'>";
            if (userHasPermission(PERM_EDIT_GOOD)) {
                echo good_control_panel($good);
            }

            switch($good['g_state']) {
                case GOOD_STATE_SOLD: echo "<div class='sold'>Продано</div>"; break;
                case GOOD_STATE_WAIT: echo "<div class='sold'>Очікуємо доставку</div>"; break;
            }

            echo "<a class='good-item' href='/?id={$good['g_id']}'><div class='good-title'>{$good['g_title']} - {$good['g_price']} грн.</div>";
            echo "<img src='".get_image_url($good['g_image'])."' style='width:250px;'></a><br>";

        echo "</td>";

        if(++$counter % $cols == 0) {
            echo "</tr><tr>";
        }
    }

    echo "</tr></TABLE>";
}



?>
