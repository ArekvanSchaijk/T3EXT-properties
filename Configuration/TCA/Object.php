<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

// Request Update fields
$GLOBALS['TCA']['tx_properties_domain_model_object']['ctrl']['requestUpdate'] = 'type';
$GLOBALS['TCA']['tx_properties_domain_model_object'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_properties_domain_model_object']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, type, type_building, offer, sort, images, year, environmental_class, description, street, zip_code, contact, price, rent_price, rent_price_type, rent_availability, rent_wait, rent_available_date, rental_agreement, lease_conditions, accessibility, price_per_square_metre, lot_size, living_area, garden_area, number_of_rooms, latitude, longitude, latitude_longitude_md5, category, presences, town, position, construction_type',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden, name, type, type_building, offer, sort, images, year, environmental_class, description;;;richtext:rte_transform[mode=ts_links], street, zip_code, contact, price, rent_price, rent_price_type, rent_availability, rent_wait, rent_available_date, rental_agreement, lease_conditions, accessibility, price_per_square_metre, lot_size, living_area, garden_area, number_of_rooms, latitude, longitude, latitude_longitude_md5, category, presences, town, position, construction_type, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
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
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_properties_domain_model_object',
				'foreign_table_where' => 'AND tx_properties_domain_model_object.pid=###CURRENT_PID### AND tx_properties_domain_model_object.sys_language_uid IN (-1,0)',
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
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
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
			'exclude' => 1,
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
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type.0', 0),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type.1',
						\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type.2',
						\Ucreation\Properties\Domain\Model\Object::TYPE_LOT,
					),
				)
			)
		),
		'type_building' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type_building',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type_building.0', 0),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type_building.1',
						\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING_NEW,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type_building.2',
						\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING_NEW,
					),
				)
			)
		),
		'offer' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer.0', 0),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer.1',
						\Ucreation\Properties\Domain\Model\Object::OFFER_SALE,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer.2',
						\Ucreation\Properties\Domain\Model\Object::OFFER_RENT
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer.3',
						\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH
					),
				)
			)
		),
		'sort' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.sort',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'images' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.images',
			'displayCond' => 'FIELD:type:>:0',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array(
					'maxitems' => 20
				),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'year' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.year',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'environmental_class' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.description',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),
		'street' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.street',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip_code' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.zip_code',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'contact' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.price',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			)
		),
		'rent_price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_price',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			)
		),
		'rent_price_type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_price_type',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'rent_availability' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.0', 0),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.1',
						\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_IMMEDIATELY,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.2',
						\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_WAIT
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.3',
						\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_BYDATE
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.4',
						\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_INCONSULTATION
					),
				)
			)
		),
		'rent_wait' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_wait',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_wait.0', 0),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_wait.1',
						1,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_wait.2',
						2,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_wait.3',
						3,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_wait.4',
						6,
					),
				)
			)
		),
		'rent_available_date' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_available_date',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => time()
				),
			),
		),
		'rental_agreement' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rental_agreement',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rental_agreement.0', 0),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rental_agreement.1',
						\Ucreation\Properties\Domain\Model\Object::RENTAL_AGREEMENT_UNDETERMEDTIME,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rental_agreement.2',
						\Ucreation\Properties\Domain\Model\Object::RENTAL_AGREEMENT_TEMPORARYTIME
					),
				)
			)
		),
		'lease_conditions' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.lease_conditions',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'accessibility' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.accessibility',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'price_per_square_metre' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.price_per_square_metre',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			)
		),
		'lot_size' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.lot_size',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'living_area' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.living_area',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'garden_area' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garden_area',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'number_of_rooms' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.number_of_rooms',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'latitude' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.latitude',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'longitude' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.longitude',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'latitude_longitude_md5' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.latitude_longitude_md5',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'category' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.category',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_category',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.category.0' ,0),
				),
			),
		),
		'presences' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.presences',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_presence',
				'MM' => 'tx_properties_object_presence_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_properties_domain_model_presence',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'town' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.town',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_town',
				'minitems' => 1,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.town.0' ,0),
				),
			),
		),
		'position' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.position',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_position',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.construction_type.0' ,0),
				),
			),
		),
		'construction_type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.construction_type',
			'displayCond' => 'FIELD:type:>:0',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_constructiontype',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.construction_type.0' ,0),
				),
			),
		),
	),
);