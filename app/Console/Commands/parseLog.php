<?php

namespace App\Console\Commands;

use App\Models\LogFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class parseLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:logFile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command parse the logs.txt file if exists in storage directory.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * create records
     * @return int
     */
    public function handle()
    : int
    {
        $handle = fopen(storage_path("/logs.txt"), "r") or die("Couldn't get handle");

        while (!feof($handle)) {
            $line = trim(fgets($handle), "\n\r\t\0");

            if ($line != "") {
                try {
                    $lineArray = $this->getArrayOfLine($line);
                    LogFile::firstOrCreate([
                        "service_name" => $lineArray[0],
                        "status_code"  => $lineArray[5],
                        "method"       => $lineArray[2],
                        "route"        => $lineArray[3],
                        "created_date" => $lineArray[1]
                    ]);
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }

            }
        }
        fclose($handle);
        return 0;
    }

    /**
     * this method return an array of each line of file
     * @param string $line
     * @return string[]
     */
    private function getArrayOfLine(string $line)
    : array
    {
        $cleanArray          = [];
        $explodeByDashArray  = explode("-", $line);
        $explodeBySpaceArray = explode(" ", $explodeByDashArray[count($explodeByDashArray) - 1]);
        unset($explodeByDashArray[count($explodeByDashArray) - 1]);
        unset($explodeByDashArray[count($explodeByDashArray) - 1]);
        unset($explodeBySpaceArray[0]);
        $arrayMerged = array_merge($explodeByDashArray, $explodeBySpaceArray);
        foreach ($arrayMerged as $item) {
            if (str_contains($item, '[')) {
                $cleanArray[] = $this->createDateField($item);
            }
            else {
                $cleanArray[] = str_replace(['"', ' '], '', $item);
            }
        }
        return $cleanArray;
    }

    /**
     * this method change format of date to make it readable for php date functions
     * @param string $item
     * @return string
     */
    private function createDateField(string $item)
    : string
    {
        $dateWithoutBrackets             = str_replace(['[', ']'], ' ', $item);
        $dateReplacedForwardSlashBySpace = str_replace("/", " ", $dateWithoutBrackets);
        $dateExplodedByColon             = explode(":", $dateReplacedForwardSlashBySpace);
        $date                            = $dateExplodedByColon[0] . " " . $dateExplodedByColon[1] . ":" . $dateExplodedByColon[2] . ":" . $dateExplodedByColon[3];
        return date("Y-m-d H:i:s", strtotime($date));
    }
}
