<?
/**
 * Interface for the 'Location' type.
 * This interface is used for type hinting in method signatures
 * and also for instanceof comparison
 */
interface Location
{
	/**
	 * Return the latitude.
	 *
	 * @return latitude		The latitude
	 */
    public function getLatitude();
	
	/**
	 * Return the longitude.
	 *
	 * @return longitude	The longitude
	 */
    public function getLongitude();
}
?>