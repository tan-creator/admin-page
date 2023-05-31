<?php

namespace App\Imports;

use App\Imports\WorkLogImport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class HandleSheets implements WithMultipleSheets, SkipsUnknownSheets
{
    use WithConditionalSheets, Importable;

    public function conditionalSheets(): array
    {
        return [
            'Worklogs' => new WorkLogImport(),
            'Users' => new UsersImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }
}
