<?php
	move_uploaded_file($_FILES['afile']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/uploads/file/'.$_FILES['afile']['name']);
?>
