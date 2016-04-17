<?php
return array(
	'ctrl' => array(
		'requestUpdate' => 'type, offer, rent_availability, garage, use_existing_contact, determine_latlong_automatic',
		'title'	=> 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object',
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
		'searchFields' => 'name,type,sort,offer,images,year,environmental_class,description,alternative_description,street,zip_code,contact,contact_name,contact_company,contact_address,contact_phone,contact_secondary_phone,contact_email,contact_website,status,price,price_type,rent_price,rent_price_type,price_per_square_metre,lot_size,living_area,garden_area,number_of_rooms,latitude,longitude,latitude_longitude_md5,category,presences,town,district,position,construction_type,',
		'iconfile' => 'EXT:properties/Resources/Public/Icons/tx_properties_domain_model_object.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, name, description, category, town, district, position, garden_position, type_building, offer, sort, year, environmental_class, street, street_number, zip_code, country, contact, price, price_type, rent_price, rent_price_type, rent_availability, rent_wait, rent_available_date, rental_agreement, lease_conditions, accessibility, price_per_square_metre, lot_size, living_area, garden_area, number_of_rooms, number_of_bedrooms, latitude, longitude, latitude_longitude_md5, presences, construction_type, garage, garage_capacity, garage_sort, images, background_image, download, meta_description, meta_keywords',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, type, name, category, description;;;richtext:rte_transform[mode=ts_links], alternative_description;;;richtext:rte_transform[mode=ts_links],
			--div--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tab.location,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.location.address;address,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.location.geodata;geodata,
			--div--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tab.object,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.object.surfaces;surfaces,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.object.property_details;property_details,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.object.garage_details;garage_details,
				presences,
			--div--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tab.offer, offer,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.offer.sale_details;sale_details,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.offer.rent_details;rent_details,
			--div--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tab.media, images, background_image, download,
			--div--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tab.contact, use_existing_contact,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.contact_details;contact_details,
			--div--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tab.metadata,
				--palette--;LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:palettes.metadata;metadata,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, hidden, starttime, endtime'),
	),
	'palettes' => array(
		'address' => array(
			'showitem' => 'street, street_number, --linebreak--, zip_code, town, --linebreak--, district, --linebreak--, country',
			'canNotCollapse' => TRUE
		),
		'geodata' => array(
			'showitem' => 'determine_latlong_automatic, --linebreak--, longitude, latitude, --linebreak--, latitude_longitude_md5',
			'canNotCollapse' => TRUE
		),
		'surfaces' => array(
			'showitem' => 'lot_size, living_area, garden_area',
			'canNotCollapse' => TRUE
		),
		'property_details' => array(
			'showitem' => 'position, garden_position, sort, type_building, --linebreak--, year, --linebreak--, environmental_class, --linebreak--,accessibility, --linebreak--,number_of_rooms,number_of_bedrooms, --linebreak--,construction_type',
			'canNotCollapse' => TRUE
		),
		'garage_details' => array(
			'showitem' => 'garage, --linebreak--, garage_sort, --linebreak--, garage_capacity',
			'canNotCollapse' => TRUE
		),
		'sale_details' => array(
			'showitem' => 'status, --linebreak--, price,, price_type, --linebreak--, price_per_square_metre',
			'canNotCollapse' => TRUE
		),
		'rent_details' => array(
			'showitem' => 'rent_price, rent_price_type, --linebreak--, rent_availability, --linebreak--, rent_wait, --linebreak--, rent_available_date, --linebreak--, rental_agreement, --linebreak--, lease_conditions',
			'canNotCollapse' => TRUE
		),
		'contact_details' => array(
			'showitem' => 'contact, contact_name, --linebreak--, contact_company, --linebreak--, contact_address, --linebreak--, contact_phone, contact_secondary_phone, --linebreak--, contact_email, --linebreak--, contact_website',
			'canNotCollapse' => TRUE
		),
		'metadata' => array(
			'showitem' => 'meta_description, --linebreak--, meta_keywords',
			'canNotCollapse' => TRUE
		),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.langu age',
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
		'type' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type.0',
						\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					),
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
		'name' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'category' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.category',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_category',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.category.0', 0),
				),
			),
		),
		'description' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.description',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'text',
				'cols' => '48',
				'rows' => '5',
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'type' => 'script',
						'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.W.RTE',
						'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_rte.gif',
						'module' => array(
							'name' => 'wizard_rte'
						)
					)
				)
			),
		),
		'alternative_description' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.alternative_description',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'text',
				'cols' => '48',
				'rows' => '5',
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'type' => 'script',
						'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.W.RTE',
						'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_rte.gif',
						'module' => array(
							'name' => 'wizard_rte'
						)
					)
				)
			),
		),
		'position' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.position',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
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
		'garden_position' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garden_position',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garden_position.0',
						\Ucreation\Properties\Domain\Model\Object::GARDEN_POSITION_NONE,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garden_position.1',
						\Ucreation\Properties\Domain\Model\Object::GARDEN_POSITION_NORTH,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garden_position.2',
						\Ucreation\Properties\Domain\Model\Object::GARDEN_POSITION_WEST,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garden_position.3',
						\Ucreation\Properties\Domain\Model\Object::GARDEN_POSITION_SOUTH,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garden_position.4',
						\Ucreation\Properties\Domain\Model\Object::GARDEN_POSITION_EAST,
					),
				)
			)
		),
		'type_building' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type_building',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type_building.0',
						\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING_NONE,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type_building.1',
						\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING_NEW,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.type_building.2',
						\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING_EXISTING,
					),
				)
			)
		),
		'year' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.year',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'sort' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.sort',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'images' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.images',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array(
					'maxitems' => 20
				),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'background_image' => array(
			'exclude' => TRUE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.background_image',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('background_image',
				array(
					'maxitems' => 1,
					'appearance' => array(
						'collapseAll'	=> 1,
						'expandSingle'	=> 1,
					),
					'foreign_types' => array(
						'0' => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
					)
				),
				'jpg,jpeg,png'
			),
		),
		'download' => array(
			'exclude' => TRUE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.download',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('download',
				array(
					'maxitems' => 1,
					'appearance' => array(
						'collapseAll'	=> 1,
						'expandSingle'	=> 1,
					),
					'foreign_types' => array(
						'0' => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
					)
				)
			),
		),
		'environmental_class' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class.0',
						\Ucreation\Properties\Domain\Model\Object::ENVIRONMENTAL_CLASS_NONE
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class.1',
						\Ucreation\Properties\Domain\Model\Object::ENVIRONMENTAL_CLASS_A
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class.2',
						\Ucreation\Properties\Domain\Model\Object::ENVIRONMENTAL_CLASS_B
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class.3',
						\Ucreation\Properties\Domain\Model\Object::ENVIRONMENTAL_CLASS_C
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class.4',
						\Ucreation\Properties\Domain\Model\Object::ENVIRONMENTAL_CLASS_D
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class.5',
						\Ucreation\Properties\Domain\Model\Object::ENVIRONMENTAL_CLASS_E
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class.6',
						\Ucreation\Properties\Domain\Model\Object::ENVIRONMENTAL_CLASS_F
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.environmental_class.7',
						\Ucreation\Properties\Domain\Model\Object::ENVIRONMENTAL_CLASS_G
					),
				),
			),
		),
		'street' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.street',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'street_number' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.street_number',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'trim'
			),
		),
		'zip_code' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.zip_code',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'eval' => 'trim'
			),
		),
		'town' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.town',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_town',
				'minitems' => 1,
				'maxitems' => 1,
				'eval' => 'required',
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.town.0', NULL),
				),
			),
		),
		'district' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.district',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'country' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.country',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'determine_latlong_automatic' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.determine_latlong_automatic',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.determine_latlong_automatic.0',
					),
				),
			),
		),
		'latitude' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.latitude',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:determine_latlong_automatic:=:0',
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 10,
			),
		),
		'longitude' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.longitude',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:determine_latlong_automatic:=:0',
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 10,
			),
		),
		'garage' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garage',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garage.0',
					),
				),
			),
		),
		'use_existing_contact' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.use_existing_contact',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.use_existing_contact.0',
					),
				),
			),
		),
		'contact' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:use_existing_contact:>:0',
				),
			),
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_contact',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact.0', 0),
				),
			),
		),
		'contact_name' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact_name',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:use_existing_contact:=:0',
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'contact_company' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact_company',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:use_existing_contact:=:0',
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'contact_address' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact_address',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:use_existing_contact:=:0',
				),
			),
			'config' => array(
				'type' => 'text',
				'cols' => '48',
				'rows' => '4',
				'eval' => 'trim',
			)
		),
		'contact_phone' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact_phone',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:use_existing_contact:=:0',
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'trim'
			)
		),
		'contact_secondary_phone' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact_secondary_phone',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:use_existing_contact:=:0',
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'trim'
			)
		),
		'contact_email' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact_email',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:use_existing_contact:=:0',
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'contact_website' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.contact_website',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:use_existing_contact:=:0',
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'offer' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer.0',
						\Ucreation\Properties\Domain\Model\Object::OFFER_SALE,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer.1',
						\Ucreation\Properties\Domain\Model\Object::OFFER_RENT
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.offer.2',
						\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH
					),
				)
			)
		),
		'status' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.status',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.status.0',
						\Ucreation\Properties\Domain\Model\Object::STATUS_AVAILABLE,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.status.1',
						\Ucreation\Properties\Domain\Model\Object::STATUS_SOLD,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.status.2',
						\Ucreation\Properties\Domain\Model\Object::STATUS_LEASED,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.status.3',
						\Ucreation\Properties\Domain\Model\Object::STATUS_NOT_AVAILABLE,
					),
				)
			)
		),
		'price' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.price',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_SALE.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'eval' => 'int'
			)
		),
		'price_type' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.price_type',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_SALE.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
				),
			),
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.price_type.0',
						\Ucreation\Properties\Domain\Model\Object::PRICE_TYPE_KK,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.price_type.1',
						\Ucreation\Properties\Domain\Model\Object::PRICE_TYPE_VON,
					),
				)
			)
		),
		'price_per_square_metre' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.price_per_square_metre',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_SALE.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'eval' => 'int'
			)
		),
		'rent_price' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_price',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_RENT.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
				),
			),
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'eval' => 'int'
			)
		),
		'rent_price_type' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_price_type',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_RENT.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
				),
			),
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_price_type.0',
						\Ucreation\Properties\Domain\Model\Object::RENT_PRICE_TYPE_BASIC,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_price_type.1',
						\Ucreation\Properties\Domain\Model\Object::RENT_PRICE_TYPE_ALLINCLUSIVE,
					),
				),
			),
		),
		'rent_availability' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_RENT.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
				),
			),
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.0',
						\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_IMMEDIATELY,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.1',
						\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_WAIT
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.2',
						\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_BYDATE
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_availability.3',
						\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_INCONSULTATION
					),
				)
			)
		),
		'rent_wait' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_wait',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_RENT.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
					'FIELD:rent_availability:=:'.\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_WAIT,
				),
			),
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
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rent_available_date',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_RENT.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
					'FIELD:rent_availability:=:'.\Ucreation\Properties\Domain\Model\Object::RENT_AVAILABILITY_BYDATE,
				),
			),
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
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rental_agreement',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_RENT.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
				),
			),
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rental_agreement.0',
						\Ucreation\Properties\Domain\Model\Object::RENTAL_AGREEMENT_UNDETERMEDTIME,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.rental_agreement.1',
						\Ucreation\Properties\Domain\Model\Object::RENTAL_AGREEMENT_TEMPORARYTIME
					),
				)
			)
		),
		'lease_conditions' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.lease_conditions',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:offer:IN:'.\Ucreation\Properties\Domain\Model\Object::OFFER_RENT.','.\Ucreation\Properties\Domain\Model\Object::OFFER_BOTH,
				),
			),
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.lease_conditions.0', 0),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.lease_conditions.1',
						\Ucreation\Properties\Domain\Model\Object::LEASE_CONDITION_PADDED,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.lease_conditions.2',
						\Ucreation\Properties\Domain\Model\Object::LEASE_CONDITION_FURNISHED
					),
				)
			)
		),
		'accessibility' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.accessibility',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'select',
				'items' => array(
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.accessibility.0',
						\Ucreation\Properties\Domain\Model\Object::ACCESSIBILITY_NONE,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.accessibility.1',
						\Ucreation\Properties\Domain\Model\Object::ACCESSIBILITY_CUSTOM,
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.accessibility.2',
						\Ucreation\Properties\Domain\Model\Object::ACCESSIBILITY_DISABILITY
					),
					array(
						'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.accessibility.3',
						\Ucreation\Properties\Domain\Model\Object::ACCESSIBILITY_SENIORS
					),
				)
			)
		),
		'lot_size' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.lot_size',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'trim'
			),
		),
		'living_area' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.living_area',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'trim'
			),
		),
		'garden_area' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garden_area',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'trim'
			),
		),
		'number_of_rooms' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.number_of_rooms',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'number_of_bedrooms' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.number_of_bedrooms',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'construction_type' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.construction_type',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
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
		'garage' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garage',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'check',
				'items' => array(
					1 => array(
						0 => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garage.0',
					),
				),
			),
		),
		'garage_capacity' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garage_capacity',	
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:garage:=:1',
				),
			),
			'config' => array(
				'type' => 'input',
				'default' => 1,
				'size' => 4,
				'eval' => 'int'
			)
		),
		'garage_sort' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garage_sort',
			'displayCond' => array(
				'AND' => array(
					'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
					'FIELD:garage:=:1',
				),
			),
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_garagesort',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.garage_sort.0' ,0),
				),
			),
		),
		'presences' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.presences',
			'displayCond' => 'FIELD:type:=:'.\Ucreation\Properties\Domain\Model\Object::TYPE_BUILDING,
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_properties_domain_model_presence',
				'MM' => 'tx_properties_object_presence_mm',
				'size' => 6,
				'autoSizeMax' => 12,
				'maxitems' => 9999,
				'multiple' => 0,
			),
		),
		'latitude_longitude_md5' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.latitude_longitude_md5',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'meta_description' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.meta_description',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'text',
				'rows' => 3,
				'cols' => 30,
				'max' => 255,
				'eval' => 'trim'
			),
		),
		'meta_keywords' => array(
			'exclude' => FALSE,
			'label' => 'LLL:EXT:properties/Resources/Private/Language/locallang_db.xlf:tx_properties_domain_model_object.meta_keywords',
			'displayCond' => 'FIELD:type:>:'.\Ucreation\Properties\Domain\Model\Object::TYPE_NONE,
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'max' => 100,
			),
		),
	),
);