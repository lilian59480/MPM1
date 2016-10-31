<?php

if (basename($_SERVER["PHP_SELF"]) == "users.php")
{
	header("Location:../index.php?view=users");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");
?>
<h1>Administration du site</h1>
<h2>Liste des utilisateurs de la base </h2>
<?php
echo "liste des utilisateurs autorises de la base :";
$users = listerUtilisateurs("nbl");
mkTable($users,array("id","pseudo"));

echo "<hr />";
echo "liste des utilisateurs non autorises de la base :";
$users = listerUtilisateurs("bl");
mkTable($users,array("id","pseudo"));
?>
<hr />
<h2>Changement de statut des utilisateurs</h2>

<form action="controleur.php">

<select name="idUser">
<?php
$users = listerUtilisateurs();

foreach ($users as $dataUser)
{

	echo "<option value=\"$dataUser[id]\">\n";
	echo  $dataUser["pseudo"];
	if ($dataUser["blacklist"] == 1) 	echo " (bl)";
	else echo " (nbl)";
	echo "\n</option>\n";
}
?>
</select>

<input type="submit" name="action" value="Interdire" />
<input type="submit" name="action" value="Autoriser" />
</form>
