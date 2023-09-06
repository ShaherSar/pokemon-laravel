<?php

namespace App\Services\ExcelFileService;

use App\Models\Animal;
use Illuminate\Support\Collection;

class AnimalsExcelParser{
    protected ExcelFile $excelFile;

    public function __construct($excelFile){
        $this->excelFile = $excelFile;

        $this->excelFile->setWorkSheet(0);
    }

    public function getAnimals() : Collection {
        $animalRecords = $this->excelFile->getRows(2);

        $animalsAttributesHashMap = $this->excelFile->getAttributesHashMap();

        $animals = [];

        foreach($animalRecords as $animalRecord){
            $animal = new Animal();

            $animal->name = $animalRecord[$animalsAttributesHashMap['Name']];
            $animal->pokedex_number = $animalRecord[$animalsAttributesHashMap['Pokedex_Number']];
            $animal->image_name = $animalRecord[$animalsAttributesHashMap['Img_name']];
            $animal->generation = $animalRecord[$animalsAttributesHashMap['Generation']];
            $animal->evolution_stage = is_numeric($animalRecord[$animalsAttributesHashMap['Evolution_Stage']]) ?
                $animalRecord[$animalsAttributesHashMap['Evolution_Stage']] : NULL;
            $animal->evolved = $animalRecord[$animalsAttributesHashMap['Evolved']] ?? false;
            $animal->family_id = $animalRecord[$animalsAttributesHashMap['FamilyID']];
            $animal->cross_gen = $animalRecord[$animalsAttributesHashMap['Cross_Gen']];
            $animal->type_1 = $animalRecord[$animalsAttributesHashMap['Type_1']];
            $animal->type_2 = $animalRecord[$animalsAttributesHashMap['Type_2']];
            $animal->weather_1 = $animalRecord[$animalsAttributesHashMap['Weather_1']];
            $animal->weather_2 = $animalRecord[$animalsAttributesHashMap['Weather_2']];
            $animal->stats_total = $animalRecord[$animalsAttributesHashMap['STAT_TOTAL']];
            $animal->stats_attack = $animalRecord[$animalsAttributesHashMap['ATK']];
            $animal->stats_defend = $animalRecord[$animalsAttributesHashMap['DEF']];
            $animal->stats_stamina = $animalRecord[$animalsAttributesHashMap['STA']];
            $animal->legendary = $animalRecord[$animalsAttributesHashMap['Legendary']];
            $animal->aquireable = $animalRecord[$animalsAttributesHashMap['Aquireable']];
            $animal->spawns = $animalRecord[$animalsAttributesHashMap['Spawns']];
            $animal->regional = $animalRecord[$animalsAttributesHashMap['Regional']];
            $animal->raidable = $animalRecord[$animalsAttributesHashMap['Raidable']];
            $animal->hatchable = $animalRecord[$animalsAttributesHashMap['Hatchable']];
            $animal->shiny = $animalRecord[$animalsAttributesHashMap['Shiny']];
            $animal->nest = $animalRecord[$animalsAttributesHashMap['Nest']];
            $animal->new = $animalRecord[$animalsAttributesHashMap['New']];
            $animal->not_gettable = $animalRecord[$animalsAttributesHashMap['Not-Gettable']];
            $animal->future_evolve = $animalRecord[$animalsAttributesHashMap['Future_Evolve']];
            $animal->cp_40 = $animalRecord[$animalsAttributesHashMap['100%_CP_@_40']];
            $animal->cp_39 = $animalRecord[$animalsAttributesHashMap['100%_CP_@_39']];

            $animals[] = $animal;
        }

        return collect($animals);
    }
}