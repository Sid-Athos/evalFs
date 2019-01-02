
<?php
    function killAvatar($dir,$avatar){
        /* Set root dir of an artist */
        $check_dir = $dir.'/*';
        foreach(glob($new_dir) as $files) {
            /* Kill each file in a dir */
            if($files === $avatar)
            {
                unlink($files);
                return true;
            }
        }
        return false;
    }
?>