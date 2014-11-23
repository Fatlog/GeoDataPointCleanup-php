<?
/**
 * Abstract class to allow other classes to be invoked as singletons.
 * Any other class that needs to be a singleton can extend this class.
 */
abstract class Singleton
{
	/**
	 * Call this function instead of 'new' when instantiating a class.
	 * This function manages all 'singleton' instances of classes
	 * that extend this class.
	 */
    final public static function getInstance() {
        static $instances = array();
        $calledClass = get_called_class();
        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass();
        }
        return $instances[$calledClass];
    }
}
?>