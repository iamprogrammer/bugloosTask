<?php

namespace App\Repositories;

use App\Models\LogFile;
use Illuminate\Database\Eloquent\Builder;


class LogRepository implements InterfaceLogRepository
{
    /**
     * this function return count of logs
     * it can add filter on some fields
     * the fields that can be filtered are these items : [created_date, service_name, status_code]
     * The requested filters are like this:[startDate, endDate, serviceNames, statusCode]
     * if there is no filter all logs count should be return
     */
    public function getLogsCount($items)
    : int
    {
        $query = LogFile::query();
        $query = $this->getFilteredQuery($query, $items);

        return $query->count();
    }

    /**
     * this private method is to make query filter and return it
     * @param $query
     * @param $items
     * @return Builder
     */
    private function getFilteredQuery($query, $items)
    : Builder
    {
        return $query->when(isset($items["startDate"]), function ($query) use ($items) {
            $query->where("created_date", ">=", $items["startDate"]);
            })
            ->when(isset($items["endDate"]), function ($query) use ($items) {
                $query->where("created_date", "<=", $items["endDate"]);
            })
            ->when(isset($items["serviceNames"]), function ($query) use ($items) {
                $query->where("service_name", "like", "%" . $items["serviceNames"] . "%");
            })
            ->when(isset($items["statusCode"]), function ($query) use ($items) {
                $query->where("status_code", $items["statusCode"]);
            });
    }
}
