<?php

namespace Ibrows\XeditableBundle\Mapper;

use Ibrows\XeditableBundle\Model\XeditableMapperInterface;

abstract class AbstractXeditableMapper implements XeditableMapperInterface
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @param string $url
     */
    public function __construct($url = null)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $path
     * @param string $value
     * @param array $attributes
     * @param array $options
     * @return array
     */
    protected function getViewParameters($path, $value, array $attributes = array(), array $options = array())
    {
        $attributes = array_merge(array(
            'data-path' => $path,
            'data-url'  => $this->getUrl(),
            'data-type' => $this->getName(),
        ), $attributes);

        return array(
            'options'       => $options,
            'attributes'    => $attributes,
            'value'         => $value
        );
    }
}