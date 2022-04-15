<?php declare(strict_types=1);
namespace ApplicationInsights\Channel\Contracts;

/**
 * Version property manager.
 */
trait Version_Manager
{
    /**
     * Gets the ver field.
     */
    public function getVer()
    {
        if (\array_key_exists('ver', $this->_data)) {
            return $this->_data['ver'];
        }

        return null;
    }

    /**
     * Sets the ver field.
     */
    public function setVer($ver) : void
    {
        $this->_data['ver'] = $ver;
    }
}
