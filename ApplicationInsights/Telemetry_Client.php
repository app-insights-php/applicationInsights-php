<?php declare(strict_types=1);
namespace ApplicationInsights;

/**
 * Main object used for interacting with the Application Insights service.
 */
class Telemetry_Client
{
    /**
     * The telemetry context this client will use.
     *
     * @var \ApplicationInsights\Telemetry_Context
     */
    private $_context;

    /**
     * The telemetry channel this client will use.
     *
     * @var \ApplicationInsights\Channel\Telemetry_Channel
     */
    private $_channel;

    /**
     * Initializes a new Telemetry_Client.
     *
     * @param \ApplicationInsights\Telemetry_Context $context
     * @param \ApplicationInsights\Channel\Telemetry_Channel $channel
     */
    public function __construct(Telemetry_Context $context = null, Channel\Telemetry_Channel $channel = null)
    {
        $this->_context = ($context == null) ?  new Telemetry_Context() : $context;
        $this->_channel = ($channel == null) ?  new Channel\Telemetry_Channel() : $channel;
    }

    /**
     * Returns the Telemetry_Context this Telemetry_Client is using.
     *
     * @return \ApplicationInsights\Telemetry_Context
     */
    public function getContext()
    {
        return $this->_context;
    }

    /**
     * Returns the Telemetry_Channel this Telemetry_Client is using.
     *
     * @return \ApplicationInsights\Channel\Telemetry_Channel
     */
    public function getChannel()
    {
        return $this->_channel;
    }

    /**
     * Sends an Page_View_Data to the Application Insights service.
     *
     * @param string $name the friendly name of the page view
     * @param string $url the url of the page view
     * @param int duration The duration in milliseconds of the page view
     * @param array $properties An array of name to value pairs. Use the name as the index and any string as the value.
     * @param array $measurements An array of name to double pairs. Use the name as the index and any double as the value.
     */
    public function trackPageView($name, $url, $duration = 0, $properties = null, $measurements = null) : void
    {
        $data = new Channel\Contracts\Page_View_Data();
        $data->setName($name);
        $data->setUrl($url);
        $data->setDuration(Channel\Contracts\Utils::convertMillisecondsToTimeSpan($duration));

        if ($properties != null) {
            $data->setProperties($properties);
        }

        if ($measurements != null) {
            $data->setMeasurements($measurements);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends an Metric_Data to the Application Insights service.
     *
     * @param string $name name of the metric
     * @param float $value value of the metric
     * @param int $type The type of value being sent. Found: \ApplicationInsights\Channel\Contracts\Data_Point_Type::Value
     * @param int $count the number of samples
     * @param float $min the minimum of the samples
     * @param float $max the maximum of the samples
     * @param float $stdDev the standard deviation of the samples
     * @param array $properties An array of name to value pairs. Use the name as the index and any string as the value.
     */
    public function trackMetric($name, $value, $type = null, $count = null, $min = null, $max = null, $stdDev = null, $properties = null) : void
    {
        $dataPoint = new Channel\Contracts\Data_Point();
        $dataPoint->setName($name);
        $dataPoint->setValue($value);
        $dataPoint->setKind($type == null ? Channel\Contracts\Data_Point_Type::Aggregation : $type);
        $dataPoint->setCount($count);
        $dataPoint->setMin($min);
        $dataPoint->setMax($max);
        $dataPoint->setStdDev($stdDev);

        $data = new Channel\Contracts\Metric_Data();
        $data->setMetrics([$dataPoint]);

        if ($properties != null) {
            $data->setProperties($properties);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends an Event_Data to the Application Insights service.
     *
     * @param string $name
     * @param array $properties An array of name to value pairs. Use the name as the index and any string as the value.
     * @param array $measurements An array of name to double pairs. Use the name as the index and any double as the value.
     */
    public function trackEvent($name, $properties = null, $measurements = null) : void
    {
        $data = new Channel\Contracts\Event_Data();
        $data->setName($name);

        if ($properties != null) {
            $data->setProperties($properties);
        }

        if ($measurements != null) {
            $data->setMeasurements($measurements);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends an Message_Data to the Application Insights service.
     *
     * @param string $message the trace message
     * @param string $severityLevel The severity level of the message. Found: \ApplicationInsights\Channel\Contracts\Message_Severity_Level::Value
     * @param array $properties An array of name to value pairs. Use the name as the index and any string as the value.
     */
    public function trackMessage($message, $severityLevel = null, $properties = null) : void
    {
        $data = new Channel\Contracts\Message_Data();
        $data->setMessage($message);
        $data->setSeverityLevel($severityLevel);

        if ($properties != null) {
            $data->setProperties($properties);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends a Request_Data to the Application Insights service.
     *
     * @param string $name a friendly name of the request
     * @param string $url the url of the request
     * @param int $startTime the timestamp at which the request started
     * @param int $durationInMilliseconds the duration, in milliseconds, of the request
     * @param int $httpResponseCode the response code of the request
     * @param bool $isSuccessful whether or not the request was successful
     * @param array $properties An array of name to value pairs. Use the name as the index and any string as the value.
     * @param array $measurements An array of name to double pairs. Use the name as the index and any double as the value.
     */
    public function trackRequest($name, $url, $startTime, $durationInMilliseconds = 0, $httpResponseCode = 200, $isSuccessful = true, $properties = null, $measurements = null) : void
    {
        $this->endRequest($this->beginRequest($name, $url, $startTime), $durationInMilliseconds, $httpResponseCode, $isSuccessful, $properties, $measurements);
    }

    /**
     * Begin a Request_Data to the Application Insights service. This request is not sent until an @see endRequest call is made, passing this request.
     *
     * @param string $name a friendly name of the request
     * @param string $url the url of the request
     * @param int $startTime the timestamp at which the request started
     *
     * @return \ApplicationInsights\Channel\Contracts\Request_Data an initialized Request_Data, which can be sent by using @see endRequest
     */
    public function beginRequest($name, $url, $startTime)
    {
        $data = new Channel\Contracts\Request_Data();
        $guid = \ApplicationInsights\Channel\Contracts\Utils::returnGuid();
        $data->setId($guid);
        $data->setName($name);
        $data->setUrl($url);
        $data->setTime($startTime);

        return $data;
    }

    /**
     * Sends a Request_Data created by @see beginRequest to the Application Insights service.
     *
     * @param int $durationInMilliseconds the duration, in milliseconds, of the request
     * @param int $httpResponseCode the response code of the request
     * @param bool $isSuccessful whether or not the request was successful
     * @param array $properties An array of name to value pairs. Use the name as the index and any string as the value.
     * @param array $measurements An array of name to double pairs. Use the name as the index and any double as the value.
     */
    public function endRequest(Channel\Contracts\Request_Data $request, $durationInMilliseconds = 0, $httpResponseCode = 200, $isSuccessful = true, $properties = null, $measurements = null) : void
    {
        $request->setResponseCode($httpResponseCode);
        $request->setSuccess($isSuccessful);

        $request->setDuration(Channel\Contracts\Utils::convertMillisecondsToTimeSpan($durationInMilliseconds));

        if ($properties != null) {
            $request->setProperties($properties);
        }

        if ($measurements != null) {
            $request->setMeasurements($measurements);
        }

        $this->_channel->addToQueue($request, $this->_context);
    }

    /**
     * Sends an Exception_Data to the Application Insights service.
     *
     * @param \Exception|\Throwable $ex The exception/throwable to send
     * @param array $properties An array of name to value pairs. Use the name as the index and any string as the value.
     * @param array $measurements An array of name to double pairs. Use the name as the index and any double as the value.
     */
    public function trackException($ex, $properties = null, $measurements = null) : void
    {
        $details = new Channel\Contracts\Exception_Details();
        $details->setId(1);
        $details->setOuterId(0);
        $details->setTypeName(\get_class($ex));
        $details->setMessage($ex->getMessage() . ' in ' . $ex->getFile() . ' on line ' . $ex->getLine());
        $details->setHasFullStack(true);

        $stackFrames = [];

        // First stack frame is in the root exception
        $frameCounter = 0;

        foreach ($ex->getTrace() as $currentFrame) {
            $stackFrame = new Channel\Contracts\Stack_Frame();

            if (\array_key_exists('class', $currentFrame) == true) {
                $stackFrame->setAssembly($currentFrame['class']);
            }

            if (\array_key_exists('file', $currentFrame) == true) {
                $stackFrame->setFileName($currentFrame['file']);
            }

            if (\array_key_exists('line', $currentFrame) == true) {
                $stackFrame->setLine($currentFrame['line']);
            }

            if (\array_key_exists('function', $currentFrame) == true) {
                $stackFrame->setMethod($currentFrame['function']);
            }

            // Make it a string to force serialization of zero
            $stackFrame->setLevel('' . $frameCounter);

            \array_unshift($stackFrames, $stackFrame);
            $frameCounter++;
        }

        $details->setParsedStack($stackFrames);

        $data = new Channel\Contracts\Exception_Data();
        $data->setExceptions([$details]);

        if ($properties != null) {
            $data->setProperties($properties);
        }

        if ($measurements != null) {
            $data->setMeasurements($measurements);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends an Dependency_Data to the Application Insights service.
     *
     * @param string $name name of the dependency
     * @param string $type the Dependency type of value being sent
     * @param string $commandName command/Method of the dependency
     * @param int $startTime the timestamp at which the request started
     * @param int $durationInMilliseconds the duration, in milliseconds, of the request
     * @param bool $isSuccessful whether or not the request was successful
     * @param int $resultCode the result code of the request
     * @param array $properties An array of name to value pairs. Use the name as the index and any string as the value.
     */
    public function trackDependency(
        $name,
        $type = '',
        $commandName = null,
        $startTime = null,
        $durationInMilliseconds = 0,
        $isSuccessful = true,
        $resultCode = null,
        $properties = null
    ) : void
    {
        $data = new Channel\Contracts\Dependency_Data();
        $data->setName($name);
        $data->setType($type);
        $data->setData($commandName);
        $data->setDuration(Channel\Contracts\Utils::convertMillisecondsToTimeSpan($durationInMilliseconds));
        $data->setSuccess($isSuccessful);
        $data->setResultCode($resultCode);

        if ($properties != null) {
            $data->setProperties($properties);
        }

        $this->_channel->addToQueue($data, $this->_context, $startTime);
    }

    /**
     * Flushes the underlying Telemetry_Channel queue.
     *
     * @param array $options - Guzzle client option overrides
     * @param bool $sendAsync - Send the request asynchronously
     *
     * @return null|\GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface|WP_Error
     */
    public function flush($options = [], $sendAsync = false)
    {
        $response = $this->_channel->send($options, $sendAsync);
        $this->_channel->setQueue([]);

        return $response;
    }
}
