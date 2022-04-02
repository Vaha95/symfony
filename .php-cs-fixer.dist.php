<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,'@Symfony:risky' => true,
        '@PHP70Migration' => true,
        'array_syntax' => ['syntax' => 'short'],
        'dir_constant' => true,
        'heredoc_to_nowdoc' => true,
        'linebreak_after_opening_tag' => true,
        'modernize_types_casting' => true,
        'self_accessor' => false,
        'multiline_whitespace_before_semicolons' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => false,
        'ordered_imports' => true,
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => false],
        'phpdoc_order' => true,
        'declare_strict_types' => false,
        'doctrine_annotation_braces' => true,
        'doctrine_annotation_indentation' => true,
        'doctrine_annotation_spaces' => true,
        'psr_autoloading' => true,
        'no_php4_constructor' => true,
        'echo_tag_syntax' => true,
        'semicolon_after_instruction' => true,
        'align_multiline_comment' => true,
        'doctrine_annotation_array_assignment' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ["author", "package"]],
        'list_syntax' => ["syntax" => "short"],
        'phpdoc_types_order' => ['null_adjustment' => 'always_last'],
        'no_superfluous_phpdoc_tags' => false,
    ])
    ->setFinder($finder)
;
