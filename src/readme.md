# This is learning Gutenberg block

simple realisation of Todo block that stores information to meta field 
*_mytheme_blocks_todo_list*

I'm register custom post todo and include custom-fields to support argument:

"supports" => ["custom-fields" ]

## USE

Add new todo post.
Next add  "Meta todo list block"

You can check meta data by calling in console:

wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' );

## Problem
Data don't save in database