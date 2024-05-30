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
use Joomla\CMS\HTML\HTMLHelper;

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

        $items = $articles->getItems();

        foreach ($items as $item) {
            $images = json_decode($item->images);

            if ($images !== null && isset($images->image_intro)) {
                $slide = new \stdClass();

                $image = new \stdClass();
                $cleanImageUrl = HTMLHelper::_('cleanImageURL', $images->image_intro);
                $image->url   = $cleanImageUrl->url;
                $image->height = $cleanImageUrl->attributes['height'];
                $image->width = $cleanImageUrl->attributes['width'];
                $image->caption = $images->image_intro_caption;
                $image->alt     = $images->image_intro_alt;
                $slide->image = $image;

                $slide->title = $item->title;

                $slides[] = $slide;
            }
        }

        return $slides;
    }
}
