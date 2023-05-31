<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class UsersExport implements FromQuery, WithHeadings, ShouldQueue, WithCustomCsvSettings
{
    public function query()
    {
        return User::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Code',
            'Fullname',
            'Email',
            'Area Code',
            'Phone Number',
            'Day Of Birth',
            'Address',
            'Roles',
            'Levels',
            'Status',
            'Types',
            'Password',
            'Remember_token',
            'Created At',
            'Updated At',
            'Department_ID',
            'Delete at',
            'Note',
        ];
    }
    public function getCsvSettings(): array
    {
        return [
            'use_bom' => true,
            'output_encoding' => 'UTF-8',
        ];
    }
}
