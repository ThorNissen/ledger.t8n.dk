<?php

namespace App\Support;

class CsvHelper
{
    /**
     * Detect the delimiter used in a CSV file by inspecting the first line.
     * Falls back to comma if nothing else matches.
     */
    public static function detectDelimiter(string $filePath): string
    {
        $handle = fopen($filePath, 'r');
        $firstLine = fgets($handle);
        fclose($handle);

        if ($firstLine === false) {
            return ',';
        }

        $candidates = [';', "\t", '|', ','];
        $counts = array_map(fn (string $d) => substr_count($firstLine, $d), $candidates);

        $best = array_keys($counts, max($counts))[0];

        return $candidates[$best];
    }

    /**
     * Read the header row from a CSV file, respecting its delimiter.
     *
     * @return array<string, string>
     */
    public static function headers(string $filePath): array
    {
        $delimiter = self::detectDelimiter($filePath);

        $handle = fopen($filePath, 'r');
        $headers = fgetcsv($handle, 0, $delimiter);
        fclose($handle);

        if (! $headers) {
            return [];
        }

        // Strip BOM and whitespace, drop empty trailing columns.
        $headers = array_map(fn (string $h) => trim($h, " \t\n\r\0\x0B\xEF\xBB\xBF"), $headers);
        $headers = array_filter($headers, fn (string $h) => $h !== '');

        return array_combine($headers, $headers);
    }
}
