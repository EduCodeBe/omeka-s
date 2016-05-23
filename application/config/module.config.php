<?php
return [
    'session' => [
        'config' => [],
        'save_handler' => null,
    ],
    'listeners' => [
        'ModuleRouteListener',
        'Omeka\MvcExceptionListener',
        'Omeka\MvcListeners',
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_path_stack'      => [
            OMEKA_PATH . '/application/view-shared',
        ],
        'strategies' => [
            'Omeka\ViewApiJsonStrategy',
        ],
    ],
    'assets' => [
        'use_externals' => true,
        'externals' => [
            'Omeka' => [
                'js/jquery.js' => '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
            ],
        ],
    ],
    'permissions' => [
        'acl_resources' => [
            'Omeka\Module\Manager',
        ],
    ],
    'temp_dir' => sys_get_temp_dir(),
    'entity_manager' => [
        'is_dev_mode' => false,
        'mapping_classes_paths' => [
            OMEKA_PATH . '/application/src/Entity',
        ],
        'resource_discriminator_map' => [
            'Omeka\Entity\Item'    => 'Omeka\Entity\Item',
            'Omeka\Entity\Media'   => 'Omeka\Entity\Media',
            'Omeka\Entity\ItemSet' => 'Omeka\Entity\ItemSet',
        ],
        'filters' => [
            'visibility' => 'Omeka\Db\Filter\VisibilityFilter',
        ],
        'functions' => [
            'numeric' => [],
            'string' => [],
            'datetime' => [],
        ],
    ],
    'installer' => [
        'pre_tasks' => [
            'Omeka\Installation\Task\CheckEnvironmentTask',
            'Omeka\Installation\Task\CheckDirPermissionsTask',
            'Omeka\Installation\Task\CheckDbConfigurationTask',
        ],
        'tasks' => [
            'Omeka\Installation\Task\DestroySessionTask',
            'Omeka\Installation\Task\ClearCacheTask',
            'Omeka\Installation\Task\InstallSchemaTask',
            'Omeka\Installation\Task\RecordMigrationsTask',
            'Omeka\Installation\Task\InstallDefaultVocabulariesTask',
            'Omeka\Installation\Task\InstallDefaultTemplatesTask',
            'Omeka\Installation\Task\CreateFirstUserTask',
            'Omeka\Installation\Task\AddDefaultSettingsTask',
        ],
    ],
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type'        => 'gettext',
                'base_dir'    => OMEKA_PATH . '/application/language',
                'pattern'     => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'logger' => [
        'log'  => false,
        'path' => OMEKA_PATH . '/data/logs/application.log',
    ],
    'http_client' => [
        'adapter'   => 'Zend\Http\Client\Adapter\Socket',
        'sslcapath' => null,
        'sslcafile' => null,
    ],
    'cli' => [
        'execute_strategy' => 'exec',
        'phpcli_path' => null,
    ],
    'file_manager' => [
        'store' => 'Omeka\File\LocalStore',
        'thumbnailer' => 'Omeka\File\ImageMagickThumbnailer',
        'thumbnail_types' => [
            'large' => [
                'strategy' => 'default',
                'constraint' => 800,
                'options' => [],
            ],
            'medium' => [
                'strategy' => 'default',
                'constraint' => 400,
                'options' => [],
            ],
            'square' => [
                'strategy' => 'square',
                'constraint' => 200,
                'options' => [
                    'gravity' => 'center',
                ],
            ],
        ],
        'thumbnail_options' => [
            'imagemagick_dir' => null,
            'page' => 0,
        ],
        'thumbnail_fallbacks' => [
            'default' => ['thumbnails/default.png', 'Omeka'],
            'fallbacks' => [
                'image' => ['thumbnails/image.png', 'Omeka'],
                'video' => ['thumbnails/video.png', 'Omeka'],
                'audio' => ['thumbnails/audio.png', 'Omeka'],
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Navigation\Service\NavigationAbstractServiceFactory',
        ],
        'factories' => [
            'Omeka\Acl'                   => 'Omeka\Service\AclFactory',
            'Omeka\ApiAdapterManager'     => 'Omeka\Service\ApiAdapterManagerFactory',
            'Omeka\ApiManager'          => 'Omeka\Service\ApiManagerFactory',
            'Omeka\AuthenticationService' => 'Omeka\Service\AuthenticationServiceFactory',
            'Omeka\EntityManager'         => 'Omeka\Service\EntityManagerFactory',
            'Omeka\FileRendererManager'   => 'Omeka\Service\FileRendererManagerFactory',
            'Omeka\Installer'             => 'Omeka\Service\InstallerFactory',
            'Omeka\Logger'                => 'Omeka\Service\LoggerFactory',
            'Omeka\MediaIngesterManager'  => 'Omeka\Service\MediaIngesterManagerFactory',
            'Omeka\MediaRendererManager'  => 'Omeka\Service\MediaRendererManagerFactory',
            'Omeka\MigrationManager'      => 'Omeka\Service\MigrationManagerFactory',
            'Omeka\ViewApiJsonStrategy'   => 'Omeka\Service\ViewApiJsonStrategyFactory',
            'Omeka\JobDispatcher'         => 'Omeka\Service\JobDispatcherFactory',
            'Omeka\HttpClient'            => 'Omeka\Service\HttpClientFactory',
            'Omeka\Site\ThemeManager'     => 'Omeka\Service\ThemeManagerFactory',
            'Omeka\Site\NavigationLinkManager' => 'Omeka\Service\NavigationLinkManagerFactory',
            'Omeka\Site\NavigationTranslator' => 'Omeka\Service\SiteNavigationTranslatorFactory',
            'Omeka\File\ImageMagickThumbnailer' => 'Omeka\Service\FileThumbnailer\ImageMagickFactory',
            'Omeka\File\LocalStore'       => 'Omeka\Service\LocalStoreFactory',
            'Omeka\File\MediaTypeMap'     => 'Omeka\Service\MediaTypeMapFactory',
            'Omeka\File\Manager'          => 'Omeka\Service\FileManagerFactory',
            'Omeka\Mailer'                => 'Omeka\Service\MailerFactory',
            'Omeka\HtmlPurifier'          => 'Omeka\Service\HtmlPurifierFactory',
            'Omeka\BlockLayoutManager'    => 'Omeka\Service\BlockLayoutManagerFactory',
            'Omeka\DataTypeManager'       => 'Omeka\Service\DataTypeManagerFactory',
            'Omeka\Cli'                   => 'Omeka\Service\CliFactory',
            'Omeka\Paginator'             => 'Omeka\Service\PaginatorFactory',
            'Omeka\RdfImporter'           => 'Omeka\Service\RdfImporterFactory',
            'Omeka\Settings'            => 'Omeka\Service\SettingsFactory',
            'Omeka\SiteSettings'        => 'Omeka\Service\SiteSettingsFactory',
            'Omeka\JobDispatchStrategy\PhpCli'      => 'Omeka\Service\JobDispatchStrategy\PhpCliFactory',
            'Omeka\JobDispatchStrategy\Synchronous' => 'Omeka\Service\JobDispatchStrategy\SynchronousFactory',
        ],
        'invokables' => [
            'ModuleRouteListener'       => 'Zend\Mvc\ModuleRouteListener',
            'Omeka\MvcExceptionListener'=> 'Omeka\Mvc\ExceptionListener',
            'Omeka\MvcListeners'        => 'Omeka\Mvc\MvcListeners',
            'Omeka\ViewApiJsonRenderer' => 'Omeka\View\Renderer\ApiJsonRenderer',
            'Omeka\File\GdThumbnailer'          => 'Omeka\File\Thumbnailer\GdThumbnailer',
            'Omeka\File\ImagickThumbnailer'     => 'Omeka\File\Thumbnailer\ImagickThumbnailer',
        ],
        'aliases' => [
            'Omeka\JobDispatchStrategy' => 'Omeka\JobDispatchStrategy\PhpCli',
            'Zend\Authentication\AuthenticationService' => 'Omeka\AuthenticationService'
        ],
        'shared' => [
            'Omeka\Paginator' => false,
            'Omeka\HttpClient' => false,
            'Omeka\File\GdThumbnailer' => false,
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Omeka\Controller\Api'                    => 'Omeka\Controller\ApiController',
            'Omeka\Controller\Index'                  => 'Omeka\Controller\IndexController',
            'Omeka\Controller\Install'                => 'Omeka\Controller\InstallController',
            'Omeka\Controller\Login'                  => 'Omeka\Controller\LoginController',
            'Omeka\Controller\Maintenance'            => 'Omeka\Controller\MaintenanceController',
            'Omeka\Controller\Migrate'                => 'Omeka\Controller\MigrateController',
            'Omeka\Controller\Site\Index'             => 'Omeka\Controller\Site\IndexController',
            'Omeka\Controller\Site\Item'              => 'Omeka\Controller\Site\ItemController',
            'Omeka\Controller\Site\ItemSet'           => 'Omeka\Controller\Site\ItemSetController',
            'Omeka\Controller\Site\Media'             => 'Omeka\Controller\Site\MediaController',
            'Omeka\Controller\Site\Page'              => 'Omeka\Controller\Site\PageController',
            'Omeka\Controller\Admin\Index'            => 'Omeka\Controller\Admin\IndexController',
            'Omeka\Controller\Admin\Item'             => 'Omeka\Controller\Admin\ItemController',
            'Omeka\Controller\Admin\ItemSet'          => 'Omeka\Controller\Admin\ItemSetController',
            'Omeka\Controller\Admin\User'             => 'Omeka\Controller\Admin\UserController',
            'Omeka\Controller\Admin\Module'           => 'Omeka\Controller\Admin\ModuleController',
            'Omeka\Controller\Admin\Job'              => 'Omeka\Controller\Admin\JobController',
            'Omeka\Controller\Admin\ResourceTemplate' => 'Omeka\Controller\Admin\ResourceTemplateController',
            'Omeka\Controller\Admin\Vocabulary'       => 'Omeka\Controller\Admin\VocabularyController',
            'Omeka\Controller\Admin\Property'         => 'Omeka\Controller\Admin\PropertyController',
            'Omeka\Controller\Admin\ResourceClass'    => 'Omeka\Controller\Admin\ResourceClassController',
            'Omeka\Controller\Admin\Media'            => 'Omeka\Controller\Admin\MediaController',
            'Omeka\Controller\Admin\Setting'          => 'Omeka\Controller\Admin\SettingController',
            'Omeka\Controller\Admin\SystemInfo'       => 'Omeka\Controller\Admin\SystemInfoController',
            'Omeka\Controller\SiteAdmin\Index'        => 'Omeka\Controller\SiteAdmin\IndexController',
            'Omeka\Controller\SiteAdmin\Page'         => 'Omeka\Controller\SiteAdmin\PageController',
        ],
    ],
    'controller_plugins' => [
        'invokables' => [
            'api'       => 'Omeka\Mvc\Controller\Plugin\Api',
            'translate' => 'Omeka\Mvc\Controller\Plugin\Translate',
            'messenger' => 'Omeka\Mvc\Controller\Plugin\Messenger',
            'paginator' => 'Omeka\Mvc\Controller\Plugin\Paginator',
            'setBrowseDefaults' => 'Omeka\Mvc\Controller\Plugin\SetBrowseDefaults',
        ],
    ],
    'api_adapters' => [
        'invokables' => [
            'users'              => 'Omeka\Api\Adapter\UserAdapter',
            'vocabularies'       => 'Omeka\Api\Adapter\VocabularyAdapter',
            'resource_classes'   => 'Omeka\Api\Adapter\ResourceClassAdapter',
            'resource_templates' => 'Omeka\Api\Adapter\ResourceTemplateAdapter',
            'properties'         => 'Omeka\Api\Adapter\PropertyAdapter',
            'items'              => 'Omeka\Api\Adapter\ItemAdapter',
            'media'              => 'Omeka\Api\Adapter\MediaAdapter',
            'item_sets'          => 'Omeka\Api\Adapter\ItemSetAdapter',
            'modules'            => 'Omeka\Api\Adapter\ModuleAdapter',
            'sites'              => 'Omeka\Api\Adapter\SiteAdapter',
            'site_pages'         => 'Omeka\Api\Adapter\SitePageAdapter',
            'jobs'               => 'Omeka\Api\Adapter\JobAdapter',
            'resources'          => 'Omeka\Api\Adapter\ResourceAdapter',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'pageTitle'              => 'Omeka\View\Helper\PageTitle',
            'htmlElement'            => 'Omeka\View\Helper\HtmlElement',
            'hyperlink'              => 'Omeka\View\Helper\Hyperlink',
            'messages'               => 'Omeka\View\Helper\Messages',
            'propertySelect'         => 'Omeka\View\Helper\PropertySelect',
            'sortLink'               => 'Omeka\View\Helper\SortLink',
            'sortSelector'           => 'Omeka\View\Helper\SortSelector',
            'propertySelector'       => 'Omeka\View\Helper\PropertySelector',
            'itemSetSelector'        => 'Omeka\View\Helper\ItemSetSelector',
            'itemSetSelect'          => 'Omeka\View\Helper\ItemSetSelect',
            'formPropertyInputs'     => 'Omeka\View\Helper\PropertyInputs',
            'resourceClassSelect'    => 'Omeka\View\Helper\ResourceClassSelect',
            'deleteConfirm'          => 'Omeka\View\Helper\DeleteConfirm',
            'searchFilters' => 'Omeka\View\Helper\SearchFilters',
            'ckEditor' => 'Omeka\View\Helper\CkEditor',
            'sitePagePagination' => 'Omeka\View\Helper\SitePagePagination',
            'sectionNav' => 'Omeka\View\Helper\SectionNav',
            'uploadLimit' => 'Omeka\View\Helper\UploadLimit'
        ],
        'factories' => [
            'api' => 'Omeka\Service\ViewHelper\ApiFactory',
            'assetUrl' => 'Omeka\Service\ViewHelper\AssetUrlFactory',
            'blockLayout' => 'Omeka\Service\ViewHelper\BlockLayoutFactory',
            'dataType' => 'Omeka\Service\ViewHelper\DataTypeFactory',
            'deleteConfirmForm' => 'Omeka\Service\ViewHelper\DeleteConfirmFormFactory',
            'i18n' => 'Omeka\Service\ViewHelper\I18nFactory',
            'media' => 'Omeka\Service\ViewHelper\MediaFactory',
            'navigationLink' => 'Omeka\Service\ViewHelper\NavigationLinkFactory',
            'pagination' => 'Omeka\Service\ViewHelper\PaginationFactory',
            'params' => 'Omeka\Service\ViewHelper\ParamsFactory',
            'setting' => 'Omeka\Service\ViewHelper\SettingFactory',
            'themeSetting' => 'Omeka\Service\ViewHelper\ThemeSettingFactory',
            'trigger' => 'Omeka\Service\ViewHelper\TriggerFactory',
            'userIsAllowed' => 'Omeka\Service\ViewHelper\UserIsAllowedFactory',
        ],
    ],
    'data_types' => [
        'invokables' => [
            'literal' => 'Omeka\DataType\Literal',
            'uri' => 'Omeka\DataType\Uri',
            'resource' => 'Omeka\DataType\Resource',
        ],
    ],
    'block_layouts' => [
        'invokables' => [
            'media' => 'Omeka\Site\BlockLayout\Media',
            'html' => 'Omeka\Site\BlockLayout\Html',
            'browsePreview' => 'Omeka\Site\BlockLayout\BrowsePreview',
            'itemShowCase' => 'Omeka\Site\BlockLayout\ItemShowcase',
            'tableOfContents' => 'Omeka\Site\BlockLayout\TableOfContents',
            'lineBreak' => 'Omeka\Site\BlockLayout\LineBreak',
            'itemWithMetadata' => 'Omeka\Site\BlockLayout\ItemWithMetadata',
        ],
    ],
    'navigation_links' => [
        'invokables' => [
            'page' => 'Omeka\Site\Navigation\Link\Page',
            'url' => 'Omeka\Site\Navigation\Link\Url',
            'browse' => 'Omeka\Site\Navigation\Link\Browse',
        ],
    ],
    'media_ingesters' => [
        'factories' => [
            'upload' => 'Omeka\Service\MediaIngester\UploadFactory',
            'url' => 'Omeka\Service\MediaIngester\UrlFactory',
            'html' => 'Omeka\Service\MediaIngester\HtmlFactory',
            'iiif' => 'Omeka\Service\MediaIngester\IIIFFactory',
            'oembed' => 'Omeka\Service\MediaIngester\OEmbedFactory',
            'youtube' => 'Omeka\Service\MediaIngester\YoutubeFactory',
        ]
    ],
    'media_renderers' => [
        'invokables' => [
            'oembed'  => 'Omeka\Media\Renderer\OEmbed',
            'youtube' => 'Omeka\Media\Renderer\Youtube',
            'html'    => 'Omeka\Media\Renderer\Html',
            'iiif'    => 'Omeka\Media\Renderer\IIIF'
        ],
        'factories' => [
            'file' => 'Omeka\Service\MediaRenderer\FileFactory'
        ]
    ],
    'file_renderers' => [
        'invokables' => [
            'fallback' => 'Omeka\Media\FileRenderer\FallbackRenderer',
            'thumbnail' => 'Omeka\Media\FileRenderer\ThumbnailRenderer',
            'audio' => 'Omeka\Media\FileRenderer\AudioRenderer',
            'video' => 'Omeka\Media\FileRenderer\VideoRenderer',
        ],
        'aliases' => [
            'audio/ogg' => 'audio',
            'audio/x-ogg' => 'audio',
            'audio/aac' => 'audio',
            'audio/x-aac' => 'audio',
            'audio/mpeg' => 'audio',
            'audio/x-mpeg' => 'audio',
            'audio/mp3' => 'audio',
            'audio/x-mp3' => 'audio',
            'audio/mpeg3' => 'audio',
            'audio/x-mpeg-3' => 'audio',
            'audio/x-mpegaudio' => 'audio',
            'audio/x-mpg' => 'audio',
            'audio/mp4' => 'audio',
            'audio/x-mp4' => 'audio',
            'audio/x-m4a' => 'audio',
            'audio/wav' => 'audio',
            'audio/x-wav' => 'audio',
            'audio/aiff' => 'audio',
            'audio/x-aiff' => 'audio',
            'application/ogg' => 'video',
            'video/mp4' => 'video',
            'video/x-m4v' => 'video',
            'video/quicktime' => 'video',
            'video/avi' => 'video',
            'video/ogg' => 'video',
            'video/webm' => 'video',
            '.mp3' => 'audio',
        ],
    ],
    'oembed' => [
        'whitelist' => [
            '#^https?://(www\.)?youtube\.com/watch.*$#i',
            '#^https?://(www\.)?youtube\.com/playlist.*$#i',
            '#^https?://youtu\.be/.*$#i',
            '#^http://blip.tv/*$#',
            '#^https?://(.+\.)?vimeo\.com/.*$#i',
            '#^https?://(www\.)?dailymotion\.com/.*$#i',
            '#^http://dai.ly/*$#',
            '#^https?://(www\.)?flickr\.com/.*$#i',
            '#^https?://flic\.kr/.*$#i',
            '#^https?://(.+\.)?smugmug\.com/.*$#i',
            '#^https?://(www\.)?hulu\.com/watch/.*$#i',
            '#^http://revision3.com/*$#',
            '#^http://i*.photobucket.com/albums/*$#',
            '#^http://gi*.photobucket.com/groups/*$#',
            '#^https?://(www\.)?scribd\.com/doc/.*$#i',
            '#^https?://wordpress.tv/.*$#i',
            '#^https?://(.+\.)?polldaddy\.com/.*$#i',
            '#^https?://poll\.fm/.*$#i',
            '#^https?://(www\.)?funnyordie\.com/videos/.*$#i',
            '#^https?://(www\.)?twitter\.com/.+?/status(es)?/.*$#i',
            '#^https?://(www\.)?soundcloud\.com/.*$#i',
            '#^https?://(www\.)?slideshare\.net/.*$#i',
            '#^https?://(www\.)?rdio\.com/.*$#i',
            '#^https?://rd\.io/x/.*$#i',
            '#^https?://(open|play)\.spotify\.com/.*$#i',
            '#^https?://(.+\.)?imgur\.com/.*$#i',
            '#^https?://(www\.)?meetu(\.ps|p\.com)/.*$#i',
            '#^https?://(www\.)?issuu\.com/.+/docs/.+$#i',
            '#^https?://(www\.)?collegehumor\.com/video/.*$#i',
            '#^https?://(www\.)?mixcloud\.com/.*$#i',
            '#^https?://(www\.|embed\.)?ted\.com/talks/.*$#i',
            '#^https?://(www\.)?(animoto|video214)\.com/play/.*$#i',
        ]
    ],
    'mail' => [
        'transport' => [
            'type' => 'sendmail',
            'options' => [],
        ],
        'default_message_options' => [
            'encoding' => 'UTF-8',
        ],
    ],
];
