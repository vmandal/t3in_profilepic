<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'T3IN.T3inProfilepic',
            'P1',
            '[T3IN] Profile Pic'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('t3in_profilepic', 'Configuration/TypoScript', 'FEuser Profile pic');

    }
);
