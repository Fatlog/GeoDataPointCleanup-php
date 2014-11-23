<?
include 'lib/Singleton.php';
include 'lib/FileIOException.php';

/**
 * Base Class for FileIO operations.
 * This class provides some basic FileIO functions
 * and some required abstract functions that need to be implemented.
 */
abstract class FileIO extends Singleton
{
	/**
	 * Child classes should implement a method to read data from a file
	 *
	 * @param	fileName	The name of the file to read.
	 */
    abstract public function readData($fileName);
	
	/**
	 * Child classes should implement a method to write data to a file
	 *
	 * @param	fileName	The name of the file to read.
	 * @param	data		The data to write to the file.
	 */
    abstract public function writeData($fileName, $data);

	/**
	 * Common base method to open a file.
	 *
	 * @param	fileName	The name of the file to open.
	 * @param	accessType	The access type required when opening the file.
	 *
	 * @return	handle		The opened file handle.
	 *
	 * @throws	exception	Throws a FileIO exception if the file cannot be opened.
	 */
    protected function openFile($fileName, $accessType) {
        $handle = fopen($fileName, $accessType);
		if($handle == FALSE) {
			throw new FileIOException('Could not load data file.');
		}
		return $handle;
    }
	
	/**
	 * Common base method to close a file handle.
	 *
	 * @param	handle		The file handle to be closed.
	 */
	protected function closeFile($handle) {
		fclose($handle);
	}
}
?>