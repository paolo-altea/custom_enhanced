<?php

/**
 * @package     Jexit.Site
 * @subpackage  mod_custom_enhanced
 *
 * @copyright   (C) 2025 Altea Software srl
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Jexit\Module\CustomEnhanced\Site\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\HTML\HTMLHelper;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Dispatcher class for mod_custom_enhanced
 *
 * @since  1.0.0
 */
class Dispatcher extends AbstractModuleDispatcher
{
    /**
     * Returns the layout data.
     *
     * @return  array
     *
     * @since   1.0.0
     */
    protected function getLayoutData(): array
    {
        $data = parent::getLayoutData();

        if ($data['params']->get('prepare_content', 0)) {
            $data['module']->content = HTMLHelper::_('content.prepare', $data['module']->content, '', 'mod_custom_enhanced.content');
        }

        return $data;
    }
}