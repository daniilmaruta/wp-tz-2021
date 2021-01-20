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
	 * Returns first image or default image
	 * @return string
	 */
	public function getFeaturedImage() {
		if ( $this->imagesIds && count( $this->imagesIds ) ) {
			$imageId = array_pop( $this->imagesIds );
			$image = wp_get_attachment_image( $imageId, 'thumbnail' );
		} else {
			$image = '<img src="' . get_stylesheet_directory_uri() . '/images/placeholder.png">';
		}

		return $image;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Return Realry description
	 * @return false|string
	 */
	public function getDescription() {
		ob_start();
		if ( $this->getCost() ) {
			echo '<h6>' . __( 'Cost', 'understrap-child' ) . ': ' . $this->getCost() . '$</h6>';
		}
		if ( $this->getArea() ) {
			echo '<h6>' . __( 'Area', 'understrap-child' ) . ': ' . $this->getArea() . 'm²</h6>';
		}
		if ( $this->getLivingArea() ) {
			echo '<h6>' . __( 'Living Area', 'understrap-child' ) . ': ' . $this->getLivingArea() . 'm²</h6>';
		}
		if ( $this->getFloor() ) {
			echo '<h6>' . __( 'Floor', 'understrap-child' ) . ': ' . $this->getFloor() . '</h6>';
		}
		if ( $this->getCity() ) {
			printf( '<h6>' . __( 'City', 'understrap-child' ) . ': <a href="%s" target="_blank">%s</a></h6>',
				get_permalink( $this->getCity() ),
				get_the_title( $this->getCity() )
			);
		}
		if ( $this->getAddress() ) {
			echo '<h6>' . __( 'Address', 'understrap-child' ) . ': ' . $this->getAddress() . '</h6>';
		}
		
		return ob_get_clean();
	}

}
