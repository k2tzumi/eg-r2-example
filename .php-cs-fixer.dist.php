<?php

declare(strict_types=1);

use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        __DIR__ . '/bootstrap',
    ])
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/public',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        // Base rule ------------------
        '@PSR2' => true,
        'strict_param' => true,

        // header ------------------
        'linebreak_after_opening_tag' => true, // Insert a line break after the opening tag to ensure no code is on the same line as the opening tag
        'no_leading_namespace_whitespace' => true, // Remove spaces before the namespace

        'no_unused_imports' => true, // Remove unused use statements

        // comment ------------------
        'align_multiline_comment' => true, // Align multiline comments /* */

        'no_empty_comment' => true, // Remove empty comments
        'no_empty_phpdoc' => true, // Remove empty PHPDoc comments
        'no_empty_statement' => true, // Remove empty statements like ;;

        // array ------------------
        'array_syntax' => ['syntax' => 'short'], // Convert array() to []
        'array_indentation' => true, // Align array indentation

        'no_superfluous_elseif' => true, // Remove unnecessary commas in the list function
        'no_multiline_whitespace_around_double_arrow' => true, // Prohibit multiline spaces around =>
        'no_trailing_comma_in_singleline_array' => true, // Remove unnecessary commas in single-line arrays
        'no_whitespace_before_comma_in_array' => true, // Prohibit spaces before commas in arrays

        // syntax ------------------
        'elseif' => true, // Convert 'else if' to 'elseif'
        'compact_nullable_typehint' => true, // Convert '? int' to '?int'
        'function_typehint_space' => true, // Add missing spaces in function return type declarations

        // space, line ------------------

        // Remove various blank lines
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_break_comment' => false,

        'method_argument_space' => [
            'ensure_fully_multiline' => true, // Ensure one argument per line when spanning multiple lines
            'keep_multiple_spaces_after_comma' => false, // Do not allow multiple spaces after a comma (false to convert multiple spaces to a single space)
        ],

        // Remove unnecessary blank lines
        'no_extra_blank_lines' => [
            'tokens' => ['extra', 'use'],
        ],

        'no_whitespace_in_blank_line' => true, // Prohibit spaces in blank lines

        // Insert a blank line before specific keywords
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'continue',
                'declare',
                'return',
                'throw',
                'try',
            ],
        ],

        // Insert a single space after a colon
        'return_type_declaration' => true,

        // Specific rule

        '@PHP80Migration:risky' => true,
        '@PHP81Migration' => true,
        '@PhpCsFixer:risky' => true,

        // Insert a single blank line before the namespace. Not used in Kantan Seikyu.
        'no_blank_lines_before_namespace' => false,
        'single_blank_line_before_namespace' => true,

        // Position of semicolons
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],

        // Around arrays
        'binary_operator_spaces' => [
            'operators' => [
                '=>' => 'single_space', // 'align', do not align =>
                '=' => 'single_space', // do not align =
            ],
        ],

        // Insert a space before comments
        'single_line_comment_spacing' => true,

        // Indentation of phpdoc
        'phpdoc_align' => [
            'align' => 'left',
        ],

        // Whether to hide unnecessary phpdoc
        'no_superfluous_phpdoc_tags' => false,

        // Whether to remove @package from phpdoc
        'phpdoc_no_package' => false,
        'general_phpdoc_annotation_remove' => [
            'annotations' => ['author'],
        ],

        // Remove unnecessary namespace settings
        'fully_qualified_strict_types' => true,

        // Add void return type
        'is_null' => true,

        // Yoda style settings
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ],

        // Handling of {} in anonymous classes
        'curly_braces_position' => [
            'anonymous_classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
        ],

        // Use @test in tests
        'php_unit_test_annotation' => [
            'style' => 'annotation',
        ],

        // Whether to enforce strictness on the asset method is left to the developer
        'php_unit_strict' => [
            'assertions' => [],
        ],

        // Do not enforce === for comparisons. Left to the developer
        'strict_comparison' => false,

        // Remove trailing comma in single-line cases
        'no_trailing_comma_in_singleline' => true,

        // Sort use statements
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => [
                'const',
                'class',
                'function',
            ],
        ],

        // Do not group use statements
        'blank_line_between_import_groups' => false,

        // Do not sort traits
        'ordered_traits' => false,

        // Use the list function
        'list_syntax' => [
            'syntax' => 'long',
        ],

        // Use single quotes
        'single_quote' => true,

        // Use static function, static fun when possible
        'static_lambda' => true,

        // Settings for variable interpolation in strings
        'simple_to_complex_string_variable' => true,

        // Space settings after function, fn
        'function_declaration' => [
            'closure_function_spacing' => 'one',
            'closure_fn_spacing' => 'one',
        ],

        // Method call style in PHPUnit
        'php_unit_test_case_static_method_calls' => [
            'call_type' => 'self',
        ],

        // Follow PSR12 rules and use one line per use HogeTrait
        'single_trait_insert_per_statement' => true,

        // Data provider names must match the test names
        'php_unit_data_provider_name' => false,

        // Replace homoglyphs (non-ASCII characters) mistakenly used in names @see https://cs.symfony.com/doc/rules/naming/no_homoglyph_names.html
        'no_homoglyph_names' => false,
    ])
    ->setFinder($finder)
    ->setUsingCache(true)
    ->setParallelConfig(ParallelConfigFactory::detect());
