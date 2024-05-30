<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_slider
 *
 * @copyright   Copyright (C) 2024 TLWebdesign. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('bootstrap.carousel', 'prettySliderCarousel' . $module->id);

$slideCounter = 0;
$autoPlay = $params->get("autoplay", null);
?>

<div class="prettySliderWrapper">
    <div id="prettySliderCarousel<?php echo $module->id; ?>"
         class="carousel slide"
         data-bs-ride="carousel"
         style="max-height">
        <div class="carousel-inner">
            <?php
            foreach ($slides as $slide) :
                ?>
                <div class="carousel-item <?php
                echo ($slideCounter == 0) ? 'active' : ''; ?>"
                     style="flex: 0 0 100%;">
                    <div class="w-100 h-100">
                        <img src="<?php
                        echo $slide->image->url; ?>"
                             class="w-100 h-auto"
                             width="<?php echo $slide->image->width; ?>"
                             height="<?php echo $slide->image->height; ?>"
                        >
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="text-white">
                                <?php
                                echo $slide->title; ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
                $slideCounter++; ?>
                <?php
            endforeach; ?>
        </div>
        <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#prettySliderCarousel<?php
                echo $module->id; ?>"
                data-bs-slide="prev"
        >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php
                echo Text::_('JPREVIOUS'); ?></span>
        </button>
        <button class="carousel-control-next"
                type="button"
                data-bs-target="#prettySliderCarousel<?php
                echo $module->id; ?>"
                data-bs-slide="next"
        >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php
                echo Text::_('JNEXT'); ?></span>
        </button>
    </div>
</div>