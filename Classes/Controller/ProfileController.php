<?php
namespace T3IN\T3inProfilepic\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use T3IN\T3inProfilepic\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;

/**
 * Class ProfileController
 */

class ProfileController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {


    /**                 	 
     * @TYPO3\CMS\Extbase\Annotation\Inject
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 */
    protected $frontendUserRepository;

    /**                 	 
     * @var \TYPO3\CMS\Core\Resource\StorageRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
	 */
    protected $storageRepository;

    public function indexAction() {

        $feuser = $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
        $this->view->assign('feuser', $feuser);

    }


    public function savePicAction(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feuser) {

        $this->frontendUserRepository->update($feuser);
        //$this->view->assign('feuser', $feuser);
        $this->redirect('index');
    }    

    /**
     * Set TypeConverter option for image upload
     */
    public function initializeSavePicAction() {
        $this->setTypeConverterConfigurationForImageUpload('feuser');
    }

    /**
     *
     */
    protected function setTypeConverterConfigurationForImageUpload($argumentName) {

        \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)
            ->registerImplementation(
                \TYPO3\CMS\Extbase\Domain\Model\FileReference::class,
                \T3IN\T3inProfilepic\Domain\Model\FileReference::class
            );

        $uploadConfiguration = [
            UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/',
        ];

        /** @var PropertyMappingConfiguration $newConfiguration */
        $newConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
        

        $newConfiguration->forProperty('image.0')
            ->setTypeConverterOptions(
                UploadedFileReferenceConverter::class,
                $uploadConfiguration
            );

    }



}
