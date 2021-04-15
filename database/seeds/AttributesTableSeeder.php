<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = collect([
            // PROJECT GENERAL
            [
                'path' => 'project_name',
                'rule' => 'required|string',
                'name' => 'Назва проєкту'
            ],
            [
                'path' => 'project_description',
                'rule' => 'nullable|string',
                'name' => 'Опис проєкту'
            ],
            [
                'path' => 'project_ready_level',
                'rule' => 'required|numeric|gte:1|lte:11',
                'name' => 'Рівень готовності'
            ],
            [
                'path' => 'project_has_competitors',
                'rule' => 'boolean',
                'name' => 'Чи є конкурентна технологія'
            ],

            // COST METHOD
            [
                'path' => 'cost_method.sum.raw_materials',
                'rule' => 'required|numeric|gte:0',
                'name' => ' Сировина і матеріали',
                'order' => 1
            ],
            [
                'path' => 'cost_method.sum.returnable_waste',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Зворотні відходи',
                'order' => 2
            ],
            [
                'path' => 'cost_method.sum.third_parties_production',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Покупні вироби, напівфабрикати і послуги виробничого характеру сторонніх організацій',
                'order' => 3
            ],
            [
                'path' => 'cost_method.sum.fuel_and_energy',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Паливо і енергія на технологічні цілі',
                'order' => 4
            ],
            [
                'path' => 'cost_method.sum.wages',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Заробітна плата виробничих працівників',
                'order' => 5
            ],
            [
                'path' => 'cost_method.sum.social_events_deductions',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Відрахування на соціальні заходи',
                'order' => 6
            ],
            [
                'path' => 'cost_method.sum.defective_lose',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Втрати від браку',
                'order' => 7
            ],
            [
                'path' => 'cost_method.sum.total_expenditures',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Загальновиробничі витрати',
                'order' => 8
            ],
            [
                'path' => 'cost_method.sum.general_expenses',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Загальногосподарські витрати',
                'order' => 9
            ],
            [
                'path' => 'cost_method.sum.other_production_expenses',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Інші виробничі витрати',
                'order' => 10
            ],
            [
                'path' => 'cost_method.sum.commercial_expenses',
                'rule' => 'required|numeric|gte:0',
                'name' => 'Комерційні витрати',
                'order' => 11
            ],
            [
                'path' => 'cost_method.percentage_of_cost',
                'rule' => 'required|numeric|gte:0|lte:100',
                'name' => 'Відсоток від витрат',
                'order' => 12
            ],

            // REVENUE METHOD
            [
                'path' => 'revenue_method.discount_rate',
                'rule' => 'required|numeric',
                'name' => 'Ставка дисконту',
            ],
            [
                'path' => 'revenue_method.periods_count',
                'rule' => 'array|min:1|max:5',
                'name' => 'Кількість періодів',
            ],
            [
                'path' => 'revenue_method.period.sales_volume',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Обсяг продажів',
                'order' => 1,
            ],
            [
                'path' => 'revenue_method.period.expected_price',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Очікувана Ціна',
                'order' => 2,
            ],
            [
                'path' => 'revenue_method.period.expected_cost',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Очікувана Собівартість',
                'order' => 3,
            ],
            [
                'path' => 'revenue_method.period.licensor_percentage',
                'rule' => 'required|numeric|gte:0|lte:100',
                'name' => 'Відсоток ліцензіара',
                'order' => 4,
            ],

            // COMPETITIVE METHOD
            [
                'path' => 'competitive_method.own_quality_value',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Кількісне значення одиничного показника якості розробки',
            ],
            [
                'path' => 'competitive_method.analog_quality_value',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Кількісне значення одиничного показника якості аналога',
            ],
            [
                'path' => 'competitive_method.weight_factor',
                'rule' => 'required|numeric|gt:0|lte:1',
                'name' => 'Коефіцієнт вагомості параметрів',
            ],
            [
                'path' => 'competitive_method.analog_implementation_costs',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Витрати впровадження аналога',
            ],
            [
                'path' => 'competitive_method.own_implementation_costs',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Витрати впровадження розробки',
            ],
            [
                'path' => 'competitive_method.analog_support_cost',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Витрати супроводу аналогу',
            ],
            [
                'path' => 'competitive_method.own_support_cost',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Витрати супроводу розробки',
            ],

            [
                'path' => 'competitive_method.k1',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Коефіцієнт оригінальності вирішеного',
            ],
            [
                'path' => 'competitive_method.k2',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Коефіцієнт складності',
            ],
            [
                'path' => 'competitive_method.k3',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Коефіцієнт очікуваної масштабності',
            ],
            [
                'path' => 'competitive_method.k4',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Коефіцієнт складності вирішеного ТЗ',
            ],
            [
                'path' => 'competitive_method.k5',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Коефіцієнт інноваційності R&D product',
            ],

            [
                'path' => 'competitive_method.parameters_count',
                'rule' => 'array|max:5|min:1',
                'name' => 'Кількість параметрів',
            ],
            [
                'path' => 'competitive_method.parameters_q_value_sum',
                'rule' => 'numeric|lte:1',
                'name' => 'Сума параметрів q',
            ],
            [
                'path' => 'competitive_method.parameters.name',
                'rule' => 'required|string|min:0',
                'name' => 'Назва',
            ],
            [
                'path' => 'competitive_method.parameters.direction',
                'rule' => 'required|numeric|in:-1,1',
                'name' => 'Прямий/непрямий',
            ],
            [
                'path' => 'competitive_method.parameters.q_value',
                'rule' => 'required|numeric|gt:0',
                'name' => 'Коефіцієнт q',
            ],
            [
                'path' => 'competitive_method.parameters.analog_value',
                'rule' => 'required|numeric',
                'name' => 'Значення параметра аналога',
            ],
            [
                'path' => 'competitive_method.parameters.own_value',
                'rule' => 'required|numeric',
                'name' => 'Значення парметра нашого',
            ],
        ]);

        $params->each(function ($item) {
            \App\Models\Attribute::query()->updateOrCreate([
                'path' => $item['path']
            ], $item);
        });
    }
}
