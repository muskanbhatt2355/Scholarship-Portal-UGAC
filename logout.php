<?php

	mysqli_close($con);
    session_destroy();
    header('Location:index_bts.php');

?>