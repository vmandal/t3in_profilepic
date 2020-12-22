<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'T3IN.T3inProfilepic',
            'P1',
            [
                'Profile' => 'index, savePic, savePicNormal'
            ],
            // non-cacheable actions
            [
                'Profile' => 'index, savePic, savePicNormal'
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        p1 {
                            iconIdentifier = t3in_profilepic-plugin-p1
                            title = LLL:EXT:t3in_profilepic/Resources/Private/Language/locallang_db.xlf:tx_t3in_profilepic_p1.name
                            description = LLL:EXT:t3in_profilepic/Resources/Private/Language/locallang_db.xlf:tx_t3in_profilepic_p1.description
                            tt_content_defValues {
                                CType = list
                                list_type = t3inprofilepic_p1
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				't3in_profilepic-plugin-p1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:t3in_profilepic/Resources/Public/Icons/user_plugin_p1.svg']
            );
            
            
		
    }


);


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('T3IN\\T3inProfilepic\\Property\\TypeConverter\\UploadedFileReferenceConverter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('T3IN\\T3inProfilepic\\Property\\TypeConverter\\ObjectStorageConverter');

