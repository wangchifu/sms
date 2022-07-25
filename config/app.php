<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Taipei',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'zh-TW',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\FortifyServiceProvider::class,
        App\Providers\JetstreamServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Arr' => Illuminate\Support\Arr::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'Date' => Illuminate\Support\Facades\Date::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Http' => Illuminate\Support\Facades\Http::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'RateLimiter' => Illuminate\Support\Facades\RateLimiter::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        // 'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'Str' => Illuminate\Support\Str::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,

    ],
    'database' => [
        //網址轉換資料庫代碼
        'sms.localhost' => 'sms074999',
        'sms.smes.chc.edu.tw' => 'sms074608',
        'sms.dches.chc.edu.tw' => 'sms074775',
        'sms.tces.chc.edu.tw' => 'sms074610',
        'sms.cses.chc.edu.tw' => 'sms074601',
        'sms.phes.chc.edu.tw' => 'sms074603',
        'sms.mses.chc.edu.tw' => 'sms074602',
        'sms.spes.chc.edu.tw' => 'sms074613',
        'sms.kges.chc.edu.tw' => 'sms074612',
        'sms.jsps.chc.edu.tw' => 'sms074614',
        'sms.tfps.chc.edu.tw' => 'sms074606',
        'sms.nges.chc.edu.tw' => 'sms074604',
        'sms.nses.chc.edu.tw' => 'sms074605',
        'sms.thps.chc.edu.tw' => 'sms074607',
        'sms.gses.chc.edu.tw' => 'sms074611',
        'sms.lsps.chc.edu.tw' => 'sms074609',
        'sms.wdes.chc.edu.tw' => 'sms074619',
        'sms.taes.chc.edu.tw' => 'sms074618',
        'sms.fyps.chc.edu.tw' => 'sms074615',
        'sms.cles.chc.edu.tw' => 'sms074620',
        'sms.fsps.chc.edu.tw' => 'sms074616',
        'sms.bses.chc.edu.tw' => 'sms074617',
        'sms.sstps.chc.edu.tw' => 'sms074625',
        'sms.wses.chc.edu.tw' => 'sms074622',
        'sms.bsps.chc.edu.tw' => 'sms074626',
        'sms.htes.chc.edu.tw' => 'sms074621',
        'sms.hnes.chc.edu.tw' => 'sms074623',
        'sms.caps.chc.edu.tw' => 'sms074624',
        'sms.hses.chc.edu.tw' => 'sms074654',
        'sms.ymes.chc.edu.tw' => 'sms074659',
        'sms.mcps.chc.edu.tw' => 'sms074657',
        'sms.ssps.chc.edu.tw' => 'sms074658',
        'sms.smses.chc.edu.tw' => 'sms074655',
        'sms.hlps.chc.edu.tw' => 'sms074656',
        'sms.wkes.chc.edu.tw' => 'sms074640',
        'sms.sdses.chc.edu.tw' => 'sms074646',
        'sms.ljes.chc.edu.tw' => 'sms074641',
        'sms.hpes.chc.edu.tw' => 'sms074642',
        'sms.tges.chc.edu.tw' => 'sms074644',
        'sms.dfes.chc.edu.tw' => 'sms074645',
        'sms.ldes.chc.edu.tw' => 'sms074771',
        'sms.lges.chc.edu.tw' => 'sms074639',
        'sms.bsses.chc.edu.tw' => 'sms074643',
        'sms.bdsps.chc.edu.tw' => 'sms074650',
        'sms.wces.chc.edu.tw' => 'sms074648',
        'sms.rses.chc.edu.tw' => 'sms074652',
        'sms.yfes.chc.edu.tw' => 'sms074651',
        'sms.ssses.chc.edu.tw' => 'sms074649',
        'sms.yses.chc.edu.tw' => 'sms074653',
        'sms.gyes.chc.edu.tw' => 'sms074647',
        'sms.sces.chc.edu.tw' => 'sms074633',
        'sms.syes.chc.edu.tw' => 'sms074634',
        'sms.dces.chc.edu.tw' => 'sms074629',
        'sms.dres.chc.edu.tw' => 'sms074630',
        'sms.hres.chc.edu.tw' => 'sms074769',
        'sms.hdes.chc.edu.tw' => 'sms074628',
        'sms.hmps.chc.edu.tw' => 'sms074627',
        'sms.pyps.chc.edu.tw' => 'sms074632',
        'sms.ssjes.chc.edu.tw' => 'sms074631',
        'sms.dtes.chc.edu.tw' => 'sms074638',
        'sms.sres.chc.edu.tw' => 'sms074637',
        'sms.sdes.chc.edu.tw' => 'sms074636',
        'sms.sgps.chc.edu.tw' => 'sms074635',
        'sms.yyes.chc.edu.tw' => 'sms074681',
        'sms.mhes.chc.edu.tw' => 'sms074688',
        'sms.dsps.chc.edu.tw' => 'sms074686',
        'sms.chcses.chc.edu.tw' => 'sms074687',
        'sms.ytes.chc.edu.tw' => 'sms074684',
        'sms.ylps.chc.edu.tw' => 'sms074680',
        'sms.csps.chc.edu.tw' => 'sms074683',
        'sms.sjses.chc.edu.tw' => 'sms074682',
        'sms.rmes.chc.edu.tw' => 'sms074685',
        'sms.stps.chc.edu.tw' => 'sms074704',
        'sms.lyps.chc.edu.tw' => 'sms074773',
        'sms.bcses.chc.edu.tw' => 'sms074707',
        'sms.scsps.chc.edu.tw' => 'sms074706',
        'sms.nyes.chc.edu.tw' => 'sms074708',
        'sms.ctps.chc.edu.tw' => 'sms074705',
        'sms.csnes.chc.edu.tw' => 'sms074772',
        'sms.yces.chc.edu.tw' => 'sms074693',
        'sms.ysps.chc.edu.tw' => 'sms074695',
        'sms.fdps.chc.edu.tw' => 'sms074694',
        'sms.sfses.chc.edu.tw' => 'sms074696',
        'sms.sdsps.chc.edu.tw' => 'sms074697',
        'sms.tpes.chc.edu.tw' => 'sms074674',
        'sms.msps.chc.edu.tw' => 'sms074679',
        'sms.pses.chc.edu.tw' => 'sms074673',
        'sms.wfes.chc.edu.tw' => 'sms074678',
        'sms.sfsps.chc.edu.tw' => 'sms074677',
        'sms.jges.chc.edu.tw' => 'sms074675',
        'sms.rtes.chc.edu.tw' => 'sms074676',
        'sms.bdses.chc.edu.tw' => 'sms074661',
        'sms.hbps.chc.edu.tw' => 'sms074777',
        'sms.fses.chc.edu.tw' => 'sms074662',
        'sms.fdes.chc.edu.tw' => 'sms074663',
        'sms.hnps.chc.edu.tw' => 'sms074664',
        'sms.mtes.chc.edu.tw' => 'sms074665',
        'sms.shps.chc.edu.tw' => 'sms074660',
        'sms.dses.chc.edu.tw' => 'sms074690',
        'sms.dtps.chc.edu.tw' => 'sms074689',
        'sms.tsps.chc.edu.tw' => 'sms074691',
        'sms.tdes.chc.edu.tw' => 'sms074692',
        'sms.dyes.chc.edu.tw' => 'sms074667',
        'sms.tses.chc.edu.tw' => 'sms074672',
        'sms.yles.chc.edu.tw' => 'sms074670',
        'sms.hsps.chc.edu.tw' => 'sms074669',
        'sms.ngps.chc.edu.tw' => 'sms074668',
        'sms.pyes.chc.edu.tw' => 'sms074666',
        'sms.sses.chc.edu.tw' => 'sms074671',
        'sms.stes.chc.edu.tw' => 'sms074699',
        'sms.daes.chc.edu.tw' => 'sms074700',
        'sms.naes.chc.edu.tw' => 'sms074701',
        'sms.tjes.chc.edu.tw' => 'sms074698',
        'sms.mles.chc.edu.tw' => 'sms074703',
        'sms.dhps.chc.edu.tw' => 'sms074702',
        'sms.smps.chc.edu.tw' => 'sms074776',
        'sms.dsses.chc.edu.tw' => 'sms074715',
        'sms.bdes.chc.edu.tw' => 'sms074712',
        'sms.wles.chc.edu.tw' => 'sms074713',
        'sms.rces.chc.edu.tw' => 'sms074714',
        'sms.ryes.chc.edu.tw' => 'sms074716',
        'sms.rfes.chc.edu.tw' => 'sms074720',
        'sms.twps.chc.edu.tw' => 'sms074717',
        'sms.njes.chc.edu.tw' => 'sms074718',
        'sms.lfes.chc.edu.tw' => 'sms074719',
        'sms.dhes.chc.edu.tw' => 'sms074726',
        'sms.ches.chc.edu.tw' => 'sms074725',
        'sms.shses.chc.edu.tw' => 'sms074722',
        'sms.fces.chc.edu.tw' => 'sms074724',
        'sms.ptes.chc.edu.tw' => 'sms074721',
        'sms.fles.chc.edu.tw' => 'sms074723',
        'sms.steps.chc.edu.tw' => 'sms074729',
        'sms.djps.chc.edu.tw' => 'sms074734',
        'sms.swes.chc.edu.tw' => 'sms074730',
        'sms.jles.chc.edu.tw' => 'sms074733',
        'sms.cges.chc.edu.tw' => 'sms074732',
        'sms.njps.chc.edu.tw' => 'sms074735',
        'sms.sjps.chc.edu.tw' => 'sms074727',
        'sms.cyes.chc.edu.tw' => 'sms074728',
        'sms.cyps.chc.edu.tw' => 'sms074731',
        'sms.tkes.chc.edu.tw' => 'sms074757',
        'sms.mjes.chc.edu.tw' => 'sms074755',
        'sms.ttes.chc.edu.tw' => 'sms074754',
        'sms.ctes.chc.edu.tw' => 'sms074753',
        'sms.caes.chc.edu.tw' => 'sms074756',
        'sms.elps.chc.edu.tw' => 'sms074736',
        'sms.ccps.chc.edu.tw' => 'sms074738',
        'sms.scses.chc.edu.tw' => 'sms074744',
        'sms.ydes.chc.edu.tw' => 'sms074739',
        'sms.sstes.chc.edu.tw' => 'sms074740',
        'sms.ydps.chc.edu.tw' => 'sms074745',
        'sms.sssps.chc.edu.tw' => 'sms074743',
        'sms.whes.chc.edu.tw' => 'sms074746',
        'sms.wsps.chc.edu.tw' => 'sms074742',
        'sms.gsps.chc.edu.tw' => 'sms074741',
        'sms.shes.chc.edu.tw' => 'sms074737',
        'sms.dcps.chc.edu.tw' => 'sms074747',
        'sms.yges.chc.edu.tw' => 'sms074748',
        'sms.sges.chc.edu.tw' => 'sms074749',
        'sms.mfes.chc.edu.tw' => 'sms074750',
        'sms.djes.chc.edu.tw' => 'sms074751',
        'sms.tcps.chc.edu.tw' => 'sms074752',
        'sms.wges.chc.edu.tw' => 'sms074765',
        'sms.mces.chc.edu.tw' => 'sms074760',
        'sms.mcws.chc.edu.tw' => 'sms074760',
        'sms.yhes.chc.edu.tw' => 'sms074761',
        'sms.fyes.chc.edu.tw' => 'sms074758',
        'sms.jses.chc.edu.tw' => 'sms074763',
        'sms.hles.chc.edu.tw' => 'sms074759',
        'sms.thes.chc.edu.tw' => 'sms074762',
        'sms.sbes.chc.edu.tw' => 'sms074766',
        'sms.lses.chc.edu.tw' => 'sms074767',
        'sms.hbes.chc.edu.tw' => 'sms074764',
        'sms.eses.chc.edu.tw' => 'sms074709',
        'sms.fsses.chc.edu.tw' => 'sms074710',
        'sms.ycps.chc.edu.tw' => 'sms074711',
        'sms.spps.chc.edu.tw' => 'sms074732',
        'sms.hyjhes.chc.edu.tw' => 'sms074541',
        'sms.ymsc.chc.edu.tw' => 'sms074505',
        'sms.cajh.chc.edu.tw' => 'sms074506',
        'sms.ctsjh.chc.edu.tw' => 'sms074540',
        'sms.ctjh.chc.edu.tw' => 'sms074507',
        'sms.csjh.chc.edu.tw' => 'sms074538',
        'sms.fyjh.chc.edu.tw' => 'sms074509',
        'sms.htjh.chc.edu.tw' => 'sms074526',
        'sms.hsjh.chc.edu.tw' => 'sms074522',
        'sms.lmjh.chc.edu.tw' => 'sms074503',
        'sms.lkjh.chc.edu.tw' => 'sms074502',
        'sms.ljis.chc.edu.tw' => 'sms074542',
        'sms.fsjh.chc.edu.tw' => 'sms074521',
        'sms.hhjh.chc.edu.tw' => 'sms074504',
        'sms.hmjh.chc.edu.tw' => 'sms074323',
        'sms.hcjh.chc.edu.tw' => 'sms074535',
        'sms.skjh.chc.edu.tw' => 'sms074524',
        'sms.ttjhs.chc.edu.tw' => 'sms074536',
        'sms.mljh.chc.edu.tw' => 'sms074511',
        'sms.yljh.chc.edu.tw' => 'sms074510',
        'sms.stjh.chc.edu.tw' => 'sms074530',
        'sms.ycjh.chc.edu.tw' => 'sms074527',
        'sms.psjh.chc.edu.tw' => 'sms074520',
        'sms.ckjh.chc.edu.tw' => 'sms074339',
        'sms.cksh.chc.edu.tw' => 'sms074339',
        'sms.cfjh.chc.edu.tw' => 'sms074518',
        'sms.ttjh.chc.edu.tw' => 'sms074525',
        'sms.pyjh.chc.edu.tw' => 'sms074519',
        'sms.tcjh.chc.edu.tw' => 'sms074328',
        'sms.ptjhs.chc.edu.tw' => 'sms074501',
        'sms.twjh.chc.edu.tw' => 'sms074531',
        'sms.ptjh.chc.edu.tw' => 'sms074534',
        'sms.ccjh.chc.edu.tw' => 'sms074532',
        'sms.hyjh.chc.edu.tw' => 'sms074533',
        'sms.ctjhs.chc.edu.tw' => 'sms074514',
        'sms.ydjh.chc.edu.tw' => 'sms074537',
        'sms.whjh.chc.edu.tw' => 'sms074512',
        'sms.tcjhs.chc.edu.tw' => 'sms074515',
        'sms.fyjhs.chc.edu.tw' => 'sms074517',
        'sms.thjh.chc.edu.tw' => 'sms074516',
        'sms.esjh.chc.edu.tw' => 'sms074529',
        'sms.elsh.chc.edu.tw' => 'sms074313',
    ],
    'schools' => [
        '074999' => '測試國小',
        '074308' => '彰化藝術高中',
        '074505' => '陽明國中',
        '074506' => '彰安國中',
        '074507' => '彰德國中',
        '074538' => '彰興國中',
        '074539' => '成功高中(國中部)',
        '074540' => '彰泰國中',
        '074541' => '信義國中小(國中部)',
        '074509' => '芬園國中',
        '074526' => '花壇國中',
        '074518' => '溪湖國中',
        '074339' => '成功高中(高中部)',
        '074519' => '埔鹽國中',
        '074520' => '埔心國中',
        '074512' => '萬興國中',
        '074517' => '芳苑國中',
        '074515' => '大城國中',
        '074514' => '竹塘國中',
        '074313' => '二林高中',
        '074516' => '草湖國中',
        '074537' => '原斗國中小(國中部)',
        '074525' => '大村國中',
        '074510' => '員林國中',
        '074511' => '明倫國中',
        '074527' => '永靖國中',
        '074536' => '大同國中',
        '074323' => '和美高中(高中部)',
        '074535' => '和群國中',
        '074521' => '福興國中',
        '074524' => '伸港國中',
        '074504' => '線西國中',
        '074503' => '鹿鳴國中',
        '074502' => '鹿港國中',
        '074542' => '鹿江國際中小學(國中部)',
        '074543' => '民權華德福實驗國中小(國中部)',
        '074522' => '秀水國中',
        '074523' => '和美高中(國中部)',
        '074534' => '埤頭國中',
        '074501' => '北斗國中',
        '074532' => '溪州國中',
        '074530' => '社頭國中',
        '074528' => '田中高中(國中部)',
        '074529' => '二水國中',
        '074531' => '田尾國中',
        '074328' => '田中高中(高中部)',
        '074533' => '溪陽國中',
        '071311' => '私立精誠高中(國中部)',
        '071317' => '私立文興高中(國中部)',
        '071318' => '私立正德高中(國中部)',
        '074601' => '中山國小',
        '074602' => '民生國小',
        '074603' => '平和國小',
        '074604' => '南郭國小',
        '074605' => '南興國小',
        '074606' => '東芳國小',
        '074607' => '泰和國小',
        '074608' => '三民國小',
        '074609' => '聯興國小',
        '074610' => '大竹國小',
        '074611' => '國聖國小',
        '074612' => '快官國小',
        '074613' => '石牌國小',
        '074614' => '忠孝國小',
        '074615' => '芬園國小',
        '074616' => '富山國小',
        '074617' => '寶山國小',
        '074618' => '同安國小',
        '074619' => '文德國小',
        '074620' => '茄荖國小',
        '074621' => '花壇國小',
        '074622' => '文祥國小',
        '074623' => '華南國小',
        '074624' => '僑愛國小',
        '074625' => '三春國小',
        '074626' => '白沙國小',
        '074627' => '和美國小',
        '074628' => '和東國小',
        '074629' => '大嘉國小',
        '074630' => '大榮國小',
        '074631' => '新庄國小',
        '074632' => '培英國小',
        '074633' => '線西國小',
        '074634' => '曉陽國小',
        '074635' => '新港國小',
        '074636' => '伸東國小',
        '074637' => '伸仁國小',
        '074638' => '大同國小',
        '074639' => '鹿港國小',
        '074640' => '文開國小',
        '074641' => '洛津國小',
        '074642' => '海埔國小',
        '074643' => '新興國小',
        '074644' => '草港國小',
        '074645' => '頂番國小',
        '074646' => '東興國小',
        '074647' => '管嶼國小',
        '074648' => '文昌國小',
        '074649' => '西勢國小',
        '074650' => '大興國小',
        '074651' => '永豐國小',
        '074652' => '日新國小',
        '074653' => '育新國小',
        '074654' => '秀水國小',
        '074655' => '馬興國小',
        '074656' => '華龍國小',
        '074657' => '明正國小',
        '074658' => '陝西國小',
        '074659' => '育民國小',
        '074660' => '溪湖國小',
        '074661' => '東溪國小',
        '074662' => '湖西國小',
        '074663' => '湖東國小',
        '074664' => '湖南國小',
        '074665' => '媽厝國小',
        '074666' => '埔鹽國小',
        '074667' => '大園國小',
        '074668' => '南港國小',
        '074669' => '好修國小',
        '074670' => '永樂國小',
        '074671' => '新水國小',
        '074672' => '天盛國小',
        '074673' => '埔心國小',
        '074674' => '太平國小',
        '074675' => '舊館國小',
        '074676' => '羅厝國小',
        '074677' => '鳳霞國小',
        '074678' => '梧鳳國小',
        '074679' => '明聖國小',
        '074680' => '員林國小',
        '074681' => '育英國小',
        '074682' => '靜修國小',
        '074683' => '僑信國小',
        '074684' => '員東國小',
        '074685' => '饒明國小',
        '074686' => '東山國小',
        '074687' => '青山國小',
        '074688' => '明湖國小',
        '074689' => '大村國小',
        '074690' => '大西國小',
        '074691' => '村上國小',
        '074692' => '村東國小',
        '074693' => '永靖國小',
        '074694' => '福德國小',
        '074695' => '永興國小',
        '074696' => '福興國小',
        '074697' => '德興國小',
        '074698' => '田中國小',
        '074699' => '三潭國小',
        '074700' => '大安國小',
        '074701' => '內安國小',
        '074702' => '東和國小',
        '074703' => '明禮國小',
        '074704' => '社頭國小',
        '074705' => '橋頭國小',
        '074706' => '朝興國小',
        '074707' => '清水國小',
        '074708' => '湳雅國小',
        '074709' => '二水國小',
        '074710' => '復興國小',
        '074711' => '源泉國小',
        '074712' => '北斗國小',
        '074713' => '萬來國小',
        '074714' => '螺青國小',
        '074715' => '大新國小',
        '074716' => '螺陽國小',
        '074717' => '田尾國小',
        '074718' => '南鎮國小',
        '074719' => '陸豐國小',
        '074720' => '仁豐國小',
        '074721' => '埤頭國小',
        '074722' => '合興國小',
        '074723' => '豐崙國小',
        '074724' => '芙朝國小',
        '074725' => '中和國小',
        '074726' => '大湖國小',
        '074727' => '溪州國小',
        '074728' => '僑義國小',
        '074729' => '三條國小',
        '074730' => '水尾國小',
        '074731' => '潮洋國小',
        '074732' => '成功國小',
        '074733' => '圳寮國小',
        '074734' => '大莊國小',
        '074735' => '南州國小',
        '074736' => '二林國小',
        '074737' => '興華國小',
        '074738' => '中正國小',
        '074739' => '育德國小',
        '074740' => '香田國小',
        '074741' => '廣興國小',
        '074742' => '萬興國小',
        '074743' => '新生國小',
        '074744' => '中興國小',
        '074745' => '原斗國中小(國小部)',
        '074746' => '萬合國小',
        '074747' => '大城國小',
        '074748' => '永光國小',
        '074749' => '西港國小',
        '074750' => '美豐國小',
        '074751' => '頂庄國小',
        '074752' => '潭墘國小',
        '074753' => '竹塘國小',
        '074754' => '田頭國小',
        '074755' => '民靖國小',
        '074756' => '長安國小',
        '074757' => '土庫國小',
        '074758' => '芳苑國小',
        '074759' => '後寮國小',
        '074760' => '民權華德福實驗國中小(國小部)',
        '074761' => '育華國小',
        '074762' => '草湖國小',
        '074763' => '建新國小',
        '074764' => '漢寶國小',
        '074765' => '王功國小',
        '074766' => '新寶國小',
        '074767' => '路上國小',
        '074769' => '和仁國小',
        '074771' => '鹿東國小',
        '074772' => '舊社國小',
        '074773' => '崙雅國小',
        '074774' => '信義國中小(國小部)',
        '074775' => '大成國小',
        '074776' => '新民國小',
        '074777' => '湖北國小',
        '074778' => '鹿江國際中小學(國小部)',
    ],

];
