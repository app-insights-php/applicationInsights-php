<?php declare(strict_types=1);
namespace ApplicationInsights\Channel\Contracts;

/**
 * THIS FILE IS AUTO-GENERATED.
 * Please do not edit manually.
 *
 * Use script at <root>/Schema/generateSchema.ps1
 */

/**
 * Data contract class for type Request_Data. An instance of Request represents completion of an external request to the application to do work and contains a summary of that request execution and the results.
 */
class Request_Data extends Base_Data implements Data_Interface
{
    /**
     * Creates a new RequestData.
     */
    public function __construct()
    {
        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.Request';
        $this->_dataTypeName = 'RequestData';
        $this->_data['ver'] = 2;
        $this->_data['id'] = null;
        $this->_data['duration'] = null;
        $this->_data['responseCode'] = null;
        $this->_data['success'] = null;
    }

    /**
     * Gets the ver field. Schema version.
     */
    public function getVer()
    {
        if (\array_key_exists('ver', $this->_data)) {
            return $this->_data['ver'];
        }

        return null;
    }

    /**
     * Sets the ver field. Schema version.
     */
    public function setVer($ver) : void
    {
        $this->_data['ver'] = $ver;
    }

    /**
     * Gets the id field. Identifier of a request call instance. Used for correlation between request and other telemetry items.
     */
    public function getId()
    {
        if (\array_key_exists('id', $this->_data)) {
            return $this->_data['id'];
        }

        return null;
    }

    /**
     * Sets the id field. Identifier of a request call instance. Used for correlation between request and other telemetry items.
     */
    public function setId($id) : void
    {
        $this->_data['id'] = $id;
    }

    /**
     * Gets the source field. Source of the request. Examples are the instrumentation key of the caller or the ip address of the caller.
     */
    public function getSource()
    {
        if (\array_key_exists('source', $this->_data)) {
            return $this->_data['source'];
        }

        return null;
    }

    /**
     * Sets the source field. Source of the request. Examples are the instrumentation key of the caller or the ip address of the caller.
     */
    public function setSource($source) : void
    {
        $this->_data['source'] = $source;
    }

    /**
     * Gets the name field. Name of the request. Represents code path taken to process request. Low cardinality value to allow better grouping of requests. For HTTP requests it represents the HTTP method and URL path template like 'GET /values/{id}'.
     */
    public function getName()
    {
        if (\array_key_exists('name', $this->_data)) {
            return $this->_data['name'];
        }

        return null;
    }

    /**
     * Sets the name field. Name of the request. Represents code path taken to process request. Low cardinality value to allow better grouping of requests. For HTTP requests it represents the HTTP method and URL path template like 'GET /values/{id}'.
     */
    public function setName($name) : void
    {
        $this->_data['name'] = $name;
    }

    /**
     * Gets the duration field. Request duration in format: DD.HH:MM:SS.MMMMMM. Must be less than 1000 days.
     */
    public function getDuration()
    {
        if (\array_key_exists('duration', $this->_data)) {
            return $this->_data['duration'];
        }

        return null;
    }

    /**
     * Sets the duration field. Request duration in format: DD.HH:MM:SS.MMMMMM. Must be less than 1000 days.
     */
    public function setDuration($duration) : void
    {
        $this->_data['duration'] = $duration;
    }

    /**
     * Gets the responseCode field. Result of a request execution. HTTP status code for HTTP requests.
     */
    public function getResponseCode()
    {
        if (\array_key_exists('responseCode', $this->_data)) {
            return $this->_data['responseCode'];
        }

        return null;
    }

    /**
     * Sets the responseCode field. Result of a request execution. HTTP status code for HTTP requests.
     */
    public function setResponseCode($responseCode) : void
    {
        $this->_data['responseCode'] = $responseCode;
    }

    /**
     * Gets the success field. Indication of successfull or unsuccessfull call.
     */
    public function getSuccess()
    {
        if (\array_key_exists('success', $this->_data)) {
            return $this->_data['success'];
        }

        return null;
    }

    /**
     * Sets the success field. Indication of successfull or unsuccessfull call.
     */
    public function setSuccess($success) : void
    {
        $this->_data['success'] = $success;
    }

    /**
     * Gets the url field. Request URL with all query string parameters.
     */
    public function getUrl()
    {
        if (\array_key_exists('url', $this->_data)) {
            return $this->_data['url'];
        }

        return null;
    }

    /**
     * Sets the url field. Request URL with all query string parameters.
     */
    public function setUrl($url) : void
    {
        $this->_data['url'] = $url;
    }

    /**
     * Gets the properties field. Collection of custom properties.
     */
    public function getProperties()
    {
        if (\array_key_exists('properties', $this->_data)) {
            return $this->_data['properties'];
        }

        return null;
    }

    /**
     * Sets the properties field. Collection of custom properties.
     */
    public function setProperties($properties) : void
    {
        $this->_data['properties'] = $properties;
    }

    /**
     * Gets the measurements field. Collection of custom measurements.
     */
    public function getMeasurements()
    {
        if (\array_key_exists('measurements', $this->_data)) {
            return $this->_data['measurements'];
        }

        return null;
    }

    /**
     * Sets the measurements field. Collection of custom measurements.
     */
    public function setMeasurements($measurements) : void
    {
        $this->_data['measurements'] = $measurements;
    }
}
