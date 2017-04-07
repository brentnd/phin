<?php

namespace Site;

use Phin\Controller;
use Faker\Factory as FakerFactory;

class PageController extends Controller
{
    protected $icons = ['bath', 'rocket', 'anchor', 'barcode', 'quora', 'futbol-o', 'fire', 'flask'];
    public function home()
    {
        $service = [];
        foreach (range(0, 8) as $number) {
            $services[] = $this->fakeService();
        }
        return view('pages.home', compact('services'));
    }

    private function fakeService()
    {
        $faker = FakerFactory::create();
        return [
                'title' => $faker->word(),
                'icon' => $faker->randomElement($array = $this->icons),
                'content' => implode(' ', $faker->sentences(3)),
            ];
    }
}