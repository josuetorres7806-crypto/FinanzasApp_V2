<?php

namespace App\Exports;

class CsvExport
{
    public static function download(
        array $rows,
        string $filename
    )
    {
        header(
            'Content-Type: text/csv'
        );

        header(
            'Content-Disposition: attachment; filename="'.$filename.'"'
        );

        $output =
            fopen(
                'php://output',
                'w'
            );

        if (!empty($rows))
        {
            fputcsv(
                $output,
                array_keys(
                    $rows[0]
                )
            );

            foreach ($rows as $row)
            {
                fputcsv(
                    $output,
                    $row
                );
            }
        }

        fclose($output);

        exit;
    }
}