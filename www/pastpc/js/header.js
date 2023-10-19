import { setClicks, toggle } from './utils.mjs';

setClicks(toggleSearchBar, '.search-icon', '.close-icon');

function toggleSearchBar(e) {
    toggle('.search-bar-close', 'search-bar-open')
}