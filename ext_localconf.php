<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Configure plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Ucreation.' . $_EXTKEY,
	'Pi1',
	array(
		'Object' => 'list, show, filters',
		'Category' => 'listCategories',

	),
	array(
		'Object' => 'list, show, filters',
		'Category' => 'listCategories',
	)
);