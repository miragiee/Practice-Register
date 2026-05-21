<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        $technoPromUser = User::where("email", "hr@technoprom.ru")->first();

        $web360User = User::where("email", "contact@web360.ru")->first();

        $innoTechUser = User::where("email", "info@innotech.ru")->first();

        /*
        |--------------------------------------------------------------------------
        | COMPANIES
        |--------------------------------------------------------------------------
        */

        DB::table("companies")->insert([
            [
                "user_id" => $technoPromUser?->id,

                "name" => "ТехноПром",

                "description" => "Разработка промышленного ПО",

                "contact_info" => "hr@technoprom.ru",

                "inn" => "123123123123",

                "website" => "technoprom.ru",

                "created_at" => now(),

                "updated_at" => now(),
            ],

            [
                "user_id" => $web360User?->id,

                "name" => "ВебСтудия 360",

                "description" => "Создание современных сайтов и приложений",

                "contact_info" => "contact@web360.ru",

                "inn" => "256256256256",

                "website" => "web360.ru",

                "created_at" => now(),

                "updated_at" => now(),
            ],

            [
                "user_id" => $innoTechUser?->id,

                "name" => "ИнноТех",

                "description" => "Инновационные технологии и стартапы",

                "contact_info" => "info@innotech.ru",

                "inn" => "356356356356",

                "website" => "innotech.ru",

                "created_at" => now(),

                "updated_at" => now(),
            ],
        ]);
    }
}
