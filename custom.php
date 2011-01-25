<?php 
// Use this file to define customized helper functions, filters or 'hacks' defined
// specifically for use in your Omeka theme. Note that helper functions that are
// designed for portability across themes should be grouped into a plugin whenever
// possible. Ideally, you should namespace these with your theme name.

function berlin_ct_display_stats_code()
{
    if ($stats = get_theme_option('stats_code')) {
       return $stats_code;
    } else { return "pants";}
}

 function berlin_ct_display_random_featured_item($withImage=false)
 {
    $featuredItem = random_featured_item($withImage);
 	$html = '<h2>Featured Item</h2>';
 	if ($featuredItem) {
 	    $itemTitle = item('Dublin Core', 'Title', array(), $featuredItem);
        
 	   $html .= '<h3>' . link_to_item($itemTitle, array(), 'show', $featuredItem) . '</h3>';
 	   if (item_has_thumbnail($featuredItem)) {
 	       $html .= link_to_item(item_thumbnail(array(), 0, $featuredItem), array('class'=>'image'), 'show', $featuredItem);
 	   }
 	   // Grab the 1st Dublin Core description field (first 150 characters)
 	   if ($itemDescription = item('Dublin Core', 'Description', array('snippet'=>500), $featuredItem)) {
 	       $html .= '<p class="item-description">' . $itemDescription . '</p>';
       }
 	} else {
 	   $html .= '<p>No featured items are available.</p>';
 	}

     return $html;
 }
 

function berlin_ct_display_random_featured_collection()
{
    $featuredCollection = random_featured_collection();
    $html = '<h2>Featured Collection</h2>';
    if ($featuredCollection) {
        $html .= '<h3>' . link_to_collection($collectionTitle, array(), 'show', $featuredCollection) . '</h3>';
        if ($collectionDescription = collection('Description', array('snippet'=>800), $featuredCollection)) {
            $html .= '<p class="collection-description">' . $collectionDescription . '</p>';
        }
        
    } else {
        $html .= '<p>No featured collections are available.</p>';
    }
    return $html;
}

function berlin_ct_display_random_featured_collection_item()
{
		$collname = get_current_collection()->name;
		$featuredItem = 0;
		$html = '<h2>Featured Item From This Collection</h2>';
		while ($featuredItem == 0) {
			$candidate_item = random_featured_item();
			if (item_belongs_to_collection($collname, $candidate_item)) {
				$featuredItem = $candidate_item;
			}
		}
		// Swiped from ItemFunctions.php
		if ($featuredItem) {
 	    $itemTitle = item('Dublin Core', 'Title', array(), $featuredItem);
        
 	   $html .= '<h3>' . link_to_item($itemTitle, array(), 'show', $featuredItem) . '</h3>';
 	   if (item_has_thumbnail($featuredItem)) {
 	       $html .= link_to_item(item_thumbnail(array(), 0, $featuredItem), array('class'=>'image'), 'show', $featuredItem);
 	   }
 	   // Grab the 1st Dublin Core description field (first 1000 characters)
 	   if ($itemDescription = item('Dublin Core', 'Description', array('snippet'=>1000), $featuredItem)) {
 	       $html .= '<p class="item-description">' . $itemDescription . '</p>';
       }
	 	} else {
 		   $html .= '<p>No featured items are available.</p>';
 		}

     return $html;
}

function custom_show_item_metadata(array $options = array(), $item = null) {
    if (!$item) {
        $item = get_current_item();
    }
		if ($dcFieldsList = get_theme_option('display_dublin_core_fields')) {
		    $html = '';
	  	  $dcFields = explode(',', $dcFieldsList);
	   	 	foreach ($dcFields as $field) {
	        	$field = trim($field);
	        	if (element_exists('Dublin Core', $field)) {
    	      	  if ($fieldValue = item('Dublin Core', $field)) {
    	        	    $html .= '<h3>'.$field.'</h3>';
    	          	  if (!item_field_uses_html('Dublin Core', $field)) {
    	            	    $fieldValue = nls2p($fieldValue);
    	            	}
    	            	$html .= $fieldValue;
	            
    	        	}
    	    	}
	    	}
				if ($zotFieldsList = get_theme_option('display_zotero_metadata_fields')) {
						$zotFields = explode(',', $zotFieldsList);
						foreach ($zotFields as $field) {
								$field = trim($field);
								if (element_exists('Zotero', $field)) {
										if ($fieldValue = item('Zotero', $field)) {
												$html .= '<h3>'.$field.'</h3>';
												if (!item_field_uses_html('Zotero', $field)) {
														$fieldValue = nls2p($fieldValue);
												}
												$html .= $fieldValue;
								
										}
								}
						}
				}
	    	$html .= show_item_metadata(array('show_element_sets' => array('Item Type Metadata')) );
	    
	    	return $html;
		} else {
	   	 return show_item_metadata($options, $item); 
    }
}


