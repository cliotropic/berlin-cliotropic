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


