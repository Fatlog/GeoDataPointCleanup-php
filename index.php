<?
include 'lib/CSVFileIO.php';
include 'lib/DataCleanser.php';
include 'lib/GeoUtilities.php';

/**
 * Start point. Setup objects and begin analysis.
 */
define("MAX_SPEED", 80);
define("MIN_SPEED", 0);
define("DEBUG", true);

try {
	// get the location data
	$fileIO = CSVFileIO::getInstance();
	$data = $fileIO->readData("data/uncleaned.csv");
	
	// scan the data for erroneous data points
	$cleansedData = (new dataCleanser)->cleanseData(new GeoUtilities(), $data);
	
	// write data to file
	$fileIO->writeData("data/cleaned.csv", $cleansedData);
} catch (FileIOException $e) {
    echo "File IO Exception\n", $e;
} catch (Exception $e) {
    echo "Exception\n", $e;
}
?>