<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterLogeRequest;
use App\Repositories\InterfaceLogRepository;
use Illuminate\Contracts\Container\BindingResolutionException;

class LogFileController extends Controller
{
    private InterfaceLogRepository $logRepo;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->logRepo = app()->make(InterfaceLogRepository::class);
    }

    public function LogCount(FilterLogeRequest $request)
    {
        $count = $this->logRepo->getLogsCount($request->all());

        return response(["count" => $count]);
    }
}
