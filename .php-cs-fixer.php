<?php

use GD75\DoubleQuoteFixer\DoubleQuoteFixer;

$config = new PhpCsFixer\Config();

return $config
	->setRiskyAllowed(true)
	->setIndent("\t")
	->setRules([
		// Each line of multi-line DocComments must have an asterisk [PSR-5] and must be aligned with the first one.
		'align_multiline_comment' => true,
		// Each element of an array must be indented exactly once.
		'array_indentation' => true,
		// PHP arrays should be declared using the configured syntax.
		'array_syntax' => true,
		// PHP attributes declared without arguments must (not) be followed by empty parentheses.
		'attribute_empty_parentheses' => true,
		// Binary operators should be surrounded by space as configured.
		'binary_operator_spaces' => true,
		// There MUST be one blank line after the namespace declaration.
		'blank_line_after_namespace' => true,
		// Ensure there is no code on the same line as the PHP open tag and it is followed by a blank line.
		'blank_line_after_opening_tag' => true,
		// An empty line feed must precede any configured statement.
		'blank_line_before_statement' => true,
		// Putting blank lines between `use` statement groups.
		'blank_line_between_import_groups' => true,
		// Controls blank lines before a namespace declaration.
		'blank_lines_before_namespace' => true,
		// Braces must be placed as configured.
		'braces_position' => ['classes_opening_brace' => 'same_line', 'control_structures_opening_brace' => 'same_line', 'functions_opening_brace' => 'same_line'],
		// A single space or none should be between cast and variable.
		'cast_spaces' => ['space' => 'none'],
		// Class, trait and interface elements must be separated with one or none blank line.
		'class_attributes_separation' => ['elements' => ['const' => 'one', 'method' => 'one', 'property' => 'none', 'trait_import' => 'none', 'case' => 'none']],
		// Whitespace around the keywords of a class, trait, enum or interfaces definition should be one space.
		'class_definition' => true,
		// When referencing an internal class it must be written using the correct casing.
		'class_reference_name_casing' => true,
		// Namespace must not contain spacing, comments or PHPDoc.
		'clean_namespace' => true,
		// Using `isset($var) &&` multiple times should be done in one call.
		'combine_consecutive_issets' => true,
		// Calling `unset` on multiple items should be done in one call.
		'combine_consecutive_unsets' => true,
		// Remove extra spaces in a nullable type declaration.
		'compact_nullable_type_declaration' => true,
		// Concatenation should be spaced according to configuration.
		'concat_space' => ['spacing' => 'one'],
		// The PHP constants `true`, `false`, and `null` MUST be written using the correct casing.
		'constant_case' => true,
		// The body of each control structure MUST be enclosed within braces.
		'control_structure_braces' => true,
		// Control structure continuation keyword must be on the configured line.
		'control_structure_continuation_position' => true,
		// Equal sign in declare statement should be surrounded by spaces or not following configuration.
		'declare_equal_normalize' => true,
		// There must not be spaces around `declare` statement parentheses.
		'declare_parentheses' => true,
		// Replaces short-echo `<?=` with long format `<?php echo`/`<?php print` syntax, or vice-versa.
		'echo_tag_syntax' => ['format' => 'short'],
		// The keyword `elseif` should be used instead of `else if` so that all control keywords look like single words.
		'elseif' => true,
		// Empty loop-body must be in configured style.
		'empty_loop_body' => ['style' => 'braces'],
		// Add curly braces to indirect variables to make them clear to understand.
		'explicit_indirect_variable' => true,
		// PHP code must use the long `<?php` tags or short-echo `<?=` tags and not other tag variations.
		'full_opening_tag' => true,
		// Removes the leading part of fully qualified symbol references if a given symbol is imported or belongs to the current namespace.
		'fully_qualified_strict_types' => true,
		// Spaces should be properly placed in a function declaration.
		'function_declaration' => ['closure_fn_spacing' => 'none'],
		// Imports or fully qualifies global classes/functions/constants.
		'global_namespace_import' => ['import_constants' => true, 'import_functions' => true],
		// Include/Require and file path should be divided with a single space. File path should not be placed within parentheses.
		'include' => true,
		// Pre- or post-increment and decrement operators should be used if possible.
		'increment_style' => ['style' => 'post'],
		// Code MUST use configured indentation type.
		'indentation_type' => true,
		// Integer literals must be in correct case.
		'integer_literal_case' => true,
		// Lambda must not import variables it doesn't use.
		'lambda_not_used_import' => true,
		// All PHP files must use same line ending.
		'line_ending' => true,
		// Ensure there is no code on the same line as the PHP open tag.
		'linebreak_after_opening_tag' => true,
		// Use `&&` and `||` logical operators instead of `and` and `or`.
		'logical_operators' => true,
		// Cast should be written in lower case.
		'lowercase_cast' => true,
		// PHP keywords MUST be in lower case.
		'lowercase_keywords' => true,
		// Class static references `self`, `static` and `parent` MUST be in lower case.
		'lowercase_static_reference' => true,
		// Magic constants should be referred to using the correct casing.
		'magic_constant_casing' => true,
		// Magic method definitions and calls must be using the correct casing.
		'magic_method_casing' => true,
		// In method arguments and method call, there MUST NOT be a space before each comma and there MUST be one space after each comma. Argument lists MAY be split across multiple lines, where each subsequent line is indented once. When doing so, the first item in the list MUST be on the next line, and there MUST be only one argument per line.
		'method_argument_space' => ['attribute_placement' => 'same_line'],
		// Method chaining MUST be properly indented. Method chaining with different levels of indentation is not supported.
		'method_chaining_indentation' => true,
		// Classes, constants, properties, and methods MUST have visibility declared, and keyword modifiers MUST be in the following order: inheritance modifier (`abstract` or `final`), visibility modifier (`public`, `protected`, or `private`), set-visibility modifier (`public(set)`, `protected(set)`, or `private(set)`), scope modifier (`static`), mutation modifier (`readonly`), type declaration, name.
		'modifier_keywords' => true,
		// DocBlocks must start with two asterisks, multiline comments must start with a single asterisk, after the opening slash. Both must end with a single asterisk before the closing slash.
		'multiline_comment_opening_closing' => true,
		// Promoted properties must be on separate lines.
		'multiline_promoted_properties' => ['minimum_number_of_parameters' => 4],
		// Forbid multi-line whitespace before the closing semicolon or move the semicolon to the new line for chained calls.
		'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
		// Function defined by PHP should be called using the correct casing.
		'native_function_casing' => true,
		// Native type declarations should be used in the correct case.
		'native_type_declaration_casing' => true,
		// All `new` expressions with a further call must (not) be wrapped in parentheses.
		'new_expression_parentheses' => ['use_parentheses' => true],
		// All instances created with `new` keyword must (not) be followed by parentheses.
		'new_with_parentheses' => ['anonymous_class' => false, 'named_class' => false],
		// Master language constructs shall be used instead of aliases.
		'no_alias_language_construct_call' => true,
		// Replace control structure alternative syntax to use braces.
		'no_alternative_syntax' => true,
		// There should not be blank lines between docblock and the documented element.
		'no_blank_lines_after_phpdoc' => true,
		// There must be a comment when fall-through is intentional in a non-empty case body.
		'no_break_comment' => true,
		// The closing `? >` tag MUST be omitted from files containing only PHP.
		'no_closing_tag' => true,
		// There should not be any empty comments.
		'no_empty_comment' => true,
		// There should not be empty PHPDoc blocks.
		'no_empty_phpdoc' => true,
		// Remove useless (semicolon) statements.
		'no_empty_statement' => true,
		// Removes extra blank lines and/or blank lines following configuration.
		'no_extra_blank_lines' => true,
		// Remove leading slashes in `use` clauses.
		'no_leading_import_slash' => true,
		// The namespace declaration line shouldn't contain leading whitespace.
		'no_leading_namespace_whitespace' => true,
		// Either language construct `print` or `echo` should be used.
		'no_mixed_echo_print' => true,
		// Operator `=>` should not be surrounded by multi-line whitespaces.
		'no_multiline_whitespace_around_double_arrow' => true,
		// There must not be more than one statement per line.
		'no_multiple_statements_per_line' => true,
		// Short cast `bool` using double exclamation mark should not be used.
		'no_short_bool_cast' => true,
		// Single-line whitespace before closing semicolon are prohibited.
		'no_singleline_whitespace_before_semicolons' => true,
		// There must be no space around double colons (also called Scope Resolution Operator or Paamayim Nekudotayim).
		'no_space_around_double_colon' => true,
		// When making a method or function call, there MUST NOT be a space between the method or function name and the opening parenthesis.
		'no_spaces_after_function_name' => true,
		// There MUST NOT be spaces around offset braces.
		'no_spaces_around_offset' => true,
		// If a list of values separated by a comma is contained on a single line, then the last item MUST NOT have a trailing comma.
		'no_trailing_comma_in_singleline' => true,
		// There must be no trailing whitespace at the end of non-blank lines.
		'no_trailing_whitespace' => true,
		// There must be no trailing whitespace at the end of lines in comments and PHPDocs.
		'no_trailing_whitespace_in_comment' => true,
		// Removes unneeded braces that are superfluous and aren't part of a control structure's body.
		'no_unneeded_braces' => true,
		// Removes unneeded parentheses around control statements.
		'no_unneeded_control_parentheses' => true,
		// Imports should not be aliased as the same name.
		'no_unneeded_import_alias' => true,
		// Variables must be set `null` instead of using `(unset)` casting.
		'no_unset_cast' => true,
		// Unused `use` statements must be removed.
		'no_unused_imports' => true,
		// In array declaration, there MUST NOT be a whitespace before each comma.
		'no_whitespace_before_comma_in_array' => ['after_heredoc' => true],
		// Remove trailing whitespace at the end of blank lines.
		'no_whitespace_in_blank_line' => true,
		// Array index should always be written by using square braces.
		'normalize_index_brace' => true,
		// Nullable single type declaration should be standardised using configured syntax.
		'nullable_type_declaration' => true,
		// Adds or removes `?` before single type declarations or `|null` at the end of union types when parameters have a default `null` value.
		'nullable_type_declaration_for_default_null_value' => true,
		// There should not be space before or after object operators `->` and `?->`.
		'object_operator_without_whitespace' => true,
		// Operators - when multiline - must always be at the beginning or at the end of the line.
		'operator_linebreak' => ['only_booleans' => true],
		// Ordering `use` statements.
		'ordered_imports' => true,
		// PHPDoc should contain `@param` for all params.
		'phpdoc_add_missing_param_annotation' => true,
		// All items of the given PHPDoc tags must be either left-aligned or (by default) aligned vertically.
		'phpdoc_align' => true,
		// PHPDoc `array<T>` type must be used instead of `T[]`.
		'phpdoc_array_type' => true,
		// Docblocks should have the same indentation as the documented subject.
		'phpdoc_indent' => true,
		// Changes doc blocks from single to multi line, or reversed. Works for class constants, properties and methods only.
		'phpdoc_line_span' => true,
		// Annotations in PHPDoc should be ordered in defined sequence.
		'phpdoc_order' => true,
		// Annotations in PHPDoc should be grouped together so that annotations of the same type immediately follow each other. Annotations of a different type are separated by a single blank line.
		'phpdoc_separation' => true,
		// Forces PHPDoc tags to be either regular annotations or inline.
		'phpdoc_tag_type' => true,
		// PHPDoc should start and end with content, excluding the very first and last line of the docblocks.
		'phpdoc_trim' => true,
		// Removes extra blank lines after summary and after description in PHPDoc.
		'phpdoc_trim_consecutive_blank_line_separation' => true,
		// The correct case must be used for standard PHP types in PHPDoc.
		'phpdoc_types' => true,
		// Sorts PHPDoc types.
		'phpdoc_types_order' => ['null_adjustment' => 'always_last'],
		// `@var` and `@type` annotations must have type and name in the correct order.
		'phpdoc_var_annotation_correct_order' => true,
		// Local, dynamic and directly referenced variables should not be assigned and directly returned by a function or method.
		'return_assignment' => true,
		// Adjust spacing around colon in return type declarations and backed enum types.
		'return_type_declaration' => true,
		// Cast `(boolean)` and `(integer)` should be written as `(bool)` and `(int)`, `(double)` and `(real)` as `(float)`, `(binary)` as `(string)`.
		'short_scalar_cast' => true,
		// A PHP file without end tag must always end with a single empty line feed.
		'single_blank_line_at_eof' => true,
		// There MUST NOT be more than one property or constant declared per statement.
		'single_class_element_per_statement' => true,
		// There MUST be one use keyword per declaration.
		'single_import_per_statement' => true,
		// Each namespace use MUST go on its own line and there MUST be one blank line after the use statements block.
		'single_line_after_imports' => true,
		// Single-line comments must have proper spacing.
		'single_line_comment_spacing' => true,
		// Single-line comments and multi-line comments with only one line of actual content should use the `//` syntax.
		'single_line_comment_style' => true,
		// Empty body of class, interface, trait, enum or function must be abbreviated as `{}` and placed on the same line as the previous symbol, separated by a single space.
		'single_line_empty_body' => true,
		// Convert double quotes to single quotes for simple strings.
		'single_quote' => true,
		// Parentheses must be declared using the configured whitespace.
		'spaces_inside_parentheses' => true,
		// Replace all `<>` with `!=`.
		'standardize_not_equals' => true,
		// Each statement must be indented.
		'statement_indentation' => true,
		// A case should be followed by a colon and not a semicolon.
		'switch_case_semicolon_to_colon' => true,
		// Removes extra spaces between colon and case value.
		'switch_case_space' => true,
		// Switch case must not be ended with `continue` but with `break`.
		'switch_continue_to_break' => true,
		// Standardize spaces around ternary operator.
		'ternary_operator_spaces' => true,
		// Use `null` coalescing operator `??` where possible.
		'ternary_to_null_coalescing' => true,
		// Arrays should be formatted like function/method arguments, without leading or trailing single line space.
		'trim_array_spaces' => true,
		// Ensure single space between a variable and its type declaration in function arguments and properties.
		'type_declaration_spaces' => true,
		// A single space or none should be around union type and intersection type operators.
		'types_spaces' => ['space' => 'single'],
		// Unary operators should be placed adjacent to their operands.
		'unary_operator_spaces' => true,
		// In array declaration, there MUST be a whitespace after each comma.
		'whitespace_after_comma_in_array' => ['ensure_single_space' => true],
		// Custom fixer to convert single quotes to double quotes where possible
		"GD75/double_quote_fixer" => true,
	])
	->setFinder(PhpCsFixer\Finder::create()
		->in(__DIR__)
		// ->exclude([
		//     'folder-to-exclude',
		// ])
		// ->append([
		//     'file-to-include',
		// ])
	)
	->registerCustomFixers(
		[
			new DoubleQuoteFixer()
		]
	)
;
