<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => rand(1,4),
            'title'=> $this->faker->sentence(5),
            'content'=>$this->faker->paragraph(15),
            'published'=> rand(0,1),
            'premium'=> rand(0,1),
            'date'=> now(),
            'type'=> 'text'
        ];
    }
    public function image()
    {
        return $this->state(function () { // tu usunąłem array $attributes
            return [
                'content'=>null,
                'type'=> 'photo',
                'image'=> $this->faker->imageUrl(1200,800)
            ];
        });
    }
}
