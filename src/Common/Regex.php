<?php

namespace CPB\Utilities\Common
{
    class Regex
    {
        public static function match(string $pattern, string $subject) : array
        {
            preg_match($pattern, $subject, $matches);

            return $matches;
        }

        public static function matchAll(string $pattern, string $subject, $flag = PREG_PATTERN_ORDER) : array
        {
            preg_match_all($pattern, $subject, $matches, $flag);

            return $matches;
        }

        public static function encapsulate(string $input, string $char, string $filter = null, string $lookFor = 'A-Za-z0-9_', int $limit = -1) : string
        {
            $filter = $filter ?? $char;

            return preg_replace(
                '/(?![^' . $filter . ']*[' . $filter . '](?:[^' . $filter . ']*[' . $filter . '][^' . $filter . ']*[' . $filter . '])*[^' . $filter . ']*$)([' . $lookFor . ']+)/',
                $char . '$1' . $char,
                $input,
                $limit
            );
        }

        public static function afterLastOccurrence(string $subject, string $character = '/') : string
        {
            return static::MatchAll('/.*\\' . $character . '(.*)/', $subject)[1][0];
        }

        public static function split(string $pattern, string $subject, int $limit = -1 , int $flags = 0)
        {
            return preg_split($pattern, $subject, $limit, $flags);
        }

        public static function replace(
            $pattern,
            string $subject,
            $replacement = '$1',
            int $limit = -1 ,
            int &$count = 0
        ): ?string {
            switch(\gettype($pattern))
            {
                case 'array':
                    return \preg_replace_callback_array($pattern, $subject, $limit, $count);

                case 'string':
                    $function = \is_string($replacement)
                        ? 'preg_replace'
                        : 'preg_replace_callback';

                    return $function($pattern, $replacement, $subject, $limit, $count);

                default:
                    throw new \InvalidArgumentException(
                        'Pattern provided is of a unsupported type'
                    );
            }
        }
    }
}
