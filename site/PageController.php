<?php

namespace Site;

use Phin\Controller;
use Phin\Facades\Faker;

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

    public function json()
    {
        return response()->json([
            'some' => 'data',
            'as' => 'json'
        ]);
    }

    private function fakeService()
    {
        return [
                'title' => Faker::word(),
                'icon' => Faker::randomElement($array = $this->icons),
                'content' => implode(' ', Faker::sentences(3)),
            ];
    }
}