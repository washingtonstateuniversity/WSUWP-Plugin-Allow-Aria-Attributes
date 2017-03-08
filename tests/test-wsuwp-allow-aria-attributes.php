<?php

class WSUWP_Allow_Aria_Attributes_Tests extends WP_UnitTestCase {

	public function test_merge_allowed_aria_attributes_with_true_value_returns_aria_array() {
		$value = WSUWP_Allow_Aria_Attributes::merge_allowed_aria_attributes( true );

		$expected = array(
			'aria-label' => true,
			'aria-labelledby' => true,
			'aria-hidden' => true,
			'aria-describedby' => true,
		);

		$this->assertEquals( $value, $expected );
	}

	public function test_merge_allowed_aria_attributes_with_array_value_merges_arrays() {
		$value = WSUWP_Allow_Aria_Attributes::merge_allowed_aria_attributes( array( 'class' => true, 'id' => true, 'data-test' => true ) );

		$expected = array(
			'class' => true,
			'id' => true,
			'data-test' => true,
			'aria-label' => true,
			'aria-labelledby' => true,
			'aria-hidden' => true,
			'aria-describedby' => true,
		);

		$this->assertEquals( $value, $expected );
	}

	public function test_merge_allowed_aria_attributes_with_string_value_does_nothing() {
		$value = WSUWP_Allow_Aria_Attributes::merge_allowed_aria_attributes( 'div' );

		$this->assertEquals( $value, 'div' );
	}

	public function test_wp_kses_post_allows_white_listed_aria_attribute() {
		$expected = '<div aria-label="testing">Test Content</div>';
		$actual = wp_kses_post( $expected );

		$this->assertEquals( $expected, $actual );
	}

	public function test_wp_kses_post_removes_non_white_listed_aria_attribute() {
		$expected = '<div aria-label="testing" aria-owns="an-element">Test Content</div>';
		$actual = wp_kses_post( $expected );

		$this->assertEquals( '<div aria-label="testing">Test Content</div>', $actual );
	}

	public function test_wp_kses_post_allows_other_white_listed_attributes() {
		$expected = '<div aria-label="testing" class="more-testing">Test Content</div>';
		$actual = wp_kses_post( $expected );

		$this->assertEquals( $expected, $actual );
	}
}
