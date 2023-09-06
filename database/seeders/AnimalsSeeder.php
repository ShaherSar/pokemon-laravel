<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Services\ExcelFileService\AnimalsExcelParser;
use App\Services\ExcelFileService\ExcelFile;
use Illuminate\Database\Seeder;

class AnimalsSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $inputFileName = storage_path()."\\app\\files\\PokemonGo.xlsx";

        $animalsExcelFile = new ExcelFile($inputFileName);

        $animalsExcelParser = new AnimalsExcelParser($animalsExcelFile);

        $animals = $animalsExcelParser->getAnimals();

        $animals->each(function(Animal $animal){
           $animal->save();
        });

    }
}
