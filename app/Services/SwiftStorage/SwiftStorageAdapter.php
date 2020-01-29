<?php

namespace App\Services\SwiftStorage;

use Nimbusoft\Flysystem\OpenStack\SwiftAdapter;
use OpenStack\Common\Transport\Utils;
use OpenStack\ObjectStore\v1\Models\Container;
use RuntimeException;

class SwiftStorageAdapter extends SwiftAdapter
{
    /**
     * The container public url.
     *
     * @var null|string
     */
    protected ?string $publicUrl;

    /**
     * SwiftStorageAdapter constructor.
     *
     * @param \OpenStack\ObjectStore\v1\Models\Container $container
     * @param null|string $publicUrl
     * @param null|string $prefix
     */
    public function __construct(Container $container, ?string $publicUrl = null, ?string $prefix = null)
    {
        $this->publicUrl = $publicUrl;

        parent::__construct($container, $prefix);
    }

    /**
     * Get the URL for the file at the given path.
     *
     * @param string $path
     * @return string
     */
    public function getUrl(string $path): string
    {
        if (! $this->publicUrl) {
            throw new RuntimeException('This disk does not support retrieving URLs.');
        }

        return Utils::normalizeUrl($this->publicUrl) . $path;
    }
}
