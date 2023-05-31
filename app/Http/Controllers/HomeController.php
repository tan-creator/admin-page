<?php

namespace App\Http\Controllers;

use App\Http\Requests\CSVRequest;
use App\Imports\HandleSheets;
use App\Models\User;
use App\Models\Worklog;
use App\Models\Department;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class HomeController extends Controller
{
    private $workLog;
    private $sheet;

    public function __construct(Worklog $workLog, HandleSheets $sheet)
    {
        $this->workLog = $workLog;
        $this->sheet = $sheet;
    }

    public function getUserWorked()
    {
        return User::has('worklogs')
            ->pluck('fullname', 'users.email')
            ->all();
    }

    public function index(Request $request)
    {
        $userWorkeds = $this->getUserWorked();
        $workLogList = $this->workLog->paginate(config('constants.paginates'));
        //Draw line
        if ($request->has('today')) {
            $result = $this->valueOfDrawline(true);
            if (!empty($result)) {
                $categories = date_format(new DateTime(), 'Y-m-d');
                $text = __('layout_master.today');
            }
        } else {
            $result = $this->valueOfDrawline();
            if (!empty($result)) {
                $categories = array_map(function ($category) {
                    $dateTime = date_create($category);
                    return date_format($dateTime, 'd-m-Y');
                }, array_keys(array_values($result)[0]));
                $text = __('layout_master.month');
            }
        }
        //Draw column
        if (!$request->has('columnChartDepartmentId') || empty(Department::find($request->columnChartDepartmentId))) {
            $department = ['id' => null, 'name' => null];
            $department = json_decode(json_encode($department));
        } else {
            $department = Department::find($request->columnChartDepartmentId);
        }

        $month = Carbon::now()->month - 1;
        $task = $this->countOfCondition('Task', $month, $department->id);
        $bug = $this->checkKeyInArray($task, $this->countOfCondition('Bug', $month,  $department->id));
        $bugCustomer = $this->checkKeyInArray($task, $this->countOfCondition('Bug_Customer', $month,  $department->id));

        ksort($bug);
        ksort($bugCustomer);

        return view('admin.pages.home', [
            'tittle' => 'Home',
            'text' =>  empty($text) ? 'No data' : $text,
            'worklogs' => $result,
            'categories' => empty($categories) ? [] : $categories,
            'workLogList' => $workLogList,
            'fullname' => $userWorkeds,
            'bug' => $bug,
            'bugCustomer' => $bugCustomer,
            'tasks' => $task,
            'userName' => array_keys($task),
            'month' => (!empty($department->name) ? $department->name : "Other") . "/" . $month . "-" . Carbon::now()->year,
            'departments' => Department::all(),
        ]);
    }

    public function import(CSVRequest $request)
    {
        try {
            config()->set('database.connections.mysql.strict', false); // turn off strict mode
            DB::reconnect();

            $this->sheet
                ->onlySheets('Users')
                ->import($request->file('file'), null, Excel::XLSX); // import users
            $this->sheet
                ->onlySheets('Worklogs')
                ->import($request->file('file'), null, Excel::XLSX); // import worklogs

            config()->set('database.connections.mysql.strict', true); // turn on strict mode
            DB::reconnect();

            return to_route('dashboard');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('failures', $failures);
        }
    }

    /*
    ** Create query
    */
    public function getQueryCondition($query, $departmentId, $month, $condition)
    {
        $query->join('users', 'worklog.email', '=', 'users.email')
            ->where('users.department_id', $departmentId)
            ->whereMonth('work_date', $month);

        if ($condition === 'Bug' || $condition === 'Bug_Customer') {
            $query->where('issue_type', $condition);
        } else if ($condition === 'Task') {
        }
        return $query;
    }

    /*
    ** Count amount bug, bug customer, task for each user
    */
    public function countOfCondition($condition, $month, $departmentId)
    {
        $query = Worklog::select('users.fullname', DB::raw('COUNT(worklog.issue_type) as count'));

        $query = $this->getQueryCondition($query, $departmentId, $month, $condition);

        $result = $query
            ->groupBy('worklog.email')
            ->get()
            ->mapWithKeys(function ($count) {
                return [$count['fullname'] => $count['count']];
            })
            ->toArray();

        if ($condition === 'Task') {
            ksort($result);
        }

        return $result;
    }

    /*
    ** Add key with value 0 to the small array if the small array do not have the key of large array
    */
    public function checkKeyInArray($largeArray, $smallArray)
    {
        foreach ($largeArray as $key => $value) {
            if (!array_key_exists($key, $smallArray)) {
                $smallArray[$key] = 0;
            }
        }
        return $smallArray;
    }
    public function valueOfDrawline(Bool $check = false)
    {
        if ($check) {
            return Worklog::with('user')
                ->select('email', DB::raw('ROUND(AVG(issue_estimate/hours), 2) as work_performance'), 'work_date')
                ->whereDate('work_date', 'now')
                ->groupBy('email', 'work_date')
                ->get()
                ->groupBy(function ($item) {
                    return $item->user->fullname;
                })
                ->mapWithKeys(function ($grouped, $key) {
                    return [$key => $grouped->pluck('work_performance', 'work_date')->toArray()];
                })
                ->toArray();
        }
        $result =  Worklog::with('user')
            ->select('email', DB::raw('ROUND(AVG(issue_estimate/hours), 2) as work_performance'), 'work_date')
            ->groupBy('email', 'work_date')
            ->get()
            ->groupBy(function ($item) {
                return $item->user->fullname;
            })
            ->mapWithKeys(function ($grouped, $key) {
                return [$key => $grouped->pluck('work_performance', 'work_date')->toArray()];
            })
            ->toArray();
        if (!empty($result)) {
            $firstDate = date_create(Worklog::select(DB::raw('MIN(work_date) as first_date'))->value('first_date'));
            $lastDate = date_create(Worklog::select(DB::raw('MAX(work_date) as last_date'))->value('last_date'));
            foreach ($result as $username => $userWorklogs) {
                $date = clone $firstDate;
                while ($date <= $lastDate) {
                    if (!key_exists($date->format('Y-m-d H:i:s'), $userWorklogs)) {
                        $result[$username][$date->format('Y-m-d 00:00:00')] = 0;
                    }
                    $date = date_modify($date, "+1day");
                }
                ksort($result[$username]);
            }
        }
        return $result;
    }
}
