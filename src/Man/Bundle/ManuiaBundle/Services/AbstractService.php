<?php
namespace Man\Bundle\ManuiaBundle\Services;

use Monolog\Logger;
use Doctrine\ORM\EntityRepository;

/**
 *
 * @author mantoine
 *
 */
abstract class AbstractService
{
    protected $service = null;

    /**
     *
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $container;

    /**
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     *
     * @param object $container
     * @return \Ddd\Bundle\AgoraBundle\Service\Config\AbstractConfig
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     *
     * @return object
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Gets a service by id.
     *
     * @param string $id
     *            The service id
     *
     * @return object The service
     */
    public function getService($id)
    {
        return $this->container->get($id);
    }

    /**
     * Adds a log record.
     *
     * @param integer $level
     *            The logging level
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function addRecord($level, $message, array $context = array())
    {
        $logger = $this->getService('logger');
        $message = '[ Service/' . $this->service . ' ] : ' . $message;
        $logger->addRecord($level, $message, $context);
    }

    /**
     * Adds a log record at the DEBUG level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logDebug($message, array $context = array())
    {
        return $this->addRecord(Logger::DEBUG, $message, $context);
    }

    /**
     * Adds a log record at the INFO level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logInfo($message, array $context = array())
    {
        return $this->addRecord(Logger::INFO, $message, $context);
    }

    /**
     * Adds a log record at the INFO level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logNotice($message, array $context = array())
    {
        return $this->addRecord(Logger::NOTICE, $message, $context);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logWarn($message, array $context = array())
    {
        return $this->addRecord(Logger::WARNING, $message, $context);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logWarning($message, array $context = array())
    {
        return $this->addRecord(Logger::WARNING, $message, $context);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logErr($message, array $context = array())
    {
        return $this->addRecord(Logger::ERROR, $message, $context);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logError($message, array $context = array())
    {
        return $this->addRecord(Logger::ERROR, $message, $context);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logCrit($message, array $context = array())
    {
        return $this->addRecord(Logger::CRITICAL, $message, $context);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logCritical($message, array $context = array())
    {
        return $this->addRecord(Logger::CRITICAL, $message, $context);
    }

    /**
     * Adds a log record at the ALERT level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logAlert($message, array $context = array())
    {
        return $this->addRecord(Logger::ALERT, $message, $context);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logEmerg($message, array $context = array())
    {
        return $this->addRecord(Logger::EMERGENCY, $message, $context);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * This method allows for compatibility with common interfaces.
     *
     * @param string $message
     *            The log message
     * @param array $context
     *            The log context
     * @return Boolean Whether the record has been processed
     */
    protected function _logEmergency($message, array $context = array())
    {
        return $this->addRecord(Logger::EMERGENCY, $message, $context);
    }

    /**
     * Transforme la chaine $item 'decamelizeItem' en 'decamelize_item'
     *
     * @param string $item
     * @return string
     */
    protected function decamelize($item)
    {
        return implode('_', array_map('strtolower', preg_split('/([A-Z]{1}[^A-Z]*)/', $cameled, - 1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY)));
    }

    /**
     * Transforme la chaine $item 'decamelize_item' en 'decamelizeItem'
     *
     * @param string $item
     * @return string
     */
    protected function camelize($item)
    {
        return lcfirst(implode('', array_map('ucfirst', array_map('strtolower', explode('_', $item)))));
    }
}