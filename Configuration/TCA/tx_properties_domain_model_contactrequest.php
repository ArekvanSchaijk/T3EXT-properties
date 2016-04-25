<?php
return array(
    'ctrl' => array(
        'title'	=> 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest',
        'label' => 'subject',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'default_sortby' => 'ORDER BY uid DESC',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => '',
        'iconfile' => 'EXT:properties/Resources/Public/Icons/tx_properties_domain_model_contactrequest.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, hash, object, first_name, last_name, email, subject, body, receiver_name, receiver_email, cc_name, cc_email, bcc_name, bcc_email',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource,
                hash, object, --palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.message;message,
			--div--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tab.receiver,
			    --palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.receiver;receiver,
			    --palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.cc;cc,
			    --palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.bcc;bcc,
            --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, hidden, starttime, endtime'),
    ),
    'palettes' => array(
        'message' => array(
            'showitem' => 'first_name, --linebreak--, last_name, --linebreak--, email, --linebreak--, subject, --linebreak--, body',
            'canNotCollapse' => TRUE
        ),
        'receiver' => array(
            'showitem' => 'receiver_name, --linebreak--, receiver_email',
            'canNotCollapse' => TRUE
        ),
        'cc' => array(
            'showitem' => 'cc_name, --linebreak--, cc_email',
            'canNotCollapse' => TRUE
        ),
        'bcc' => array(
            'showitem' => 'bcc_name, --linebreak--, bcc_email',
            'canNotCollapse' => TRUE
        ),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => FALSE,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_properties_domain_model_contactrequest',
                'foreign_table_where' => 'AND tx_properties_domain_model_contactrequest.pid=###CURRENT_PID### AND tx_properties_domain_model_contactrequest.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => FALSE,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => FALSE,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'hash' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.hash',
            'config' => array(
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'object' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.object',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_properties_domain_model_object',
                'minitems' => 0,
                'maxitems' => 1,
                'readOnly' => TRUE,
            ),
        ),
        'first_name' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.first_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'last_name' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.last_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'email' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'subject' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.subject',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'body' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.body',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 3,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'receiver_name' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.receiver_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'receiver_email' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.receiver_email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'cc_name' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.cc_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'cc_email' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.cc_email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'bcc_name' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.bcc_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
        'bcc_email' => array(
            'exclude' => FALSE,
            'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_contactrequest.bcc_email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => TRUE,
            ),
        ),
    ),
);