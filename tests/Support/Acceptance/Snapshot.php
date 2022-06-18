<?php

declare(strict_types=1);

namespace Tests\Support\Acceptance;

use Tests\Support\AcceptanceTester;

/**
 * class OrderManagement
 * */
class Snapshot
{

	protected AcceptanceTester $I;

	protected array $data_snapshots;

	protected string $command_to_fix = '';

	/**
	 * __construct
	 */
	public function __construct(AcceptanceTester $I)
	{
		$this->I = $I;
		$this->data_snapshots = [];
	}

	/**
	 * @Then check static pages
	 */
	public function checkStaticPages()
	{
		$this->command_to_fix = '';

		foreach ($this->data_snapshots as $url) {
			$screenshot_base_name = str_replace('/', '', $url);
			$screenshot_name = $screenshot_base_name.'.png';

			$this->I->amOnUrl($url);

			// Remove all `iframe` HTML elements
			$this->I->executeJS("document.querySelectorAll('iframe').forEach(e => e.remove());");

			// Stop all the `video` elements and rewind to the very beginning.
			$this->I->executeJS("document.querySelectorAll('video').forEach(vid => { vid.pause(); vid.currentTime = 0;}  );");

			// Wait for jQuery ajax is completed.
			$this->I->waitForJS("return $.active == 0;", 10);

			$this->I->wait(1);

			$this->I->makeScreenshot($screenshot_base_name);

			$width = $this->I->executeJS('return document.documentElement.scrollWidth;');
			$height = $this->I->executeJS('return document.documentElement.scrollHeight;');

			$path_to_new_screenshots = codecept_output_dir().'debug'.DIRECTORY_SEPARATOR;
			$path_to_old_screenshots = codecept_data_dir();

			$have_own_dir = false;

			[ $current_width, $current_height ] = getimagesize($path_to_new_screenshots.$screenshot_name);

			if ($width > $current_width || $height > $current_height) {
				for ($i_width = 0; $i_width <= $width; $i_width+=$current_width) {
					for ($i_height = 0; $i_height <= $height; $i_height+=$current_height) {
						$composite_screenshot_base_name = $screenshot_base_name.'_'.$i_width.'x'.$i_height;
						$composite_screenshot_name = $composite_screenshot_base_name.'.png';

						$this->I->executeJS('window.scrollTo('.$i_width.', '.$i_height.')');
						$this->I->wait(2);
						$this->I->makeScreenshot($composite_screenshot_base_name);

						$path_to_new_screenshot = $path_to_new_screenshots.$composite_screenshot_name;
						$path_to_old_screenshot = $path_to_old_screenshots.$screenshot_base_name.DIRECTORY_SEPARATOR.$composite_screenshot_name;

						if (! file_exists($path_to_old_screenshot) || sha1(file_get_contents($path_to_new_screenshot)) != sha1(file_get_contents($path_to_old_screenshot))) {
							if (! $have_own_dir) {
								$have_own_dir = true;
								$this->command_to_fix .= 'mkdir -p '.$path_to_old_screenshots.$screenshot_base_name.PHP_EOL;
							}
							$this->command_to_fix .= 'cp -f '.$path_to_new_screenshot.' '.$path_to_old_screenshot.PHP_EOL;
						}
					}
				}
			} else {
				$path_to_new_screenshot = $path_to_new_screenshots.$screenshot_name;
				$path_to_old_screenshot = $path_to_old_screenshots.$screenshot_name;

				if (! file_exists($path_to_old_screenshot) || sha1(file_get_contents($path_to_new_screenshot)) != sha1(file_get_contents($path_to_old_screenshot))) {
					$this->command_to_fix .= 'cp -f '.$path_to_new_screenshot.' '.$path_to_old_screenshot.PHP_EOL;
				}
			}
		}

		if(isset($path_to_old_screenshots)){
			$file = fopen($path_to_old_screenshots . '/command-to-fix.sh', 'w');
			fwrite($file, '#! /bin/bash' . PHP_EOL);
			fwrite($file, $this->command_to_fix);
			fclose($file);
		}

		$this->I->assertIsEmpty($this->command_to_fix, 'These files are not equal:'.PHP_EOL.$this->command_to_fix.'Please make command above.');
	}

	/**
	 * @Given I set data for test static pages:
	 */
	public function iSetDataForTestStaticPages(\Behat\Gherkin\Node\TableNode $data_snapshots)
	{
		$data_snapshots = $data_snapshots->getTable();
		$this->data_snapshots = array_column($data_snapshots, 0);
	}
}
