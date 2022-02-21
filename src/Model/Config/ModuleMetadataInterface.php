<?php

namespace MagePsycho\StorePricing\Model\Config;

/**
 * Module metadata
 *
 * @api
 */
interface ModuleMetadataInterface
{
    /**
     * Get Module version
     *
     * @return string
     */
    public function getVersion();

    /**
     * Get Module edition
     *
     * @return string
     */
    public function getEdition();

    /**
     * Get Module name
     *
     * @return string
     */
    public function getName();
}
