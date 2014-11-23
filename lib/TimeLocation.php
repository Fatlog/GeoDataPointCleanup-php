<?
include 'lib/Location.php';

/**
 * Implements the Location interface and adds a timetsamp member variable
 * that allows a time to be associated with the specified latitude & longitude.
 */
class TimeLocation implements Location
{
	/**
	 * Variables to store the lat, long and time
	 */
	private $latitude, $longitude, $timestamp;
	
	/**
	 * Constructor.
	 * Specify the latitude, longitude and optionally the time these data items were recorded.
	 *
	 * @param $lat		The latitude.
	 * @param $long		The longitude.
	 * @param $time		Optional. The time these variables were recorded at.
	 */
	function __construct($lat, $long, $time = 0)
	{
		$this->latitude = $lat;
		$this->longitude = $long;
		$this->timestamp = $time;
	}
	
	/**
	 * Return the latitude.
	 *
	 * @return latitude		The latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}
	
	/**
	 * Return the longitude.
	 *
	 * @return longitude	The longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}
	
	/**
	 * Return the timestamp.
	 *
	 * @return timestamp	The timestamp
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}
}
?>