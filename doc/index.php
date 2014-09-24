<?php
/**
 * Documentation page
 *
 * @author h.woltersdorf
 */

require_once __DIR__ . '/../vendor/autoload.php';

use hollodotme\TreeMDown\TreeMDown;

$treemdown = new TreeMDown( __DIR__ . '/Types' );
$treemdown->setProjectName( 'Types' );
$treemdown->setShortDescription( 'PHP data types' );
$treemdown->enablePrettyNames();
$treemdown->hideFilenameSuffix();
$treemdown->hideEmptyFolders();

$treemdown->display();
