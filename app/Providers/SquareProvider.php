<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/24/2016
 * Time: 8:09 AM
 */

namespace App\Providers;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use SquareConnect\Api\LocationApi;

class SquareProvider extends AbstractProvider implements ProviderInterface
{
	/**
	 * {@inheritdoc}
	 */
	protected function getAuthUrl($state)
	{
		return $this->buildAuthUrlFromBase('https://connect.squareup.com/oauth2/authorize', $state);
	}
	/**
	 * {@inheritdoc}
	 */
	protected function getTokenUrl()
	{
		return 'https://accounts.spotify.com/api/token';
	}
	/**
	 * {@inheritdoc}
	 */
	public function getAccessToken($code)
	{
		$response = $this->getHttpClient()->post($this->getTokenUrl(), [
			'headers' => ['Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)],
			'body'    => $this->getTokenFields($code),
		]);
		return $this->parseAccessToken($response->getBody());
	}
	/**
	 * {@inheritdoc}
	 */
	protected function getTokenFields($code)
	{
		return array_add(
			parent::getTokenFields($code), 'grant_type', 'authorization_code'
		);
	}
	/**
	 * {@inheritdoc}
	 */
	protected function getUserByToken($token)
	{
		$response = $this->getHttpClient()->get('https://api.spotify.com/v1/me', [
			'headers' => [
				'Authorization' => 'Bearer ' . $token,
			],
		]);
		return json_decode($response->getBody(), true);
	}
	/**
	 * {@inheritdoc}
	 */
	protected function formatScopes(array $scopes)
	{
		return implode(' ', $scopes);
	}
	/**
	 * {@inheritdoc}
	 */
	protected function mapUserToObject(array $user)
	{
		return (new User)->setRaw($user)->map([
			'id'       => $user['id'],
			'nickname' => $user['display_name'],
			'name'     => $user['display_name'],
			'avatar'   => !empty($user['images']) ? $user['images'][0]['url'] : null,
		]);
	}
}
