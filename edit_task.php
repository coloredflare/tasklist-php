<?php

include_once "session.php";
include_once "sql.php";
include_once "page.php";

if(isset($_POST['task_id']) && isset($_POST['task_name'])) {

	$task_name = $_POST['task_name'];
	$task_id = $_POST['task_id'];

	$task = get_item_task($task_id);
	$parent = $task['parent'];

	$task['name'] = $task_name;

	set_item_task_name($task);

	header("Location: items/$parent");
}

elseif(isset($_GET['task_id'])) {
	$task_id = $_GET['task_id'];

	$task = get_item_task($task_id);
	page_header("Edit Task");
	?>

	<div class="flex">
		<form action="edit_task.php" method="post">
			<input type="hidden" name = "task_id" value="<?=$task_id?>">
			<input id="task_name" type="text" name="task_name" value="<?=$task['name']?>" placeholder="Task Name">
			<input class="shadow-border button--round button--small" type="submit" value="Save">
		</form>
	</div>
	<?php
	page_footer();
}

?>
