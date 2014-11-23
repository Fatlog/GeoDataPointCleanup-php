<?
include 'lib/FileIO.php';
include 'lib/TimeLocation.php';

/**
 * FileIO class specific to reading & writing data to/from a CSV file.
 *
 * @param	fileName	The name of the file to read.
 */
class CSVFileIO extends FileIO
{
	/**
	 * Read data from a CSV file.
	 * This function reads specific data from a CSV file and stores it in an array.
	 * TODO: This function should be made more generic by passing in how the data is formatted
	 * and how it should be returned.
	 *
	 * @param	fileName	The name of the file to read.
	 *
	 * @return	locations	An array of the extracted locations.
	 */
	public function readData($fileName) {
		$handle = $this->openFile($fileName, "r");
		
		// init vars
		$locations = array();
		
		// loop through file stream data creating geo locations and
		// adding to array to be returned
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$locations[] = new TimeLocation($data[0], $data[1], $data[2]);
		}
		
		// close file handle
		$this->closeFile($handle);
		
		return $locations;
	}

	/**
	 * Write data to a CSV file.
	 * This function takes the specified data and writes it in the correct format
	 * to a CSV file.
	 *
	 * @param	fileName	The name of the file to read.
	 * @param	data		The data to write to the CSV file.
	 */
	public function writeData($fileName, $data) {
		if(count($data) > 0) {
			$handle = $this->openFile($fileName, "w");
			foreach ($data as $line) {
				fputcsv($file,explode(',',$line));
				echo "$line<br>";
			}
			$this->closeFile($handle);
		}
	}
}
?>