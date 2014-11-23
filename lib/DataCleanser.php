<?
include 'lib/DistanceDescriptors.php';

/**
 * Data Cleanser.
 * This class is responsible for taking an array of data and checking it for 
 * any erroneous location points.
 *
 * Assumptions: The following are assumed to be erroneous location points.
 * 1: Where the speed travelled is 0.
 * 2: Where the speed travelled is unrealistic. i.e. It is assumed that the data relates to
 *    travel on inner city roads and therefore has a max spped limit as defined by MAX_SPEED.
 */
class dataCleanser {
	private $cleanedPoints;
	
	/**
	 * Constructor
	 */
	function __construct() {
		$this->cleanedPoints = array();
	}
	
	/**
	 * Iterates through the specified data points and checks if they are erroneous.
	 *
	 * @param	geoUtils		Geo Utils class.
	 * @param	dataPoints		The data points to analyse.
	 *
	 * @return	cleanedPoints	The cleaned data points - erroneous points removed.
	 */
	public function cleanseData(GeoUtilities $geoUtils, $dataPoints) {
		// init vars
		$previousLocation = null;		
		
		// iterate points and check previous location against current location
		foreach($dataPoints as $currentLocation) {
			if($previousLocation instanceof Location
				&& $currentLocation instanceof Location) {
				if($this->checkLocation($geoUtils, $currentLocation, $previousLocation)) {
					$this->cleanedPoints[] = $currentLocation->getLatitude().
						",".$currentLocation->getLongitude().",".$currentLocation->getTimestamp()."\n";
				}
			}
			$previousLocation = $currentLocation;
		}
		
		return $this->cleanedPoints;
	}
	
	/**
	 * Checks the two locations to see if the speed/distance travelled is reasonable.
	 * If the speed/distance travelled is reasonable, the point is added to the cleanedPoints arrray.
	 *
	 * @param	geoUtils			Geo Utils class.
	 * @param	currentLocation		The current location.
	 * @param	previousLocation	The previous location.
	 *
	 * @return 	boolean				Boolean denoting if the distance was reasonable.
	 */
	private function checkLocation(GeoUtilities $geoUtils, 
		TimeLocation $currentLocation, TimeLocation $previousLocation) {
		// calculate time between the two points
		$timeTaken = $currentLocation->getTimestamp() - $previousLocation->getTimestamp();
		
		// calculate distance travelled
		$distance = $geoUtils->getDistanceTravelled($currentLocation, 
			$previousLocation, DistanceDescriptors::KILOMETRES);
		
		// calculate speed based on time taken and distance travelled
		$speed = $geoUtils->getSpeedTravelled($timeTaken, $distance);
		
		// reasonable speed?
		if($speed > MIN_SPEED && $speed < MAX_SPEED) {
			return true;
		} else {
			if(DEBUG) {
				echo "Erroneous Point: ".date("d/m/y, H:i:s", $currentLocation->getTimestamp()).
					", Time: $timeTaken seconds, Travelled: ".round($distance, 4).
					"km, <b>Speed: ".round($speed)." kmh</b><br>";
			}
			return false;
		}
	}
}
?>