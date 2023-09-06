<?php

namespace App\Services\ExcelFileService;

use App\Helpers\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelFile{
    protected string $filePath;

    protected Spreadsheet $spreadSheet;

    protected ?Worksheet $workSheet;

    protected int $highestRow;

    public function __construct(string $filePath){
        $this->filePath = $filePath;

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $reader->setReadDataOnly(true);

        $this->spreadSheet = $reader->load($this->filePath);
    }

    public function getRows(int $offset = 1,int $limit = 0) : array {
        if(!$this->workSheet){
            throw new \Exception("set worksheet first");
        }

        $endRow = $limit > 0 ? ($offset + $limit - 1) : $this->highestRow;

        $recordsHashMap = [];

        $rowIterator = $this->workSheet->getRowIterator($offset, $endRow);

        while($rowIterator->valid()){
            $row = $rowIterator->current();

            $rowData = [];

            $columnIterator = $row->getCellIterator();

            while($columnIterator->valid()){
                $cell = $columnIterator->current();

                $rowData[$cell->getColumn()] = $cell->getValue();

                $columnIterator->next();
            }

            $recordsHashMap[$row->getRowIndex()] = $rowData;

            $rowIterator->next();
        }

        return $recordsHashMap;
    }

    public function getRowsNumber() : int {
        return $this->highestRow;
    }

    public function setWorkSheet(int $sheetIndex) : bool {
        if(!isset($this->spreadSheet->getAllSheets()[$sheetIndex])){
            return false;
        }

        $this->workSheet = $this->spreadSheet->getSheet($sheetIndex);

        $this->highestRow = $this->workSheet->getHighestRow();

        return true;
    }

    public function getAttributesHashMap() : array {
        $attributesHashmap = [];

        foreach($this->getRows(1,1)[1] as $key => $columnName){
            $attributesHashmap[StringHelper::stringToKey($columnName)] = $key;
        }

        return $attributesHashmap;
    }
}