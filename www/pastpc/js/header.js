import { setClicks, toggleClass, hasClass, select, setClick } from './utils.mjs'

setClicks(toggleSearchBar, '.search-icon', '.search-close-icon')
setClicks(toggleMenuBar, '.burger-icon', '.menu-close-icon')
setClick(submitSearch, '.submit-search-icon')

function toggleSearchBar(e) {
    if (!hasClass('.slideout-menu', 'slideout-menu-open'))
        toggleClass('.search-bar-close', 'search-bar-open')
    select('.search-input').value = ''
}
function toggleMenuBar(e) {
    if (!hasClass('.search-bar', 'search-bar-open'))
        toggleClass('.slideout-menu-close', 'slideout-menu-open')
}
function submitSearch(e) {
    select('.search-bar-form').submit()
}