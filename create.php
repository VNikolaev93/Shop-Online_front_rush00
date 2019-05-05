#!/usr/bin/php
<?php
if ($_POST["login"] && $_POST["passwd"] && $_POST["submit"] == "OK")
{
	if (!file_exists("../htdocs/private"))
		mkdir ("../htdocs/private");
	if (!file_exists("../htdocs/private/passwd"))
		file_put_contents("../htdocs/private/passwd", null);
	$user = unserialize(file_get_contents("../htdocs/private/passwd"));
	if ($user)
	{
		$i = 0;
		foreach ($user as $key => $value)
		{
			if ($value["login"] == $_POST["login"])
				$i = 1;
		}
	}
	if ($i)
		echo "ERROR\n";
	else
	{
		$temp["login"] = $_POST["login"];
		$temp["passwd"] = hash('md5', $_POST["passwd"]);
		$user[] = $temp;
		file_put_contents("../htdocs/private/passwd", serialize($user));
		echo "OK\n";
}
else
	echo "ERROR\n";
?>
