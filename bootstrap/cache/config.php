<?php return array (
  'analytics' => 
  array (
    'name' => 'Analytics',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 98,
    'view_id' => NULL,
    'cache_lifetime_in_minutes' => 1440,
    'cache' => 
    array (
      'store' => 'file',
    ),
    'enabled_dashboard_widgets' => true,
  ),
  'app' => 
  array (
    'name' => 'Elections',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:QjPDHktEOado8rHzsIT0uzvnCZOULT0T7b9DNqDLKZ8=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
    ),
    'debug_blacklist' => 
    array (
      '_ENV' => 
      array (
        0 => 'APP_KEY',
        1 => 'ADMIN_DIR',
        2 => 'DB_DATABASE',
        3 => 'DB_USERNAME',
        4 => 'DB_PASSWORD',
        5 => 'REDIS_PASSWORD',
        6 => 'MAIL_PASSWORD',
        7 => 'PUSHER_APP_KEY',
        8 => 'PUSHER_APP_SECRET',
      ),
      '_SERVER' => 
      array (
        0 => 'APP_KEY',
        1 => 'ADMIN_DIR',
        2 => 'DB_DATABASE',
        3 => 'DB_USERNAME',
        4 => 'DB_PASSWORD',
        5 => 'REDIS_PASSWORD',
        6 => 'MAIL_PASSWORD',
      ),
      '_POST' => 
      array (
        0 => 'password',
      ),
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'author' => 
  array (
    'vendor' => 'Kamrul cms',
    'vendor_url' => '#',
    'email' => 'anik825@gmail.com',
    'app_version' => '2.6',
    'lic1' => 'e10adc3949ba59abbe56e057f20f883e',
    'pid' => 1,
    'envato_purchase_code' => 0,
  ),
  'backup' => 
  array (
    'backup' => 
    array (
      'name' => 'Elections',
      'source' => 
      array (
        'files' => 
        array (
          'include' => 
          array (
            0 => '/home/kamrul/php/lara_elections',
          ),
          'exclude' => 
          array (
            0 => '/home/kamrul/php/lara_elections/vendor',
            1 => '/home/kamrul/php/lara_elections/node_modules',
            2 => '/home/kamrul/php/lara_elections/.git',
            3 => '/home/kamrul/php/lara_elections/.idea',
          ),
          'follow_links' => false,
          'ignore_unreadable_directories' => false,
          'relative_path' => NULL,
        ),
        'databases' => 
        array (
          0 => 'mysql',
        ),
      ),
      'database_dump_compressor' => NULL,
      'database_dump_file_extension' => '',
      'destination' => 
      array (
        'filename_prefix' => '',
        'disks' => 
        array (
          0 => 'local',
        ),
      ),
      'temporary_directory' => '/home/kamrul/php/lara_elections/storage/app/backup-temp',
      'password' => NULL,
      'encryption' => 'default',
    ),
    'notifications' => 
    array (
      'notifications' => 
      array (
        'Spatie\\Backup\\Notifications\\Notifications\\BackupHasFailed' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\UnhealthyBackupWasFound' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupHasFailed' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\BackupWasSuccessful' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\HealthyBackupWasFound' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupWasSuccessful' => 
        array (
          0 => 'mail',
        ),
      ),
      'notifiable' => 'Spatie\\Backup\\Notifications\\Notifiable',
      'mail' => 
      array (
        'to' => NULL,
        'from' => 
        array (
          'address' => 'admin@admin.com',
          'name' => 'Elections',
        ),
      ),
      'slack' => 
      array (
        'webhook_url' => '',
        'channel' => NULL,
        'username' => NULL,
        'icon' => NULL,
      ),
    ),
    'monitor_backups' => 
    array (
      0 => 
      array (
        'name' => 'Elections',
        'disks' => 
        array (
          0 => 'local',
        ),
        'health_checks' => 
        array (
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumAgeInDays' => 1,
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumStorageInMegabytes' => 5000,
        ),
      ),
    ),
    'cleanup' => 
    array (
      'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
      'default_strategy' => 
      array (
        'keep_all_backups_for_days' => 7,
        'keep_daily_backups_for_days' => 16,
        'keep_weekly_backups_for_weeks' => 8,
        'keep_monthly_backups_for_months' => 4,
        'keep_yearly_backups_for_years' => 2,
        'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
      ),
    ),
  ),
  'branch' => 
  array (
    'name' => 'Branch',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 53,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
        'lock_connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home/kamrul/php/lara_elections/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'elections_cache',
  ),
  'contactform' => 
  array (
    'name' => 'ContactForm',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 41,
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'anik_lara_elections',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'anik_lara_elections',
        'username' => 'kamrul',
        'password' => '12345678',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'anik_lara_elections',
        'username' => 'kamrul',
        'password' => '12345678',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'anik_lara_elections',
        'username' => 'kamrul',
        'password' => '12345678',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'elections_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
        'test_auto_detect' => true,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => '/home/kamrul/php/lara_elections/storage/framework/cache/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'public',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home/kamrul/php/lara_elections/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home/kamrul/php/lara_elections/public/uploads',
        'url' => 'http://localhost/public/uploads',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
      ),
    ),
    'links' => 
    array (
      '/home/kamrul/php/lara_elections/public/storage' => '/home/kamrul/php/lara_elections/storage/app/public',
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'kamruldashboard' => 
  array (
    'name' => 'KamrulDashboard',
    'module_version' => '1.3',
    'module_type' => 'plugin',
    'pid' => 92,
    'site_name' => 'Elections',
    'slug_pattern' => '--slug--',
    'backup_mysql_execute_path' => '',
    'driver' => 'database',
    'disable_verify_csrf_token' => false,
    'cache' => 
    array (
      'enabled' => false,
    ),
    'enable_email_smtp_settings' => true,
    'phone_validation_rule' => 'min:8|max:15|regex:/^([0-9\\s\\-\\+\\(\\)]*)$/',
    'enable_less_secure_web' => false,
    'google_fonts_url' => 'https://fonts.bunny.net',
    'google_fonts_enabled_cache' => true,
    'prefixes' => 
    array (
      'Modules\\AdminBoard\\Http\\Models\\AdminWorkshop' => 'workshop',
      'Modules\\AdminBoard\\Http\\Models\\AdminNews' => 'news',
      'Modules\\AdminBoard\\Http\\Models\\AdminEvent' => 'event',
      'Modules\\AdminBoard\\Http\\Models\\AdminTeam' => 'team',
      'Modules\\AdminBoard\\Http\\Models\\AdminCategory' => 'category',
      'Modules\\AdminBoard\\Http\\Models\\AdminCareerNavigator' => 'syllabus',
      'Modules\\AdminBoard\\Http\\Models\\AdminFacility' => 'facility',
      'Modules\\AdminBoard\\Http\\Models\\AdminNoticeBoard' => 'notice-board',
      'Modules\\AdminBoard\\Http\\Models\\AdminAcademicGroup' => 'academic-group',
      'Modules\\AdminBoard\\Http\\Models\\AdminGalleryBoard' => 'gallery-board',
      'Modules\\AdminBoard\\Http\\Models\\AdminClub' => 'clubs',
      'Modules\\AdminBoard\\Http\\Models\\AdminService' => 'services',
      'Modules\\AdminBoard\\Http\\Models\\AdminPackage' => 'packages',
      'Modules\\AdminBoard\\Http\\Models\\AdminFtpServer' => 'ftpserver',
      'Modules\\AdminBoard\\Http\\Models\\AdminPartner' => 'partner',
      'Modules\\Post\\Http\\Models\\Post' => NULL,
      'Modules\\Post\\Http\\Models\\Page' => NULL,
      'Modules\\Post\\Http\\Models\\Category' => NULL,
    ),
    'public_single_ending_url' => NULL,
    'admin_dir' => 'admin',
    'supported' => 
    array (
      'slug' => 
      array (
        'KamrulDashboard\\Post\\Models\\Page' => 'Pages',
        'Modules\\AdminBoard\\Http\\Models\\AdminWorkshop' => 'Workshop Posts',
        'Modules\\AdminBoard\\Http\\Models\\AdminNews' => 'News Posts',
        'Modules\\AdminBoard\\Http\\Models\\AdminEvent' => 'Event Posts',
        'Modules\\AdminBoard\\Http\\Models\\AdminTeam' => 'Team Posts',
        'Modules\\AdminBoard\\Http\\Models\\AdminCategory' => 'Category Posts',
        'Modules\\AdminBoard\\Http\\Models\\AdminCareerNavigator' => 'Syllabus Posts',
        'Modules\\AdminBoard\\Http\\Models\\AdminFacility' => 'Facilities Posts',
        'Modules\\AdminBoard\\Http\\Models\\AdminNoticeBoard' => 'Notice Boards Posts',
        'Modules\\AdminBoard\\Http\\Models\\AdminAcademicGroup' => 'Academic Group Data',
        'Modules\\AdminBoard\\Http\\Models\\AdminGalleryBoard' => 'Gallery Board Data',
        'Modules\\AdminBoard\\Http\\Models\\AdminClub' => 'AdminClub Data',
        'Modules\\AdminBoard\\Http\\Models\\AdminService' => 'Service Data',
        'Modules\\AdminBoard\\Http\\Models\\AdminPackage' => 'Packages Data',
        'Modules\\AdminBoard\\Http\\Models\\AdminFtpServer' => 'Ftp Server Data',
        'Modules\\AdminBoard\\Http\\Models\\AdminPartner' => 'Ftp Server Data',
        'Modules\\Post\\Http\\Models\\Post' => 'Site Posts',
        'Modules\\Post\\Http\\Models\\Page' => 'Site Pages',
        'Modules\\Post\\Http\\Models\\Category' => 'Site Categories',
      ),
    ),
    'slug' => 
    array (
      'disable_preview' => 
      array (
      ),
      'slug_generated_columns' => 
      array (
      ),
      'enable_slug_translator' => false,
    ),
    'date_format' => 
    array (
      'date' => 'Y-m-d',
      'date_time' => 'Y-m-d H:i:s',
      'js' => 
      array (
        'date' => 'yyyy-mm-dd',
        'date_time' => 'yyyy-mm-dd H:i:s',
      ),
    ),
    'cache_site_map' => false,
    'countries' => 
    array (
      'AF' => 'Afghanistan',
      'AX' => 'Åland Islands',
      'AL' => 'Albania',
      'DZ' => 'Algeria',
      'AS' => 'American Samoa',
      'AD' => 'Andorra',
      'AO' => 'Angola',
      'AI' => 'Anguilla',
      'AQ' => 'Antarctica',
      'AG' => 'Antigua and Barbuda',
      'AR' => 'Argentina',
      'AM' => 'Armenia',
      'AW' => 'Aruba',
      'AU' => 'Australia',
      'AT' => 'Austria',
      'AZ' => 'Azerbaijan',
      'BS' => 'Bahamas',
      'BH' => 'Bahrain',
      'BD' => 'Bangladesh',
      'BB' => 'Barbados',
      'BY' => 'Belarus',
      'BE' => 'Belgium',
      'PW' => 'Belau',
      'BZ' => 'Belize',
      'BJ' => 'Benin',
      'BM' => 'Bermuda',
      'BT' => 'Bhutan',
      'BO' => 'Bolivia',
      'BQ' => 'Bonaire, Saint Eustatius and Saba',
      'BA' => 'Bosnia and Herzegovina',
      'BW' => 'Botswana',
      'BV' => 'Bouvet Island',
      'BR' => 'Brazil',
      'IO' => 'British Indian Ocean Territory',
      'BN' => 'Brunei',
      'BG' => 'Bulgaria',
      'BF' => 'Burkina Faso',
      'BI' => 'Burundi',
      'KH' => 'Cambodia',
      'CM' => 'Cameroon',
      'CA' => 'Canada',
      'CV' => 'Cape Verde',
      'KY' => 'Cayman Islands',
      'CF' => 'Central African Republic',
      'TD' => 'Chad',
      'CL' => 'Chile',
      'CN' => 'China',
      'CX' => 'Christmas Island',
      'CC' => 'Cocos (Keeling) Islands',
      'CO' => 'Colombia',
      'KM' => 'Comoros',
      'CG' => 'Congo (Brazzaville)',
      'CD' => 'Congo (Kinshasa)',
      'CK' => 'Cook Islands',
      'CR' => 'Costa Rica',
      'HR' => 'Croatia',
      'CU' => 'Cuba',
      'CW' => 'Cura&ccedil;ao',
      'CY' => 'Cyprus',
      'CZ' => 'Czech Republic',
      'DK' => 'Denmark',
      'DJ' => 'Djibouti',
      'DM' => 'Dominica',
      'DO' => 'Dominican Republic',
      'EC' => 'Ecuador',
      'EG' => 'Egypt',
      'SV' => 'El Salvador',
      'GQ' => 'Equatorial Guinea',
      'ER' => 'Eritrea',
      'EE' => 'Estonia',
      'ET' => 'Ethiopia',
      'FK' => 'Falkland Islands',
      'FO' => 'Faroe Islands',
      'FJ' => 'Fiji',
      'FI' => 'Finland',
      'FR' => 'France',
      'GF' => 'French Guiana',
      'PF' => 'French Polynesia',
      'TF' => 'French Southern Territories',
      'GA' => 'Gabon',
      'GM' => 'Gambia',
      'GE' => 'Georgia',
      'DE' => 'Germany',
      'GH' => 'Ghana',
      'GI' => 'Gibraltar',
      'GR' => 'Greece',
      'GL' => 'Greenland',
      'GD' => 'Grenada',
      'GP' => 'Guadeloupe',
      'GU' => 'Guam',
      'GT' => 'Guatemala',
      'GG' => 'Guernsey',
      'GN' => 'Guinea',
      'GW' => 'Guinea-Bissau',
      'GY' => 'Guyana',
      'HT' => 'Haiti',
      'HM' => 'Heard Island and McDonald Islands',
      'HN' => 'Honduras',
      'HK' => 'Hong Kong',
      'HU' => 'Hungary',
      'IS' => 'Iceland',
      'IN' => 'India',
      'ID' => 'Indonesia',
      'IR' => 'Iran',
      'IQ' => 'Iraq',
      'IE' => 'Ireland',
      'IM' => 'Isle of Man',
      'IL' => 'Israel',
      'IT' => 'Italy',
      'CI' => 'Ivory Coast',
      'JM' => 'Jamaica',
      'JP' => 'Japan',
      'JE' => 'Jersey',
      'JO' => 'Jordan',
      'KZ' => 'Kazakhstan',
      'KE' => 'Kenya',
      'KI' => 'Kiribati',
      'KW' => 'Kuwait',
      'XK' => 'Kosovo',
      'KG' => 'Kyrgyzstan',
      'LA' => 'Laos',
      'LV' => 'Latvia',
      'LB' => 'Lebanon',
      'LS' => 'Lesotho',
      'LR' => 'Liberia',
      'LY' => 'Libya',
      'LI' => 'Liechtenstein',
      'LT' => 'Lithuania',
      'LU' => 'Luxembourg',
      'MO' => 'Macao',
      'MK' => 'North Macedonia',
      'MG' => 'Madagascar',
      'MW' => 'Malawi',
      'MY' => 'Malaysia',
      'MV' => 'Maldives',
      'ML' => 'Mali',
      'MT' => 'Malta',
      'MH' => 'Marshall Islands',
      'MQ' => 'Martinique',
      'MR' => 'Mauritania',
      'MU' => 'Mauritius',
      'YT' => 'Mayotte',
      'MX' => 'Mexico',
      'FM' => 'Micronesia',
      'MD' => 'Moldova',
      'MC' => 'Monaco',
      'MN' => 'Mongolia',
      'ME' => 'Montenegro',
      'MS' => 'Montserrat',
      'MA' => 'Morocco',
      'MZ' => 'Mozambique',
      'MM' => 'Myanmar',
      'NA' => 'Namibia',
      'NR' => 'Nauru',
      'NP' => 'Nepal',
      'NL' => 'Netherlands',
      'NC' => 'New Caledonia',
      'NZ' => 'New Zealand',
      'NI' => 'Nicaragua',
      'NE' => 'Niger',
      'NG' => 'Nigeria',
      'NU' => 'Niue',
      'NF' => 'Norfolk Island',
      'MP' => 'Northern Mariana Islands',
      'KP' => 'North Korea',
      'NO' => 'Norway',
      'OM' => 'Oman',
      'PK' => 'Pakistan',
      'PS' => 'Palestinian Territory',
      'PA' => 'Panama',
      'PG' => 'Papua New Guinea',
      'PY' => 'Paraguay',
      'PE' => 'Peru',
      'PH' => 'Philippines',
      'PN' => 'Pitcairn',
      'PL' => 'Poland',
      'PT' => 'Portugal',
      'PR' => 'Puerto Rico',
      'QA' => 'Qatar',
      'RE' => 'Reunion',
      'RO' => 'Romania',
      'RU' => 'Russia',
      'RW' => 'Rwanda',
      'BL' => 'Saint Barth&eacute;lemy',
      'SH' => 'Saint Helena',
      'KN' => 'Saint Kitts and Nevis',
      'LC' => 'Saint Lucia',
      'MF' => 'Saint Martin (French part)',
      'SX' => 'Saint Martin (Dutch part)',
      'PM' => 'Saint Pierre and Miquelon',
      'VC' => 'Saint Vincent and the Grenadines',
      'SM' => 'San Marino',
      'ST' => 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe',
      'SA' => 'Saudi Arabia',
      'SN' => 'Senegal',
      'RS' => 'Serbia',
      'SC' => 'Seychelles',
      'SL' => 'Sierra Leone',
      'SG' => 'Singapore',
      'SK' => 'Slovakia',
      'SI' => 'Slovenia',
      'SB' => 'Solomon Islands',
      'SO' => 'Somalia',
      'ZA' => 'South Africa',
      'GS' => 'South Georgia/Sandwich Islands',
      'KR' => 'South Korea',
      'SS' => 'South Sudan',
      'ES' => 'Spain',
      'LK' => 'Sri Lanka',
      'SD' => 'Sudan',
      'SR' => 'Suriname',
      'SJ' => 'Svalbard and Jan Mayen',
      'SZ' => 'Swaziland',
      'SE' => 'Sweden',
      'CH' => 'Switzerland',
      'SY' => 'Syria',
      'TW' => 'Taiwan',
      'TJ' => 'Tajikistan',
      'TZ' => 'Tanzania',
      'TH' => 'Thailand',
      'TL' => 'Timor-Leste',
      'TG' => 'Togo',
      'TK' => 'Tokelau',
      'TO' => 'Tonga',
      'TT' => 'Trinidad and Tobago',
      'TN' => 'Tunisia',
      'TR' => 'Turkey',
      'TM' => 'Turkmenistan',
      'TC' => 'Turks and Caicos Islands',
      'TV' => 'Tuvalu',
      'UG' => 'Uganda',
      'UA' => 'Ukraine',
      'AE' => 'United Arab Emirates',
      'GB' => 'United Kingdom (UK)',
      'US' => 'United States (US)',
      'UM' => 'United States (US) Minor Outlying Islands',
      'UY' => 'Uruguay',
      'UZ' => 'Uzbekistan',
      'VU' => 'Vanuatu',
      'VA' => 'Vatican',
      'VE' => 'Venezuela',
      'VN' => 'Vietnam',
      'VG' => 'Virgin Islands (British)',
      'VI' => 'Virgin Islands (US)',
      'WF' => 'Wallis and Futuna',
      'EH' => 'Western Sahara',
      'WS' => 'Samoa',
      'YE' => 'Yemen',
      'ZM' => 'Zambia',
      'ZW' => 'Zimbabwe',
    ),
    'purifier' => 
    array (
      'default' => 
      array (
        'HTML.Doctype' => 'HTML 4.01 Transitional',
        'HTML.Allowed' => 'div,b,strong,i,em,u,a[href|title|rel|style|target],ul,ol,li,p[style],br,span[style],img[width|height|alt|src|style],button,ins[style|data-ad-client|data-ad-slot|data-ad-format|data-full-width-responsive]',
        'HTML.AllowedElements' => 
        array (
          0 => 'a',
          1 => 'b',
          2 => 'blockquote',
          3 => 'br',
          4 => 'code',
          5 => 'em',
          6 => 'h1',
          7 => 'h2',
          8 => 'h3',
          9 => 'h4',
          10 => 'h5',
          11 => 'h6',
          12 => 'hr',
          13 => 'i',
          14 => 'img',
          15 => 'li',
          16 => 'ol',
          17 => 'p',
          18 => 'pre',
          19 => 's',
          20 => 'span',
          21 => 'strong',
          22 => 'sub',
          23 => 'sup',
          24 => 'table',
          25 => 'tbody',
          26 => 'td',
          27 => 'th',
          28 => 'thead',
          29 => 'tr',
          30 => 'u',
          31 => 'ul',
          32 => 'pre',
          33 => 'abbr',
          34 => 'kbd',
          35 => 'var',
          36 => 'samp',
          37 => 'hr',
          38 => 'iframe',
          39 => 'figure',
          40 => 'figcaption',
          41 => 'section',
          42 => 'article',
          43 => 'aside',
          44 => 'blockquote',
          45 => 'caption',
          46 => 'del',
          47 => 'div',
          48 => 'button',
          49 => 'ins',
        ),
        'HTML.SafeIframe' => 'true',
        'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
        'Attr.AllowedFrameTargets' => 
        array (
          0 => '_blank',
        ),
        'CSS.AllowedProperties' => 
        array (
          0 => 'font',
          1 => 'font-size',
          2 => 'font-weight',
          3 => 'font-style',
          4 => 'font-family',
          5 => 'text-decoration',
          6 => 'padding-left',
          7 => 'color',
          8 => 'background-color',
          9 => 'text-align',
          10 => 'max-width',
          11 => 'border',
          12 => 'width',
          13 => 'line-height',
          14 => 'word-spacing',
          15 => 'border-style',
          16 => 'list-style-type',
          17 => 'border-color',
          18 => 'height',
          19 => 'min-width',
          20 => 'min-height',
          21 => 'max-height',
        ),
        'CSS.MaxImgLength' => NULL,
        'AutoFormat.AutoParagraph' => false,
        'AutoFormat.RemoveEmpty' => false,
      ),
      'custom_elements' => 
      array (
        0 => 
        array (
          0 => 'u',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
        1 => 
        array (
          0 => 'button',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
        2 => 
        array (
          0 => 'ins',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
      ),
      'custom_attributes' => 
      array (
        0 => 
        array (
          0 => 'a',
          1 => 'rel',
          2 => 'Text',
        ),
        1 => 
        array (
          0 => 'ins',
          1 => 'data-ad-client',
          2 => 'Text',
        ),
        2 => 
        array (
          0 => 'ins',
          1 => 'data-ad-slot',
          2 => 'Text',
        ),
        3 => 
        array (
          0 => 'ins',
          1 => 'data-ad-format',
          2 => 'Text',
        ),
        4 => 
        array (
          0 => 'ins',
          1 => 'data-ad-full-width-responsive',
          2 => 'Text',
        ),
      ),
    ),
  ),
  'log-viewer' => 
  array (
    'storage-path' => '/home/kamrul/php/lara_elections/storage/logs',
    'pattern' => 
    array (
      'prefix' => 'laravel-',
      'date' => '[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]',
      'extension' => '.log',
    ),
    'locale' => 'auto',
    'theme' => 'bootstrap-4',
    'route' => 
    array (
      'enabled' => true,
      'attributes' => 
      array (
        'prefix' => 'log-viewer',
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
      ),
    ),
    'per-page' => 30,
    'download' => 
    array (
      'prefix' => 'laravel-',
      'extension' => 'log',
    ),
    'menu' => 
    array (
      'filter-route' => 'log-viewer::logs.filter',
      'icons-enabled' => true,
    ),
    'icons' => 
    array (
      'all' => 'fa fa-fw fa-list',
      'emergency' => 'fa fa-fw fa-bug',
      'alert' => 'fa fa-fw fa-bullhorn',
      'critical' => 'fa fa-fw fa-heartbeat',
      'error' => 'fa fa-fw fa-times-circle',
      'warning' => 'fa fa-fw fa-exclamation-triangle',
      'notice' => 'fa fa-fw fa-exclamation-circle',
      'info' => 'fa fa-fw fa-info-circle',
      'debug' => 'fa fa-fw fa-life-ring',
    ),
    'colors' => 
    array (
      'levels' => 
      array (
        'empty' => '#D1D1D1',
        'all' => '#8A8A8A',
        'emergency' => '#B71C1C',
        'alert' => '#D32F2F',
        'critical' => '#F44336',
        'error' => '#FF5722',
        'warning' => '#FF9100',
        'notice' => '#4CAF50',
        'info' => '#1976D2',
        'debug' => '#90CAF9',
      ),
    ),
    'highlight' => 
    array (
      0 => '^#\\d+',
      1 => '^Stack trace:',
    ),
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'deprecations' => NULL,
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home/kamrul/php/lara_elections/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home/kamrul/php/lara_elections/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/home/kamrul/php/lara_elections/storage/logs/laravel.log',
      ),
      'deprecations' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'mail.admin.com',
        'port' => '25',
        'encryption' => '0',
        'username' => 'admin@admin.com',
        'password' => '123456',
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -t -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => 'admin@admin.com',
      'name' => 'Elections',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home/kamrul/php/lara_elections/resources/views/vendor/mail',
      ),
    ),
  ),
  'menus' => 
  array (
    'name' => 'Menus',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 73,
    'locations' => 
    array (
      'main-menu' => 'Main Navigation',
      'header-menu' => 'Header Navigation',
      'right-menu' => 'Right Navigation',
      'apps-menu' => 'Apps Navigation',
      'footer-menu' => 'Footer Navigation',
    ),
    'styles' => 
    array (
      'navbar' => 'Nwidart\\Menus\\Presenters\\Bootstrap\\NavbarPresenter',
      'navbar-right' => 'Nwidart\\Menus\\Presenters\\Bootstrap\\NavbarRightPresenter',
      'nav-pills' => 'Nwidart\\Menus\\Presenters\\Bootstrap\\NavPillsPresenter',
      'nav-tab' => 'Nwidart\\Menus\\Presenters\\Bootstrap\\NavTabPresenter',
      'sidebar' => 'Nwidart\\Menus\\Presenters\\Bootstrap\\SidebarMenuPresenter',
      'navmenu' => 'Nwidart\\Menus\\Presenters\\Bootstrap\\NavMenuPresenter',
      'adminlte' => 'Nwidart\\Menus\\Presenters\\Admin\\AdminltePresenter',
      'zurbmenu' => 'Nwidart\\Menus\\Presenters\\Foundation\\ZurbMenuPresenter',
    ),
    'ordering' => true,
  ),
  'modules' => 
  array (
    'namespace' => 'Modules',
    'stubs' => 
    array (
      'enabled' => false,
      'path' => '/home/kamrul/php/lara_elections/vendor/nwidart/laravel-modules/src/Commands/stubs',
      'files' => 
      array (
        'routes/web' => 'Routes/web.php',
        'routes/api' => 'Routes/api.php',
        'views/index' => 'Resources/views/index.blade.php',
        'views/master' => 'Resources/views/layouts/master.blade.php',
        'scaffold/config' => 'Config/config.php',
        'composer' => 'composer.json',
        'assets/js/app' => 'Resources/assets/js/app.js',
        'assets/sass/app' => 'Resources/assets/sass/app.scss',
        'webpack' => 'webpack.mix.js',
        'package' => 'package.json',
      ),
      'replacements' => 
      array (
        'routes/web' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
        ),
        'routes/api' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'webpack' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'json' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'MODULE_NAMESPACE',
          3 => 'PROVIDER_NAMESPACE',
        ),
        'views/index' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'views/master' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
        ),
        'scaffold/config' => 
        array (
          0 => 'STUDLY_NAME',
        ),
        'composer' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'VENDOR',
          3 => 'AUTHOR_NAME',
          4 => 'AUTHOR_EMAIL',
          5 => 'MODULE_NAMESPACE',
          6 => 'PROVIDER_NAMESPACE',
        ),
      ),
      'gitkeep' => true,
    ),
    'paths' => 
    array (
      'modules' => '/home/kamrul/php/lara_elections/Modules',
      'assets' => '/home/kamrul/php/lara_elections/public/modules',
      'migration' => '/home/kamrul/php/lara_elections/database/migrations',
      'generator' => 
      array (
        'config' => 
        array (
          'path' => 'Config',
          'generate' => true,
        ),
        'command' => 
        array (
          'path' => 'Console',
          'generate' => true,
        ),
        'migration' => 
        array (
          'path' => 'Database/Migrations',
          'generate' => true,
        ),
        'seeder' => 
        array (
          'path' => 'Database/Seeders',
          'generate' => true,
        ),
        'factory' => 
        array (
          'path' => 'Database/factories',
          'generate' => true,
        ),
        'model' => 
        array (
          'path' => 'Entities',
          'generate' => true,
        ),
        'routes' => 
        array (
          'path' => 'Routes',
          'generate' => true,
        ),
        'controller' => 
        array (
          'path' => 'Http/Controllers',
          'generate' => true,
        ),
        'filter' => 
        array (
          'path' => 'Http/Middleware',
          'generate' => true,
        ),
        'request' => 
        array (
          'path' => 'Http/Requests',
          'generate' => true,
        ),
        'provider' => 
        array (
          'path' => 'Providers',
          'generate' => true,
        ),
        'assets' => 
        array (
          'path' => 'Resources/assets',
          'generate' => true,
        ),
        'lang' => 
        array (
          'path' => 'Resources/lang',
          'generate' => true,
        ),
        'views' => 
        array (
          'path' => 'Resources/views',
          'generate' => true,
        ),
        'test' => 
        array (
          'path' => 'Tests/Unit',
          'generate' => true,
        ),
        'test-feature' => 
        array (
          'path' => 'Tests/Feature',
          'generate' => true,
        ),
        'repository' => 
        array (
          'path' => 'Repositories',
          'generate' => false,
        ),
        'event' => 
        array (
          'path' => 'Events',
          'generate' => false,
        ),
        'listener' => 
        array (
          'path' => 'Listeners',
          'generate' => false,
        ),
        'policies' => 
        array (
          'path' => 'Policies',
          'generate' => false,
        ),
        'rules' => 
        array (
          'path' => 'Rules',
          'generate' => false,
        ),
        'jobs' => 
        array (
          'path' => 'Jobs',
          'generate' => false,
        ),
        'emails' => 
        array (
          'path' => 'Emails',
          'generate' => false,
        ),
        'notifications' => 
        array (
          'path' => 'Notifications',
          'generate' => false,
        ),
        'resource' => 
        array (
          'path' => 'Transformers',
          'generate' => false,
        ),
        'component-view' => 
        array (
          'path' => 'Resources/views/components',
          'generate' => false,
        ),
        'component-class' => 
        array (
          'path' => 'View/Components',
          'generate' => false,
        ),
      ),
    ),
    'commands' => 
    array (
      0 => 'Nwidart\\Modules\\Commands\\CommandMakeCommand',
      1 => 'Nwidart\\Modules\\Commands\\ComponentClassMakeCommand',
      2 => 'Nwidart\\Modules\\Commands\\ComponentViewMakeCommand',
      3 => 'Nwidart\\Modules\\Commands\\ControllerMakeCommand',
      4 => 'Nwidart\\Modules\\Commands\\DisableCommand',
      5 => 'Nwidart\\Modules\\Commands\\DumpCommand',
      6 => 'Nwidart\\Modules\\Commands\\EnableCommand',
      7 => 'Nwidart\\Modules\\Commands\\EventMakeCommand',
      8 => 'Nwidart\\Modules\\Commands\\JobMakeCommand',
      9 => 'Nwidart\\Modules\\Commands\\ListenerMakeCommand',
      10 => 'Nwidart\\Modules\\Commands\\MailMakeCommand',
      11 => 'Nwidart\\Modules\\Commands\\MiddlewareMakeCommand',
      12 => 'Nwidart\\Modules\\Commands\\NotificationMakeCommand',
      13 => 'Nwidart\\Modules\\Commands\\ProviderMakeCommand',
      14 => 'Nwidart\\Modules\\Commands\\RouteProviderMakeCommand',
      15 => 'Nwidart\\Modules\\Commands\\InstallCommand',
      16 => 'Nwidart\\Modules\\Commands\\ListCommand',
      17 => 'Nwidart\\Modules\\Commands\\ModuleDeleteCommand',
      18 => 'Nwidart\\Modules\\Commands\\ModuleMakeCommand',
      19 => 'Nwidart\\Modules\\Commands\\FactoryMakeCommand',
      20 => 'Nwidart\\Modules\\Commands\\PolicyMakeCommand',
      21 => 'Nwidart\\Modules\\Commands\\RequestMakeCommand',
      22 => 'Nwidart\\Modules\\Commands\\RuleMakeCommand',
      23 => 'Nwidart\\Modules\\Commands\\MigrateCommand',
      24 => 'Nwidart\\Modules\\Commands\\MigrateRefreshCommand',
      25 => 'Nwidart\\Modules\\Commands\\MigrateResetCommand',
      26 => 'Nwidart\\Modules\\Commands\\MigrateRollbackCommand',
      27 => 'Nwidart\\Modules\\Commands\\MigrateStatusCommand',
      28 => 'Nwidart\\Modules\\Commands\\MigrationMakeCommand',
      29 => 'Nwidart\\Modules\\Commands\\ModelMakeCommand',
      30 => 'Nwidart\\Modules\\Commands\\PublishCommand',
      31 => 'Nwidart\\Modules\\Commands\\PublishConfigurationCommand',
      32 => 'Nwidart\\Modules\\Commands\\PublishMigrationCommand',
      33 => 'Nwidart\\Modules\\Commands\\PublishTranslationCommand',
      34 => 'Nwidart\\Modules\\Commands\\SeedCommand',
      35 => 'Nwidart\\Modules\\Commands\\SeedMakeCommand',
      36 => 'Nwidart\\Modules\\Commands\\SetupCommand',
      37 => 'Nwidart\\Modules\\Commands\\UnUseCommand',
      38 => 'Nwidart\\Modules\\Commands\\UpdateCommand',
      39 => 'Nwidart\\Modules\\Commands\\UseCommand',
      40 => 'Nwidart\\Modules\\Commands\\ResourceMakeCommand',
      41 => 'Nwidart\\Modules\\Commands\\TestMakeCommand',
      42 => 'Nwidart\\Modules\\Commands\\LaravelModulesV6Migrator',
      43 => 'Nwidart\\Modules\\Commands\\ComponentClassMakeCommand',
      44 => 'Nwidart\\Modules\\Commands\\ComponentViewMakeCommand',
    ),
    'scan' => 
    array (
      'enabled' => false,
      'paths' => 
      array (
        0 => '/home/kamrul/php/lara_elections/vendor/*/*',
      ),
    ),
    'composer' => 
    array (
      'vendor' => 'nwidart',
      'author' => 
      array (
        'name' => 'Nicolas Widart',
        'email' => 'n.widart@gmail.com',
      ),
      'composer-output' => false,
    ),
    'cache' => 
    array (
      'enabled' => false,
      'key' => 'laravel-modules',
      'lifetime' => 60,
    ),
    'register' => 
    array (
      'translations' => true,
      'files' => 'register',
    ),
    'activators' => 
    array (
      'file' => 
      array (
        'class' => 'Nwidart\\Modules\\Activators\\FileActivator',
        'statuses-file' => '/home/kamrul/php/lara_elections/modules_statuses.json',
        'cache-key' => 'activator.installed',
        'cache-lifetime' => 604800,
      ),
    ),
    'activator' => 'file',
  ),
  'newsletter' => 
  array (
    'name' => 'Newsletter',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 24,
  ),
  'post' => 
  array (
    'name' => 'Post',
    'module_version' => '1.3',
    'module_type' => 'plugin',
    'pid' => 69,
    'templates' => 
    array (
      'default' => 'Default',
    ),
  ),
  'purifier' => 
  array (
    'encoding' => 'UTF-8',
    'finalize' => true,
    'ignoreNonStrings' => false,
    'cachePath' => '/home/kamrul/php/lara_elections/storage/app/purifier',
    'cacheFileMode' => 493,
    'settings' => 
    array (
      'default' => 
      array (
        'HTML.Doctype' => 'HTML 4.01 Transitional',
        'HTML.Allowed' => 'div,b,strong,i,em,u,a[href|title|rel|style|target],ul,ol,li,p[style],br,span[style],img[width|height|alt|src|style],button,ins[style|data-ad-client|data-ad-slot|data-ad-format|data-full-width-responsive]',
        'HTML.AllowedElements' => 
        array (
          0 => 'a',
          1 => 'b',
          2 => 'blockquote',
          3 => 'br',
          4 => 'code',
          5 => 'em',
          6 => 'h1',
          7 => 'h2',
          8 => 'h3',
          9 => 'h4',
          10 => 'h5',
          11 => 'h6',
          12 => 'hr',
          13 => 'i',
          14 => 'img',
          15 => 'li',
          16 => 'ol',
          17 => 'p',
          18 => 'pre',
          19 => 's',
          20 => 'span',
          21 => 'strong',
          22 => 'sub',
          23 => 'sup',
          24 => 'table',
          25 => 'tbody',
          26 => 'td',
          27 => 'th',
          28 => 'thead',
          29 => 'tr',
          30 => 'u',
          31 => 'ul',
          32 => 'pre',
          33 => 'abbr',
          34 => 'kbd',
          35 => 'var',
          36 => 'samp',
          37 => 'hr',
          38 => 'iframe',
          39 => 'figure',
          40 => 'figcaption',
          41 => 'section',
          42 => 'article',
          43 => 'aside',
          44 => 'blockquote',
          45 => 'caption',
          46 => 'del',
          47 => 'div',
          48 => 'button',
          49 => 'ins',
        ),
        'HTML.SafeIframe' => 'true',
        'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
        'Attr.AllowedFrameTargets' => 
        array (
          0 => '_blank',
        ),
        'CSS.AllowedProperties' => 
        array (
          0 => 'font',
          1 => 'font-size',
          2 => 'font-weight',
          3 => 'font-style',
          4 => 'font-family',
          5 => 'text-decoration',
          6 => 'padding-left',
          7 => 'color',
          8 => 'background-color',
          9 => 'text-align',
          10 => 'max-width',
          11 => 'border',
          12 => 'width',
          13 => 'line-height',
          14 => 'word-spacing',
          15 => 'border-style',
          16 => 'list-style-type',
          17 => 'border-color',
          18 => 'height',
          19 => 'min-width',
          20 => 'min-height',
          21 => 'max-height',
        ),
        'CSS.MaxImgLength' => NULL,
        'AutoFormat.AutoParagraph' => false,
        'AutoFormat.RemoveEmpty' => false,
      ),
      'test' => 
      array (
        'Attr.EnableID' => 'true',
      ),
      'youtube' => 
      array (
        'HTML.SafeIframe' => 'true',
        'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
      ),
      'custom_definition' => 
      array (
        'id' => 'html5-definitions',
        'rev' => 1,
        'debug' => false,
        'elements' => 
        array (
          0 => 
          array (
            0 => 'section',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          1 => 
          array (
            0 => 'nav',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          2 => 
          array (
            0 => 'article',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          3 => 
          array (
            0 => 'aside',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          4 => 
          array (
            0 => 'header',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          5 => 
          array (
            0 => 'footer',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          6 => 
          array (
            0 => 'address',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          7 => 
          array (
            0 => 'hgroup',
            1 => 'Block',
            2 => 'Required: h1 | h2 | h3 | h4 | h5 | h6',
            3 => 'Common',
          ),
          8 => 
          array (
            0 => 'figure',
            1 => 'Block',
            2 => 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow',
            3 => 'Common',
          ),
          9 => 
          array (
            0 => 'figcaption',
            1 => 'Inline',
            2 => 'Flow',
            3 => 'Common',
          ),
          10 => 
          array (
            0 => 'video',
            1 => 'Block',
            2 => 'Optional: (source, Flow) | (Flow, source) | Flow',
            3 => 'Common',
            4 => 
            array (
              'src' => 'URI',
              'type' => 'Text',
              'width' => 'Length',
              'height' => 'Length',
              'poster' => 'URI',
              'preload' => 'Enum#auto,metadata,none',
              'controls' => 'Bool',
            ),
          ),
          11 => 
          array (
            0 => 'source',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'src' => 'URI',
              'type' => 'Text',
            ),
          ),
          12 => 
          array (
            0 => 's',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          13 => 
          array (
            0 => 'var',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          14 => 
          array (
            0 => 'sub',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          15 => 
          array (
            0 => 'sup',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          16 => 
          array (
            0 => 'mark',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          17 => 
          array (
            0 => 'wbr',
            1 => 'Inline',
            2 => 'Empty',
            3 => 'Core',
          ),
          18 => 
          array (
            0 => 'ins',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'cite' => 'URI',
              'datetime' => 'CDATA',
            ),
          ),
          19 => 
          array (
            0 => 'del',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'cite' => 'URI',
              'datetime' => 'CDATA',
            ),
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            0 => 'iframe',
            1 => 'allowfullscreen',
            2 => 'Bool',
          ),
          1 => 
          array (
            0 => 'table',
            1 => 'height',
            2 => 'Text',
          ),
          2 => 
          array (
            0 => 'td',
            1 => 'border',
            2 => 'Text',
          ),
          3 => 
          array (
            0 => 'th',
            1 => 'border',
            2 => 'Text',
          ),
          4 => 
          array (
            0 => 'tr',
            1 => 'width',
            2 => 'Text',
          ),
          5 => 
          array (
            0 => 'tr',
            1 => 'height',
            2 => 'Text',
          ),
          6 => 
          array (
            0 => 'tr',
            1 => 'border',
            2 => 'Text',
          ),
        ),
      ),
      'custom_attributes' => 
      array (
        0 => 
        array (
          0 => 'a',
          1 => 'rel',
          2 => 'Text',
        ),
        1 => 
        array (
          0 => 'ins',
          1 => 'data-ad-client',
          2 => 'Text',
        ),
        2 => 
        array (
          0 => 'ins',
          1 => 'data-ad-slot',
          2 => 'Text',
        ),
        3 => 
        array (
          0 => 'ins',
          1 => 'data-ad-format',
          2 => 'Text',
        ),
        4 => 
        array (
          0 => 'ins',
          1 => 'data-ad-full-width-responsive',
          2 => 'Text',
        ),
      ),
      'custom_elements' => 
      array (
        0 => 
        array (
          0 => 'u',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
        1 => 
        array (
          0 => 'button',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
        2 => 
        array (
          0 => 'ins',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'localhost',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
      'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'seohelper' => 
  array (
    'name' => 'SeoHelper',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 94,
    'title' => 
    array (
      'separator' => '-',
      'first' => true,
      'max' => 120,
    ),
    'description' => 
    array (
      'max' => 386,
    ),
    'misc' => 
    array (
      'canonical' => true,
      'robots' => false,
      'default' => 
      array (
        'viewport' => 'width=device-width, initial-scale=1',
        'author' => '',
        'publisher' => '',
      ),
    ),
    'webmasters' => 
    array (
      'google' => '',
      'bing' => '',
      'alexa' => '',
      'pinterest' => '',
      'yandex' => '',
    ),
    'open-graph' => 
    array (
      'prefix' => 'og:',
      'type' => 'website',
      'properties' => 
      array (
      ),
    ),
    'twitter' => 
    array (
      'prefix' => 'twitter:',
      'card' => 'summary',
      'metas' => 
      array (
      ),
    ),
    'analytics' => 
    array (
      'google' => '',
    ),
    'supported' => 
    array (
      0 => 'Modules\\Post\\Http\\Models\\Page',
      1 => 'Modules\\AdminBoard\\Http\\Models\\AdminWorkshop',
      2 => 'Modules\\AdminBoard\\Http\\Models\\AdminNews',
      3 => 'Modules\\AdminBoard\\Http\\Models\\AdminEvent',
      4 => 'Modules\\AdminBoard\\Http\\Models\\AdminTeam',
      5 => 'Modules\\AdminBoard\\Http\\Models\\AdminNoticeBoard',
      6 => 'Modules\\AdminBoard\\Http\\Models\\AdminAcademicGroup',
      7 => 'Modules\\AdminBoard\\Http\\Models\\AdminGalleryBoard',
      8 => 'Modules\\AdminBoard\\Http\\Models\\AdminClub',
      9 => 'Modules\\AdminBoard\\Http\\Models\\AdminService',
      10 => 'Modules\\AdminBoard\\Http\\Models\\AdminPackage',
      11 => 'Modules\\AdminBoard\\Http\\Models\\AdminFtpServer',
      12 => 'Modules\\AdminBoard\\Http\\Models\\AdminPartner',
      13 => 'Modules\\Post\\Http\\Models\\Post',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/kamrul/php/lara_elections/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'kamruldashboard_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'shortcodes' => 
  array (
    'name' => 'Shortcodes',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 77,
  ),
  'sitemap' => 
  array (
    'name' => 'Sitemap',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 50,
    'use_cache' => false,
    'cache_key' => 'cms-sitemap.http://localhost',
    'cache_duration' => 3600,
    'escaping' => true,
    'use_limit_size' => false,
    'max_size' => NULL,
    'use_styles' => true,
    'styles_location' => '/vendor/sitemap/styles/',
    'use_gzip' => false,
  ),
  'testimonial' => 
  array (
    'name' => 'Testimonial',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 55,
  ),
  'theme' => 
  array (
    'name' => 'Theme',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 84,
    'public_theme_name' => NULL,
    'events' => 
    array (
    ),
    'containerDir' => 
    array (
      'layout' => 'layouts',
      'asset' => '',
      'partial' => 'partials',
      'view' => 'views',
    ),
    'themeDefault' => 'default',
    'themeDir' => 'themes',
    'display_theme_manager_in_admin_panel' => true,
  ),
  'themeicon' => 
  array (
    'name' => 'ThemeIcon',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 52,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home/kamrul/php/lara_elections/resources/views',
    ),
    'compiled' => '/home/kamrul/php/lara_elections/storage/framework/views',
  ),
  'widget' => 
  array (
    'name' => 'Widget',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 92,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'public_path' => NULL,
    'convert_entities' => true,
    'options' => 
    array (
      'font_dir' => '/home/kamrul/php/lara_elections/storage/fonts',
      'font_cache' => '/home/kamrul/php/lara_elections/storage/fonts',
      'temp_dir' => '/tmp',
      'chroot' => '/home/kamrul/php/lara_elections',
      'allowed_protocols' => 
      array (
        'file://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'http://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'https://' => 
        array (
          'rules' => 
          array (
          ),
        ),
      ),
      'log_output_file' => NULL,
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_paper_orientation' => 'portrait',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => true,
    ),
  ),
  'snappy' => 
  array (
    'pdf' => 
    array (
      'enabled' => true,
      'binary' => '/usr/bin/wkhtmltopdf',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
    'image' => 
    array (
      'enabled' => true,
      'binary' => '/usr/local/bin/wkhtmltoimage',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
  ),
  'laravel-form-builder' => 
  array (
    'defaults' => 
    array (
      'wrapper_class' => 'form-group mb-3 col-md-12',
      'wrapper_error_class' => 'has-error',
      'label_class' => 'control-label',
      'field_class' => 'form-control',
      'field_error_class' => '',
      'help_block_class' => 'help-block',
      'error_class' => 'text-danger',
      'required_class' => 'required',
      'help_block_tag' => 'p',
    ),
    'form' => 'laravel-form-builder::form',
    'text' => 'laravel-form-builder::text',
    'textarea' => 'laravel-form-builder::textarea',
    'button' => 'laravel-form-builder::button',
    'buttongroup' => 'laravel-form-builder::buttongroup',
    'radio' => 'laravel-form-builder::radio',
    'checkbox' => 'laravel-form-builder::checkbox',
    'select' => 'laravel-form-builder::select',
    'choice' => 'laravel-form-builder::choice',
    'repeated' => 'laravel-form-builder::repeated',
    'child_form' => 'laravel-form-builder::child_form',
    'collection' => 'laravel-form-builder::collection',
    'static' => 'laravel-form-builder::static',
    'template_prefix' => '',
    'default_namespace' => '',
    'custom_fields' => 
    array (
    ),
    'plain_form_class' => 'Kris\\LaravelFormBuilder\\Form',
    'form_builder_class' => 'Kris\\LaravelFormBuilder\\FormBuilder',
    'form_helper_class' => 'Kris\\LaravelFormBuilder\\FormHelper',
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => '',
    ),
    'pdf_generator' => 'snappy',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
    'parameters' => 
    array (
      'dom' => 'Bfrtip',
      'order' => 
      array (
        0 => 
        array (
          0 => 0,
          1 => 'desc',
        ),
      ),
      'buttons' => 
      array (
        0 => 'create',
        1 => 'export',
        2 => 'print',
        3 => 'reset',
        4 => 'reload',
      ),
    ),
    'generator' => 
    array (
      'columns' => 'id,add your columns,created_at,updated_at',
      'buttons' => 'create,export,print,reset,reload',
      'dom' => 'Bfrtip',
    ),
  ),
  'datatables-html' => 
  array (
    'namespace' => 'LaravelDataTables',
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'ziggy' => 
  array (
    'except' => 
    array (
      0 => 'debugbar.*',
    ),
  ),
  'Modules' => 
  array (
    'AdminBoard' => 
    array (
      'email' => 
      array (
        'name' => 'adminboard::settings.email.title',
        'description' => 'adminboard::settings.email.description',
        'templates' => 
        array (
          'notice' => 
          array (
            'title' => 'New consult',
            'description' => 'Send to the agent email / admin email when someone contact via consult form',
            'subject' => 'New consult',
            'can_off' => true,
            'variables' => 
            array (
              'consult_name' => 'Name',
              'consult_phone' => 'Phone',
              'consult_email' => 'Email',
              'consult_content' => 'Content',
              'consult_link' => 'Link',
              'consult_subject' => 'Subject',
              'consult_ip_address' => 'IP address',
            ),
          ),
          'new-pending-property' => 
          array (
            'title' => 'New pending property',
            'description' => 'Send email to admin when a new property created',
            'subject' => 'New pending property by {{ post_author }} waiting for approve',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'post_author' => 'Post Author',
              'post_name' => 'Post Name',
              'post_url' => 'Post URL',
            ),
          ),
          'account-registered' => 
          array (
            'title' => 'Account registered',
            'description' => 'Send a notification to admin when a new account registered',
            'subject' => 'New account registered on {{ site_title }}',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'account_name' => 'Account name',
              'account_email' => 'Account email',
            ),
          ),
          'confirm-email' => 
          array (
            'title' => 'Confirm email',
            'description' => 'Send email to user when they register an account to verify their email',
            'subject' => 'Confirm Email Notification',
            'can_off' => false,
            'variables' => 
            array (
              'verify_link' => 'Verify email link',
            ),
          ),
          'password-reminder' => 
          array (
            'title' => 'Reset password',
            'description' => 'Send email to user when requesting reset password',
            'subject' => 'Reset Password',
            'can_off' => false,
            'variables' => 
            array (
              'reset_link' => 'Reset password link',
            ),
          ),
          'payment-receipt' => 
          array (
            'title' => 'Payment receipt',
            'description' => 'Send a notification to user when they buy credits',
            'subject' => 'Payment receipt for package {{ package_name }} on {{ site_title }}',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'account_name' => 'Account name',
              'account_email' => 'Account email',
              'package_name' => 'Name of package',
              'package_price' => 'Price',
              'package_percent_discount' => 'Discount',
              'package_number_of_listings' => 'Number of package listings',
            ),
          ),
          'free-credit-claimed' => 
          array (
            'title' => 'Free credit claimed',
            'description' => 'Send a notification to admin when free credit is claimed',
            'subject' => '{{ account_name }} has claimed free credit on {{ site_title }}',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'account_name' => 'Account name',
              'account_email' => 'Account email',
            ),
          ),
          'payment-received' => 
          array (
            'title' => 'Payment received',
            'description' => 'Send a notification to admin when someone buy credits',
            'subject' => 'Payment received from {{ account_name }} on {{ site_title }}',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'account_name' => 'Account name',
              'account_email' => 'Account email',
              'package_name' => 'Name of package',
              'package_price' => 'Price',
              'package_percent_discount' => 'Discount',
              'package_number_of_listings' => 'Number of package listings',
            ),
          ),
        ),
      ),
      'config' => 
      array (
        'name' => 'AdminBoard',
        'use_language_v2' => true,
        'module_version' => '2.8',
        'module_type' => 'plugin',
        'enable_faq_in_event_details' => true,
        'pid' => 21,
      ),
    ),
    'ContactForm' => 
    array (
      'email' => 
      array (
        'name' => 'contactform::contact.settings.email.title',
        'description' => 'contactform::contact.settings.email.description',
        'templates' => 
        array (
          'notice' => 
          array (
            'title' => 'contactform::contact.settings.email.templates.notice_title',
            'description' => 'contactform::contact.settings.email.templates.notice_description',
            'subject' => 'Message sent via your contact form from {{ site_title }}',
            'can_off' => true,
            'variables' => 
            array (
              'contact_name' => 'Contact name',
              'contact_subject' => 'Contact subject',
              'contact_email' => 'Contact email',
              'contact_phone' => 'Contact phone',
              'contact_address' => 'Contact address',
              'contact_content' => 'Contact content',
            ),
          ),
        ),
      ),
    ),
    'Icon' => 
    array (
      'icon' => 
      array (
        'className' => 'icon',
        'attributes' => 
        array (
        ),
      ),
    ),
    'KamrulDashboard' => 
    array (
      'assets' => 
      array (
        'offline' => true,
        'enable_version' => true,
        'version' => '2.2.1',
        'scripts' => 
        array (
          0 => 'global',
          1 => 'quixnav-init',
          2 => 'custom',
          3 => 'select2',
          4 => 'datepicker',
          5 => 'app',
          6 => 'toastr',
          7 => 'toastr_script',
          8 => 'language-global',
        ),
        'styles' => 
        array (
          0 => 'color_picker',
          1 => 'style',
          2 => 'font-icons',
          3 => 'toastr_css',
          4 => 'select2',
          5 => 'datepicker',
          6 => 'waypoints',
          7 => 'style_custom',
          8 => 'language',
        ),
        'resources' => 
        array (
          'scripts' => 
          array (
            'toastr' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor/toastr/js/toastr.min.js',
              ),
            ),
            'toastr_script' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/js/toastr_script.js',
              ),
            ),
            'global' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor/global/global.min.js',
              ),
            ),
            'quixnav-init' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/js/quixnav-init.js',
              ),
            ),
            'custom' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/js/custom.min.js',
              ),
            ),
            'custom-scrollbar' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/mCustomScrollbar/jquery.mCustomScrollbar.js',
              ),
            ),
            'excanvas' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/excanvas/excanvas.min.js',
              ),
            ),
            'fancybox' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/fancybox/jquery.fancybox.min.js',
              ),
            ),
            'are-you-sure' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/are-you-sure/jquery.are-you-sure.js',
              ),
            ),
            'waypoints' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/waypoints/jquery.waypoints.min.js',
              ),
            ),
            'slug' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/slug/slug.js',
              ),
            ),
            'spectrum' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/spectrum/spectrum.js',
              ),
            ),
            'jquery-ui' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/jquery-ui/jquery-ui.min.js',
              ),
            ),
            'language-global' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/Language/js/language-global.js',
              ),
            ),
            'stickyTableHeaders' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/StickyTableHeaders/jquery.stickytableheaders.min.js',
              ),
            ),
            'select2' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/select2/js/select2.min.js',
              ),
            ),
            'datepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/flatpickr/flatpickr.min.js',
              ),
            ),
            'datetimepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
              ),
            ),
            'clockpicker' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/Modules/KamrulDashboard/vendor/clockpicker/js/bootstrap-clockpicker.min.js',
                  1 => '/vendor/Modules/KamrulDashboard/js/plugins-init/clock-picker-init.js',
                ),
              ),
            ),
            'timepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
              ),
            ),
            'input-mask' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/jquery-inputmask/jquery.inputmask.bundle.min.js',
              ),
            ),
            'app' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/js/app.js',
              ),
            ),
            'vue-app' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/js/vue-app.js',
              ),
            ),
            'blockui' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/jquery.blockUI.js',
              ),
            ),
            'dropzone' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/dropzone/dist/min/dropzone.min.js',
              ),
            ),
            'color_picker' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/Modules/KamrulDashboard/vendor/jquery-asColor/jquery-asColor.min.js',
                  1 => '/vendor/Modules/KamrulDashboard/vendor/jquery-asGradient/jquery-asGradient.min.js',
                  2 => '/vendor/Modules/KamrulDashboard/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js',
                  3 => '/vendor/Modules/KamrulDashboard/js/plugins-init/jquery-asColorPicker.init.js',
                ),
              ),
            ),
            'datatables' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/Modules/KamrulDashboard/vendor2/DataTables/DataTables/js/jquery.dataTables.min.js',
                  1 => '/vendor/Modules/KamrulDashboard/vendor2/DataTables/DataTables/js/dataTables.bootstrap.min.js',
                  2 => '/vendor/Modules/KamrulDashboard/vendor2/DataTables/Buttons/js/dataTables.buttons.min.js',
                  3 => '/vendor/Modules/KamrulDashboard/vendor2/DataTables/Buttons/js/buttons.bootstrap.min.js',
                  4 => '/vendor/Modules/KamrulDashboard/vendor2/DataTables/Responsive/js/dataTables.responsive.min.js',
                ),
              ),
            ),
            'form-validation' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/js-validation/js/js-validation.js',
              ),
            ),
            'moment' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/moment-with-locales.min.js',
              ),
            ),
            'bootstrap3-editable' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor/bootstrap3-editable/js/bootstrap-editable.js',
              ),
            ),
            'tagify' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/tagify/tagify.js',
              ),
            ),
            'ckeditor' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'attributes' => 
              array (
                'type' => 'module',
              ),
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/Modules/KamrulDashboard/js/ckeditor/script.js',
                  1 => '/vendor/Modules/KamrulDashboard/js/ckeditor/ckeditor.js',
                  2 => '/vendor/Modules/KamrulDashboard/js/ckeditor/editor.js',
                ),
              ),
            ),
            'apexchart' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/apexchart/apexcharts.min.js',
              ),
            ),
            'jquery-nestable' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/jquery-nestable/jquery.nestable.min.js',
              ),
            ),
          ),
          'styles' => 
          array (
            'toastr_css' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor/toastr/css/toastr.min.css',
              ),
            ),
            'style' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/css/style.css',
              ),
            ),
            'style_custom' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/css/style_custom.css',
              ),
            ),
            'bootstrap3-editable' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor/bootstrap3-editable/css/bootstrap-editable.css',
              ),
            ),
            'spectrum' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/spectrum/spectrum.css',
              ),
            ),
            'fancybox' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/fancybox/jquery.fancybox.min.css',
              ),
            ),
            'menu_custom' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/Menus/css/menu_custom.css',
              ),
            ),
            'color_picker' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor/jquery-asColorPicker/css/asColorPicker.min.css',
              ),
            ),
            'jquery-ui' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/jquery-ui/jquery-ui.min.css',
              ),
            ),
            'tagify' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/tagify/tagify.css',
              ),
            ),
            'font-icons' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/icons/font-icons.css',
              ),
            ),
            'custom-scrollbar' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/mCustomScrollbar/jquery.mCustomScrollbar.css',
              ),
            ),
            'select2' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/Modules/KamrulDashboard/vendor2/select2/css/select2.min.css',
                  1 => '/vendor/Modules/KamrulDashboard/vendor2/select2/css/select2-bootstrap.min.css',
                ),
              ),
            ),
            'slug' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/slug/slug.css',
              ),
            ),
            'datepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/flatpickr/flatpickr.min.css',
              ),
            ),
            'datetimepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css',
              ),
            ),
            'clockpicker' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor/clockpicker/css/bootstrap-clockpicker.min.css',
              ),
            ),
            'timepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
              ),
            ),
            'dropzone' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/dropzone/dist/min/dropzone.min.css',
              ),
            ),
            'language' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/language/css/language.css',
              ),
            ),
            'datatables' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/Modules/KamrulDashboard/vendor2/DataTables/DataTables/css/dataTables.bootstrap.min.css',
                  1 => '/vendor/Modules/KamrulDashboard/vendor2/DataTables/Buttons/css/buttons.bootstrap.min.css',
                  2 => '/vendor/Modules/KamrulDashboard/vendor2/DataTables/Responsive/css/responsive.bootstrap.min.css',
                ),
              ),
            ),
            'apexchart' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/apexchart/apexcharts.css',
              ),
            ),
            'jquery-nestable' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/Modules/KamrulDashboard/vendor2/jquery-nestable/jquery.nestable.min.css',
              ),
            ),
          ),
        ),
      ),
      'media' => 
      array (
        'sizes' => 
        array (
          'thumb' => '150x150',
        ),
        'permissions' => 
        array (
          0 => 'folders.create',
          1 => 'folders.edit',
          2 => 'folders.trash',
          3 => 'folders.destroy',
          4 => 'files.create',
          5 => 'files.edit',
          6 => 'files.trash',
          7 => 'files.destroy',
          8 => 'files.favorite',
          9 => 'folders.favorite',
        ),
        'libraries' => 
        array (
          'stylesheets' => 
          array (
            0 => 'vendor/Modules/KamrulDashboard/libraries/jquery-context-menu/jquery.contextMenu.min.css',
            1 => 'vendor/Modules/KamrulDashboard/css/media.css?v=1765455153',
          ),
          'javascript' => 
          array (
            0 => 'vendor/Modules/KamrulDashboard/libraries/lodash/lodash.min.js',
            1 => 'vendor/Modules/KamrulDashboard/libraries/clipboard/clipboard.min.js',
            2 => 'vendor/Modules/KamrulDashboard/libraries/dropzone/dropzone.js',
            3 => 'vendor/Modules/KamrulDashboard/libraries/jquery-context-menu/jquery.ui.position.min.js',
            4 => 'vendor/Modules/KamrulDashboard/libraries/jquery-context-menu/jquery.contextMenu.min.js',
            5 => 'vendor/Modules/KamrulDashboard/js/media.js?v=1765455153',
          ),
        ),
        'allowed_mime_types' => 'jpg,jpeg,png,gif,txt,docx,zip,mp3,bmp,csv,xls,xlsx,ppt,pptx,pdf,mp4,doc,mpga,wav,webp',
        'mime_types' => 
        array (
          'image' => 
          array (
            0 => 'image/png',
            1 => 'image/jpeg',
            2 => 'image/gif',
            3 => 'image/bmp',
            4 => 'image/svg+xml',
            5 => 'image/webp',
          ),
          'video' => 
          array (
            0 => 'video/mp4',
          ),
          'document' => 
          array (
            0 => 'application/pdf',
            1 => 'application/vnd.ms-excel',
            2 => 'application/excel',
            3 => 'application/x-excel',
            4 => 'application/x-msexcel',
            5 => 'text/plain',
            6 => 'application/msword',
            7 => 'text/csv',
            8 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            9 => 'application/vnd.ms-powerpoint',
            10 => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
          ),
        ),
        'default_image' => '/vendor/Modules/KamrulDashboard/images/placeholder.png',
        'sidebar_display' => 'horizontal',
        'watermark' => 
        array (
          'enabled' => 0,
          'source' => NULL,
          'size' => 10,
          'opacity' => 70,
          'position' => 'bottom-right',
          'x' => 10,
          'y' => 10,
        ),
        'chunk' => 
        array (
          'enabled' => false,
          'chunk_size' => 1048576,
          'max_file_size' => 1048576,
          'storage' => 
          array (
            'tmp' => 'tmp',
            'chunks' => 'chunks',
            'disk' => 'local',
          ),
          'clear' => 
          array (
            'timestamp' => '-3 HOURS',
            'schedule' => 
            array (
              'enabled' => true,
              'cron' => '25 * * * *',
            ),
          ),
          'chunk' => 
          array (
            'name' => 
            array (
              'use' => 
              array (
                'session' => true,
                'browser' => false,
              ),
            ),
          ),
        ),
        'preview' => 
        array (
          'document' => 
          array (
            'enabled' => true,
            'default' => 'microsoft',
            'type' => 'iframe',
            'mime_types' => 
            array (
              0 => 'application/pdf',
              1 => 'application/vnd.ms-excel',
              2 => 'application/excel',
              3 => 'application/x-excel',
              4 => 'application/x-msexcel',
              5 => 'application/msword',
              6 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
              7 => 'application/vnd.ms-powerpoint',
              8 => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
              9 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ),
          ),
        ),
        'default_upload_url' => 'http://localhost/storage',
        'generate_thumbnails_enabled' => true,
      ),
      'email' => 
      array (
        'name' => 'kamruldashboard::setting.email.template_title',
        'description' => 'kamruldashboard::setting.email.template_description',
        'templates' => 
        array (
          'header' => 
          array (
            'title' => 'kamruldashboard::setting.email.template_header',
            'description' => 'kamruldashboard::setting.email.template_header_description',
          ),
          'footer' => 
          array (
            'title' => 'kamruldashboard::setting.email.template_footer',
            'description' => 'kamruldashboard::setting.email.template_footer_description',
          ),
          'password-reminder' => 
          array (
            'title' => 'Reset password',
            'description' => 'Send email to user when requesting reset password',
            'subject' => 'Reset Password',
            'can_off' => false,
            'variables' => 
            array (
              'reset_link' => 'Reset password link',
            ),
          ),
          'test' => 
          array (
            'title' => 'kamruldashboard::setting.email.test_email',
            'description' => 'kamruldashboard::setting.email.test_email_description',
            'subject' => 'Message sent Test mail',
            'can_off' => false,
          ),
        ),
      ),
    ),
    'Newsletter' => 
    array (
      'email' => 
      array (
        'name' => 'newsletter::newsletter.settings.email.templates.title',
        'description' => 'newsletter::newsletter.settings.email.templates.description',
        'templates' => 
        array (
          'subscriber_email' => 
          array (
            'title' => 'newsletter::newsletter.settings.email.templates.to_user.title',
            'description' => 'newsletter::newsletter.settings.email.templates.to_user.description',
            'subject' => '{{ site_title }}: Subscription Confirmed!',
            'can_off' => true,
            'variables' => 
            array (
              'newsletter_name' => 'Full name of user who subscribe newsletter',
              'newsletter_email' => 'Email of user who subscribe newsletter',
              'newsletter_unsubscribe_link' => 'Link for unsubscribe newsletter',
            ),
          ),
          'admin_email' => 
          array (
            'title' => 'newsletter::newsletter.settings.email.templates.to_admin.title',
            'description' => 'newsletter::newsletter.settings.email.templates.to_admin.description',
            'subject' => 'New user subscribed your newsletter',
            'can_off' => true,
            'variables' => 
            array (
              'newsletter_email' => 'Email of user who subscribe newsletter',
            ),
          ),
        ),
        'variables' => 
        array (
        ),
      ),
    ),
    'Post' => 
    array (
      'config' => 
      array (
        'name' => 'Post',
        'module_version' => '1.3',
        'module_type' => 'plugin',
        'pid' => 69,
        'templates' => 
        array (
          'default' => 'Default',
        ),
      ),
    ),
    'Sitemap' => 
    array (
      'config' => 
      array (
        'name' => 'Sitemap',
        'module_version' => '1.0',
        'module_type' => 'plugin',
        'pid' => 50,
        'use_cache' => false,
        'cache_key' => 'cms-sitemap.http://localhost',
        'cache_duration' => 3600,
        'escaping' => true,
        'use_limit_size' => false,
        'max_size' => NULL,
        'use_styles' => true,
        'styles_location' => '/vendor/Modules/Sitemap/styles/',
        'use_gzip' => false,
      ),
    ),
  ),
  'adminboard' => 
  array (
    'name' => 'AdminBoard',
    'use_language_v2' => true,
    'module_version' => '2.8',
    'module_type' => 'plugin',
    'enable_faq_in_event_details' => true,
    'pid' => 21,
  ),
  'languageadvanced' => 
  array (
    'name' => 'LanguageAdvanced',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 46,
    'supported' => 
    array (
      'Modules\\AdminBoard\\Http\\Models\\AdminPartner' => 
      array (
        0 => 'name',
        1 => 'tag_line',
        2 => 'description',
        3 => 'short_description',
      ),
      'Modules\\AdminBoard\\Http\\Models\\AdminEvent' => 
      array (
        0 => 'name',
        1 => 'set_time',
        2 => 'content',
        3 => 'short_description',
        4 => 'description',
        5 => 'faq_schema_config',
        6 => 'courses_learn_schema_config',
      ),
      'Modules\\AdminBoard\\Http\\Models\\AdminNews' => 
      array (
        0 => 'name',
        1 => 'description',
        2 => 'short_description',
      ),
      'Modules\\Post\\Http\\Models\\Page' => 
      array (
        0 => 'name',
        1 => 'description',
        2 => 'short_description',
      ),
      'Modules\\Post\\Http\\Models\\Category' => 
      array (
        0 => 'name',
        1 => 'description',
        2 => 'short_description',
      ),
      'Modules\\Location\\Http\\Models\\Country' => 
      array (
        0 => 'name',
        1 => 'nationality',
      ),
      'Modules\\Location\\Http\\Models\\State' => 
      array (
        0 => 'name',
        1 => 'abbreviation',
      ),
      'Modules\\Location\\Http\\Models\\City' => 
      array (
        0 => 'name',
      ),
    ),
    'translatable_meta_boxes' => 
    array (
      0 => 'faq_schema_config_wrapper',
      1 => 'courses_learn_schema_config_wrapper',
    ),
    'page_use_language_v2' => true,
    'category_use_language_v2' => true,
  ),
  'admission' => 
  array (
    'name' => 'Admission',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 92,
  ),
  'assets' => 
  array (
    'offline' => true,
    'enable_version' => false,
    'version' => 1765455153,
    'scripts' => 
    array (
      0 => 'modernizr',
      1 => 'app',
    ),
    'styles' => 
    array (
      0 => 'bootstrap',
    ),
    'resources' => 
    array (
      'scripts' => 
      array (
        'app' => 
        array (
          'use_cdn' => false,
          'location' => 'footer',
          'src' => 
          array (
            'local' => '/js/app.js',
          ),
        ),
        'modernizr' => 
        array (
          'use_cdn' => true,
          'location' => 'header',
          'src' => 
          array (
            'local' => '/vendor/kamruldashboard/modernizr/modernizr.min.js',
            'cdn' => '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js',
          ),
        ),
      ),
      'styles' => 
      array (
        'bootstrap' => 
        array (
          'use_cdn' => true,
          'location' => 'header',
          'src' => 
          array (
            'local' => '/kamruldashboard/bootstrap/css/bootstrap.min.css',
            'cdn' => '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css',
          ),
          'attributes' => 
          array (
            'integrity' => 'sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB',
            'crossorigin' => 'anonymous',
          ),
        ),
      ),
    ),
  ),
  'awesomeicon' => 
  array (
    'name' => 'AwesomeIcon',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 96,
  ),
  'captcha' => 
  array (
    'name' => 'Captcha',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 47,
    'type' => 'v2',
    'secret' => 'no-captcha-secret',
    'site_key' => 'no-captcha-site-key',
    'hide_badge' => false,
    'request_method' => NULL,
    'options' => 
    array (
      'multiple' => false,
      'lang' => 'en',
    ),
    'attributes' => 
    array (
      'theme' => 'light',
    ),
    'math-captcha' => 
    array (
      'operands' => 
      array (
        0 => '+',
        1 => '-',
        2 => '*',
      ),
      'rand-min' => 2,
      'rand-max' => 5,
    ),
  ),
  'election' => 
  array (
    'name' => 'Election',
    'module_version' => '1.1',
    'module_type' => 'plugin',
    'pid' => 63,
  ),
  'faq' => 
  array (
    'name' => 'Faq',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 22,
    'schema_supported' => 
    array (
      0 => 'Modules\\Post\\Http\\Models\\Page',
      1 => 'Modules\\Post\\Http\\Models\\Post',
    ),
    'use_language_v2' => false,
  ),
  'icon' => 
  array (
    'name' => 'Icon',
    'className' => 'icon',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 25,
    'attributes' => 
    array (
    ),
  ),
  'language' => 
  array (
    'name' => 'Language',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 60,
    'supported' => 
    array (
      0 => 'Modules\\Menus\\Http\\Models\\Menus',
      1 => 'Modules\\Menus\\Http\\Models\\MenusLocation',
      2 => 'Modules\\Faq\\Http\\Models\\Faq',
      3 => 'Modules\\Faq\\Http\\Models\\FaqCategory',
      4 => 'theme-options',
      5 => 'widget-manager',
      6 => 'Modules\\SimpleSlider\\Http\\Models\\SimpleSlider',
    ),
    'hideDefaultLocaleInURL' => true,
    'localesMapping' => 
    array (
    ),
  ),
  'location' => 
  array (
    'name' => 'Location',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 91,
    'bulk-import' => 
    array (
      'mime_types' => 
      array (
        0 => 'application/vnd.ms-excel',
        1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        2 => 'text/csv',
        3 => 'application/csv',
        4 => 'text/plain',
      ),
      'mimes' => 
      array (
        0 => 'xls',
        1 => 'xlsx',
        2 => 'csv',
      ),
    ),
    'supported' => 
    array (
    ),
  ),
  'option' => 
  array (
    'name' => 'Option',
    'module_version' => '1.8',
    'module_type' => 'plugin',
    'pid' => 19,
  ),
  'simpleslider' => 
  array (
    'name' => 'SimpleSlider',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 29,
  ),
  'sociallogin' => 
  array (
    'name' => 'SocialLogin',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 69,
    'supported' => 
    array (
    ),
  ),
  'table' => 
  array (
    'name' => 'Table',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 98,
  ),
  'translation' => 
  array (
    'name' => 'Translation',
    'module_version' => '1.0',
    'module_type' => 'plugin',
    'pid' => 62,
    'exclude_groups' => 
    array (
    ),
  ),
);
