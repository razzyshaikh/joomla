<?php
/**
 * @package     FOF
 * @copyright Copyright (c)2010-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 2 or later
 */

namespace FOF30\Controller\Exception;

defined('_JEXEC') or die;

/**
 * Exception thrown when we can't find a suitable method to handle the requested task
 */
class TaskNotFound extends \InvalidArgumentException {}
