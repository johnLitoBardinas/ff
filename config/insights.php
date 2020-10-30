<?php

declare(strict_types=1);

use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenDefineFunctions;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenFinalClasses;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenPrivateMethods;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits;
use NunoMaduro\PhpInsights\Domain\Metrics\Architecture\Classes;
use SlevomatCodingStandard\Sniffs\Commenting\UselessFunctionDocCommentSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\AlphabeticallySortedUsesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DisallowMixedTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Preset
    |--------------------------------------------------------------------------
    |
    | This option controls the default preset that will be used by PHP Insights
    | to make your code reliable, simple, and clean. However, you can always
    | adjust the `Metrics` and `Insights` below in this configuration file.
    |
    | Supported: "default", "laravel", "symfony", "magento2", "drupal"
    |
    */

    'preset' => 'laravel',
    /*
    |--------------------------------------------------------------------------
    | IDE
    |--------------------------------------------------------------------------
    |
    | This options allow to add hyperlinks in your terminal to quickly open
    | files in your favorite IDE while browsing your PhpInsights report.
    |
    | Supported: "textmate", "macvim", "emacs", "sublime", "phpstorm",
    | "atom", "vscode".
    |
    | If you have another IDE that is not in this list but which provide an
    | url-handler, you could fill this config with a pattern like this:
    |
    | myide://open?url=file://%f&line=%l
    |
    */

    'ide' => null,
    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may adjust all the various `Insights` that will be used by PHP
    | Insights. You can either add, remove or configure `Insights`. Keep in
    | mind that all added `Insights` must belong to a specific `Metric`.
    |
    */

    'exclude' => [
        //  'path/to/directory-or-file'
    ],

    'add' => [
        Classes::class => [
            ForbiddenFinalClasses::class,
        ],
    ],

    'remove' => [
        AlphabeticallySortedUsesSniff::class,
        DeclareStrictTypesSniff::class,
        DisallowMixedTypeHintSniff::class,
        ForbiddenDefineFunctions::class,
        ForbiddenNormalClasses::class,
        ForbiddenTraits::class,
        ParameterTypeHintSniff::class,
        PropertyTypeHintSniff::class,
        ReturnTypeHintSniff::class,
        UselessFunctionDocCommentSniff::class,
        ObjectCalisthenics\Sniffs\Classes\ForbiddenPublicPropertySniff::class,
        SlevomatCodingStandard\Sniffs\ControlStructures\DisallowEmptySniff::class,
        PHP_CodeSniffer\Standards\PSR1\Sniffs\Methods\CamelCapsMethodNameSniff::class,
        PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer::class
    ],

    'config' => [
        ForbiddenPrivateMethods::class => [
            'title' => 'The usage of private methods is not idiomatic in Laravel.',
        ],
        \ObjectCalisthenics\Sniffs\Metrics\MethodPerClassLimitSniff::class => [
            'maxCount' => 13,
        ],
        \NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh::class => [
            'maxComplexity' => 6,
        ],
        \PhpCsFixer\Fixer\Import\OrderedImportsFixer::class => [
            'sort_algorithm' => 'alpha', // possible values ['alpha', 'length', 'none']
        ],
        \PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff::class => [
            'lineLimit' => 110,
            'absoluteLineLimit' => 120,
            'ignoreComments' => false,
        ],
        \PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer::class => [
            'order' => [ // List of strings defining order of elements.
                'use_trait',
                'constant_protected',
                'constant_private',
                'constant_public',
                'property_protected',
                'property_private',
                'property_public',
                'construct',
                'destruct',
                'magic',
                'phpunit',
                'method_protected',
                'method_private',
                'method_public',
            ],
            'sortAlgorithm' => 'none' // possible values ['none', 'alpha']
        ],
        \PhpCsFixer\Fixer\Basic\BracesFixer::class => [
            'allow_single_line_closure' => true,
            'position_after_anonymous_constructs' => 'same', // possible values ['same', 'next']
            'position_after_control_structures' => 'same', // possible values ['same', 'next']
            'position_after_functions_and_oop_constructs' => 'next', // possible values ['same', 'next']
        ],
        \ObjectCalisthenics\Sniffs\Files\FunctionLengthSniff::class => [
            'maxLength' => 66,
        ],
        \ObjectCalisthenics\Sniffs\NamingConventions\ElementNameMinimalLengthSniff::class => [
            'minLength' => 3,
            'allowedShortNames' => ['i', 'id', 'to', 'up', 'IN', 'OUT'],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Requirements
    |--------------------------------------------------------------------------
    |
    | Here you may define a level you want to reach per `Insights` category.
    | When a score is lower than the minimum level defined, then an error
    | code will be returned. This is optional and individually defined.
    |
    */

    'requirements' => [
       'min-quality' => 88,
       'min-complexity' => 88,
       'min-architecture' => 88,
       'min-style' => 88,
       'disable-security-check' => false,
    ],

];
