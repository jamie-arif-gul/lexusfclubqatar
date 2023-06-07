<span>
    <?php if (isset($success)) {
        echo '<div class="alert alert-success alert-dismissable success theme_color"> ';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        print_r($success);
        echo '</span>';
        echo'</div>';
    } ?>
</span>
<span>
    <?php if (isset($errors)) {
        echo '<div class="alert alert-danger alert-dismissable"> ';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        print_r($errors);
        echo '</span>';
        echo'</div>';
    } ?>
</span>