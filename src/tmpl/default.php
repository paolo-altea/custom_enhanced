<?php

/**
 * @package     Jexit.Site
 * @subpackage  mod_custom_enhanced
 *
 * @copyright   (C) 2025 Altea Software srl
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId = 'mod-custom-enhanced-' . $module->id;

$images = $params->get('images');
if (is_string($images)) {
    $decoded = json_decode($images, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $images = $decoded;
    }
}
if (is_object($images)) {
    $images = (array) $images;
}
if (!is_array($images)) {
    $images = [];
}

// Normalizzazione unica: cast ad array e filtro immagini vuote
$images = array_values(array_filter(array_map(static function ($item) {
    $item = (array) $item;
    return !empty($item['image']) ? $item : null;
}, $images)));

?>

<div id="<?php echo htmlspecialchars($modId, ENT_QUOTES, 'UTF-8'); ?>" class="mod-custom-enhanced custom">
    <?php if (!empty($images)) : ?>
        <div class="mod-custom-enhanced__media">
            <?php foreach ($images as $item) : ?>
                <?php
                $image = $item['image'];
                $imageAlt = $item['image_alt'] ?? '';
                $imageMobile = $item['image_mobile'] ?? null;

                $imageData = HTMLHelper::_('cleanImageURL', $image);
                $imageUrl = Uri::root(true) . '/' . $imageData->url;
                $imageWidth = $imageData->attributes['width'] ?? null;
                $imageHeight = $imageData->attributes['height'] ?? null;
                $imageMobileUrl = $imageMobile
                    ? Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $imageMobile)->url
                    : null;
                ?>
                <picture class="mod-custom-enhanced__picture">
                    <?php if ($imageMobileUrl) : ?>
                        <source media="(max-width: 768px)" srcset="<?php echo htmlspecialchars($imageMobileUrl, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php endif; ?>
                    <img
                        src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>"
                        alt="<?php echo htmlspecialchars($imageAlt, ENT_QUOTES, 'UTF-8'); ?>"
                        <?php if ($imageWidth && $imageHeight) : ?>
                            width="<?php echo htmlspecialchars((string) $imageWidth, ENT_QUOTES, 'UTF-8'); ?>"
                            height="<?php echo htmlspecialchars((string) $imageHeight, ENT_QUOTES, 'UTF-8'); ?>"
                        <?php endif; ?>
                        class="mod-custom-enhanced__image"
                        loading="lazy"
                    >
                </picture>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($module->content) : ?>
        <div class="mod-custom-enhanced__content">
            <?php echo $module->content; ?>
        </div>
    <?php endif; ?>
</div>
