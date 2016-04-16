<?php

$parent_directory = dirname(__FILE__);

require_once($parent_directory."/../gitlab-hook/class-gitlab-storage.php");
require_once($parent_directory."/../gitlab-hook/class-gitlab-sync.php");

$gs = new Gitlab_Sync();

$gs->update();