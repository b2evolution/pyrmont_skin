<?php
/**
 * This is the template that displays the item block
 *
 * This file is not meant to be called directly.
 * It is meant to be called by an include in the main.page.php template (or other templates)
 *
 * b2evolution - {@link http://b2evolution.net/}
 * Released under GNU GPL License - {@link http://b2evolution.net/about/license.html}
 * @copyright (c)2003-2009 by Francois PLANQUE - {@link http://fplanque.net/}
 *
 * @package evoskins
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

global $Item;

// Default params:
$params = array_merge( array(
		'feature_block'			=> false,
		'content_mode'			=> 'auto',		// 'auto' will auto select depending on $disp-detail
		'item_class'			=> 'bPost',
		'image_size'			=> 'fit-400x320',
	), $params );

?>

<div class="clear"></div>
<div id="<?php $Item->anchor_id() ?>" class="<?php $Item->div_classes( $params ) ?>" lang="<?php $Item->lang() ?>">
  <?php $Item->locale_temp_switch() ?>
  <div class="date">
    <?php
	$Item->issue_date( array(
			'before'    => '',
			'after'     => '<br />',
			'date_format' => 'M/d',
		));
	
	$Item->issue_date( array(
			'before'    => '',
			'after'     => '',
			'date_format' => 'Y',
		));
	?>
  </div>
  <div class="bTitle">
    <div class="star_rating">
      <?php $Plugins->call_by_code( 'starrating', array('id' => $Item->ID ) ); ?>
    </div>
    <h2>
      <?php
	  $Item->edit_link( array(
			  'before'	=> '',
			  'after'	=> ' ',
			  'text'	=>	get_icon('edit'),
		  ) );
	  
	  $Item->title();
	  ?>
    </h2>
    <div class="postmeta">
      <?php
		$Item->categories( array(
			  'before'          => T_('Categories').': ',
			  'after'           => '',
			  'include_main'    => true,
			  'include_other'   => true,
			  'include_external'=> true,
			  'link_categories' => true,
		  ) );
		
		// List all tags attached to this post:
		$Item->tags( array(
			  'before'	=> ' / '.T_('Tags').': ',
			  'after'		=> '',
			  'separator'	=> ', ',
		  ) );
		
		// Link to comments, trackbacks, etc.:
		$Item->feedback_link( array(
			  'type'		=> 'comments',
			  'link_before'	=> ' / <span class="comments">',
			  'link_after'	=> '</span>',
			  'link_text_zero'	=> '#',
			  'link_text_one'	=> '#',
			  'link_text_more'	=> '#',
			  'link_title'		=> '#',
			  'use_popup'		=> false,
		  ) );
		?>
    </div>
  </div>
  <div class="clear"></div>
  <?php
	// POST CONTENT INCLUDED HERE
	skin_include( '_item_content.inc.php', $params );
	
	// "Post bottom" CONTAINER EMBEDDED HERE
	skin_container( NT_('Post bottom'), array(
			'block_start'	=>	'<div class="PostBottom">',
			'block_end'		=>	'</div>',
		) );
	?>
</div>
<?php
// FEEDBACK (COMMENTS/TRACKBACKS) INCLUDED HERE
skin_include( '_item_feedback.inc.php', array(
		'before_section_title'	=> '<div class="comment_section_title">',
		'after_section_title'	=> '</div>',
		'form_title_start'		=> '<div class="comment_form_title">',
		'form_title_end'		=> '</div>',
		'comment_list_start'	=> '',
		'comment_list_end'		=> '',
	) );

locale_restore_previous();
?>
