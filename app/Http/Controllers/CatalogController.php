<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Отображение страницы каталога вузов
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Данные вузов
        |--------------------------------------------------------------------------
        */

        $universities = [

            [
                'id' => 1,

                'name' => 'МГТУ им. Н.Э. Баумана',

                'description' =>
                    'Ведущий технический университет России с сильной базой в области робототехники и IT.',

                'image' => 'images/baumanka.jpg',

                'rating' => '4.9',

                'students_count' => 1240,

                'tags' => [
                    'Робототехника',
                    'Data Science'
                ]
            ],

            [
                'id' => 2,

                'name' => 'НИУ ВШЭ',

                'description' =>
                    'Фокус на экономику, социальные науки и современные цифровые технологии в бизнесе.',

                'image' => 'images/hse.jpg',

                'rating' => '4.8',

                'students_count' => 856,

                'tags' => [
                    'Бизнес-аналитика',
                    'UX дизайн'
                ]
            ],

            [
                'id' => 3,

                'name' => 'ИТМО',

                'description' =>
                    'Первый исследовательский университет. Мировые лидеры в олимпиадном программировании.',

                'image' => 'images/itmo.jpg',

                'rating' => '4.7',

                'students_count' => 2105,

                'tags' => [
                    'AI & ML',
                    'Разработка'
                ]
            ]

        ];

        /*
        |--------------------------------------------------------------------------
        | Данные кандидатов
        |--------------------------------------------------------------------------
        */

        $candidates = [

            [
                'name' => 'Александр Волков',

                'course' => '4 курс, Бакалавр',

                'avatar' => 'AB',

                'avatar_color' => 'blue',

                'university' => 'МГТУ им. Баумана',

                'specialization' => 'Software Engineer',

                'match' => '98% Match',

                'status' => 'Готов к офферу',

                'status_type' => 'success'
            ],

            [
                'name' => 'Елена Соколова',

                'course' => '4 курс, Магистратура',

                'avatar' => 'EC',

                'avatar_color' => 'beige',

                'university' => 'НИУ ВШЭ',

                'specialization' => 'Data Scientist',

                'match' => '94% Match',

                'status' => 'На стажировке',

                'status_type' => 'warning'
            ],

            [
                'name' => 'Дмитрий Кузнецов',

                'course' => '3 курс, Бакалавр',

                'avatar' => 'ДК',

                'avatar_color' => 'orange',

                'university' => 'ИТМО',

                'specialization' => 'Frontend Dev',

                'match' => '91% Match',

                'status' => 'Готов к офферу',

                'status_type' => 'success'
            ]

        ];

        /*
        |--------------------------------------------------------------------------
        | Количество партнеров
        |--------------------------------------------------------------------------
        */

        $partnersCount = 124;

        /*
        |--------------------------------------------------------------------------
        | Возвращение страницы
        |--------------------------------------------------------------------------
        */

        return view(
            'catalog_of_universities',
            compact(
                'universities',
                'candidates',
                'partnersCount'
            )
        );
    }
}
