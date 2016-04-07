<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$columns = array();
if ($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['properties']) {
    $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['properties']);
    if ($extConf['hideObjectsColumns']) {
        $columns = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $extConf['hideObjectsColumns']);
    }
}

foreach ($columns as $column) {
    unset($GLOBALS['TCA']['tx_properties_domain_model_category']['columns'][$column]);
    $GLOBALS['TCA']['tx_properties_domain_model_object']['columns'][$column] = array(
        'config' => array(
            'type' => 'passthrough'
        )
    );
}

unset($columns, $column);