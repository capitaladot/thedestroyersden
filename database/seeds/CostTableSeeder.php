<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CostTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard ();
		Cost::create([
		/* universal */
			['id' => 1, 'skill_id' => 1, 'value' => 5, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 2, 'skill_id' => 2, 'value' => 4, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 3, 'skill_id' => 3, 'value' => 5, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 4, 'skill_id' => 4, 'value' => 5, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 5, 'skill_id' => 5, 'value' => 5, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 6, 'skill_id' => 6, 'value' => 7, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 7, 'skill_id' => 7, 'value' => 5, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 8, 'skill_id' => 8, 'value' => 6, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 9, 'skill_id' => 9, 'value' => 2, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 10, 'skill_id' => 10, 'value' => 6, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 11, 'skill_id' => 11, 'value' => 1, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 12, 'skill_id' => 12, 'value' => 5, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 13, 'skill_id' => 13, 'value' => 10, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 14, 'skill_id' => 14, 'value' => 1, 'character_class_id' => null, 'homeland_id' => null],
			['id' => 15, 'skill_id' => 15, 'value' => 10, 'character_class_id' => null, 'homeland_id' => null],
		/* Dacian */
			['id' => 16, 'skill_id' => 1, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 17, 'skill_id' => 2, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 18, 'skill_id' => 3, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 19, 'skill_id' => 4, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 20, 'skill_id' => 5, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 21, 'skill_id' => 6, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 22, 'skill_id' => 7, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 23, 'skill_id' => 8, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 24, 'skill_id' => 9, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 25, 'skill_id' => 10, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 26, 'skill_id' => 11, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 27, 'skill_id' => 12, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 28, 'skill_id' => 13, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 29, 'skill_id' => 14, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
			['id' => 30, 'skill_id' => 15, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 3],
		/* Coggland */
			['id' => 31, 'skill_id' => 11, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 2],
		/* UhlWho */
			['id' => 32, 'skill_id' => 1, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 33, 'skill_id' => 2, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 34, 'skill_id' => 3, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 35, 'skill_id' => 4, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 36, 'skill_id' => 5, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 37, 'skill_id' => 6, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 38, 'skill_id' => 7, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 39, 'skill_id' => 8, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 40, 'skill_id' => 9, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 41, 'skill_id' => 10, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 42, 'skill_id' => 11, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 43, 'skill_id' => 12, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 44, 'skill_id' => 13, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 45, 'skill_id' => 14, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
			['id' => 46, 'skill_id' => 15, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 12],
		/* Englehelm */
			['id' => 47, 'skill_id' => 8, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 4],
		/* Korkfinn */
			['id' => 48, 'skill_id' => 3, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 5],
			['id' => 49, 'skill_id' => 4, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 5],
		/* Nimbus */
			['id' => 50, 'skill_id' => 12, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 8],
			['id' => 51, 'skill_id' => 13, 'value' => -2, 'character_class_id' => null, 'homeland_id' => 8],
		/* Sa'kree #9*/
			['id' => 52, 'skill_id' => 3, 'value' => +2, 'character_class_id' => null, 'homeland_id' => 9],
			['id' => 53, 'skill_id' => 6, 'value' => +2, 'character_class_id' => null, 'homeland_id' => 9],
		/* Totem Valley */
			['id' => 54, 'skill_id' => 6, 'value' => -1, 'character_class_id' => null, 'homeland_id' => 11],
		/* end of Universal */
		/* Physical abilities */
		/* Lanoda, #6, -1 */
		/* San'Jay, Climb and Swim free */
		/* Uhl'Who +2 */
		]);
	}

}
