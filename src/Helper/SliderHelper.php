<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_slider
 *
 * @copyright   Copyright (C) 2024 TLWebdesign. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace JoomlaDagen\Module\Slider\Site\Helper;

use Joomla\CMS\Application\SiteApplication;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Registry\Registry;

\defined('_JEXEC') or die;

/**
 * Helper for mod_slider
 *
 * @since  V1.0.0
 */
class SliderHelper implements DatabaseAwareInterface
{
    use DatabaseAwareTrait;

    /**
     * Retrieve sliders
     *
     * @param   Registry         $params  The module parameters
     * @param   SiteApplication  $app     The application
     *
     * @return  array
     *
     * @since   1.0.0
     */

    public function getSlides(Registry $params, SiteApplication $app): array
    {
        $slides = array();

        $factory = $app->bootComponent('com_content')->getMVCFactory();

        // Get an instance of the generic articles model
        $articles = $factory->createModel('Articles', 'Site', ['ignore_request' => true]);

        // Set application parameters in model
        $appParams = $app->getParams();
        $articles->setState('params', $appParams);

        // tijdelijke naam slides
        $slides = $articles->getItems();

        return $slides;
    }
}
