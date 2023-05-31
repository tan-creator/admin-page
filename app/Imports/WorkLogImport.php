<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Worklog;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class WorkLogImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    WithBatchInserts,
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
        return new Worklog([
            'email' => $row['username'],
            'issue_type' => $row['issue_type'],
            'issue_estimate' => $row['issue_original_estimate'],
            'hours' => $row['hours'],
            'work_date' =>
            \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['work_date'])
                ->format('Y-m-d H:i:s'),
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'numeric',
            'issue_type' => [
                Rule::in(['Bug', 'Bug_Customer', 'Change Request', 'Epic', 'Feedback', 'Improvement', 'Leakage', 'Q&A', 'Sub-task', 'Task', 'New Feature'])
            ],
            'issue_estimate' => 'min:0',
            'hours' => 'min:0',
            'work_date' => 'before:today',
        ];
    }
}
