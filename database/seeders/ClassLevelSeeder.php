<?php

namespace Database\Seeders;

use App\Models\ClassLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $classlevel = [
            ['ID' => 1, 'Name' => 'Guarderia','Short' => 'GRD','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'Guarderia','Accounting'=>'0','Visible'=>'0','Delta'=>'1'],
            ['ID' => 2, 'Name' => 'Lactantes','Short' => 'LAC','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'PreMaternal','Accounting'=>'0','Visible'=>'0','Delta'=>'1'],
            ['ID' => 3, 'Name' => 'Maternal','Short' => 'MAT','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'Maternal','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 4, 'Name' => '1K','Short' => '1K','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'2','SEPName'=>'Kinder 1','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 5, 'Name' => '2K','Short' => '2K','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'2','SEPName'=>'Kinder 2','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 6, 'Name' => '3K','Short' => '3K','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'2','SEPName'=>'Kinder 3','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 7, 'Name' => '1ro Prim','Short' => '1P','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'3','SEPName'=>'Primero','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 8, 'Name' => '2do Prim','Short' => '2P','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'3','SEPName'=>'Segundo','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 9, 'Name' => '3ro Prim','Short' => '3P','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'3','SEPName'=>'Tercero','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 10,'Name' => '4to Prim','Short' => '4P','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'3','SEPName'=>'Cuarto','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 11,'Name' => '5to Prim','Short' => '5P','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'3','SEPName'=>'Quinto','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 12,'Name' => '6to Prim','Short' => '6P','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'3','SEPName'=>'Sexto','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 13,'Name' => '1ro Sec','Short' => '1S','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'4','SEPName'=>'Primero','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 14,'Name' => '2do Sec','Short' => '2S','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'4','SEPName'=>'Segundo','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 15,'Name' => '3ro Sec','Short' => '3S','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'4','SEPName'=>'Tercero','Accounting'=>'0','Visible'=>'1','Delta'=>'1'],
            ['ID' => 16,'Name' => '1er Semestre','Short' => 'I','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'Primer Semestre','Accounting'=>'0','Visible'=>'0','Delta'=>'2'],
            ['ID' => 17,'Name' => '2do Semestre','Short' => 'II','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'Segundo Semestre','Accounting'=>'0','Visible'=>'0','Delta'=>'1'],
            ['ID' => 18,'Name' => '3er Semestre','Short' => 'III','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'Tercer Semestre','Accounting'=>'0','Visible'=>'0','Delta'=>'2'],
            ['ID' => 19,'Name' => '4to Semestre','Short' => 'IV','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'Cuarto Semestre','Accounting'=>'0','Visible'=>'0','Delta'=>'1'],
            ['ID' => 20,'Name' => '5to Semestre','Short' => 'V','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'Quinto Semestre','Accounting'=>'0','Visible'=>'0','Delta'=>'2'],
            ['ID' => 21,'Name' => '6to Semestre','Short' => 'VI','CurrentCap'=>'0','FutureCap'=>'0','GroupCap'=>'0','NivelEducativoID'=>'0','SEPName'=>'Sexto Semestre','Accounting'=>'0','Visible'=>'0','Delta'=>'1']
        ];
        ClassLevel::insert($classlevel);
    }
}