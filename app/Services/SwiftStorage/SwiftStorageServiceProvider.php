<?php

namespace App\Services\SwiftStorage;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use OpenStack\OpenStack;

class SwiftStorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Storage::extend('swift', function ($app, $config): FilesystemInterface {
            $options = [
                'authUrl' => $config['authUrl'],
                'region' => $config['region'],
                'user' => [
                    'name' => $config['username'],
                    'password' => $config['password'],
                    'domain'   => [
                        'id' => 'default',
                    ],
                ],
                'scope' => [
                    'project' => [
                        'id' => $config['projectId'],
                    ],
                ],
            ];

            if (isset($config['visibility']) && $config['visibility'] === 'public') {
                $options['publicUrl'] = $this->containerUrl($config);
            }

            $openstack = new OpenStack($options);

            $identity = $openstack->identityV3([
                'region' => $config['region']
            ]);

            if ($token = Cache::get('openstack-token')) {
                $options['cachedToken'] = $token;
            } else {
                $token = $identity->generateToken([
                    'user' => [
                        'name' => $config['username'],
                        'password' => $config['password'],
                        'domain'   => [
                            'id' => 'default',
                        ],
                    ]
                ]);

                Cache::put(
                    'openstack-token',
                    $token->export(),
                    Carbon::now()->diffInSeconds(Carbon::createFromImmutable($token->expires))
                );

                $options['cachedToken'] = $token->export();
            }

            $container = $openstack->objectStoreV1()->getContainer($config['containerName']);

            $adapter = new SwiftStorageAdapter($container, $options['publicUrl'] ?? null);

            return new Filesystem($adapter);
        });
    }

    /**
     * Get the cloud disk's container url.
     *
     * @param array $config
     * @return string
     */
    private function containerUrl(array $config): string
    {
        $region = Str::lower($config['region']);

        return "https://storage.{$region}.cloud.ovh.net/v1/AUTH_{$config['tenantId']}/{$config['containerName']}";
    }
}
