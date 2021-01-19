<?php
namespace TZ\Realty;

if( ! defined( 'ABSPATH' ) ) exit;

class Realty {
	private $id, $cost, $area, $livingArea, $floor, $city, $address, $imagesIds;

	public function __construct( $id ) {
		$imagesIds   = [];
		$countImages = 6;
		if ( function_exists( 'get_field' ) ) {
			$cost       = get_field( 'cost', $id );
			$area       = get_field( 'area', $id );
			$livingArea = get_field( 'living_are', $id );
			$floor      = get_field( 'floor', $id );
			$city       = get_field( 'city', $id );
			$address    = get_field( 'address', $id );
			for ( $i = 1; $countImages > $i; $i ++ ) {
				$image = get_field( 'image_' . $i, $id );
				if ( $image ) {
					array_push( $imagesIds, $image );
				}
			}
		} else {
			$cost       = get_post_meta( $id, 'cost', true );
			$area       = get_post_meta( $id, 'area', true );
			$livingArea = get_post_meta( $id, 'living_are', true );
			$floor      = get_post_meta( $id, 'floor', true );
			$city       = get_post_meta( $id, 'city', true );
			$address    = get_post_meta( $id, 'address', true );
			for ( $i = 1; $countImages > $i; $i ++ ) {
				$image = get_post_meta( 'image_' . $i, true );
				if ( $image ) {
					array_push( $imagesIds, $image );
				}
			}
		}

		$this->id         = $id;
		$this->cost       = $cost;
		$this->area       = $area;
		$this->livingArea = $livingArea;
		$this->floor      = $floor;
		$this->city       = $city;
		$this->address    = $address;
		$this->imagesIds  = $imagesIds;
	}

	/**
	 * @return mixed
	 */
	public function getCost() {
		return $this->cost;
	}

	/**
	 * @return mixed
	 */
	public function getArea() {
		return $this->area;
	}

	/**
	 * @return mixed
	 */
	public function getLivingArea() {
		return $this->livingArea;
	}

	/**
	 * @return mixed
	 */
	public function getFloor() {
		return $this->floor;
	}

	/**
	 * @return mixed
	 */
	public function getCity() {
		return get_post( $this->city );
	}

	/**
	 * @return mixed
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Returns array Ids
	 * @return array
	 */
	public function getImagesIds() {
		return $this->imagesIds;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

}
