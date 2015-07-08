<?php
    if($_POST['instaslick_hidden'] == 'Y') {
        //Form data sent
        $userId = $_POST['instaslick_userId'];
        update_option('instaslick_userId', $userId);
         
        $accessToken = $_POST['instaslick_accessToken'];
        update_option('instaslick_accessToken', $accessToken);
         
        $speed = $_POST['instaslick_speed'];
        update_option('instaslick_speed', $speed);
         
        $autoplaySpeed = $_POST['instaslick_autoplaySpeed'];
        update_option('instaslick_autoplaySpeed', $autoplaySpeed);

        ?>
        <div class="updated">
            <p><strong><?php _e('Options saved.' ); ?></strong></p>
        </div>
<?php
    } else {
        //Normal page display
        $userId = get_option('instaslick_userId');
        $accessToken = get_option('instaslick_accessToken');
        $speed = get_option('instaslick_speed');
        $autoplaySpeed = get_option('instaslick_autoplaySpeed');

    }
?>

<div class="wrap">
    <?php echo "<h2>" . __( 'Instaslick Setting', 'instaslick_trdom' ) . "</h2>"; ?>
     
    <form name="instaslick_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="instaslick_hidden" value="Y">
        <?php echo "<h4>" . __( 'Instagram Settings', 'instaslick_trdom' ) . "</h4>"; ?>
        <p><?php _e("User ID: " ); ?><input type="text" name="instaslick_userId" value="<?php echo $userId; ?>" size="20"><?php _e(" ex: User ID from Instagram" ); ?></p>
        <p><?php _e("Access Token: " ); ?><input type="text" name="instaslick_accessToken" value="<?php echo $accessToken; ?>" size="20"><?php _e(" ex: Access Token from Instagram" ); ?></p>
        <hr />
        <?php echo "<h4>" . __( 'Slick Carousel Setting', 'instaslick_trdom' ) . "</h4>"; ?>
        <p><?php _e("Speed: " ); ?><input type="text" name="instaslick_speed" value="<?php echo $speed; ?>" size="20"><?php _e(" ex: 1000" ); ?></p>
        <p><?php _e("Autoplay Speed: " ); ?><input type="text" name="instaslick_autoplaySpeed" value="<?php echo $autoplaySpeed; ?>" size="20"><?php _e(" ex: 2000" ); ?></p>
         
        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'instaslick_trdom' ) ?>" />
        </p>
    </form>
</div>