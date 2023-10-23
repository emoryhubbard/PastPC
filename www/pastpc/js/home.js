import { toggleClasses, hasClass, select, setClick } from './utils.mjs'

setClick(toggleSearchBar, '.find-a-pc')

function toggleSearchBar(e) {
    if (!hasClass('.slideout-menu', '.slideout-menu-open'))
        toggleClasses('.search-bar', '.search-bar-close', '.search-bar-open')
    if (hasClass('.search-bar', '.search-bar-open'))
        select('.search-input').focus()
    select('.search-input').value = ''
}