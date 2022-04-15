<?php declare(strict_types=1);
namespace ApplicationInsights\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Contains tests for Telemetry_Context class.
 */
class Telemetry_Context_Test extends TestCase
{
    public function testInstrumentationKey() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $instrumentationKey = Utils::getTestInstrumentationKey();
        $telemetryContext->setInstrumentationKey($instrumentationKey);
        $this->assertEquals($instrumentationKey, $telemetryContext->getInstrumentationKey());
    }

    public function testDeviceContext() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $context = $telemetryContext->getDeviceContext();
        $this->assertEquals($context, new \ApplicationInsights\Channel\Contracts\Device());
        $telemetryContext->setDeviceContext(Utils::getSampleDeviceContext());
        $context = $telemetryContext->getDeviceContext();
        $this->assertEquals($context, Utils::getSampleDeviceContext());
    }

    public function testCloudContext() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $context = $telemetryContext->getCloudContext();
        $this->assertEquals($context, new \ApplicationInsights\Channel\Contracts\Cloud());
        $telemetryContext->setCloudContext(Utils::getSampleCloudContext());
        $context = $telemetryContext->getCloudContext();
        $this->assertEquals($context, Utils::getSampleCloudContext());
    }

    public function testApplicationContext() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $context = $telemetryContext->getApplicationContext();
        $this->assertEquals($context, new \ApplicationInsights\Channel\Contracts\Application());
        $telemetryContext->setApplicationContext(Utils::getSampleApplicationContext());
        $context = $telemetryContext->getApplicationContext();
        $this->assertEquals($context, Utils::getSampleApplicationContext());
    }

    public function testUserContext() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $context = $telemetryContext->getUserContext();

        $defaultUserContext = new \ApplicationInsights\Channel\Contracts\User();
        $currentUser = new \ApplicationInsights\Current_User();
        $defaultUserContext->setId($currentUser->id);
        $this->assertEquals($context, $defaultUserContext);

        $telemetryContext->setUserContext(Utils::getSampleUserContext());
        $context = $telemetryContext->getUserContext();
        $this->assertEquals($context, Utils::getSampleUserContext());
    }

    public function testLocationContext() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $context = $telemetryContext->getLocationContext();
        $this->assertEquals($context, new \ApplicationInsights\Channel\Contracts\Location());
        $telemetryContext->setLocationContext(Utils::getSampleLocationContext());
        $context = $telemetryContext->getLocationContext();
        $this->assertEquals($context, Utils::getSampleLocationContext());
    }

    public function testOperationContext() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $context = $telemetryContext->getOperationContext();
        $this->assertNotEmpty($context->getId());
        $telemetryContext->setOperationContext(Utils::getSampleOperationContext());
        $context = $telemetryContext->getOperationContext();
        $this->assertEquals($context, Utils::getSampleOperationContext());
    }

    public function testSessionContext() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $context = $telemetryContext->getSessionContext();

        $defaultSessionContext = new \ApplicationInsights\Channel\Contracts\Session();
        $currentSession = new \ApplicationInsights\Current_Session();
        $defaultSessionContext->setId($currentSession->id);
        $this->assertEquals($context, $defaultSessionContext);

        $telemetryContext->setSessionContext(Utils::getSampleSessionContext());
        $context = $telemetryContext->getSessionContext();
        $this->assertEquals($context, Utils::getSampleSessionContext());
    }

    public function testProperties() : void
    {
        $telemetryContext = new \ApplicationInsights\Telemetry_Context();
        $properties = $telemetryContext->getProperties();
        $this->assertEquals($properties, []);
        $telemetryContext->setProperties(Utils::getSampleCustomProperties());
        $properties = $telemetryContext->getProperties();
        $this->assertEquals($properties, Utils::getSampleCustomProperties());
    }
}
