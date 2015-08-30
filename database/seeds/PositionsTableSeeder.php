<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Position as Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            ['text' => 'генеральный директор', 'children' => 
                [
                    ['text' => 'финансовый директор', 'children' =>
                        [
                            ['text' => 'коммерческий директор', 'children' => 
                                [
                                    ['text' => 'начальник отдела продаж', 'children' => 
                                        [
                                            ['text' => 'специалист по продажам', 'children' => 
                                                [
                                                    ['text' => 'агент по продажам'],
                                                    ['text' => 'помощник специалиста по продажам']
                                                ]
                                            ],
                                            ['text' => 'секретарь']
                                        ]
                                    ],
                                    ['text' => 'начальник отдела маркетинга', 'children' => 
                                        [
                                            ['text' => 'главный маркетолог', 'children' => 
                                                [
                                                    ['text' => 'консультант по маркетингу', 'children' => 
                                                        [
                                                            ['text' => 'помощник консультанта по маркетингу'],
                                                        ]
                                                    ],
                                                    ['text' => 'секретарь'],
                                                    ['text' => 'руководитель группы маркетинга', 'children' => 
                                                        [
                                                            ['text' => 'маркетолог', 'children' => 
                                                                [
                                                                    ['text' => 'помощник маркетолога'],
                                                                    ['text' => 'промоутер']
                                                                ]
                                                            ]
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    ['text' => 'технический директор', 'children' =>
                        [
                            ['text' => 'начальник it отдела', 'children' => 
                                [
                                    ['text' => 'менеджер проекта', 'children' =>
                                        [
                                            ['text' => 'программист-архитектор', 'children' => 
                                                [
                                                    ['text' => 'консультат архитектора'],
                                                ],
                                            ],
                                            ['text' => 'старший разработчик', 'children' => 
                                                [
                                                    ['text' => 'разработчик', 'children' => 
                                                        [
                                                            ['text' => 'младший разработчик']
                                                        ]
                                                    ]
                                                ]
                                            ],
                                            ['text' => 'начальник отдела качества', 'children' =>
                                                [
                                                    ['text' => 'старший тестировщик', 'children' => 
                                                        [
                                                            ['text' => 'тестировщик']
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                    ['text' => 'менеджер кадров'],
                                    ['text' => 'секретарь'],
                                    ['text' => 'финансовый консультат']
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        Position::buildTree($positions);
    }
}
