<?php

namespace App\Exports;

use App\Iborseminar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;

class SeminarExport implements FromCollection, withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Iborseminar::select('reg_code', 'fname', 'lname', 'email', 'phone_number', 'occupation')->get();
    }

    public function headings (): array 
    {
    	return [
    		'#',
    		'CODE',
    		'FIRST NAME',
    		'LAST NAME',
    		'EMAIL',
    		'PHONE NUMBER',
    		'OCCUPATION',
    	];
    }
}
