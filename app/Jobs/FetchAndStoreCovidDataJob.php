<?php

namespace App\Jobs;

use App\Models\CovidCase;
use App\Models\CovidTest;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchAndStoreCovidDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $apiUrl = config('covid19.covid_api_url');

        try{
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->get($apiUrl);
        }
        catch(Exception $ex){
            Log::error('Error in fetch data - '. $ex->getMessage());
        }

        if($response->status() != 200){
            Log::error('Api fetch response - '. $response->status());
            return;
        }

        $body = $response->getBody();
        $contents = json_decode($body->getContents(), true)['data'];

        $covidCases = Arr::except($contents,['daily_pcr_testing_data','daily_antigen_testing_data','hospital_data']);

        //update records on covid_cases table
        $this->updateOrCreateCovidCases($covidCases);


        $coviTestsDataCount = CovidTest::count();
        if($coviTestsDataCount == 0){
            //first time upload all the records to the covid_tests table
            $this->createCovidDataOnlyFirstTime($contents);
        }
        else{
            //only create or update new data on covid_tests
            $date = Carbon::today()->format('Y-m-d');
            $pcr_count = collect($contents['daily_pcr_testing_data'])->where('date', $date)->max('pcr_count') ?? 0;
            $antigen_count = collect($contents['daily_antigen_testing_data'])->where('date', $date)->max('pcr_count') ?? 0;

            $this->createOrUpdateNewCovidTestData($date, $pcr_count, $antigen_count);

        }

    }

    private function updateOrCreateCovidCases(array $covidCases)
    {
        // check is there have a record for current data
        $todayCovidCaseRecordId = CovidCase::query()
            ->whereDate('created_at',Carbon::today())
            ->value('id');

        CovidCase::updateOrCreate([
                'id' => $todayCovidCaseRecordId
            ],$covidCases);
    }

    private function createCovidDataOnlyFirstTime($contents)
    {
        $pcrTestsDataChunks = collect($contents['daily_pcr_testing_data'])->chunk(50);
        foreach($pcrTestsDataChunks as $pcrTestsDataCollections){
            foreach($pcrTestsDataCollections as $pcrTestData){
                try{
                    CovidTest::updateOrCreate(['date' => $pcrTestData['date']],$pcrTestData);
                }
                catch(Exception $ex){
                    Log::error('Covid Test pcr data insert error - '. $ex->getMessage());
                }
            }
        }

        $antigenTestsDataChunks = collect($contents['daily_antigen_testing_data'])->chunk(50);

        foreach($antigenTestsDataChunks as $antigenTestDataCollection){
            foreach($antigenTestDataCollection as $antigenTestData){
                try{
                    CovidTest::updateOrCreate(['date' => $antigenTestData['date']],$antigenTestData);
                }
                catch(Exception $ex){
                    Log::error('Covid Test antigen data insert error - '. $ex->getMessage());
                }
            }
        }

    }

    private function createOrUpdateNewCovidTestData($date, $pcr_count, $antigen_count)
    {
        CovidTest::updateOrCreate([
            'date' => $date
        ],[
            'date' => $date,
            'pcr_count' => $pcr_count,
            'antigen_count' => $antigen_count
        ]);
    }

}
