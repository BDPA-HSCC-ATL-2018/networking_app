<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/networking_app/lib/db.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/networking_app/chapter-members.php';

$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : null;

if ( empty($q) ) {
  echo "No data";
  return;
} else {
  getChapterMembers($q);
}
