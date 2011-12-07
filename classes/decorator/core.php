<?php
/**
 * Declares base Decorator_Core
 *
 * PHP version 5
 *
 * @group decorator
 *
 * @category  Decorator
 * @package   Decorator
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-decorator/tree/master/classes/decorator/core.php
 * @since     2011-12-07
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides base Decorator_Core
 *
 * PHP version 5
 *
 * @group decorator
 *
 * @category  Decorator
 * @package   Decorator
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-decorator/tree/master/classes/decorator/core.php
 */
abstract class Decorator_Core
{
  protected $_decorated = NULL; /** Decorated instance */


  /**
   * Instanciate a decorator
   *
   * @param Object $decorated instance of an object to decorate
   *
   * @return Decorator Decorator instance
   */
  protected function __construct($decorated)
  {
    $this->_decorated = $decorated;
  }


  /**
   * Decorates inner instance
   *
   * This method must be overloaded by specific decorator instance.
   *
   * @return mixed decorated output
   */
  abstract public function decorate();


  /**
   * Factory to instanciate a specific decorator
   *
   * @param Object $decorated instance of an object to decorate
   * @param string $type      optional type of decoration
   *
   * @return Decorator Decorator instance
   *
   * @throws Decorator_Exception Can't instanciate specific decorator: :classname class not found
   */
  public static function factory($decorated, $type = '')
  {
    $classname = 'Decorator_'.get_class($decorated);

    if ( ! empty($type))
    {
      $classname .= '_'.$type;
    }

    if ( ! class_exists($classname))
    {
      throw new Decorator_Exception(
          'Can\'t instanciate specific decorator: :classname class not found',
          array(':classname' => $classname)
      );
    }

    return new $classname($decorated);
  }

} // end class Decorator_Core