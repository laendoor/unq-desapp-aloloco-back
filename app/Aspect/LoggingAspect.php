<?php

namespace App\Aspect;

use Carbon\Carbon;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Psr\Log\LoggerInterface;

/**
 * Application logging aspect
 */
class LoggingAspect implements Aspect
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Logging Service's: <timestamp, user, method, parameters>
     *
     * @param MethodInvocation $invocation
     * @After("execution(public App\Repository\Doctrine*Repository->*(*))")
     */
    public function beforeMethod(MethodInvocation $invocation)
    {
        $obj = $invocation->getThis();
        $method = $invocation->getMethod();
        $className = is_object($obj) ? get_class($obj) : $obj;

        if (!$method->isConstructor()) {
            $timestamp = Carbon::now();
            // esto genera una recursión infinita pq vuelve a entrar a este poincut
            // $user = resolve(UserRepository::class)->find(1);
            $user = 'none';
            $method = $className . '::' . $method->getName();
            $args = collect($invocation->getArguments())->map(function ($arg) {
                return is_array($arg) ? $this->parseArray($arg) : $arg;
            });
            $parameters = $args->isEmpty() ? 'without parameters' : 'with '.$this->parseArray($args->toArray()).')';

            $this->logger->info("<$timestamp, $user, $method, $parameters>");
        }

    }

    protected function parseArray(array $array = []) {
        return "[". implode(',', $array) ."]";
    }
}