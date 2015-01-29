<?php

use Faker\Factory as Faker;

/**
 * Page Table Seeder
 * 
 * Add default values to pages table
 */
class PageTableSeeder extends Seeder
{
	/**
	 * Seed table
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		DB::table('pages')->delete();

		$titles = [ 'Policies', 'Contact', 'About' ];

		// create example pages using titles with fake content
		foreach ($titles as $title)
		{
			$content = array_map(function($elem)
				{ 
					return "<p>{$elem}</p>";

				}, $faker->paragraphs(rand(3, 12)));

			Page::create(
					[
						'title'     => $title,
						'content'   => implode('', $content),
						'permalink' => Str::slug($title)
					]
				);
		}
	}
}

?>

