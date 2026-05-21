<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'name' => 'Neymar',
            'phone' => '+55 (11) 15745-4522',
            'email' => 'neymarjr@contato.com',
            'category' => 'Soccer Player',
        ]);

        Contact::create([
            'name' => 'Ronaldinho Gaúcho',
            'phone' => '+55 (11) 14255-4980',
            'email' => 'ronaldinho10@contato.com',
            'category' => 'Soccer Legend',
        ]);

        Contact::create([
            'name' => 'Messi',
            'phone' => '+55 (11) 17536-3781',
            'email' => 'messi@contato.com',
            'category' => 'Soccer Player',
        ]);
    }
}
