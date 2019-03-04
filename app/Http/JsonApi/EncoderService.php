<?php
declare(strict_types=1);

namespace App\Http\JsonApi;

use Exception;
use Neomerx\JsonApi\Http\BaseResponses;
use Neomerx\JsonApi\Contracts\Encoder\EncoderInterface;
use Neomerx\JsonApi\Contracts\Http\Headers\MediaTypeInterface;
use Neomerx\JsonApi\Encoder\Encoder;

/**
 * Class EncoderService
 */
class EncoderService extends BaseResponses
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $encoders = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
    /**
     * Create HTTP response.
     *
     * @param string|null $content
     * @param int         $statusCode
     * @param array       $headers
     *
     * @return mixed
     */
    public function createResponse(?string $content, int $statusCode, array $headers)
    {

    }

    public function getEncoder(string $name = 'default'): EncoderInterface;
    {
        if (!isset($this->encoders[$name])) {
            if ($name === 'default') {
                $config = $this->config;
            } elseif(isset($this->config['encoders'][$name])) {
                $config = $this->config['encoders'][$name];
            } else {
                throw new Exception(sprintf('No configuration found for %s "%s"', Encoder::class, $name));
            }

            // $encoder_options = isset($config['encoder-options']) && is_array($config['encoder-options']) ?
            //     $config['encoder-options'] :
            //     [];
            // $options = $this->getEncoderOptions($encoder_options);

            $encoder = Encoder::instance(
                $this->config['schemas']
            );

            if (isset($config['jsonapi'])) {
                if (is_array($config['jsonapi'])) {
                    $encoder->withJsonApiVersion($config['jsonapi']);
                } elseif ($config['jsonapi'] === true) {
                    $encoder->withJsonApiVersion('1.1');
                }
            }
            if (isset($config['options']) && is_int($config['options'])) {
                $encoder->withEncodeOptions($config['options']);
            }
            if (isset($config['urlPrefix']) && is_string($config['urlPrefix'])) {
                $encoder->withUrlPrefix($config['urlPrefix']);
            }
            if (isset($config['depth']) && is_int($config['depth'])) {
                $encoder->withEncodeDepth($config['depth']);
            }
            if (isset($config['meta']) && is_array($config['meta'])) {
                $encoder->withMeta($config['meta']);
            }

            $this->encoders[$name] = $encoder;
        }
        return $this->encoders[$name];
    }

    public function getMediaType(array $config): MediaTypeInterface
    {
        // $options = isset($config['options']) && is_int($config['options']) ?
        //     $config['options'] :
        //     0;
        // $urlPrefix = isset($config['urlPrefix']) && is_string($config['urlPrefix']) ?
        //     $config['urlPrefix'] :
        //     null;
        // $depth = isset($config['depth']) && is_int($config['depth']) ?
        //     $config['depth'] :
        //     512;
        // return new EncoderOptions($options, $urlPrefix, $depth);
    }
}
