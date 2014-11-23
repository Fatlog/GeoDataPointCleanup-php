<?
/**
 * Collection of algorithms related to spped calculations.
 * Can be mixed into an existing class.
 */
trait speedAlgorithms {
	/**
	 * Returns the speed traveleed based on the time taken and the distance travelled.
	 *
	 * @param	timeTaken	The time taken to travel the distance.
	 * @param	distance	The distance travelled.
	 * @return 	speed		The average speed travelled over the time specified.
	 */
    public function getSpeedTravelled($timeTaken, $distance) {
        return (60/$timeTaken) * $distance * 60;
    }
}

/**
 * Collection of algorithms related to geographoc locations.
 */
class GeoUtilities
{
	// mixin the speed algorithms functions
	use speedAlgorithms;
	
	// class constants
	const KILOMETRES_MULTIPLIER = 1.609344;
	const NAUTICAL_MILES_MULTIPLIER = 0.8684;
	
	/**
	 * Returns the distance travelled between two points.
	 * The distance travelled can be returned in either miles, kilometres or nautical miles.
	 *
	 * Algorithm taken from...
	 * http://www.geodatasource.com/developers/php
	 *
	 * @param	location1	The first location visited.
	 * @param	location2	The second location visited.
	 * @param	unit		Optional. The distance type of the return value (MH, KMH, NMH).
	 *
	 * @return 	distance	The distance between teh two locations visited.
	 */
	public function getDistanceTravelled(Location $location1, 
		Location $location2, $unit = DistanceDescriptors::KILOMETRES) {
		$theta = $location1->getLongitude() - $location2->getLongitude();
		$dist = sin(deg2rad($location1->getLatitude())) * sin(deg2rad($location2->getLatitude())) 
			+ cos(deg2rad($location1->getLatitude())) * cos(deg2rad($location2->getLatitude())) 
			* cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == DistanceDescriptors::KILOMETRES) {
			return ($miles * self::KILOMETRES_MULTIPLIER);
		} else if ($unit == DistanceDescriptors::NAUTICAL_MILES) {
			return ($miles * self::NAUTICAL_MILES_MULTIPLIER);
		} else {
			return $miles;
		}
	}
}
?>