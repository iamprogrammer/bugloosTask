<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterLogRequest;
use App\Repositories\InterfaceLogRepository;
use Illuminate\Contracts\Container\BindingResolutionException;

class LogFileController extends Controller
{
    private InterfaceLogRepository $logRepo;

    /**
     * injecting dependencies by constructor.
     *
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->logRepo = app()->make(InterfaceLogRepository::class);
    }

    /**
     * this action return count of logs that exists in database by accepting some filters.
     * filters are contains : [startDate, endDate, serviceNames, statusCode]
     */
    public function LogCount(FilterLogRequest $request)
    {
        $count = $this->logRepo->getLogsCount($request->validated());

        return response(["count" => $count]);
    }
}
