<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,',
		'iconfile' => 'EXT:properties/Resources/Public/Icons/tx_properties_domain_model_category.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, disable_filter_option',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden, name,
			--div--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tab.filter_settings,
				disable_filter_search,
				disable_filter_type,
				disable_filter_types,
				disable_filter_offer,
				disable_filter_town,
				disable_filter_towns,
				disable_filter_price_range,
				disable_filter_presences,
				disable_filter_lot_size,
				disable_filter_position,
				disable_filter_construction_type,
				disable_filter_status,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
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
				'foreign_table' => 'tx_properties_domain_model_category',
				'foreign_table_where' => 'AND tx_properties_domain_model_category.pid=###CURRENT_PID### AND tx_properties_domain_model_category.sys_language_uid IN (-1,0)',
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
		'name' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'disable_filter_search' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_search',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_search.0',
					),
				),
			),
		),
		'disable_filter_type' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_type',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_type.0',
					),
				),
			),
		),
		'disable_filter_types' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_types',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_types.0',
					),
				),
			),
		),
		'disable_filter_offer' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_offer',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_offer.0',
					),
				),
			),
		),
		'disable_filter_town' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_town',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_town.0',
					),
				),
			),
		),
		'disable_filter_towns' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_towns',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_towns.0',
					),
				),
			),
		),
		'disable_filter_price_range' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_price_range',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_price_range.0',
					),
				),
			),
		),
		'disable_filter_presences' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_presences',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_presences.0',
					),
				),
			),
		),
		'disable_filter_lot_size' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_lot_size',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_lot_size.0',
					),
				),
			),
		),
		'disable_filter_position' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_position',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_position.0',
					),
				),
			),
		),
		'disable_filter_construction_type' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_construction_type',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_construction_type.0',
					),
				),
			),
		),
		'disable_filter_status' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_status',
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_category.disable_filter_status.0',
					),
				),
			),
		),
	),
);