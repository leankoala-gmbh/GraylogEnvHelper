<?php

namespace Leankoala\GraylogEnvHelper;

use Gelf\Message;

abstract class Helper
{
    const ENV_HOST = 'WORKER_HOST';
    const ENV_WORKER = 'WORKER_IDENTIFIER';
    const ENV_ENVIRONMENT = 'WORKER_ENVIRONMENT';

    /**
     * Create a Graylog GelfMessage using ENV vars for setting mandatory fields.
     *
     * @param $facility
     * @param $shortMessage
     * @return Message
     */
    public static function createMessage($facility, $shortMessage)
    {
        $gelfMessage = new Message();

        $gelfMessage->setShortMessage($shortMessage);
        $gelfMessage->setFacility($facility);

        $gelfMessage->setHost(self::getHost());

        $gelfMessage->setAdditional('environment', self::getEnvironment());
        $gelfMessage->setAdditional('worker', self::getWorker());

        return $gelfMessage;
    }

    private static function getEnvironment()
    {
        return self::getEnv(self::ENV_ENVIRONMENT, 'develop');
    }

    private static function getWorker()
    {
        return self::getEnv(self::ENV_WORKER, 'local');
    }

    private static function getHost()
    {
        return self::getEnv(self::ENV_HOST, 'local');
    }

    private static function getEnv($key, $fallback)
    {
        if (getenv($key)) {
            return getenv($key);
        } else {
            return $fallback;
        }
    }
}
