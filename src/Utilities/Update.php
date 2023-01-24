<?php

namespace RayTech\WPAbstractClasses\Utilities;

use Gitlab\Client;

class Update {
	public function checkForUpdates( string $type, string $version_comp, mixed $opt ) {
		$regex_string = '/\d*\.\d*\.\d*(\_*\-*\.*[0-9a-zA-Z]*)*/';
		$version      = '';
		switch ( $type ) {
			case 'http':
				$data = json_decode( wp_remote_get( $opt['url'] )['body'] );
				if ( is_string( $data->version ) ) {
					preg_match( $regex_string, $data->version, $matches );
					$version = $matches[0];
				}
				break;
			case 'gitlab':
				$client = new Client();
				$client->setUrl( 'https://gitlab.raytechhosting.com' );
				$client->authenticate( $opt['token'], Client::AUTH_HTTP_TOKEN );
				$version = $client->tags()->all( $opt['repo'] )[0]['name'];
				break;
			case 'github':
				$output = wp_remote_get( 'https://api.github.com/repos/' . $opt['team'] . '/' . $opt['repo'] . '/git/refs/tags' );
				$data   = json_decode( $output['body'] );
				$ref    = end( $data )->ref;
				if ( is_string( $ref ) ) {
					preg_match( $regex_string, $ref, $matches );
					$version = $matches[0];
				}
				break;
			case 'bitbucket':
				$output = wp_remote_get( 'https://api.bitbucket.org/2.0/repositories/' . $opt['team'] . '/' . $opt['repo'] . '/refs/tags' );
				$ref    = end( json_decode( $output['body'] )->values )->name;
				if ( is_string( $ref ) ) {
					preg_match( $regex_string, $ref, $matches );
					$version = $matches[0];
				}
				break;
		}
		preg_match( $regex_string, $version_comp, $matches );
		return version_compare( $matches[0], $version, '<' );
	}
}
