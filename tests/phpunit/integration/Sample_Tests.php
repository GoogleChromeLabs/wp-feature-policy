<?php
/**
 * Class Google\WP_Feature_Policy\Tests\PHPUnit\Integration\Sample_Tests
 *
 * @package   Google\WP_Feature_Policy
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://wordpress.org/plugins/feature-policy/
 */

namespace Google\WP_Feature_Policy\Tests\PHPUnit\Integration;

use Google\WP_Feature_Policy\Tests\PHPUnit\Framework\Integration_Test_Case;

/**
 * Class containing a sample test.
 */
class Sample_Tests extends Integration_Test_Case {

	/**
	 * Performs a sample test.
	 */
	public function testNothingUseful() {
		$this->assertTrue( defined( 'ABSPATH' ) );
	}
}
