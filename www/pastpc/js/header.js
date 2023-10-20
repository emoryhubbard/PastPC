import { setClicks, toggleClass, hasClass } from './utils.mjs'

setClicks(toggleSearchBar, '.search-icon', '.search-close-icon')
setClicks(toggleMenuBar, '.burger-icon', '.menu-close-icon')

function toggleSearchBar(e) {
    if (!hasClass('.slideout-menu', 'slideout-menu-open'))
        toggleClass('.search-bar-close', 'search-bar-open')
}
function toggleMenuBar(e) {
    if (!hasClass('.search-bar', 'search-bar-open'))
        toggleClass('.slideout-menu-close', 'slideout-menu-open')
}