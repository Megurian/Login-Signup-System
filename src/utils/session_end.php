<?php
require_once "session_start.php";

session_unset();
session_destroy();

header('Location: ..\..\public\html\login_form.php');