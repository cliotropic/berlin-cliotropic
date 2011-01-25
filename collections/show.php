<?php head(array('title'=>collection('Name'), 'bodyid'=>'collections', 'bodyclass' => 'show')); ?>

<div id="primary">
    <h1><?php echo collection('Name'); ?></h1>


		<!-- Featured Item -->
    	<div class="item" id="featured-item">
    	    <?php echo berlin_ct_display_random_featured_collection_item(); ?>

    	</div><!--end featured-item-->	

    <?php echo plugin_append_to_collections_show(); ?>
    
</div><!-- end primary -->
<div id="secondary">
    <div id="description" class="element">
        <h2>Description</h2>
        <div class="element-text"><?php echo nls2p(collection('Description')); ?></div>
    </div><!-- end description -->
    
    <?php if (collection_has_collectors()): ?>
    <div id="collectors" class="element">
        <h2>Collector(s)</h2> 
        <div class="element-text">
            <ul>
                <li><?php echo collection('Collectors', array('delimiter'=>'</li><li>')); ?></li>
            </ul>
        </div>
    </div><!-- end collectors -->
    <?php endif; ?>
    <p class="view-items-link"><?php echo link_to_browse_items('View the items in ' . collection('Name'), array('collection' => collection('id'))); ?></p>
    
    
</div>

<div id="tertiary">

    <div id="collection-items" class="element">
        <h2>Selected Items</h2>
            
        <?php while (loop_items_in_collection(6)): ?>
			<div class="item hentry"> 
            
    		<h3><?php echo link_to_item(item('Dublin Core', 'Title'), array('class'=>'permalink')); ?></h3>
    		<?php if ($text = item('Item Type Metadata', 'Text', array('snippet'=>500))): ?>
    			<div class="item-description">
    			<p><?php echo $text; ?></p>
    			</div>
    		<?php elseif ($description = item('Dublin Core', 'Description', array('snippet'=>250))): ?>
    			<div class="item-description">
    			<?php echo $description; ?>
    			</div>
		    <?php endif; ?>

    		<?php if (item_has_thumbnail()): ?>
    		<div class="item-img">
    			<?php echo link_to_item(item_thumbnail(array('alt'=>item('Dublin Core', 'Title')))); ?>						
    		</div>
    		<?php endif; ?>

			</div>
		
    <?php endwhile; ?>
    </div><!-- end collection-items -->

</div>


<?php foot(); ?>
