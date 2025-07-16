<?php

namespace ElementsHiveForBreakdance;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "ElementsHiveForBreakdance\\OrbitingIconsItem",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class OrbitingIconsItem extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'CircleIcon';
    }

    static function tag()
    {
        return 'div';
    }

    static function tagOptions()
    {
        return [];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'Orbiting Icons Item';
    }

    static function className()
    {
        return 'eh-orbiting-icons-item';
    }

    static function category()
    {
        return 'elements_hive';
    }

    static function badge()
    {
        return ['backgroundColor' => 'var(--yellow300)', 'textColor' => 'var(--black)', 'label' => 'EH'];
    }

    static function slug()
    {
        return __CLASS__;
    }

    static function template()
    {
        return file_get_contents(__DIR__ . '/html.twig');
    }

    static function defaultCss()
    {
        return file_get_contents(__DIR__ . '/default.css');
    }

    static function defaultProperties()
    {
        return false;
    }

    static function defaultChildren()
    {
        return false;
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [c(
        "icons",
        "Icons",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "circle_path",
        "Circle Path",
        [c(
        "radius",
        "Radius",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']], 'rangeOptions' => ['min' => 50, 'max' => 300, 'step' => 1]],
        true,
        false,
        [],
      ), c(
        "stroke_color",
        "Stroke Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "stroke_width",
        "Stroke Width",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 5, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "apply_glow",
        "Apply Glow",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "animation",
        "Animation",
        [c(
        "direction",
        "Direction",
        [],
        ['type' => 'button_bar', 'layout' => 'inline', 'items' => [['value' => 'normal', 'text' => 'Normal', 'icon' => 'ArrowRightIcon'], ['value' => 'reverse', 'text' => 'Reverse', 'icon' => 'ArrowLeftIcon']]],
        true,
        false,
        [],
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']], 'rangeOptions' => ['min' => 1, 'max' => 20, 'step' => 1]],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "position",
        "Position",
        [c(
        "position",
        "Position",
        [],
        ['type' => 'focus_point', 'layout' => 'vertical'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      )];
    }

    static function contentControls()
    {
        return [c(
        "content",
        "Content",
        [c(
        "icons",
        "Icons",
        [c(
        "icon",
        "Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "style_overrides",
        "Style Overrides",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'unitOptions' => ['types' => []], 'rangeOptions' => ['min' => 40, 'max' => 100, 'step' => 1], 'condition' => [[['path' => '%%CURRENTPATH%%.style_overrides', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'vertical', 'condition' => [[['path' => '%%CURRENTPATH%%.style_overrides', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'vertical', 'condition' => [[['path' => '%%CURRENTPATH%%.style_overrides', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['condition' => [[['path' => '%%CURRENTPATH%%.style_overrides', 'operand' => 'is set', 'value' => '']]], 'type' => 'popout']
     )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '', 'defaultTitle' => 'Icon', 'buttonName' => 'Add Icon']],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return false;
    }

    static function settings()
    {
        return false;
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return false;
    }

    static function nestingRule()
    {
        return ["type" => "final", "restrictedToBeADirectChildOf" => ['ElementsHiveForBreakdance\OrbitingCircles', 'ElementsHiveForBreakdance\OrbitingIcons'],  ];
    }

    static function spacingBars()
    {
        return false;
    }

    static function attributes()
    {
        return false;
    }

    static function experimental()
    {
        return false;
    }

    static function order()
    {
        return 10;
    }

    static function dynamicPropertyPaths()
    {
        return [];
    }

    static function additionalClasses()
    {
        return [['name' => 'eh-orbit-animation-reversed', 'template' => '{% if design.animation.direction|default(\'forward\') == \'reversed\' %}
  true
{% endif %}']];
    }

    static function projectManagement()
    {
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
