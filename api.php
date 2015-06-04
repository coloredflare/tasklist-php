<?php
include_once "sql.php";

function api($request) {
	if (preg_match('/^\/login\/([a-z]+)\/([a-z]+$)/', $request, $matches)) {
		login($matches[1], $matches[2]);
	}
	elseif (preg_match('/^\/items\/([0-9]+)$/', $request, $matches)) {
		api_items($matches[1]);
	}
}

function login($username, $password) {
	$hash = md5($username . $password . time());
	$user = get_user($username, $password);
	if ($user) {
		$user_id = $user['id'];
		set_session($hash, $user_id);
		echo json_encode($hash);
	}
}

function api_items($parent) {
	// FIXME: don't hardcode user id!
	$items = get_items(1, $parent);
	header("Content-Type: application/json");
	echo json_encode($items);
}