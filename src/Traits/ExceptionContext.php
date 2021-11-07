<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget\Traits;

use Throwable;

trait ExceptionContext
{
    /**
     * Get the exception code context for the given exception.
     *
     * @return string
     */
    public function getContextAsString(Throwable $exception)
    {
        $context = $this->getContext($exception);

        $exceptionLine = $exception->getLine();

        $markedExceptionLine = sprintf('> %s', $exceptionLine);

        $maxLineLen = max(strlen(array_key_last($context)), strlen($markedExceptionLine));

        $contextString = PHP_EOL.array_reduces(
                $context,
                function ($carry, $code, $line) use ($maxLineLen, $exceptionLine, $markedExceptionLine) {
                    $line === $exceptionLine and $line = $markedExceptionLine;

                    $line = str_pad($line, $maxLineLen, ' ', STR_PAD_LEFT);

                    return "$carry    $line    $code".PHP_EOL;
                },
                ''
            );

        return sprintf('[%s]', $contextString);
    }

    /**
     * Get the exception code context for the given exception.
     *
     * @return array
     */
    public function getContext(Throwable $exception)
    {
        return $this->getEvalContext($exception) ?? $this->getFileContext($exception);
    }

    /**
     * Get the exception code context when eval() failed.
     *
     * @return array|null
     */
    protected function getEvalContext(Throwable $exception)
    {
        if (str_contains($exception->getFile(), "eval()'d code")) {
            return [
                $exception->getLine() => "eval()'d code",
            ];
        }
    }

    /**
     * Get the exception code context from a file.
     *
     * @return array
     */
    protected function getFileContext(Throwable $exception)
    {
        $context = explode("\n", file_get_contents($exception->getFile()));

        $context = array_slice($context, $exception->getLine() - 10, 20, true);

        return array_reduces($context, function ($carry, $value, $key) {
            $carry[$key + 1] = $value;

            return $carry;
        }, []);
    }
}
