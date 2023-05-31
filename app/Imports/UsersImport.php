<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UsersImport implements 
      ToModel, 
      WithHeadingRow, 
      WithValidation,
      WithBatchInserts,
      WithUpserts,
      WithChunkReading
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return  new User([
            'fullname' => $row['full_name'],
            'email' => $row['username'],
        ]);
    }

    public function batchSize(): int
    {
        return 25;
    }

    public function chunkSize(): int
    {
        return 25;
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'email';
    }

    public function rules(): array
    {
        return [
            'email' => 'email|max:50',
            'fullname' => 'max:50',
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'email.email' => 'Username field must be a valid email address',
            'email.max' => 'Username field must be under 50 characters',
            'fullname.max' => 'Full name field must be under 50 characters',
        ];
    }
}
