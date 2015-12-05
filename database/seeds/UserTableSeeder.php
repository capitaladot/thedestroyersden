<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$users = array(
			array( // row #0
				'id' => 1,
				'name' => 'Austin Thomas Clerkin',
				'email' => 'austinitor@gmail.com',
				'password' => NULL,
				'remember_token' => 'HLy1aRNiuh7irByD9K2HZwak1j8SQ4MS0dzbmN4pJNPpcwkI7IpgdKop76JO',
				'updated_at' => '2015-09-07 17:57:19',
				'slug' => 'austin-thomas-clerkin',
				'title' => 'Austin Thomas Clerkin',
				'facebook_id' => 10153167558321827,
				'access_token' => NULL,
				'amazon_id' => NULL,
			),
			array( // row #1
				'id' => 2,
				'name' => 'The Destroyer\'s Den',
				'email' => 'destroyersdenlarp@gmail.com',
				'password' => '$2y$10$1k4r9SJmQ7cPpS19fziMROq56pv.11dTtVHxD8fYqY4c20nF/ZYMS',
				'remember_token' => 'GbVCS0PPhNZEczMNXChRBx5g2DmYm3Rutytj1XSqWeCdLUPxjVQyLQxgrWlV',
				'created_at' => '2015-05-11 11:00:05',
				'updated_at' => '2015-09-09 18:25:10',
				'slug' => 'the-destroyers-den',
				'title' => 'The Destroyer\'s Den',
				'facebook_id' => NULL,
				'access_token' => NULL,
				'amazon_id' => NULL,
			),
			array( // row #2
				'id' => 3,
				'name' => 'Ashley Kaufman',
				'email' => 'lostashe82@gmail.com',
				'password' => NULL,
				'remember_token' => 'jpnu9cw5P3S3qiMoT5epj63sdi9Y9GMCnD4p435LmLcoGWyoZJ52qSTtZ0rq',
				'updated_at' => '2015-09-07 09:48:03',
				'slug' => 'ashley-kaufman',
				'title' => 'Ashley Kaufman',
				'facebook_id' => 10105018477657478,
				'access_token' => NULL,
				'amazon_id' => NULL,
			),
			array( // row #3
				'id' => 24,
				'name' => 'Test Account',
				'email' => 'austin.clerkin@facebook.com',
				'password' => '$2y$10$f/9AACz1Qqwe9m0xjp5SLeTfrrK2PFJIUWFioTxD3bAXIUo3t2VkG',
				'remember_token' => 'N1AYJCTVWXPW0whoZ18I3eRIwATEBlyWduYB2V0P0YIV1OsSf2oRJfMgJahc',
				'created_at' => '2015-09-09 10:29:44',
				'updated_at' => '2015-09-09 10:30:00',
				'slug' => 'test-account',
				'title' => 'Test Account',
				'facebook_id' => NULL,
				'access_token' => NULL,
				'amazon_id' => NULL,
			),
			array( // row #4
				'id' => 25,
				'name' => 'Test Account 2',
				'email' => 'capitaladot@yahoo.com',
				'password' => '$2y$10$B.s/ygfsxASYbT7/2BkI9O1Fnyrzn6ebCSVgSSs9V6Jnu7UzJOBnO',
				'remember_token' => 'vBFWfIjmfAzhjqnPhdiztlTI6HyDNAnCyQneeQAjpNNr0ZkKcLGmxegEDOHf',
				'created_at' => '2015-09-09 10:30:31',
				'updated_at' => '2015-09-09 10:30:38',
				'slug' => 'test-account-2',
				'title' => 'Test Account 2',
				'facebook_id' => NULL,
				'access_token' => NULL,
				'amazon_id' => NULL,
			),
			array( // row #6
				'id' => 27,
				'name' => 'Richard Wetzel',
				'email' => 'mew314159@yahoo.com',
				'password' => NULL,
				'remember_token' => NULL,
				'created_at' => '2015-09-12 23:17:49',
				'updated_at' => '2015-09-12 23:17:49',
				'slug' => 'richard-wetzel',
				'title' => 'Richard Wetzel',
				'facebook_id' => 10207841644747961,
				'access_token' => NULL,
				'amazon_id' => NULL,
			),
			array( // row #7
				'id' => 28,
				'name' => 'Killraven',
				'email' => 'damienkillraven@gmail.com',
				'password' => '$2y$10$SVq5yt3oiBePAILWPoXKxObpNzaKPI/t98ZTsgUlXXnnNB9cfE1Je',
				'remember_token' => NULL,
				'created_at' => '2015-09-20 21:45:51',
				'updated_at' => '2015-09-20 21:45:51',
				'slug' => 'killraven',
				'title' => 'Killraven',
				'facebook_id' => NULL,
				'access_token' => NULL,
				'amazon_id' => NULL,
			),
		);
		foreach($users as $user){
			$userObj = new User($user);
			$this->command->info ( 'Creating user:'.$user['email']. "... success:".$userObj->save());
		}
		$this->command->info ( 'User table seeded!' );
	}

}
