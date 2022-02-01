<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <label for="search-input" class="is-sr-only">Search for:</label>
    <input type="text" placeholder="What can we help you find?" id="search-input" name="s" value="<?php echo esc_attr(get_search_query()); ?>" />
    <button type="submit">Search</button>
</form>