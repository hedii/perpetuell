<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => true,
        ],

        'cloud-public' => [
            'driver' => 'swift',
            'username' => env('OVH_OPENSTACK_USERNAME'),
            'password' => env('OVH_OPENSTACK_PASSWORD'),
            'projectId' => env('OVH_OPENSTACK_PROJECT_ID'),
            'tenantId' => env('OVH_OPENSTACK_TENANT_ID'),
            'tenantName' => env('OVH_OPENSTACK_TENANT_NAME'),
            'authUrl' => env('OVH_OPENSTACK_AUTH_URL', 'https://auth.cloud.ovh.net/v3/'),
            'region' => env('OVH_OPENSTACK_REGION', 'GRA'),
            'containerName' => env('OVH_OPENSTACK_CONTAINER_NAME', 'perpetuell'),
            'visibility' => 'public',
        ],

    ],

];
