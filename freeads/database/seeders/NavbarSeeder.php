<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\Navbar;
  
class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'name' => 'home',
                'route' => 'home',
                'ordering' => 1,
            ],
            [
                'name' => 'sign_in',
                'route' => 'sign_in',
                'ordering' => 2,
            ],
            [
                'name' => 'register',
                'route' => 'register',
                'ordering' => 3,
            ],
            [
                'name' => 'post_ad',
                'route' => 'post_ad',
                'ordering' => 4,
            ],
        ];
  
        foreach ($links as $key => $navbar) {
            Navbar::create($navbar);
        }
    }
}