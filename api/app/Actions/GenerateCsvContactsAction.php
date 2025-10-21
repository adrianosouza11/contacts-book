<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class GenerateCsvContactsAction
{
    public function generate(Collection $data, string $absolutePath) : void
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            'ID',
            'Nome',
            'Telefone',
            'E-mail',
            'Endereço',
            'Número',
            'Bairro',
            'Cidade',
            'Estado',
            'CEP',
            'Criado em:'
        ]);

        $row = 2;

        foreach ($data as $eachData) {
            $sheet->setCellValue("A{$row}", $eachData->id);
            $sheet->setCellValue("B{$row}", $eachData->contact_name);
            $sheet->setCellValue("C{$row}", $eachData->contact_phone);
            $sheet->setCellValue("D{$row}", $eachData->contact_email);
            $sheet->setCellValue("E{$row}", $eachData->address);
            $sheet->setCellValue("F{$row}", $eachData->number);
            $sheet->setCellValue("G{$row}", $eachData->neighborhood);
            $sheet->setCellValue("H{$row}", $eachData->city);
            $sheet->setCellValue("I{$row}", $eachData->state);
            $sheet->setCellValue("J{$row}", $eachData->postal_code);
            $sheet->setCellValue("K{$row}", $eachData->created_at ?? '');

            $row++;
        }

        $writer = new Csv($spreadsheet);

        $writer->setDelimiter(',');
        $writer->setEnclosure('');
        $writer->setLineEnding("\r\n");
        $writer->setSheetIndex(0);

        $writer->save($absolutePath);
    }
}
