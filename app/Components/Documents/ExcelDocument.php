<?php

namespace App\Components\Documents;

use App\Components\Interfaces\XmlDocumentInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelDocument extends Document implements XmlDocumentInterface
{
    private $cols = [
        0 => 'A',
        1 => 'B',
        2 => 'C',
        3 => 'D',
        4 => 'E',
        5 => 'F',
        6 => 'G',
        7 => 'H',
        8 => 'I',
        9 => 'J',
        10 => 'K',
        11 => 'L',
        12 => 'M',
        13 => 'N',
        14 => 'O',
        15 => 'P',
    ];

    /**
     * @var string
     */
    private $spreadsheet;

    /**
     * ExcelDocument constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->spreadsheet = new Spreadsheet();
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function render()
    {
        ob_start();
        $writer = new Xlsx($this->spreadsheet);
        $writer->save("storage/app/" . $this->name);

        $this->setContent(file_get_contents("./storage/app/" . $this->name));
    }

    /**
     * @param $name
     * @param $value
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function addItem($name, $value)
    {
        $this->spreadsheet->getActiveSheet()->setCellValue($name, $value);
    }

    /**
     * @param $rowNum
     * @param $data
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function addNestedItem($rowNum, $data)
    {
        $sheet = $this->spreadsheet->getActiveSheet();

        foreach ($data as $key => $value) {
            $sheet->setCellValue($this->cols[$key] . $rowNum, $value);
        }
    }
}
